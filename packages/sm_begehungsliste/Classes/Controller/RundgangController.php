<?php

declare(strict_types=1);

namespace Be\SmBegehungsliste\Controller;


use TYPO3\CMS\Extbase\Reflection\DocBlock\Tags\Null_;

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
     * @var \TYPO3\CMS\Extbase\Service\ImageService
     */
    protected $imageService = null;


    /**
     * @param \TYPO3\CMS\Extbase\Service\ImageService $imageService
     */
    public function injectImageService(\TYPO3\CMS\Extbase\Service\ImageService $imageService)
    {
        $this->imageService = $imageService;
    }


    /**
     * schwerpunktRepository
     *
     * @var \Be\SmBegehungsliste\Domain\Repository\SchwerpunktRepository
     */
    protected $schwerpunktRepository = null;

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
     * problemRepository
     *
     * @var \Be\SmBegehungsliste\Domain\Repository\ProblemRepository
     */
    protected $problemRepository = null;

    /**
     * rundgangRepository
     *
     * @var \Be\SmBegehungsliste\Domain\Repository\RundgangRepository
     */
    protected $rundgangRepository = null;

    /**
     * @param \Be\SmBegehungsliste\Domain\Repository\SchwerpunktRepository $schwerpunktRepository
     */
    public function injectSchwerpunktRepository(\Be\SmBegehungsliste\Domain\Repository\SchwerpunktRepository $schwerpunktRepository)
    {
        $this->schwerpunktRepository = $schwerpunktRepository;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository $userRepository
     */
    public function injectFrontendUserRepository(\TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param \Be\SmBegehungsliste\Domain\Repository\ProblemRepository $problemRepository
     */
    public function injectProblemRepository(\Be\SmBegehungsliste\Domain\Repository\ProblemRepository $problemRepository)
    {
        $this->problemRepository = $problemRepository;
    }

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
                $base_url = "https://amk-begehungsliste.branding-energy.de/";
                //  $base_url = 'https://amkbegehung.ddev.site/';
                foreach ($problems as $problem) {
                    $problem_array = [];
                    $problem_array['uid'] = $problem->getUid();
                    $problem_array['text'] = $problem->getText();
                    $problem_array['tstamp'] = $problem->getCrdate();
                    $problem_array['status'] = $problem->getStatus();
                    $problem_array['termin'] = $problem->getTermin();
                    if ($problem->getBereich()) {
                        $problem_array['bereich']["uid"] = $problem->getBereich()->getUid();
                        $problem_array['bereich']["name"] = $problem->getBereich()->getName();
                    }
                    if ($problem->getFeuser()) {
                        $verantwortlicher = $problem->getFeuser();
                        $problem_array['verantwortlicher']['uid'] = $verantwortlicher->getUid();
                        $problem_array['verantwortlicher']['firstName'] = $verantwortlicher->getFirstname();
                        $problem_array['verantwortlicher']['lastName'] = $verantwortlicher->getLastname();
                    }
                    if ($problem->getMassnahme()) {
                        $massnahme = $problem->getMassnahme();
                        $problem_array['massnahme']['uid'] = $massnahme->getUid();
                        $problem_array['massnahme']['name'] = $massnahme->getName();
                    }
                    if ($problem_array['status'] == 0) {
                        $counterproblem++;
                    }
                    $problem_array['inhalteneu'] = json_decode($problem->getNeueinhalte());
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
                    // $images = json_decode($problem->getImages(),true);
                    //  $images_array = [];
                    //Bilder URL
                    $images = $problem->getImage();
                    $images_array = [];
                    $count = 0;
                    foreach ($images as $image) {
                        // generate image in controller
                        // prerequisite: the model has a mandatory property "image"
                        // get image path
                        $imagePath = $image->getOriginalResource()->getOriginalFile()->getPublicUrl();
                        // process image (resize to 1000x500 pixel)
                        if (file_exists($imagePath) && $count==0) {
                            $processedImage = $this->imageService->applyProcessingInstructions($this->imageService->getImage($imagePath, null, false), ['width' => '500', 'height' => '500c-100']);

                            // build absolute url (a little bit cheating with the trim…)
                            //     $imageUri = $this->request->getBaseUri() . trim($this->imageService->getImageUri($processedImage), '/');
                            $imageUri = $base_url . trim($this->imageService->getImageUri($processedImage), '/');
                            $image_array = [];
                            //   var_dump($image);
                            //$image_array("url") =  $image->getOriginalResource()->getPublicUrl();
                            $images_array[] = $imageUri;
                        }
                        $count++;
                    }
                    $problem_array['images'] = $images_array;

                    //   $problem_array['images'] = ($problem->getImage());

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
                if ($rundgang->getVerantwortlicher()) {
                    $rundgang_array['verantwortlicher']['uid'] = $rundgang->getVerantwortlicher()->getUid();
                    $rundgang_array['verantwortlicher']['firstName'] = $rundgang->getVerantwortlicher()->getFirstname();
                    $rundgang_array['verantwortlicher']['lastName'] = $rundgang->getVerantwortlicher()->getLastname();
                }
                $rundgang_array['uid'] = $rundgang->getUid();
                $rundgang_array['kurztext'] = $rundgang->getKurztext();
                $rundgang_array['tstamp'] = $problem->getCrdate();

                if ($rundgang->getSchwerpunkt()) {
                    $rundgang_array['schwerpunkt']["uid"] = $rundgang->getSchwerpunkt()->getUid();
                    $rundgang_array['schwerpunkt']["name"] = $rundgang->getSchwerpunkt()->getName();
                }
                $rundgang_array['inhalteneu'] = (json_decode($rundgang->getNeueinhalte()) == Null?'{"schwerpunkt_neu":"","teilnehmer_neu":"","verantwortlicher_neu":""}':json_decode($rundgang->getNeueinhalte()));

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
            $rundgaengearray['schwerpunkte'] = $this->schwerpunktRepository->findAll();

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

        // modus MAIL?
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('modus') == "mail") {
            // Mail Emfänger 1
            $receivers = "s.matthes@branding-energy.de";

            if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('rundgangUid') != '') {
                $thisRundgang = $this->rundgangRepository->findByUid(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('rundgangUid'));
            //  echo "Rundgang gefunden";
            }

            if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('problemUid') != '') {
                $thisMangel = $this->problemRepository->findByUid(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('problemUid'));
             //   echo "Mangel gefunden";
            }

            //pdf erstellen
            $pdf = new \HeikoHardt\HhdevFpdi\Fpdi('L', 'mm', [297, 210]);
            $storageRepository = $this->objectManager->get('TYPO3\\CMS\\Core\\Resource\\StorageRepository');
            $storage = $storageRepository->findByUid('1');
            $folder = 'fileadmin/pdfs';
            $targetFolder = null;
            if ($storage->hasFolder($folder)) {
                $targetFolder = $storage->getFolder($folder);
            } else {
                $targetFolder = $storage->createFolder($folder);
            }

            $pdf->AddPage();
            $pdf->SetAutoPageBreak(0);
            $pdf->setSourceFile('fileadmin/Vorlage.pdf');
            $tplIdx = $pdf->importPage(1);
            $pdf->useTemplate($tplIdx, 0, 0, 297);
            $pdf->SetFont('Helvetica', '', '12');


            $pdf->SetTextColor(34, 63, 122);
            $pdf->SetDrawColor(34, 63, 122);
            $pdf->SetY(15);
            $pdf->SetFontSize(8);
            $pdf->SetFont('Helvetica', 'B', '10');
            $pdf->SetXY(5, 35);

            // neue Inhalte Rundgang
            $neueInhalteRundgang = json_decode($thisRundgang->getNeueinhalte(), true);

            $pdf->Write(10, 'Schwerpunkl: ');
            $pdf->Write(10,utf8_decode(($thisRundgang->getSchwerpunkt() ?  ($thisRundgang->getSchwerpunkt()->getName()) : '-')  . " " . ($neueInhalteRundgang['schwerpunkt_neu'] != '' ? $neueInhalteRundgang['schwerpunkt_neu'] : '')));
            $pdf->SetXY(5, 40);
            $pdf->Write(10, 'Verantwortlicher: ');
            $pdf->Write(10, utf8_decode(($thisRundgang->getVerantwortlicher() ? $thisRundgang->getVerantwortlicher()->getFirstname() . " " . $thisRundgang->getVerantwortlicher()->getLastname() : '-')
                . " " . ($neueInhalteRundgang['verantwortlicher_neu'] != '' ? $neueInhalteRundgang['verantwortlicher_neu'] : '')));
            // teilnehmer
            $i = 0;
            $pdf_teilnehmer="";
            foreach ($thisRundgang->getTeilnehmer() as $teilnehmer) {
                if ($i == 0) {
                    $pdf_teilnehmer = $teilnehmer->getFirstname() . " " . $teilnehmer->getLastname();
                } else {
                    $pdf_teilnehmer .= ", " . $teilnehmer->getFirstname() . " " . $teilnehmer->getLastname();
                }
                $i++;
            }
            $pdf->SetXY(5, 45);
            $pdf->Write(10, 'Teilnehmer: ');
            $pdf->Write(10, utf8_decode($pdf_teilnehmer. " " . ($neueInhalteRundgang['teilnehmer_neu'] != '' ? $neueInhalteRundgang['teilnehmer_neu'] : '')));
            $pdf->SetFont('Helvetica', '', '8');
            $line = 45;

            $line = $line + 12;
            $pdf->SetFont('Helvetica');
            date_default_timezone_set('Europe/Berlin');
            $i = 1;
            if ($thisMangel) {
                // wenn einzelner Mangel ausgewählt
                $mangel = $thisMangel;
                if ($line > 180) {
                    $pdf->AddPage();
                    $line = 20;
                }
                // Hintergrundfarbe abwechselnd
                if ($i % 2 == 0) {
                    $pdf->SetFillColor(255, 255, 255);
                    $fill = false;
                } else {
                    $pdf->SetFillColor(200, 200, 200);
                    $fill = true;
                }

                //Neue Inhalte json -> Array
                $neueInhalte = json_decode($mangel->getNeueinhalte(), true);


                // Ansicht Spalten
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetXY(10, $line);
                $pdf->Rect(7, $line+1, 250, 38);

                $pdf->SetFillColor(63, 105, 139);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->SetXY(5, $line);
                $pdf->Cell(25, 6, $mangel->getCrdate()->format('Y-m-d'), 1, 0, 'C', true);
                $pdf->SetTextColor(0, 0, 0);

                $fill = false;
                $pdf->SetXY(10, $line+8);
                //    $pdf->write(10,($mangel->getBereich() ? $mangel->getBereich()->getName() : '') . " kein bereich" . ($neueInhalte['bereich_neu'] != '' ? $neueInhalte['bereich_neu'] : ''));
                $pdf->Cell(100, 4, "Bereich: ".utf8_decode(($mangel->getBereich() ? $mangel->getBereich()->getName() : '') . " " . ($neueInhalte['bereich_neu'] != '' ? $neueInhalte['bereich_neu'] : '')), 0, 1, '', $fill);
                // $line = $line + 6;$pdf->SetXY(10, $line);
                $pdf->Cell(100, 4, "Massnahme: ".utf8_decode(($mangel->getMassnahme() ? $mangel->getMassnahme()->getName() : '') . " " . ($neueInhalte['massnahme_neu'] != '' ? $neueInhalte['massnahme_neu'] : '')), 0, 1, '', $fill);
                $pdf->Cell(100, 4, "Verantwortlicher: ".utf8_decode(($mangel->getFeuser() ? $mangel->getFeuser()->getFirstname() . " " . $mangel->getFeuser()->getLastname() : '') . " " . ($neueInhalte['verantwortlicher_neu'] != '' ? $neueInhalte['verantwortlicher_neu'] : '')), 0, 1, '', $fill);
                $pdf->Cell(18, 4, "Frist: ".$mangel->getTermin(), 0, 1, '', $fill);
                $pdf->Cell(100, 20, $mangel->getText(), 0, 1, '', $fill);

                // Bild
                $base_url = 'https://amk-begehungsliste.branding-energy.de/';
              //  $pdf->Write(10, $base_url . "/" .$image->getOriginalResource()->getOriginalFile()->getPublicUrl());

               // echo $base_url;
                $imagePath="";
                $imagecount = 0;
                foreach ($mangel->getImage() as $image) {
                  //  echo $_SERVER['DOCUMENT_ROOT']."/".$image->getOriginalResource()->getOriginalFile()->getPublicUrl();
                    //  $pdf->Write(10, "image: " .$_SERVER['DOCUMENT_ROOT']."/".$image->getOriginalResource()->getOriginalFile()->getPublicUrl());
                    //   $pdf->Image($base_url .$image->getOriginalResource()->getOriginalFile()->getPublicUrl(), 150, $line + 10, 80);

                    //  $imagePath = $image->getOriginalResource()->getOriginalFile()->getPublicUrl();
                    //  $image = $base_url . "/" . $imagePath;
                    //    $pdf->Image($image, 150, $line + 10, 40);
                    if (file_exists($_SERVER['DOCUMENT_ROOT']."/".$image->getOriginalResource()->getOriginalFile()->getPublicUrl()))  {
                        // $imagePath = $image->getOriginalResource()->getOriginalFile()->getPublicUrl();
                        $pdf->Image($base_url .$image->getOriginalResource()->getOriginalFile()->getPublicUrl(), 187, $line+1, 70,38);
                    }
                    $imagecount++;
                }
//var_dump( );die();
                //  $imagePath = $mangel->getImage()->getOriginalResource()->getOriginalFile()->getPublicUrl();
                //      $imagePath = $base_url . trim($this->imageService->getImageUri($mangel->getImage()), '/');

                //     echo $imagePath;
                if ($imagePath != '') {
                    $image = $base_url . "/" . $imagePath;
                    // $image =  '\\\dgapp02\wwwroot_Arbeitsschutzportal\laufliste/' . $imagePath;
                    //  $pdf->Write(10,$image);
                    //  $line = $line + 8;
                    if (file_exists($image)) {
                        $pdf->Write(10, $base_url . "/" .$image->getOriginalResource()->getOriginalFile()->getPublicUrl());

                        $pdf->Image($image, 10, $line + 10, 40);
                    } else {
                        $pdf->SetXY(10, $line + 2);
                        $pdf->Write(10, "Bild hier: " . $image);
                    }

                }
                $i++;
                $line = $line + 44;
                // Email Empfänger

                if ($mangel->getFeuser() && $mangel->getFeuser()->getEmail() != '')
                    $receivers .= ',' . $mangel->getFeuser()->getEmail();
            } else {
                foreach ($thisRundgang->getProblems() as $mangel) {


                    if ($line > 180) {
                        $pdf->AddPage();
//                    $pdf->SetXY(10, 20);
                        $line = 20;
                    }
                    // Hintergrundfarbe abwechselnd
                    if ($i % 2 == 0) {
                        $pdf->SetFillColor(255, 255, 255);
                        $fill = false;
                    } else {
                        $pdf->SetFillColor(200, 200, 200);
                        $fill = true;
                    }

                    //Neue Inhalte json -> Array
                    $neueInhalte = json_decode($mangel->getNeueinhalte(), true);

                    // Ansicht Spalten
                    $pdf->SetDrawColor(0, 0, 0);
                    $pdf->SetXY(10, $line);
                    $pdf->Rect(7, $line+1, 250, 38);

                    $pdf->SetFillColor(63, 105, 139);
                    $pdf->SetTextColor(255, 255, 255);
                    $pdf->SetXY(5, $line);
                    $pdf->Cell(25, 6, $mangel->getCrdate()->format('Y-m-d'), 1, 0, 'C', true);
                    $pdf->SetTextColor(0, 0, 0);

                    $fill = false;
                    $pdf->SetXY(10, $line+8);
                    //    $pdf->write(10,($mangel->getBereich() ? $mangel->getBereich()->getName() : '') . " kein bereich" . ($neueInhalte['bereich_neu'] != '' ? $neueInhalte['bereich_neu'] : ''));
                    $pdf->Cell(100, 4, "Bereich: ".utf8_decode(($mangel->getBereich() ? $mangel->getBereich()->getName() : '') . " " . ($neueInhalte['bereich_neu'] != '' ? $neueInhalte['bereich_neu'] : '')), 0, 1, '', $fill);
                    // $line = $line + 6;$pdf->SetXY(10, $line);
                    $pdf->Cell(100, 4, "Massnahme: ".utf8_decode(($mangel->getMassnahme() ? $mangel->getMassnahme()->getName() : '') . " " . ($neueInhalte['massnahme_neu'] != '' ? $neueInhalte['massnahme_neu'] : '')), 0, 1, '', $fill);
                    $pdf->Cell(100, 4, "Verantwortlicher: ".utf8_decode(($mangel->getFeuser() ? $mangel->getFeuser()->getFirstname() . " " . $mangel->getFeuser()->getLastname() : '') . " " . ($neueInhalte['verantwortlicher_neu'] != '' ? $neueInhalte['verantwortlicher_neu'] : '')), 0, 1, '', $fill);
                    $pdf->Cell(18, 4, "Frist: ".$mangel->getTermin(), 0, 1, '', $fill);
                    $pdf->Cell(100, 20, $mangel->getText(), 0, 1, '', $fill);

                    // Bild
                    $base_url = 'https://amk-begehungsliste.branding-energy.de/';
                    $imagePath="";
                    $imagecount=0;
                    foreach ($mangel->getImage() as $image) {

                        $imagefile = $_SERVER['DOCUMENT_ROOT']."/".$image->getOriginalResource()->getOriginalFile()->getPublicUrl();

                        if (is_file($imagefile) && filesize($imagefile)>100 && $imagecount==0)  {

                    $pdf->Image($base_url .$image->getOriginalResource()->getOriginalFile()->getPublicUrl(), 187, $line+1, 70,38);
                        }
                        $imagecount++;
                    }

                    if ($imagePath != '') {
                        $image = $base_url . "/" . $imagePath;
                        // $image =  '\\\dgapp02\wwwroot_Arbeitsschutzportal\laufliste/' . $imagePath;
                        //  $pdf->Write(10,$image);
                        //  $line = $line + 8;
                        if (file_exists($image)) {
                            $pdf->Write(10, $base_url . "/" .$image->getOriginalResource()->getOriginalFile()->getPublicUrl());

                //            $pdf->Image($image, 10, $line + 10, 40);
                        } else {
                            $pdf->SetXY(10, $line + 2);
                            $pdf->Write(10, "Bild hier: " . $image);
                        }

                    }
                    $i++;
                    $line = $line + 44;
                    // Email Empfänger
                    if ($mangel->getFeuser() && $mangel->getFeuser()->getEmail() != '') {
                        if (strpos($receivers,  $mangel->getFeuser()->getEmail()) == false) {
                            $receivers .= ',' . $mangel->getFeuser()->getEmail();
                        }

                    }


                }
                // Email Verantwortlicher Rundgang
                if (strpos($receivers,  $thisRundgang->getVerantwortlicher()->getEmail()) == false) {
                    $receivers .= ',' . $thisRundgang->getVerantwortlicher()->getEmail();
                }
            }


            // Footer
            $pdf->SetXY(10, 250);
            $pdf->Line(10, 245, 200, 245);
            $pdf->Write(10, 'Datum: ' . date('d.m.Y H:i') . 'Uhr');
            $pdf->SetX(80);
            $actualtime = time();

            $pdfname = "Protokoll_Rundgang_" . \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('rundgangUid') . "-" . date('Ymd_Hi', $actualtime) . '.pdf';
            $pdf->Output($folder . "/" . $pdfname, 'F');
      //     die();


            // Email zusammenstellen
            $htmlContent = "<b>Rundgang Mängelliste</b> <br><br>Bitte öffnen Sie die beiliegende pdf Datei.";

            $subject = utf8_decode('Liste Mängel Rundgang ');


            // Boundary#

            $semi_rand = md5(strval(time()));
            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

            $headers = 'From: AMK Begehungsliste<info@branding-energy.de>';

            // Headers for attachment
            $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";


            $htmlContent .= "<br><br>Diese Email wurde automatisch generiert.";
            $from = 'Laufliste<laufliste@danpower-gruppe.de';
            // Multipart boundary
            $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
                "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";


            // Preparing attachment
            $file = $folder . "/" . $pdfname;
            if (!empty($file) > 0) {
                if (is_file($file)) {
                    $message .= "--{$mime_boundary}\n";
                    $fp = @fopen($file, "rb");
                    $data = @fread($fp, filesize($file));

                    @fclose($fp);
                    $data = chunk_split(base64_encode($data));
                    $message .= "Content-Type: application/octet-stream; name=\"" . basename($file) . "\"\n" .
                        "Content-Description: " . basename($file) . "\n" .
                        "Content-Disposition: attachment;\n" . " filename=\"" . basename($file) . "\"; size=" . filesize($file) . ";\n" .
                        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                }
            }
            $message .= "--{$mime_boundary}--";
            $returnpath = "-f" . $from;

            $success = @mail($receivers, $subject, $message, $headers, $returnpath);

            if (!$success) {
                echo "error mail: " . error_get_last()['message'];
            }


        } else {
            //    $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
            if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('rundgang_json')) {
                $rundgang_json = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('rundgang_json');
            }
            $rundgang_array = json_decode($rundgang_json, true);
            date_default_timezone_set('Europe/Berlin');
            $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');

            // Neuer Rundgang ?
            if ($rundgang_array["uid"] != '') {
                $thisRundgang = $this->rundgangRepository->findByUid($rundgang_array["uid"]);

            } else {
                $thisRundgang = new \Be\SmBegehungsliste\Domain\Model\Rundgang();
                $thisRundgang->setKurztext(date("Y/m/d-H:i"));
                $this->rundgangRepository->add($thisRundgang);
                $persistenceManager->persistAll();

            }
            //     $thisRundgang->setKurztext("Rundgang ".date("Y/m/d"));
            //Verantwortlichen finden
            if ($rundgang_array["verantwortlicher"]["firstName"] != '') {

                //print_r( $rundgang_array["verantwortlicher"]); die();
             //   echo "UID: ".$thisRundgang->getUid();
                $verantwortlicher = $this->userRepository->findByUid($rundgang_array["verantwortlicher"]["uid"]);
                $thisRundgang->setVerantwortlicher($verantwortlicher);
            }

            // Teilnehmer
            foreach ($rundgang_array["teilnehmer"] as $einzelner_teilnehmer_array) {
                $teilnehmer = $this->userRepository->findByUid($einzelner_teilnehmer_array["uid"]);
                $thisRundgang->addTeilnehmer($teilnehmer);
            }
