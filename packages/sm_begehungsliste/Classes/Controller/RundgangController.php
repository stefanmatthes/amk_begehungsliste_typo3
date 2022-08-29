<?php

declare(strict_types=1);

namespace Be\SmBegehungsliste\Controller;


/**
 * This file is part of the "Begehungsliste" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Stefan Matthes <stefan.matthes@branding-energy.de>, Branding Energy
 */

/**
 * RundgangController
 */
class RundgangController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * schwerpunktRepository
     *
     * @var \Be\SmBegehungsliste\Domain\Repository\SchwerpunktRepository
     */
    protected $schwerpunktRepository = null;

    /**
     * @param \Be\SmBegehungsliste\Domain\Repository\SchwerpunktRepository $schwerpunktRepository
     */
    public function injectSchwerpunktRepository(\Be\SmBegehungsliste\Domain\Repository\SchwerpunktRepository $schwerpunktRepository)
    {
        $this->schwerpunktRepository = $schwerpunktRepository;
    }

    /**
     * massnahmeRepository
     *
     * @var \Be\SmBegehungsliste\Domain\Repository\MassnahmeRepository
     */
    protected $massnahmeRepository = null;

    /**
     * bereichRepository
     *
     * @var \Be\SmBegehungsliste\Domain\Repository\BereichRepository
     */
    protected $bereichRepository = null;

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
     * problemRepository
     *
     * @var \Be\SmBegehungsliste\Domain\Repository\ProblemRepository
     */
    protected $problemRepository = null;

    /**
     * @param \Be\SmBegehungsliste\Domain\Repository\ProblemRepository $problemRepository
     */
    public function injectProblemRepository(\Be\SmBegehungsliste\Domain\Repository\ProblemRepository $problemRepository)
    {
        $this->problemRepository = $problemRepository;
    }


    /**
     * rundgangRepository
     *
     * @var \Be\SmBegehungsliste\Domain\Repository\RundgangRepository
     */
    protected $rundgangRepository = null;



    /**
     * @param \Be\SmBegehungsliste\Domain\Repository\MassnahmeRepository $massnahmeRepository
     */
    public function injectMassnahmeRepository(\Be\SmBegehungsliste\Domain\Repository\MassnahmeRepository $massnahmeRepository)
    {
        $this->massnahmeRepository = $massnahmeRepository;
    }

    /**
     * @param \Be\SmBegehungsliste\Domain\Repository\BereichRepository $bereichRepository
     */
    public function injectBereichRepository(\Be\SmBegehungsliste\Domain\Repository\BereichRepository $bereichRepository)
    {
        $this->bereichRepository = $bereichRepository;
    }


    /**
     * action index
     *
     * @param Be\SmBegehungsliste\Domain\Model\Rundgangg
     * @return string|object|null|void
     */
    public function indexAction()
    {
    }

    /**
     * action list
     *
     * @param Be\SmBegehungsliste\Domain\Model\Rundgangg
     * @return string|object|null|void
     */
    public function listAction()
    {
        global $TSFE;
        $rundgaenge = $this->rundgangRepository->findAll();
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('userid')) {
            $userUid = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('userid');

            //  $rundgaenge = $this->rundgangRepository->findAllForUser($userUid);
            $rundgaenge = $this->rundgangRepository->findAll();

            //     $rundgange = $laufliste->getModule()->toArray();
            $rundgang_array = [];
            $rundgange_array = [];
            $count_offene_messungen = 0;
            foreach ($rundgaenge as $rundgang) {

                // $rundgang_array = (array) $rundgang;
                $rundgang_array['data'] = $rundgang;

                //   $problems = $this->problemRepository->findBylID($rundgang->getUid());
                $problems = $rundgang->getProblems();
                $problems_array = [];
                $counterproblem = 0;
                $base_url = 'https://service1.danpower-gruppe.de/';
                foreach ($problems as $problem) {
                    $problem_array = [];
                    $problem_array['uid'] = $problem->getUid();
                    $problem_array['text'] = $problem->getText();
                    $problem_array['tstamp'] = $problem->getCrdate();
                    $problem_array['status'] = $problem->getStatus();
                    $problem_array['termin'] = $problem->getTermin();
                 if ($problem->getBereich()){
                        $problem_array['bereich']["uid"] = $problem->getBereich()->getUid();
                        $problem_array['bereich']["name"] = $problem->getBereich()->getName();
                    }

                    if ($problem_array['status'] == 0) {
                        $counterproblem++;
                    }
                    $feuserproblem = $problem->getFeuser();

                    //  $problem_array['user'] = $feuserproblem;
                    if ($feuserproblem) {

                        //    $problem_array['user']['firstName'] = $feuserproblem->getFirstname();
                        //    $problem_array['user']['lastName'] = $feuserproblem->getLastname();
                    } else {
                        $problem_array['user']['firstName'] = "unbekannt";
                        $problem_array['user']['lastName'] = "";
                    }

                    //   $problem_array['feuserkomplett'] = $problem->getFeuser();
                    //Bilder URL
                    $images = $problem->getImages();
                    $images_array = [];
                    foreach ($images as $image) {

                        // generate image in controller
                        // prerequisite: the model has a mandatory property "image"
                        // get image path
                        $imagePath = $image->getOriginalResource()->getOriginalFile()->getPublicUrl();

                        // process image (resize to 1000x500 pixel)
                        if (file_exists($imagePath)) {
                            $processedImage = $this->imageService->applyProcessingInstructions($this->imageService->getImage($imagePath, null, false), ['width' => '500', 'height' => '500c-100']);

                            // build absolute url (a little bit cheating with the trim…)
                            //     $imageUri = $this->request->getBaseUri() . trim($this->imageService->getImageUri($processedImage), '/');
                            $imageUri = $base_url . trim($this->imageService->getImageUri($processedImage), '/');
                            $image_array = [];

                            //   var_dump($image);
                            //$image_array("url") =  $image->getOriginalResource()->getPublicUrl();
                            $images_array[] = $imageUri;
                        }
                    }
                    $problem_array['images'] = $images_array;

                    // Logs aussuchen
                    //  $logs = $this->logRepository->findByProblem($problem->getUid());
                    $logs = $problem->getLogs();
                    $logs_array = [];
                    foreach ($logs as $log) {
                        $log_array = [];
                        $log_array['uid'] = $log->getUid();
                        $log_array['text'] = $log->getText();
                        $log_array['crdate'] = $log->getCrdate();
                        $log_array['type'] = $log->getType();
                        $feuserlog = $log->getFeuser();
                        if ($feuserlog) {

                            //    $log_array['feuser'] = $log->getFeuser;
                            $log_array['user']['firstName'] = $feuserlog->getFirstname();
                            $log_array['user']['lastName'] = $feuserlog->getLastname();
                        } else {
                            $log_array['user']['firstName'] = "unbekannt";
                            $log_array['user']['lastName'] = "";
                        }
                        $logs_array[] = $log_array;
                    }
                    $problem_array['logs'] = $logs_array;
                    $problems_array[] = $problem_array;
                }
                $rundgang_array['maengel'] = $problems_array;

                //  $problem_array['user'] = $feuser;
                //     $verantwortlicher = $rundgang->getVerantwortlicher();
                $teilnehmer = $rundgang->getTeilnehmer();

                //  var_dump($verantwortlicher);
                $alle_teilnehmer = [];
                if ($teilnehmer) {
                    foreach ($teilnehmer as $teil_nehmer) {
                        $einzelner_teilnehmer = [];

                        //        $einzelner_teilnehmer['feuser'] = $teil_nehmer;
                        $einzelner_teilnehmer['uid'] = $teil_nehmer->getUid();
                        $einzelner_teilnehmer['firstName'] = $teil_nehmer->getFirstname();
                        $einzelner_teilnehmer['lastName'] = $teil_nehmer->getLastname();
                        $alle_teilnehmer[] = $einzelner_teilnehmer;
                    }

                    //
                } else {
                    $problem_array['user']['firstName'] = "unbekannt";
                    $problem_array['user']['lastName'] = "";
                }
                $rundgang_array['teilnehmer'] = $alle_teilnehmer;
                $rundgang_array['verantwortlicher']['uid'] = $rundgang->getVerantwortlicher()->getUid();
                $rundgang_array['verantwortlicher']['firstName'] = $rundgang->getVerantwortlicher()->getFirstname();
                $rundgang_array['verantwortlicher']['lastName'] = $rundgang->getVerantwortlicher()->getLastname();
                $rundgang_array['uid'] = $rundgang->getUid();
                $rundgang_array['kurztext'] = $rundgang->getKurztext();
              if ($rundgang->getSchwerpunkt()) {
                  $rundgang_array['bereich']["uid"] = $rundgang->getSchwerpunkt()->getUid();
                  $rundgang_array['bereich']["name"] = $rundgang->getSchwerpunkt()->getName();
              }

                //     $rundgang_array['anzahl_offene_stoerungen'] = $this->problemRepository->findOpenByRundgangID($rundgang->getUid())->count();
                $rundgange_array[] = $rundgang_array;

                // print_r($rundgang_array);
            }
            $rundgaengearray['rundgaenge'] = $rundgange_array;

            //alle möglichen User
            $rundgaengearray['user'] = $this->userRepository->findAll();

            //Alle Bereiche
            $rundgaengearray['bereiche'] = $this->bereichRepository->findAll();

            //Alle Massnahmen
            $rundgaengearray['bereiche'] = $this->schwerpunktRepository->findAll();
            //Alle Massnahmen
            $rundgaengearray['massnahmen'] = $this->massnahmeRepository->findAll();
        }

        //   $rundgangs = $this->modulRepository->findAll();
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('type') == '1452982642') {
            $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
            $theView->setControllerContext($this->controllerContext);
            $theView->assign('rundgaenge', $rundgaengearray);

            //   $theView->assign('rundgaenge', $rundgange_array);
            $theView->setVariablesToRender(['rundgaenge']);
            return $theView->render();
        } else {
            $this->view->assign('rundgangs', $rundgaenge);
        }
    }

    /**
     * action show
     *
     * @param Be\SmBegehungsliste\Domain\Model\Rundgangg
     * @return string|object|null|void
     */
    public function showAction(\Be\SmBegehungsliste\Domain\Model\Rundgang $rundgang)
    {
        $this->view->assign('rundgang', $rundgang);
    }

    /**
     * action new
     *
     * @param Be\SmBegehungsliste\Domain\Model\Rundgangg
     * @return string|object|null|void
     */
    public function newAction()
    {
    }

    /**
     * action create
     *
     * @param Be\SmBegehungsliste\Domain\Model\Rundgangg
     * @return string|object|null|void
     */
    public function createAction(\Be\SmBegehungsliste\Domain\Model\Rundgang $newRundgang)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->rundgangRepository->add($newRundgang);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param Be\SmBegehungsliste\Domain\Model\Rundgangg
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("rundgang")
     * @return string|object|null|void
     */
    public function editAction(\Be\SmBegehungsliste\Domain\Model\Rundgang $rundgang)
    {
        $this->view->assign('rundgang', $rundgang);
    }

    /**
     * action update
     *
     * @return string|object|null|void
     */
    public function updateAction()
    {
    //    $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);

        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('rundgang_json')) {
            $rundgang_json = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('rundgang_json');
        }

        $rundgang_array = json_decode($rundgang_json,true);

        // Neuer Rundgang ?
        if ($rundgang_array["uid"]!=''){
            $thisRundgang = $this->rundgangRepository->findByUid($rundgang_array["uid"]);
        } else
        {
            $thisRundgang = new \Be\SmBegehungsliste\Domain\Model\Rundgang;

            date_default_timezone_set('Europe/Berlin');
            $thisRundgang->setKurztext(date("Y/m/d-H:i"));

       //     $thisRundgang->setKurztext("Rundgang ".date("Y/m/d"));

            //Verantwortlichen finden
          if ($rundgang_array["verantwortlicher"]){
              //print_r( $rundgang_array["verantwortlicher"]); die();
              $verantwortlicher = $this->userRepository->findByUid($rundgang_array["verantwortlicher"]["uid"]);
              $thisRundgang->setVerantwortlicher($verantwortlicher);
          }

            // Teilnehmer
            foreach ($rundgang_array["teilnehmer"] as $einzelner_teilnehmer_array) {
                $teilnehmer = $this->userRepository->findByUid($einzelner_teilnehmer_array["uid"]);
                $thisRundgang->addTeilnehmer($teilnehmer);

            }
            //Schwerpunkt
            //   $schwerpunktt = $this->schwerpunktRepository->findByUid($rundgang_array["schwerpunktt"]["uid"]);
            //   $thisRundgang->setSchwerpunkt($schwerpunktt);

            $this->rundgangRepository->add($thisRundgang);
        }


        $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');


         // Mängel
        foreach ($rundgang_array["maengel"] as $key=>$mangel_array) {
            if ($mangel_array["uid"]!='') {
                $thisMangel = $this->problemRepository->findByUid($mangel_array["uid"]);

            }else{
                $thisMangel = new \Be\SmBegehungsliste\Domain\Model\Problem();
                $thisMangel->setText($mangel_array["text"]);
                //Verantwortlichen finden
             if ($mangel_array["verantwortlicher"]){
                 $verantwortlicher = $this->userRepository->findByUid($mangel_array["verantwortlicher"]["uid"]);
                 $thisMangel->setFeuser($verantwortlicher);
             }
                //Massnahme finden
                if ($mangel_array["massnahme"]) {
                    $massname = $this->massnahmeRepository->findByUid($mangel_array["massnahme"]["uid"]);
                    $thisMangel->setMassnahme($massname);
                }
                if ($mangel_array["termin"]) {
                    $thisMangel->setTermin($mangel_array["termin"]);
                }

                // Images
                if ($mangel_array["images"]) {
                    foreach ($mangel_array["images"] as $image) {
                       // $teilnehmer = $this->userRepository->findByUid($einzelner_teilnehmer_array["uid"]);
                        $thisMangel->addImage($image);

                    }
                    $thisMangel->setTermin($mangel_array["termin"]);
                }
                $this->problemRepository->add($thisMangel);

                $persistenceManager->persistAll();
                $rundgang_array["maengel"][$key]["uid"] = $thisMangel->getUid();
            }
            // Text

            $thisRundgang->addProblem($thisMangel);
            $this->rundgangRepository->update($thisRundgang);
            $persistenceManager->persistAll();
        }


        // Rundgang zurückschicken
        $rundgang_array["uid"]=$thisRundgang->getUid();
        $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
        $theView->setControllerContext($this->controllerContext);
        $theView->assign('rundgang', $rundgang_array);

        //   $theView->assign('rundgaenge', $rundgange_array);
        $theView->setVariablesToRender(['rundgang']);
        return $theView->render();

        die();
     //   $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param Be\SmBegehungsliste\Domain\Model\Rundgangg
     * @return string|object|null|void
     */
    public function deleteAction(\Be\SmBegehungsliste\Domain\Model\Rundgang $rundgang)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->rundgangRepository->remove($rundgang);
        $this->redirect('list');
    }

    /**
     * action showstat
     *
     * @param Be\SmBegehungsliste\Domain\Model\Rundgangg
     * @return string|object|null|void
     */
    public function showstatAction()
    {
    }

    /**
     * @param \Be\SmBegehungsliste\Domain\Repository\RundgangRepository $RundgangRepository
     */
    public function injectRundgangRepository(\Be\SmBegehungsliste\Domain\Repository\RundgangRepository $rundgangRepository)
    {
        $this->rundgangRepository = $rundgangRepository;
    }
}
