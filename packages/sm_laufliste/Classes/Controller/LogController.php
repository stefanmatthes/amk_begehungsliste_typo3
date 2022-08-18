<?php
namespace Be\SmLaufliste\Controller;

/***
 *
 * This file is part of the "Laufliste" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Stefan Matthes <stefan.matthes@branding-energy.de>, Branding Energy
 *
 ***/

/**
 * LogController
 */
class LogController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
     */
    protected $userRepository = null;

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository $userRepository
     */
    public function injectFrontendUserRepository(\TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * logRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\LogRepository
     */
    protected $logRepository = null;

    /**
     * @param \Be\SmLaufliste\Domain\Repository\LogRepository $logRepository
     */
    public function injectLogRepository(\Be\SmLaufliste\Domain\Repository\LogRepository $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    /**
     * problemRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\ProblemRepository
     */
    protected $problemRepository = null;


    /**
     * @param \Be\SmLaufliste\Domain\Repository\ProblemRepository $problemRepository
     */
    public function injectProblemRepository(\Be\SmLaufliste\Domain\Repository\ProblemRepository $problemRepository)
    {
        $this->problemRepository = $problemRepository;
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $logs = $this->logRepository->findAll();
        $this->view->assign('logs', $logs);
    }

    /**
     * action show
     *
     * @param \Be\SmLaufliste\Domain\Model\Log $log
     * @return void
     */
    public function showAction(\Be\SmLaufliste\Domain\Model\Log $log)
    {
        $this->view->assign('log', $log);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {

    }

    /**
     * action create
     *
     * @param \Be\SmLaufliste\Domain\Model\Log $newLog
     */
    public function createAction(\Be\SmLaufliste\Domain\Model\Log $newLog = NULL)
    {
        $stoerungsid = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['stoerungid'];
        $newLog = new \Be\SmLaufliste\Domain\Model\Log();
        $problem = $this->problemRepository->findbyUid($stoerungsid);
        $user = $this->userRepository->findByUid(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['userid']);
        $jsonarray = json_decode(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['formjson'], true);
        //   var_dump($jsonarray);
        $text = $jsonarray['text'];
        $type = $jsonarray['type'];
        $newLog->setFeuser($user);
        $newLog->setText($text);
        $newLog->setType($type);
		$newLog->setProblem($stoerungsid);
        $this->logRepository->add($newLog);
		
        $problem->addLog($newLog);
        $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        $persistenceManager->persistAll();
        $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
        $theView->setControllerContext($this->controllerContext);
        $theView->assign('success', 'true');
        $theView->assign('message', 'Alles gespeichert');
        $theView->assign('data', null);
        $theView->assign('problem', $problem);
        $theView->assign('log', $newLog);
        $theView->setVariablesToRender(['success', 'message', 'data', 'problem', 'log']);
        return $theView->render();
    }
}