//echo "schwerpunkt ".$rundgang_array["schwerpunkt"];
            //Schwerpunkt
            if ($rundgang_array["schwerpunkt"]!='Keine Auswahl') {

                //   print_r($rundgang_array["schwerpunkt"]);
                $schwerpunktt = $this->schwerpunktRepository->findByUid($rundgang_array["schwerpunkt"]["uid"]);
             if ($schwerpunktt)   $thisRundgang->setSchwerpunkt($schwerpunktt);
            }


            // Mängel
            foreach ($rundgang_array["maengel"] as $key => $mangel_array) {
                $MangelneueInhalte = [];
                if ($mangel_array["uid"] != '') {
                    $thisMangel = $this->problemRepository->findByUid($mangel_array["uid"]);
                    date_default_timezone_set('Europe/Berlin');
                } else {
                    // Neuer Mangel
                    $thisMangel = new \Be\SmBegehungsliste\Domain\Model\Problem();
                    $this->problemRepository->add($thisMangel);
                    $persistenceManager->persistAll();
                    // Timestamp zurückgeben
                    $rundgang_array["maengel"][$key]["tstamp"] = date('Y-m-d')."T".date('H:i:s')."+00:00";//time(); //;
                    // BASE64 Image aus Array entfernen
                  //  $rundgang_array["maengel"][$key]["images"][0] = '';

                }
                $thisMangel->setText($mangel_array["text"]);

                //Verantwortlichen finden
                if ($mangel_array["verantwortlicher"]&& $mangel_array["verantwortlicher"]!='neu') {
                    $verantwortlicher = $this->userRepository->findByUid($mangel_array["verantwortlicher"]["uid"]);
                    $thisMangel->setFeuser($verantwortlicher);
                }

                //Massnahme finden
                if ($mangel_array["massnahme"] && $mangel_array["massnahme"]!='neu') {
                    $massname = $this->massnahmeRepository->findByUid($mangel_array["massnahme"]["uid"]);
                    $thisMangel->setMassnahme($massname);
                    // echo "massnahme uid ".$massname->getName();
                }
                if ($mangel_array["bereich"] && $mangel_array["bereich"]!='neu') {
                    $bereich = $this->bereichRepository->findByUid($mangel_array["bereich"]["uid"]);
                    $thisMangel->setBereich($bereich);
                    // echo "massnahme uid ".$massname->getName();
                }
                if ($mangel_array["termin"]) {
                    $thisMangel->setTermin($mangel_array["termin"]);
                }

//var_dump($thisMangel->getImage());die();
                //Image, wenn noch keins vorhanden
                if ($mangel_array["images"]) {

                    // alte Bilder entfernen
              //     foreach ($thisMangel->getImage() as $image_delete) {
                      // $thisMangel->removeImage($image_delete);
               //     }

                    $foto = $mangel_array["images"][0];
                    //  $foto = 'data:image/png;base64,AAAFBfj42Pj4';
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
                        $newFileReference = $this->objectManager->get('Be\\SmBegehungsliste\\Domain\\Model\\FileReference');

                        $newFileReference->setTablenames('tx_smbegehungsliste_domain_model_problem');
                        $newFileReference->setFile($movedNewFile);
                        // $newFileReference->setHidden(1);
                        //     \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($assignment);
                        // $newFileReference->setPeer($peer);
                        //                    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($newFileReference);
                        $thisMangel->addImage($newFileReference);
                        $this->problemRepository->update($thisMangel);
                        //    \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($thisMangel);
                        //   $persistenceManager =  $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager');
                        // $persistenceManager->persistAll();

                        // Url statt base64 zurücksenden
                        //   $rundgang_array["maengel"][$key]["images"][0] = $originalFilePath;
                      //  $rundgang_array["maengel"][$key]["images"][0] = "https://amk-begehungsliste.branding-energy.de/fileadmin/Stoerungsbilder/".$newFileName;

                    }
                }


                $MangelneueInhalte = [];
                //   $MangelneueInhalte["inhalteneu"] = $mangel_array["inhalteneu"];
