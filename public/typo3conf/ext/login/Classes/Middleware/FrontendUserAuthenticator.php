<?php
namespace Webicorns\Login\Middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerAwareInterface;
use TYPO3\CMS\Core\Authentication\AbstractUserAuthentication;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\UserAspect;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Webicorns\Login\Authentication\FrontendUserAuthentication;

class FrontendUserAuthenticator implements MiddlewareInterface
{
    /**
     * @var Context
     */
    protected $context;

    /** @var ResponseFactoryInterface */
    private $responseFactory;

    public function __construct(Context $context, ResponseFactoryInterface $responseFactory)
    {
        $this->context = $context;
        $this->responseFactory = $responseFactory;
    }

    /**
     * Creates a frontend user authentication object, tries to authenticate a user and stores
     * it in the current request as attribute.
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $frontendUser = GeneralUtility::makeInstance(FrontendUserAuthentication::class);

         if($request->getMethod() == "GET") {
            // List of page IDs where to look for frontend user records
            $pid = $request->getParsedBody()['pid'] ?? $request->getQueryParams()['pid'] ?? 0;
            if(!$pid && array_key_exists('pid', $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['login'])) {
                $pid = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['login']['pid'];
            }
            if ($pid) {
                $frontendUser->checkPid_value = implode(',', GeneralUtility::intExplode(',', $pid));
            }

            // Check if a session is transferred, and update the cookie parameters
            $frontendSessionKey = $request->getParsedBody()['FE_SESSION_KEY'] ?? $request->getQueryParams()['FE_SESSION_KEY'] ?? '';
            if ($frontendSessionKey) {
                $request = $this->transferFrontendUserSession($frontendUser, $request, $frontendSessionKey);
            }

            // Authenticate now
            $frontendUser->start();
            $frontendUser->unpack_uc();

            // Register the frontend user as aspect and within the session
            $this->setFrontendUserAspect($frontendUser);

            if(GeneralUtility::_GP($frontendUser->formfield_uname) && GeneralUtility::_GP($frontendUser->formfield_uident)) {
                $responseData = new \StdClass();
                $responseData->status = 'error';

                $response = $this->responseFactory->createResponse()
                    ->withHeader('Content-Type', 'application/json; charset=utf-8')
                    ->withHeader('Access-Control-Allow-Origin', '*')
                    ->withStatus('403', 'Credentials incorrect');
                $response->getBody()->write(json_encode($responseData));
            } else {
                $response = $handler->handle($request);
            }
            // Store session data for fe_users if it still exists
            if ($frontendUser instanceof FrontendUserAuthentication) {
                $frontendUser->storeSessionData();

                if(GeneralUtility::_GP($frontendUser->formfield_uname) && GeneralUtility::_GP($frontendUser->formfield_uident)) {
                    if($frontendUser->user != NULL) {
                        /*    $responseData->status = 'success';
                            $responseData->user = new \StdClass();
                            $responseData->user->username = $frontendUser->user['username'];
                            $responseData->user->first_name = $frontendUser->user['first_name'];
                            $responseData->user->last_name = $frontendUser->user['last_name'];
                            $responseData->user->email = $frontendUser->user['email'];*/
                        $responseData = $frontendUser->user;
                        $response = $this->responseFactory->createResponse()
                            ->withHeader('Content-Type', 'application/json; charset=utf-8')
                            ->withHeader('Access-Control-Allow-Origin', '*')
                            ->withStatus('200', 'Succesfully authorized');

                        $response->getBody()->write(json_encode($responseData));
                    }
                }
            }
        } else {
            $response = $handler->handle($request);
        }

        return $response;
    }

    /**
     * It's possible to transfer a frontend user session via a GET/POST parameter 'FE_SESSION_KEY'.
     * In the future, this logic should be moved into the FrontendUserAuthentication object directly,
     * but only if FrontendUserAuthentication does not request superglobals (like $_COOKIE) anymore.
     *
     * @param \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication $frontendUser
     * @param ServerRequestInterface $request
     * @param string $frontendSessionKey
     * @return ServerRequestInterface
     */
    protected function transferFrontendUserSession(
        FrontendUserAuthentication $frontendUser,
        ServerRequestInterface $request,
        string $frontendSessionKey
    ): ServerRequestInterface {
        [$sessionId, $hash] = explode('-', $frontendSessionKey);
        // If the session key hash check is OK, set the cookie
        if (hash_equals(md5($sessionId . '/' . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']), (string)$hash)) {
            $cookieName = FrontendUserAuthentication::getCookieName();

            // keep the global cookie overwriting for now, as long as FrontendUserAuthentication does not
            // use the request object for fetching the cookie information.
            $_COOKIE[$cookieName] = $sessionId;
            if (isset($_SERVER['HTTP_COOKIE'])) {
                // See https://forge.typo3.org/issues/27740
                $_SERVER['HTTP_COOKIE'] .= ';' . $cookieName . '=' . $sessionId;
            }
            // Add the cookie to the Server Request object
            $cookieParams = $request->getCookieParams();
            $cookieParams[$cookieName] = $sessionId;
            $request = $request->withCookieParams($cookieParams);
            $frontendUser->forceSetCookie = true;
            $frontendUser->dontSetCookie = false;
        }
        return $request;
    }

    /**
     * Register the frontend user as aspect
     *
     * @param AbstractUserAuthentication $user
     */
    protected function setFrontendUserAspect(AbstractUserAuthentication $user)
    {
        $this->context->setAspect('frontend.user', GeneralUtility::makeInstance(UserAspect::class, $user));
    }
}
