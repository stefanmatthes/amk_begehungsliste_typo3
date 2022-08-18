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
 * ProblemController
 */
class ProblemController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
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
     * standortRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\StandortRepository
     */
    protected $standortRepository = null;

    /**
     * @param \Be\SmLaufliste\Domain\Repository\StandortRepository $standortRepository
     */
    public function injectStandortRepository(\Be\SmLaufliste\Domain\Repository\StandortRepository $standortRepository)
    {
        $this->standortRepository = $standortRepository;
    }


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
     * modulRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\ModulRepository
     */
    protected $modulRepository = null;

    /**
     * @param \Be\SmLaufliste\Domain\Repository\ModulRepository $modulRepository
     */
    public function injectModulRepository(\Be\SmLaufliste\Domain\Repository\ModulRepository $modulRepository)
    {
        $this->modulRepository = $modulRepository;
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $problems = $this->problemRepository->findAll();
        $this->view->assign('problems', $problems);
    }

    /**
     * action show
     *
     * @param \Be\SmLaufliste\Domain\Model\Problem $problem
     * @return void
     */
    public function showAction(\Be\SmLaufliste\Domain\Model\Problem $problem)
    {
        $this->view->assign('problem', $problem);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        $moduls = $this->modulRepository->findAll();
        $this->view->assign('moduls', $moduls);
        $this->view->assign('feuser', $GLOBALS['TSFE']->fe_user->user);
    }

    /**
     * action create
     *
     * @param \Be\SmLaufliste\Domain\Model\Problem $newProblem
     * @return void
     */
    public function createAction(\Be\SmLaufliste\Domain\Model\Problem $newProblem = NULL)
    {
        $newProblem = new \Be\SmLaufliste\Domain\Model\Problem();
        $this->addFlashMessage('Störung wurde angelegt.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['userid']) {
            $user = $this->userRepository->findByUid(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['userid']);
            $newProblem->setFeuser($user);
        }
       // mail('s.matthes@emagio.de', 'log Stoerung', 'Stoerung: ' . json_encode(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')));
        $jsonarray = json_decode(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['formjson'], true);
        //   var_dump($jsonarray);
        $text = $jsonarray['text'];
        $status = $jsonarray['status'];
        $modul = $this->modulRepository->findByUid(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['modulid']);
        $standort = $this->standortRepository->findByModulId($modul);
        $actual_pid = $standort[0]['pid'];
        $newProblem->setPid($actual_pid);
        $newProblem->setText($text);
        $newProblem->setFeuser($user);
        $newProblem->setModul($modul);
        $newProblem->setStatus($status);
        if ($newProblem) {
            $this->problemRepository->add($newProblem);
        }
        //  var_dump($newProblem);
        //   die();
        $modul->addProblem($newProblem);
        $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        $persistenceManager->persistAll();
        //Image
        if (strlen(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['foto']) > 100) {
            $foto = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['foto'];
            // $foto = 'data:image/png;base64,AAAFBfj42Pj4';
            $image = base64_decode(preg_replace('#^data:image/\\w+;base64,#i', '', $foto));
            //echo "check";
            $storageRepository = $this->objectManager->get('TYPO3\\CMS\\Core\\Resource\\StorageRepository');
            $storage = $storageRepository->findByUid('1');
            // 1 ==> default to fileadmin
            $folder = 'Stoerungsbilder';
            $targetFolder = null;
            if ($storage->hasFolder($folder)) {
                $targetFolder = $storage->getFolder($folder);
            } else {
                $targetFolder = $storage->createFolder($folder);
            }
            //Temp Bild speichern
            $newFileName = time() . '.jpeg';
            $tmpFolder = 'fileadmin/_tmp/';
            $originalFilePath = $tmpFolder . $newFileName;
            file_put_contents($originalFilePath, $image);
            //be careful - you should validate the file type! This is not included here
            //this is the fileadmin storage
            //build the new storage folder
            if (file_exists($originalFilePath)) {
                $movedNewFile = $storage->addFile($originalFilePath, $targetFolder, $newFileName);
                //   \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($movedNewFile);
                $newFileReference = $this->objectManager->get('Be\\SmLaufliste\\Domain\\Model\\FileReference');
                $newFileReference->setTablenames('tx_smlaufliste_domain_model_problem');
                $newFileReference->setFile($movedNewFile);
                // $newFileReference->setHidden(1);
                //     \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($assignment);
                // $newFileReference->setPeer($peer);
                //                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($newFileReference);
                $newProblem->addImage($newFileReference);
                $this->problemRepository->update($newProblem);
                //    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($newProblem);
                //   $persistenceManager =  $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager');
                $persistenceManager->persistAll();
            }
        }
        $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
        $theView->setControllerContext($this->controllerContext);
        $theView->assign('success', 'true');
        $theView->assign('message', 'Alles gespeichert');
        $theView->assign('data', null);
        $theView->assign('problem', $newProblem);
        $theView->assign('modul', $modul);
        $theView->setVariablesToRender(['success', 'message', 'data', 'problem', 'modul']);
        return $theView->render();
    }

    /**
     * action edit
     *
     * @param \Be\SmLaufliste\Domain\Model\Problem $problem
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("problem")
     * @return void
     */
    public function editAction(\Be\SmLaufliste\Domain\Model\Problem $problem)
    {
        $this->view->assign('problem', $problem);
    }

    /**
     * action update
     *
     * @param \Be\SmLaufliste\Domain\Model\Problem $problem
     * @return void
     */
    public function updateAction(\Be\SmLaufliste\Domain\Model\Problem $problem = NULL)
    {
        $parameter = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste');
        $user = $this->userRepository->findByUid($parameter['userid']);
        $problem = $this->problemRepository->findByUid($parameter['stoerungid']);
        $newStatus = $parameter['status'];
        //        var_dump($problem);
        $problem->setStatus($newStatus);
        //Logeintrag "Geschlossen"
        $newLog = new \Be\SmLaufliste\Domain\Model\Log();
        $newLog->setFeuser($user);
        if ($newStatus == 1) {
            $newLog->setText('Geschlossen');
        } else {
            $newLog->setText('Wiedereröffnet');
        }
        //  $newLog->setType($type);
        $newLog->setProblem($problem);
        $this->logRepository->add($newLog);
        $problem->addLog($newLog);
        $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        $persistenceManager->persistAll();
        //  var_dump($Problem);
        $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
        $theView->setControllerContext($this->controllerContext);
        $theView->assign('success', 'true');
        $theView->assign('message', 'Alles gespeichert');
        //$theView->assign('data', null);
        ////   $theView->assign('problem', $newProblem);
        //    $theView->assign('newMaintenance', $newMaintenance);
        $theView->setVariablesToRender(['success', 'message']);
        return $theView->render();
        die;
        echo 'OK';
        die;
    }

    /**
     * action delete
     *
     * @param \Be\SmLaufliste\Domain\Model\Problem $problem
     * @return void
     */
    public function deleteAction(\Be\SmLaufliste\Domain\Model\Problem $problem)
    {
        $this->addFlashMessage('Störung wurde gelöscht.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->problemRepository->remove($problem);
        $this->redirect('list');
    }
}
