<?php
namespace Webicorns\Login\Authentication;


use TYPO3\CMS\Core\Authentication\LoginType;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class FrontendUserAuthentication extends \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication
{
    /**
     * Form field with login-name
     * @var string
     */
    public $formfield_uname = 'user';

    /**
     * Form field with password
     * @var string
     */
    public $formfield_uident = 'pass';

    /**
     * Form field with status: *'login', 'logout'. If empty login is not verified.
     * @var string
     */
    public $formfield_status = 'logintype';

    /**
     * Returns an info array with Login/Logout data submitted by a form or params
     *
     * @return array
     * @internal
     */
    public function getLoginFormData()
    {
        $loginData = [
            'status' => GeneralUtility::_GP($this->formfield_status),
            'uname'  => GeneralUtility::_GP($this->formfield_uname),
            'uident' => GeneralUtility::_GP($this->formfield_uident),
        ];

        if($loginData['uname'] && $loginData['uident']) {
            $loginData['status'] = LoginType::LOGIN;
        }

        // Only process the login data if a login is requested
        if ($loginData['status'] === LoginType::LOGIN) {
            $loginData = $this->processLoginData($loginData);
            
        }
        return $loginData;
    }

    
}