//echo json_encode( $mangel_array["inhalteneu"]);
                //  $MangelneueInhalte["neueinhalte"]["verantwortlicher_neu"] = $mangel_array["verantwortlicher_neu"];
                //   $MangelneueInhalte["neueinhalte"]["massnahme_neu"] = $mangel_array["massnahme_neu"];
                $thisMangel->setNeueinhalte(json_encode($mangel_array["inhalteneu"]));
                $persistenceManager->persistAll();
                $rundgang_array["maengel"][$key]["uid"] = $thisMangel->getUid();

                //  $rundgang_array["maengel"][$key]["tstamp"] = $thisMangel->getCrdate();

                $thisRundgang->addProblem($thisMangel);
                $this->rundgangRepository->update($thisRundgang);
                $persistenceManager->persistAll();


                // Text
            }

            // Neue Inhalte
            $neueInhalte = [];
            $neueInhalte["inhalteneu"] = $rundgang_array["inhalteneu"];

            //  $neueInhalte["neueinhalte"]["verantwortlicher_neu"] = $rundgang_array["verantwortlicher_neu"];
            //   $neueInhalte["neueinhalte"]["teilnehmer_neu"] = $rundgang_array["teilnehmer_neu"];
            // print_r($rundgang_array["inhalteneu"]);
            $thisRundgang->setNeueinhalte(json_encode($neueInhalte["inhalteneu"]));
            $this->rundgangRepository->update($thisRundgang);
            $persistenceManager->persistAll();

            // Rundgang zurückschicken
            $rundgang_array["uid"] = $thisRundgang->getUid();

        }

        //    $rundgang_array["feedback"] = "Mangel gespeichert";
        $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
        $theView->setControllerContext($this->controllerContext);
        $theView->assign('rundgang', $rundgang_array);

        //   $theView->assign('rundgaenge', $rundgange_array);
        $theView->setVariablesToRender(['rundgang']);
        return $theView->render();
        die;

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
