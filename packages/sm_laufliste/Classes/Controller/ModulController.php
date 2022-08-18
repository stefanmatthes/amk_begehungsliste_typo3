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
 * ModulController
 */
class ModulController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
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
     * messungRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\MessungRepository
     */
    protected $messungRepository = null;

    /**
     * @param \Be\SmLaufliste\Domain\Repository\MessungRepository $messungRepository
     */
    public function injectMessungRepository(\Be\SmLaufliste\Domain\Repository\MessungRepository $messungRepository)
    {
        $this->messungRepository = $messungRepository;
    }


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
     * rundgangaktivRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\RundgangaktivRepository
     */
    protected $rundgangaktivRepository = null;

    /**
     * @param \Be\SmLaufliste\Domain\Repository\RundgangaktivRepository $rundgangaktivRepository
     */
    public function injectRundgangaktivRepository(\Be\SmLaufliste\Domain\Repository\RundgangaktivRepository $rundgangaktivRepository)
    {
        $this->rundgangaktivRepository = $rundgangaktivRepository;
    }

    /**
     * rundgangRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\RundgangRepository
     */
    protected $rundgangRepository = null;


    /**
     * @param \Be\SmLaufliste\Domain\Repository\RundgangRepository $rundgangRepository
     */
    public function injectRundgangRepository(\Be\SmLaufliste\Domain\Repository\RundgangRepository $rundgangRepository)
    {
        $this->rundgangRepository = $rundgangRepository;
    }


    /**
     * action sendSignature
     *
     */
    public function sendSignatureAction()
    {
		$protokollpath[2] = '\\\danpower-gruppe.lokal\dg-daten\850_Kraftwerke\K-B\450_Berichtswesen\Protokolle_Lauflisten';
		$protokollpath[1]  ='\\\danpower-gruppe.lokal\dg-daten\850_Kraftwerke\K-E\450_Berichtswesen\15_Protokolle_Lauflisten';
		$protokollpath[10] ='\\\danpower-gruppe.lokal\dg-daten\850_Kraftwerke\K-H\450_Berichtswesen\Protokolle_Lauflisten';
		$protokollpath[13] ='\\\danpower-gruppe.lokal\dg-daten\850_Kraftwerke\K-H\450_Berichtswesen\Protokolle_Lauflisten';
		$protokollpath[7]  ='\\\danpower-gruppe.lokal\dg-daten\850_Kraftwerke\K-S\450_Berichtswesen\Protokolle_Lauflisten';
		$protokollpath[8]  = '\\\danpower-gruppe.lokal\dg-daten\850_Kraftwerke\K-P\450_Berichtswesen\Protokolle_Lauflisten';
		$protokollpath[9]  ='\\\danpower-gruppe.lokal\dg-daten\850_Kraftwerke\K-D\450_Berichtswesen\Berichte, Protokolle\Protokolle Läuferlisten';
		$protokollpath[12] ='\\\danpower-gruppe.lokal\dg-daten\850_Kraftwerke\K-B_KVA\450_Berichtswesen\Protokoll Lauflisten KSR';
		
		$base_url = 'https://service1.danpower-gruppe.de/';

        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['aktiver_rundgang']['uid']) {
            $aktiver_rundgang_id = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['aktiver_rundgang']['uid'];
        } else {
           // $aktiver_rundgang_id = 786;
	
        }
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['userid']) {
            $user = $this->userRepository->findByUid(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['userid']);
        }
        else {
            $user = $this->userRepository->findByUid(10);
        }
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['kommentar']) {
            $kommentar = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['kommentar'];
        }
        $actualtime = time();
        $aktiver_rundgang = $this->rundgangaktivRepository->findByUid($aktiver_rundgang_id);
		
		if (!$aktiver_rundgang) {
					
			        $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
        $theView->setControllerContext($this->controllerContext);
        $theView->assign('success', 'true');
        $theView->assign('message', 'Fehler beim Speichern ');
        $theView->assign('data', null);
        $theView->setVariablesToRender(['success', 'message', 'data']);
        //    echo "[success]"; die();
		
        return $theView->render();
        die;
		}
        // Rundgang auslesen
        //  $aktiver_rundgang = $this->rundgangaktivRepository->findByUid($aktiver_rundgang_id);
        $aktiver_rundgang->setZeitende($actualtime);
        //  echo $aktiver_rundgang_id;die();
        $rundgang = $aktiver_rundgang->getRundgang();
        //   mail('s.matthes@emagio.de', 'Abschluss Rundgang', 'Abschluss Rundgang: ' . json_encode(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')));
        //   $jsonarray = json_decode(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['formjson'], true);
        //Image
        if (strlen(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['signatureUrl']) > 100) {
            $foto = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['signatureUrl'];
            $image = base64_decode(preg_replace('#^data:image/\\w+;base64,#i', '', $foto));
            $storageRepository = $this->objectManager->get('TYPO3\\CMS\\Core\\Resource\\StorageRepository');
            $storage = $storageRepository->findByUid('1');
            $folder = 'Signaturen';
            $targetFolder = null;
            if ($storage->hasFolder($folder)) {
                $targetFolder = $storage->getFolder($folder);
            } else {
                $targetFolder = $storage->createFolder($folder);
            }
            $newFileName = $actualtime . '.png';
            $tmpFolder = 'fileadmin/_tmp/';

            $originalFilePath = $tmpFolder . $newFileName;
            file_put_contents($originalFilePath, $image);
            if (file_exists($originalFilePath)) {
                $movedNewFile = $storage->addFile($originalFilePath, $targetFolder, $newFileName);
                $newFileReference = $this->objectManager->get('Be\\SmLaufliste\\Domain\\Model\\FileReference');
                $newFileReference->setTablenames('tx_smlaufliste_domain_model_rundgangaktiv');
                $signature_image = 'fileadmin/Signaturen/' . $newFileName;
                $newFileReference->setFile($movedNewFile);
                $aktiver_rundgang->setSignature($newFileReference);
            }
        }
        // Rundgang hidden wegen Performance
        $this->rundgangaktivRepository->update($aktiver_rundgang);
        //  $persistenceManager->persistAll();
        // Email versenden
        $pdf = new \HeikoHardt\HhdevFpdi\Fpdi('P', 'mm', [210, 297]);
        $storageRepository = $this->objectManager->get('TYPO3\\CMS\\Core\\Resource\\StorageRepository');
        $storage = $storageRepository->findByUid('1');
        $folder = 'pdfs';
        $targetFolder = null;
        if ($storage->hasFolder($folder)) {
            $targetFolder = $storage->getFolder($folder);
        } else {
            $targetFolder = $storage->createFolder($folder);
        }
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(0);
        $pdf->setSourceFile('fileadmin/Protokoll.pdf');
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0, 210);
        // now write some text above the imported page
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(34, 63, 122);
        // $pdf->Image("fileadmin/clientlogo.png", 150, 8, 50);
        $pdf->SetDrawColor(34, 63, 122);
        $pdf->SetY(15);
        $pdf->SetFontSize(18);
        $pdf->Write(10, utf8_decode('Protokoll Laufliste'));
        $pdf->SetFontSize(10);
        $pdf->SetXY(10, 25);
        $pdf->Write(10, 'Rundgang:');
        $pdf->SetX(40);
        $pdf->Write(10, utf8_decode($rundgang->getName()));
        $pdf->SetXY(10, 30);
        $pdf->Write(10, 'Schicht:');
        $pdf->SetX(40);
        $pdf->Write(10, utf8_decode($aktiver_rundgang->getSchicht()->getName()));
        $pdf->SetXY(10, 35);
        $pdf->Write(10, 'Datum/Uhrzeit:');
        $pdf->SetX(40);
        $pdf->Write(10, date('d.m.Y H:i') . 'Uhr');
        $pdf->SetXY(10, 40);
        $pdf->Write(10, utf8_decode('Läufer:'));
        $pdf->SetX(40);
        $pdf->Write(10, utf8_decode($user->getFirstName() . ' ' . $user->getLastName()));
        $standort = $rundgang->getStandort();
        $pdf->SetXY(125, 28);
        $pdf->MultiCell(75, 10, $standort->getName(), 0, 'R', 0);
        $pdf->SetXY(125, 38);
        $pdf->MultiCell(75, 5, utf8_decode($standort->getAdresse()), 0, 'R', 0);
        // Vorzeitig beendet?
        if ($kommentar != '') {
            $pdf->SetXY(50, 60);
            $pdf->Write(10, 'Vorzeitig beendet, Grund:' . utf8_decode($kommentar));
        }
        $pdf->SetFillColor(224, 230, 237);
        $pdf->SetXY(10, 72);
        $pdf->SetFont('Helvetica', 'B');
        $pdf->Cell(90, 6, 'Bezeichnung', 0, 0, 'L', 1);
        //$pdf->SetX(120);
        //$pdf->Write(10, "KKS");
        $pdf->Cell(50, 6, 'KKS', 0, 0, 'L', 1);
        $pdf->Cell(30, 6, 'Wert', 0, 0, 'L', 1);
        $pdf->Cell(20, 6, 'i.O.', 0, 0, 'L', 1);
        $pdf->SetFont('Helvetica');
        //  $pdf->Line(10, 80, 200, 80);
        //  $resultsarray = $newMaintenance->getResult();
        $line = 85;
        $pdf->SetFillColor(246, 248, 249);
        //var_dump($resultsarray);
        $count_stoerung = 0;
        $pdf->SetLineWidth(0.1);
        $pdf->SetDrawColor(34, 63, 122);
        $module = $aktiver_rundgang->getRundgang()->getLaufliste()->getModule()->toArray();
        $modul_array = [];
        $module_array = [];
        $line = 80;
        $page_count = 1;
        $anzahl_seiten = round(count($module) / 16.5);
		
		// Array der Standorte und Kurzformen
		$array_standortkurz = [];
        $array_standortkurz[1] ="ELW" ;
        $array_standortkurz[2] ="TRB" ;
        $array_standortkurz[7] ="SUR" ;
        $array_standortkurz[8] ="PAF" ;
        $array_standortkurz[10] ="PAF_TEST" ;
        $array_standortkurz[9] ="DEL" ;
        $array_standortkurz[12] ="KSR" ;
        $array_standortkurz[13] ="HEIDEGRUND" ;

        $pdfname = "Protokoll_Laufliste_".$array_standortkurz[$standort->getUid()]."_".date('Ymd_Hi',$actualtime) . '.pdf';
		
		// CSV Array
		$csv_array = [];
		
        foreach ($module as $modul) {
            $modul_array = [];
            $modul_array['kks'] = $modul->getKks();
            $modul_array['uid'] = $modul->getUid();
            $modul_array['maxdiffday'] = $modul->getDiff();
            $modul_array['kurztext'] = $modul->getKurztext();
            //$letztemessung = $this->messungRepository->findLetzteMessungModul($modul->getUid(), $aktiver_rundgang_id);
            $letztemessung =   $this->messungRepository->findLetzteMessungenModul($modul->getUid(), $aktiver_rundgang_id);
			
			   //Abfrage der letzten Messung anhand aktiver_rundgang_id
            if($letztemessung[0]['rundgangaktiv']!=$aktiver_rundgang_id)
            {
              // es gab keine Messung im letzten Rundgang, Array 0 muss daher gesetzt werden und array eins verschieben
                $letztemessung[1] = $letztemessung[0];
                $letztemessung[0] = [];
            }
            $modul_array['wert_letztemessung'] = $letztemessung[0]['value'];
            $modul_array['wert_letztemessung_tstamp'] = $letztemessung[0]['crdate'];
			
            $modul_array['wert_letztemessung'] = $letztemessung[0]['value'];
            $modul_array['wert_letztemessung_tstamp'] = $letztemessung[0]['crdate'];

            //   echo $modul_array['uid'].": ".$letztemessung[0]['value']." ".$letztemessung[1]['value']."     ";
            // Anzahl der offenen Störungen
            //    $modul_array['anzahl_offene_stoerungen'] = $this->problemRepository->findOpenByModulID($modul->getUid())->count();
            $module_array[] = $modul_array;
            if ($line > 240) {
                $pdf->SetXY(182, 280);
                $pdf->Write(10, 'Seite ' . $page_count);
                $page_count++;
                $pdf->AddPage();
                $pdf->SetXY(10, 15);
                $pdf->Write(10, 'Rundgang:');
                $pdf->SetX(50);
                $pdf->Write(10, utf8_decode($rundgang->getName()));
                $pdf->SetXY(10, 20);
                $pdf->Write(10, 'Schicht:');
                $pdf->SetX(50);
                $pdf->Write(10, utf8_decode($aktiver_rundgang->getSchicht()->getName()));
                $pdf->SetXY(10, 25);
                $pdf->Write(10, 'Datum/Uhrzeit:');
                $pdf->SetX(50);
                $pdf->Write(10, date('d.m.Y H:i') . 'Uhr');
                $pdf->SetFillColor(224, 230, 237);
                $pdf->SetXY(10, 37);
                $pdf->SetFont('Helvetica', 'B');
                $pdf->Cell(90, 6, 'Bezeichnung', 0, 0, 'L', 1);
                //$pdf->SetX(120);
                //$pdf->Write(10, "KKS");
                $pdf->Cell(50, 6, 'KKS', 0, 0, 'L', 1);
                $pdf->Cell(30, 6, 'Wert', 0, 0, 'L', 1);
                $pdf->Cell(20, 6, 'i.O.', 0, 0, 'L', 1);
                $pdf->SetFont('Helvetica');
                //  $pdf->Line(10, 80, 200, 80);
                //  $resultsarray = $newMaintenance->getResult();
                $pdf->SetFillColor(246, 248, 249);
                $line = 45;
            }
            $pdf->SetXY(10, $line);
            // Centered text in a framed 20*10 mm cell and line break
            $pdf->Cell(85, 6, substr(utf8_decode($modul_array['kurztext']),0,40), 0, 0, 'L', 1);
            //      $pdf->Write(10, utf8_decode($modul_array['kurztext']));
            //  $pdf->SetX(120);
            //     $pdf->Cell(80);
            $pdf->Cell(105, 6, utf8_decode($modul_array['kks']), 0, 0, 'L', 1);
            //    $pdf->Write(10, utf8_decode($modul_array['kks']));
            $pdf->SetX(140);
            //    $pdf->Write(10,$modul_array['wert_letztemessung']);
			
			
		//	$csv_array[]= .",".$letztemessung[0]['crdate'].",".$letztemessung[0]['value']);
		
		// CSV Array füllen, auch wenn kein Wert eingetragen
		  if ($modul_array['maxdiffday'] != 0 || $modul_array['uid'] == 595  ) {
			  $letztemessung_0_crdate = ($letztemessung[0]['crdate']?$letztemessung[0]['crdate']:'#' );
			  $letztemessung_0_value = ($letztemessung[0]['value']?$letztemessung[0]['value']:'#' );
			//  echo "wert". $letztemessung_0_value;
			  $csv_row=[];
					$csv_row[]=$modul_array['kks'];
					$csv_row[]=$letztemessung_0_crdate;
					$csv_row[]=$letztemessung_0_value;
					$csv_array[]= $csv_row;
		  }
		
            if ($modul->getCheckonly() == 0 && $modul_array['wert_letztemessung']) {
					
                if ($modul_array['maxdiffday'] != 0 || $modul_array['uid'] == 595  ) {  // 595 ist Füllstand
					
                    if (is_numeric($letztemessung[1]['value'])) {
                        $modul_array['wert_vorletztemessung'] = (float)str_replace(',', '.', $letztemessung[1]['value']);
					
                    } else {
                        $modul_array['wert_vorletztemessung'] = $letztemessung[1]['value'];
                    }
						
					// CSV Array	
					
					
                    $modul_array['wert_vorletztemessung_tstamp'] = $letztemessung[1]['crdate'];
                    $wertdiff = abs($modul_array['wert_letztemessung'] - $modul_array['wert_vorletztemessung']);
                    $zeitdiff = $modul_array['wert_letztemessung_tstamp'] - $modul_array['wert_vorletztemessung_tstamp'];
                    $zeitfaktor = $zeitdiff / 3600 / 24;  // Zeitfaktor auf 24 h bezogen ... 24h = 1
                    $modul_array['wertdiff'] = $wertdiff;
                    if ($zeitdiff > 0) {

                        $wertdiffnormalisiert = $modul_array['maxdiffday']  * $zeitdiff / (24* 3600);
                        $mindiffnormalisiert = $modul_array['wert_vorletztemessung'] - (abs($modul_array['min'])  * $zeitfaktor);

                        $modul_array['minnormalisiert'] = (abs($modul_array['min'])  * $zeitfaktor);
                        $modul_array['mindiffnormalisiert'] = $mindiffnormalisiert;
                        $modul_array['maxdiffnormalisiert'] = $modul_array['wert_vorletztemessung'] + ($modul_array['maxdiffday']  * $zeitfaktor);
                    }
                    $modul_array['wertdiff'] = $wertdiff;
                    $modul_array['zeitdiff'] = $zeitdiff;

                    $modul_array['zeitfaktor'] =$zeitfaktor;

                    $modul_array['wertdiffnormalisiert'] =  $modul_array['wert_vorletztemessung'] + $wertdiffnormalisiert;
                    $modul_array['diff_danger'] = ($modul_array['wert_letztemessung'] > $modul_array['maxdiffnormalisiert'] ||  $modul_array['wert_letztemessung'] < $mindiffnormalisiert)  ? 1 : 0;
                    if ($modul_array['diff_danger'] >0)  $pdf->SetTextColor(255, 0, 0);
            //  echo   $zeitfaktor." maxdiffnormalisiert ". $modul_array['maxdiffnormalisiert']."  ".  $modul_array['wertdiffnormalisiert'];

					
                }
                else {


                if ($modul->getMax() != $modul->getMin() && ($modul_array['wert_letztemessung'] > $modul->getMax() || $modul_array['wert_letztemessung'] < $modul->getMin())) {
                    $pdf->SetTextColor(255, 0, 0);
                }
            }


                $pdf->Cell(20, 6, $modul_array['wert_letztemessung'], 0, 0, 'R', 1);

                if ($modul->getUnit() != '-') {
                    $pdf->Cell(18, 6, utf8_decode($modul->getUnit()), 0, 0, 'L', 1);
                }
				if ($modul_array['maxdiffday'] != 0){
					$pdf->SetX(175);
					$pdf->Cell(10, 6,"(+".round($wertdiff,3).")", 0, 0, 'L', 1);
				}
				
            } else {
                if ($modul_array['wert_letztemessung'] == '1') {
                    $pdf->Image('fileadmin/OK.png', 192, $line + 1, 4);
                }
                if ($modul_array['wert_letztemessung'] == '0' && $modul->getCheckonly() == 1) {
                    $pdf->Image('fileadmin/NOTOK.png', 192, $line + 1, 4);
                }
            }
            $pdf->SetTextColor(34, 63, 122);
            //  $pdf->Line(10, $line + 8, 200, $line + 8);
            $line = $line + 6.5;
        }
        $pdf->SetLineWidth(0.2);
        $pdf->SetDrawColor(34, 63, 122);
        $pdf->SetXY(10, 250);
        $pdf->Line(10, 245, 200, 245);
        $pdf->Write(10, 'Datum: ' . date('d.m.Y H:i') . 'Uhr');
        $pdf->SetX(80);
        $pdf->Write(10, utf8_decode('Läufer:') . utf8_decode($user->getFirstName() . ' ' . $user->getLastName()));
        $pdf->SetXY(80, 260);
        $pdf->Write(10, 'Unterschrift: ');
        $pdf->SetXY(182, 280);
        $pdf->Write(10, 'Seite ' . $page_count);
        if ($signature_image) {
            $pdf->Image($signature_image, 110, 260, 50);
        }
        // Liste Störungen
        $pdf->AddPage();
        $pdf->SetXY(10, 7);
        $pdf->SetFontSize(18);
        //   $pdf->Write(10, utf8_decode('Aktuelle Störungen:'));
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFillColor(255, 0, 0);
        $pdf->Rect(0, 0,210, 20,'F');

        //  $pdf->Write(10, utf8_decode('Aktuelle Störungen:'));
        $pdf->Cell(200, 6, utf8_decode('Aktuelle Störungen:'), 0, 0, 'L', 1);
        $pdf->SetTextColor(34, 63, 122);
        $pdf->SetFontSize(10);
        $pdf->SetXY(10, 25);
        $pdf->Write(10, 'Standort:');
        $pdf->SetX(50);
        $pdf->Write(10, utf8_decode($standort->getName()));
        $pdf->SetXY(10, 32);
        $pdf->Write(10, 'Datum/Uhrzeit:');
        $pdf->SetX(50);
        $pdf->Write(10, date('d.m.Y H:i') . 'Uhr');
        $line = 40;
        $pid = $standort->getPid();
        $offene_stoerungen = $this->problemRepository->findAllOpen($pid);
        foreach ($offene_stoerungen as $stoerung) {

            if ($stoerung->getModul()) {
                if ($line > 210) {
                    $pdf->AddPage();
                    $pdf->SetXY(10, 7);
                    $pdf->SetFontSize(18);
                    $pdf->SetTextColor(255, 255, 255);
                    $pdf->SetFillColor(255, 0, 0);

                    //  $pdf->Write(10, utf8_decode('Aktuelle Störungen:'));
                    $pdf->Rect(0, 0,210, 20,'F');

                    $pdf->Cell(200, 6, utf8_decode('Aktuelle Störungen:'), 0, 0, 'L', 1);
                    $pdf->SetTextColor(34, 63, 122);

                    $pdf->SetFontSize(10);
                    $pdf->SetXY(10, 25);
                    $pdf->Write(10, 'Standort:');
                    $pdf->SetX(50);
                    $pdf->Write(10, utf8_decode($standort->getName()));
                    $pdf->SetXY(10, 32);
                    $pdf->Write(10, 'Datum/Uhrzeit:');
                    $pdf->SetX(50);
                    $pdf->Write(10, date('d.m.Y H:i') . 'Uhr');
                    $line = 50;
                }

                $pdf->SetXY(10, $line);
                $pdf->SetFillColor(224, 230, 237);
                $pdf->Cell(190, 6, utf8_decode($stoerung->getModul()->getKks() . ' - ' . $stoerung->getModul()->getKurztext()), 0, 0, 'L', 1);
                $line = $line + 6.5;
                $pdf->SetXY(10, $line);
                //    $pdf->Write(10,utf8_decode($stoerung->getModul()->getKurztext()));
                $user = $stoerung->getFeuser();
                if ($user) {
                    $userFullname = $user->getFirstname() . ' ' . $user->getLastname() . ' (Username: ' . $user->getUsername(). ')';
                } else {
                    $userFullname = 'unbekannter User';
                }
                //  var_dump ($user);
                $pdf->Write(10, '>> Gemeldet am ' . $stoerung->getCrdate()->format('d.m.Y H:i') . ' von ' . utf8_decode($userFullname));
                $line = $line + 9.5;
                $pdf->SetXY(10, $line);
                $pdf->Write(5, utf8_decode($stoerung->getText()));
                $line = $pdf->GetY() + 1;
                // Bild
                $images = $stoerung->getImages();
                $images_array = [];
                foreach ($images as $image) {
                    // generate image in controller
                    // prerequisite: the model has a mandatory property "image"
                    // get image path
                    $imagePath = $image->getOriginalResource()->getOriginalFile()->getPublicUrl();
                    if ($imagePath != '') {
                        $image =  $base_url."laufliste/v10/" . $imagePath;
						// $image =  '\\\dgapp02\wwwroot_Arbeitsschutzportal\laufliste/' . $imagePath;
                         //  $pdf->Write(10,$image);
                        //  $line = $line + 8;
                    if  (file_exists($image))  {
						$pdf->Image($image, 10, $line + 10, 40);
					}
					else {
						 $pdf->SetXY(10, $line+2);
					$pdf->Write(10,"Bild hier: ". $image);
					}
					
                     $line = $line + 8;
                    }
                }

            }
            //  $pdf->SetX(172);
            //   $pdf->Cell(10,6,utf8_decode($stoerung->getStatus()),0,0,'L',1);
            $line = $line + 15;
        }
        // $pdf->Output();
        //Ausgabe der PDF
        //Variante 1: PDF direkt an den Benutzer senden:
        // $pdf->Output($pdfName, 'I');
        //   die();
        $empfaenger = [];
        $array_empfaenger = $standort->getReceiver();
        foreach ($array_empfaenger as $singleempfaenger) {
            if ($singleempfaenger->getEmail() != '') {
             //   $empfaenger[$singleempfaenger->getEmail()] = $singleempfaenger->getFirstName() . ' ' . $singleempfaenger->getLastName();
                $empfaenger[]=$singleempfaenger->getEmail();
				
            }
        }

      //  echo $standort->getUid().$pdfname_neu ;
      //  $pdfname = $actualtime . '.pdf';
      //  $pdf->Output('fileadmin/pdfs/' . $pdfname, 'F');
	
		 $pdf->Output($protokollpath[$standort->getUid()]."/".$pdfname, 'F');
        // 	 $pdf->Output("fileadmin/Protokolle/".$pdfname, 'F');  // locale DEV
        //
		 // Zusätzlich in fileadmin speichern für externen Zugriff evtl später
	//	 $pdf->Output($protokollpath[$standort->getUid()]."/".$pdfname, 'F');

        // Create the message
    /*    $mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
        // Prepare and send the message
        $mail->setSubject('Protokoll ' . utf8_decode($standort->getName()))
            ->setFrom(['m.langschwager@branding-energy.de' => 'Laufliste'])
            ->setTo($empfaenger)
            //  ->setTo(['s.matthes@branding-energy.de' => 'Matthes'])
            ->setBody('Laufliste Protokoll')
            ->addPart('Ein neues Protokoll', 'text/html')
            ->attach(\Swift_Attachment::fromPath('fileadmin/pdfs/' . $pdfname))
            ->send();
*/

// Abspeichern CSV

if (empty($csv_array)==False) {
	
		$fileName = $protokollpath[$standort->getUid()]."/csv_Dateien/Zaehlerstaende_Laufliste_".$array_standortkurz[$standort->getUid()]."_".date('Ymd_Hi',$actualtime) . '.csv';
		// echo $fileName;
		if(file_exists($fileName)):
			$csvFile = fopen($fileName,'a');
		else:
			$csvFile = fopen($fileName,'w');
			$head = ["kks","date","wert"];
			fputcsv($csvFile,$head);
		endif;
		//var_dump($csv_array);
		foreach($csv_array as $row){
			
		fputcsv($csvFile,$row);
}

fclose($csvFile);
} else {
	//echo "1";
}


// Variante Windows Server


	$htmlContent = '<h2>Laufliste Protokoll ' . utf8_decode($standort->getName()).'</h2>Ein neues Laufliste Protokoll wurde erstellt.<br><br>Es wurde abgelegt unter: <br><b>
	'.utf8_decode($protokollpath[$standort->getUid()].'\\'.$pdfname)."</b><br><br>
	";
	 
	 $subject = 'Protokoll ' . utf8_decode($standort->getName());

	 
// Boundary
$semi_rand = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

 $headers = 'From: Laufliste<laufliste@danpower-gruppe.de>';
  
  // Headers for attachment
  $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
	
	if ($kommentar != '') {
            $subject .=' (mit Kommentar)';
			$htmlContent .= '<br><br><b>Kommentar</b>: '.$kommentar;
			 $headers .= "X-Priority: 1 (Highest)\n";
        $headers .= "X-MSMail-Priority: High\n";
        $headers .= "Importance: High\n";
        }
		$htmlContent .= "<br><br>Diese Email wurde automatisch generiert.";
	 $from = 'Laufliste<laufliste@danpower-gruppe.de';
// Multipart boundary
 $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";

// Preparing attachment
$file = $protokollpath[$standort->getUid()]."/".$pdfname;
if(!empty($file) > 0){
    if(is_file($file)){
        $message .= "--{$mime_boundary}\n";
        $fp =    @fopen($file,"rb");
        $data =  @fread($fp,filesize($file));

        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .
        "Content-Description: ".basename($file)."\n" .
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    }
}
$message .= "--{$mime_boundary}--"; 
$returnpath = "-f" . $from;

/*	 
	$header[] = 'MIME-Version: 1.0';
	$header[] = 'Content-type: text/html; charset=iso-8859-1';
	$header[] = 'boundary=\"{$mime_boundary}\"';
*/
	 // zusätzliche Header
	
	// $receivers= 'Laufliste <matthess@danpower-gruppe.lokal>';
	  foreach ($empfaenger as $singleempfaenger) {
	//	  echo $singleempfaenger;
	$receivers.= $singleempfaenger.',';
	}
	  
	// $headers.= 'To: '. $receivers.'\n';
$receivers.= "matthess@danpower-gruppe.lokal";
//echo $receivers;
	 //$success =  mail("matthess@danpower-gruppe.lokal", $subject, $nachricht, implode("\r\n", $header));
	 $success =  @mail($receivers, $subject, $message, $headers,$returnpath);
	 
	 if (!$success) {
		 echo "error mail: ".error_get_last()['message'];
	 }
 
 
 
        $aktiver_rundgang->setEmailprotokoll($actualtime);

        $this->rundgangaktivRepository->update($aktiver_rundgang);
        //  $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        //  $persistenceManager->persistAll();
        $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
        $theView->setControllerContext($this->controllerContext);
        $theView->assign('success', 'true');
        $theView->assign('message', 'Alles gespeichert');
        $theView->assign('data', null);
        $theView->setVariablesToRender(['success', 'message', 'data']);
        //    echo "[success]"; die();
        return $theView->render();
        die;
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        global $TSFE;
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('userid')) {
            $userUid = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('userid');
            $rundgaenge = $this->rundgangRepository->findAllForUser($userUid);

           // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($rundgaenge);
            //   $rundgaenge = $this->rundgangRepository->findbyUid(1);
            //   $rundgaenge = $this->rundgangRepository->findAll()->current();die();
            if (empty($rundgaenge)) {
                $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
                $theView->setControllerContext($this->controllerContext);
                $theView->assign('success', 'false');
                $theView->assign('message', 'Kein Rundgang für diesen User.');
                $theView->setVariablesToRender(['success', 'message']);
                return $theView->render();
                die;
            }
           //  krexx($rundgaenge);die();
            $rundgaengearray = [];
            $modulsarray = [];
            $rundgangarray = [];
            $lauflistearray = [];
            //   foreach ($rundgaenge as $rundgang) {
            $rundgang = $rundgaenge;
            // erstmal nur einen Rundgang. später mehrere
            //    $modulsarray[]

            foreach ($rundgaenge as $rundgang) {
                $rundgangarray['rundgaenge'][]=$rundgang;
                // aktuellen Rundgang Finden anhand der Schichten und Zeiten


                $schichten = $rundgang->getSchichten();
                $schichtarray = [];
                $schichtenarray = [];
                $aktuelle_stunde = date('H', time());
                $aktueller_wochentag = intval(date('w', time()));
                foreach ($schichten as $schicht) {
                    $schichtarray['name'] = $schicht->getName();
                    $tagearray = $schicht->getTage();
                    //  $schichtarray['tage'] =$tagearray;
                    $checktag = false;
                    $checkstunde = false;
                    $nachtschicht = false;
                    $zeitstart = $schicht->getZeitstart();
                    $schichtarray['zeitstart'] = $zeitstart;
                    $zeitende = $schicht->getZeitende();
                    $schichtarray['zeitende'] = $zeitende;
                    $schichtarray['aktuelle_stunde'] = intval($aktuelle_stunde);
                    $schichtarray['aktueller_tag'] = intval($aktueller_wochentag);
                    // Tag checken
                    //Uhrzeit checken inklMittrnacht
                    if ($zeitstart < $zeitende) {
                        if ($zeitstart <= $aktuelle_stunde && $zeitende > $aktuelle_stunde) {
                            $checkstunde = true;
                        }
                    } else {
                        $nachtschicht = true;
                        if ($zeitstart <= $aktuelle_stunde && $aktuelle_stunde < 25 || $zeitende > $aktuelle_stunde && $aktuelle_stunde >= 0) {
                            $checkstunde = true;
                        }
                    }
                    foreach ($tagearray as $tag) {
                        if ($tag->getUid() == 7) {
                            $tag_des_arrays = 0;
                        } else {
                            $tag_des_arrays = $tag->getUid();
                        }
                        if (!$nachtschicht && $tag_des_arrays == $aktueller_wochentag || $nachtschicht && ($zeitende > $aktuelle_stunde && $aktuelle_stunde >= 0) && ($tag_des_arrays == $aktueller_wochentag - 1 || $tag_des_arrays == $aktueller_wochentag + 6) || $nachtschicht && ($zeitstart <= $aktuelle_stunde && $aktuelle_stunde < 25) && $tag_des_arrays == $aktueller_wochentag) {
                            $checktag = true;
                        }
                    }
                    $schichtarray['nachtschicht'] = intval($nachtschicht);
                    $schichtarray['checktag'] = $checktag;
                    $schichtarray['checkstunde'] = $checkstunde;
                    //  $schichtarray['aktueller_wochentag'] = intval($aktueller_wochentag);
                    // $schichtarray['Wochentag-HEUTE'] = $checktag;
                    if ($checktag && $checkstunde) {
                        $aktuelle_schicht = $schicht;
                        $rundgangaktuell = $rundgang;
                        $rundgangarray['rundgang_uid'] = $rundgang->getUid();
                        $rundgangarray['rundgang_name'] = $rundgang->getName();
                        $rundgangarray['standort'] = $rundgang->getStandort();
                        $actual_pid = $rundgang->getStandort()->getPid();
                        $user = $this->userRepository->findByUid($userUid);
                        $rundgangarray['user'] = $user;
                        $laufliste = $rundgang->getLaufliste();

                        //   $rundgangarray["aktuelle_schicht"]=   $aktuelle_schicht;
                        $rundgangarray['aktuelle_schicht_name'] = $schicht->getName();
                        $rundgangarray['aktuelle_schicht_uid'] = $schicht->getUid();
                        $rundgangarray['aktuelle_schicht_start'] = $schicht->getZeitstart();
                        $rundgangarray['aktuelle_schicht_ende'] = $schicht->getZeitende();
                        // BErechnung Schichtende in Timestmp
                        //   $heute    = date('d M Y', time());
                        //   $rundgangarray['heute'] =  $heute ;
                        $schichtende_tstamp = date('d M Y ', time()) . $zeitende . ':00';
                        $rundgangarray['schichtende_tstamp'] = $nachtschicht && $aktuelle_stunde < $zeitstart || !$nachtschicht ? strtotime($schichtende_tstamp) : strtotime($schichtende_tstamp . ' +1 day');
                    }
                    //    $schichtarray["tage"] = $schicht->getTage();
                    $schichtenarray[] = $schichtarray;
                }


                $rundgangarray["schichten"] = $schichtenarray;
                //      $rundgangarray["alleschichten"] = $schichten;
                // Gibt es aktiven Rundgang?

            }
            $aktiver_rundgang = $this->rundgangaktivRepository->findAktiverRundgang($rundgangarray['aktuelle_schicht_uid'], $rundgangarray['rundgang_uid']);
           //  var_dump($aktiver_rundgang);
            if (!$aktiver_rundgang) {
               //  echo "neuer Rundgang";
			    // alte aktive Rundgänge HIDDEN setzen
                $offene_aktive_rundgaenge = $this->rundgangaktivRepository->findOffeneAktiveRundgaenge($rundgangaktuell);
                foreach( $offene_aktive_rundgaenge as $offene_aktive_rundgang) {
                    $offene_aktive_rundgang->setHidden(1);
                    $offene_aktive_rundgang->setDeleted(1);
                    $this->rundgangaktivRepository->update($offene_aktive_rundgang);
                };
                $aktiver_rundgang = new \Be\SmLaufliste\Domain\Model\Rundgangaktiv();
                if ($aktuelle_schicht) {
                    $aktiver_rundgang->setSchicht($aktuelle_schicht);
                }
                $aktiver_rundgang->setFeuser($user);
                $aktiver_rundgang->setRundgang($rundgangaktuell);
                $aktiver_rundgang->setPid($actual_pid);
                $aktiver_rundgang->setZeitstart(time());
                $this->rundgangaktivRepository->add($aktiver_rundgang);
                $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
                $persistenceManager->persistAll();
                $rundgangaktuell->addLog($aktiver_rundgang);
            } else {

            }
            $rundgangarray['aktiver_rundgang'] = $aktiver_rundgang;
            $rundgangarray['protokoll'] = 'fileadmin/pdfs/protokoll_' . $aktiver_rundgang->getZeitende() . '.pdf';

            $lauflistearray = $rundgangarray;
            // Übernahme der Inhalte auf die erste Ebene
            $lauflistearray['laufliste_name'] = $laufliste->getName();
            $lauflistearray['laufliste_text'] = $laufliste->getText();
            //    $lauflistearray["moduls"]=$laufliste->getModule()->toArray();
            $module = $laufliste->getModule()->toArray();
            $modul_array = [];
            $module_array = [];
            $count_offene_messungen = 0;
            foreach ($module as $modul) {
                // $modul_array = (array) $modul;
                $modul_array['data'] = $modul;
				
				           $problems = $this->problemRepository->findByModulID($modul->getUid());
            $problems_array = [];
            $counterproblem = 0;
            $base_url = 'https://service1.danpower-gruppe.de/';

            foreach ($problems as $problem) {
                $problem_array = [];
                $problem_array['uid'] = $problem->getUid();
                $problem_array['text'] = $problem->getText();
                $problem_array['tstamp'] = $problem->getCrdate();
                $problem_array['status'] = $problem->getStatus();
                if ($problem_array['status'] == 0) {
                    $counterproblem++;
                }
                $feuser = $problem->getFeuser();
                $problem_array['user']=$feuser;
                if ($feuser)
                {
                    $problem_array['feuser']['firstName'] = $feuser->getFirstName();
                    $problem_array['feuser']['lastName'] = $feuser->getLastName();
                }
                else {
                    $problem_array['feuser']['firstName'] = "unbekannt";
                    $problem_array['feuser']['lastName'] = "";
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
                    if (file_exists($imagePath)){
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
                $logs = $this->logRepository->findByProblem($problem->getUid());
                $logs_array = [];
                foreach ($logs as $log) {
                    $log_array = [];
                    $log_array['uid'] = $log->getUid();
                    $log_array['text'] = $log->getText();
                    $log_array['crdate'] = $log->getCrdate();
                    $log_array['type'] = $log->getType();
                    // $log_array['feuser'] = $log->getFeuser();
                    $feuserlog = $problem->getFeuser();

                    if ($feuserlog)
                    {
                        $log_array['feuser']['firstName'] = $feuserlog->getFirstName();
                        $log_array['feuser']['lastName'] = $feuserlog->getLastName();
                    }
                    else {
                        $log_array['feuser']['firstName'] = "unbekannt";
                        $log_array['feuser']['lastName'] = "";
                    }

                    $logs_array[] = $log_array;
                }
                $problem_array['logs'] = $logs_array;
                $problems_array[] = $problem_array;
            }
				$modul_array['failures'] = $problems_array;
				 $modul_array['dokumente'] = [];
				$modul_array['kks'] = $modul->getKks();
                $modul_array['uid'] = $modul->getUid();
                $modul_array['tokenid'] = $modul->getTokenid();
                $modul_array['checkonly'] = $modul->getCheckonly();
                $modul_array['maxdiffday'] = $modul->getDiff();
                $modul_array['kurztext'] = $modul->getKurztext();
                $modul_array['anleitung'] = $modul->getAnleitung();
                $modul_array['onlynumbers'] = $modul_array['maxdiffday']!=0?1:0;
                $modul_array['ort'] = $modul->getOrt();
                $modul_array['unit'] = $modul->getUnit();
                $modul_array['min'] = str_replace(',', '.',$modul->getMin() );
                $modul_array['max'] = str_replace(',', '.',$modul->getMax() );
                $letztemessung = $this->messungRepository->findLetzteMessungenModul($modul->getUid(), $aktiver_rundgang_id);
                // check ob numerisch
                if (is_numeric($letztemessung[0]['value']) && !$modul_array['checkonly']) {
                    $modul_array['wert_letztemessung'] = (float)str_replace(',', '.',$letztemessung[0]['value'] );
					            
				}
                else
                {
					 $modul_array['wert_letztemessung'] = str_replace(',', '.',$letztemessung[0]['value'] );
                }

                $modul_array['wert_letztemessung_tstamp'] = $letztemessung[0]['crdate'];
                $modul_array['wert_letztemessung_aktueller_rundgang'] = $letztemessung[0]['rundgangaktiv'];
                $modul_array['wert_danger'] =0;

                // Diffenrenz ?
                $modul_array['diff_danger'] = 0;

                if ($modul_array['maxdiffday'] != 0) {
                    if (is_numeric($letztemessung[1]['value'])) {
                        $modul_array['wert_vorletztemessung'] = (float)str_replace(',', '.',$letztemessung[1]['value'] );
                    }
                    else
                    {
                        $modul_array['wert_vorletztemessung'] = $letztemessung[1]['value'];
                    }
                    $modul_array['wert_vorletztemessung_tstamp'] = $letztemessung[1]['crdate'];
                    $wertdiff = abs($modul_array['wert_letztemessung'] - $modul_array['wert_vorletztemessung']);
                    $zeitdiff = $modul_array['wert_letztemessung_tstamp'] - $modul_array['wert_vorletztemessung_tstamp'];
                    $zeitfaktor = $zeitdiff / 3600 / 24;  // Zeitfaktor auf 24 h bezogen ... 24h = 1

                    $modul_array['wertdiff'] = $wertdiff;
                    if ($zeitdiff > 0) {
                        $wertdiffnormalisiert = $modul_array['maxdiffday']  * $zeitdiff / (24* 3600);
                        $mindiffnormalisiert = $modul_array['wert_vorletztemessung'] - (abs($modul_array['min'])  * $zeitfaktor);

                        $modul_array['minnormalisiert'] = (abs($modul_array['min'])  * $zeitfaktor);
                        $modul_array['mindiffnormalisiert'] = $mindiffnormalisiert;
                        $modul_array['maxdiffnormalisiert'] = $modul_array['wert_vorletztemessung'] + ($modul_array['maxdiffday']  * $zeitfaktor);
                    }
                    $modul_array['wertdiff'] = $wertdiff;
                    $modul_array['zeitdiff'] = $zeitdiff;

                    $modul_array['zeitfaktor'] =$zeitfaktor;

                    $modul_array['wertdiffnormalisiert'] =  $modul_array['wert_vorletztemessung'] + $wertdiffnormalisiert;
                    $modul_array['diff_danger'] = ($modul_array['wert_letztemessung'] > $modul_array['maxdiffnormalisiert'] ||  $modul_array['wert_letztemessung'] < $mindiffnormalisiert)  ? 1 : 0;
                }
                else {
                    $modul_array['wert_danger'] = $modul_array['checkonly'] && $modul_array['wert_letztemessung'] == 0 || $modul_array['wert_letztemessung'] && ($modul_array['wert_letztemessung'] > $modul_array['max'] || $modul_array['wert_letztemessung'] < $modul_array['min']) && $modul_array['max'] > $modul_array['min'] ? 1 : 0;

                }

                //  $modul_array['max_diff_prozentual'] = $modul_array['diff_value'] * $zeitdiff / $modul_array['maxdiffday'];

                // Alles ausgefüllt?
                if ($letztemessung[0]['rundgangaktiv'] == $aktiver_rundgang->getUid()) {

                } else {
                    $count_offene_messungen++;
                }
                if ($count_offene_messungen == 0) {
                    $lauflistearray['aktiver_rundgang_fertig'] = 1;
                } else {
                    // Anzahl der offenen Störungen
                    $lauflistearray['count_offene_messungen'] = $count_offene_messungen;
                }
                $modul_array['anzahl_offene_stoerungen'] = $this->problemRepository->findOpenByModulID($modul->getUid())->count();
                $module_array[] = $modul_array;
            }
            $lauflistearray['moduls'] = $module_array;
        }
        //   $moduls = $this->modulRepository->findAll();
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('type') == '1452982642') {
            $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
            $theView->setControllerContext($this->controllerContext);
            $theView->assign('laufliste', $lauflistearray);
            $theView->assign('moduls', $moduls);
            $theView->setVariablesToRender(['laufliste']);
            return $theView->render();
        } else {
            $this->view->assign('laufliste', $lauflistearray);
        }
    }

    /**
     * action show
     *
     * @param string $modul
     * @return void
     */
    public function showAction(string $modul = NULL)
    {
        global $TSFE;
        //    mail('s.matthes@emagio.de', 'RFID Scan',  'start ');
        if ($_REQUEST) {
            //     mail('s.matthes@emagio.de', 'RFID Scan', 'start ' . json_encode($_REQUEST));  AKTIVIEREN
        }
        //   mail('s.matthes@emagio.de', 'RFID Scan',  'start1 '.json_encode( \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')));
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('type') == '1452982642') {
            $tokenID = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['modul'];
            $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
            $theView->setControllerContext($this->controllerContext);
            if (strpos($tokenID, 'en') === false) {
                $modul = $this->modulRepository->findByUid($tokenID);
            } else {
                //    mail('s.matthes@emagio.de', 'RFID Scan', 'Scanned TokenID ' . $tokenID);
                //     mail('s.matthes@emagio.de', 'RFID Scan', "Auto Auswahl ".$tokenID);
                $modul = $this->modulRepository->findByTokenID(substr($tokenID, 2));
            }
            $letztemessung = $this->messungRepository->findLetzteMessungModul($modul->getUid());
            $mymodule = [];
            $mymodule['modul']['wert_letztemessung'] = $letztemessung['value'];
            $mymodule['modul']['wert_letztemessung_tstamp'] = $letztemessung['crdate'];
            $mymodule['modul']['time'] = time();
            $mymodule['modul']['diff_milliseconds'] = time() - $letztemessung['crdate'];
            $mymodule['modul']['diff_prozentual'] = $letztemessung['value'] * (time() - $letztemessung['crdate']) / (24 * 60 * 60);
            $mymodule['modul']['data'] = $modul;
            //Dokumente inkl. URL
            //$dokumente = $modul->getDokumente();
            $myDokumente = [];
        /*    foreach ($dokumente as $dokument) {
                $myDokument = [];
                //   var_dump ($dokument->getOriginalResource());
                $doc_url = $dokument->getOriginalResource()->getPublicUrl();
                $doc_title = $dokument->getOriginalResource()->getTitle();
                $myDokument['title'] = $doc_title;
                $myDokument['url'] = $doc_url;
                $myDokumente[] = $myDokument;
            }*/
            $mymodule['modul']['dokumente'] = $myDokumente;
            // Störungen auslesen
            $problems = $this->problemRepository->findByModulID($modul->getUid());
            $problems_array = [];
            $counterproblem = 0;
            $base_url = 'https://service1.danpower-gruppe.de/';

            foreach ($problems as $problem) {
                $problem_array = [];
                $problem_array['uid'] = $problem->getUid();
                $problem_array['text'] = $problem->getText();
                $problem_array['tstamp'] = $problem->getCrdate();
                $problem_array['status'] = $problem->getStatus();
                if ($problem_array['status'] == 0) {
                    $counterproblem++;
                }
                $feuser = $problem->getFeuser();
                $problem_array['user']=$feuser;
                if ($feuser)
                {
                    $problem_array['feuser']['firstName'] = $feuser->getFirstName();
                    $problem_array['feuser']['lastName'] = $feuser->getLastName();
                }
                else {
                    $problem_array['feuser']['firstName'] = "unbekannt";
                    $problem_array['feuser']['lastName'] = "";
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
                    $processedImage = $this->imageService->applyProcessingInstructions($this->imageService->getImage($imagePath, null, false), ['width' => '500', 'height' => '500c-100']);
                    // build absolute url (a little bit cheating with the trim…)
                    //     $imageUri = $this->request->getBaseUri() . trim($this->imageService->getImageUri($processedImage), '/');
                    $imageUri = $base_url . trim($this->imageService->getImageUri($processedImage), '/');
                    $image_array = [];
                    //   var_dump($image);
                    //$image_array("url") =  $image->getOriginalResource()->getPublicUrl();
                    $images_array[] = $imageUri;
                }
                $problem_array['images'] = $images_array;
                // Logs aussuchen
                $logs = $this->logRepository->findByProblem($problem->getUid());
                $logs_array = [];
                foreach ($logs as $log) {
                    $log_array = [];
                    $log_array['uid'] = $log->getUid();
                    $log_array['text'] = $log->getText();
                    $log_array['crdate'] = $log->getCrdate();
                    $log_array['type'] = $log->getType();
                    // $log_array['feuser'] = $log->getFeuser();
                    $feuserlog = $problem->getFeuser();

                    if ($feuserlog)
                    {
                        $log_array['feuser']['firstName'] = $feuserlog->getFirstName();
                        $log_array['feuser']['lastName'] = $feuserlog->getLastName();
                    }
                    else {
                        $log_array['feuser']['firstName'] = "unbekannt";
                        $log_array['feuser']['lastName'] = "";
                    }

                    $logs_array[] = $log_array;
                }
                $problem_array['logs'] = $logs_array;
                $problems_array[] = $problem_array;
            }
            $mymodule['modul']['failures'] = $problems_array;
            $mymodule['modul']['anzahl_offene_stoerungen'] = $counterproblem;
            $theView->assign('modul', $mymodule);
            $theView->setVariablesToRender(['modul']);
            return $theView->render();
        } else {
            if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['moduluid']) {
                $modul = $this->modulRepository->findByUid(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['moduluid']);
                $this->view->assign('modul', $modul);
            } elseif ($modul->getUid()) {
                $this->view->assign('modul', $modul);
            } else {
                $tokenid = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['modul']['tokenid'];
                echo $tokenid;
                $mymodul = $this->modulRepository->findByTokenId($tokenid);
                $this->view->assign('tokenid', $tokenid);
                $this->view->assign('modul', $mymodul);
                $this->redirect('show', 'Modul', NULL, ['modul' => $mymodul]);
            }
            $this->view->assign('user', $GLOBALS['TSFE']->fe_user->user);
        }
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        echo 'user';
        if ($this->request->hasArgument('username')) {
            $password = $this->request->getArgument('password');
            $result = TRUE;
            // Log the user in
            $loginData = [
                'uname' => $this->request->getArgument('username'),
                'uident' => $this->request->getArgument('password'),
                'uident_text' => $row['password'],
                'status' => 'login'
            ];
            $GLOBALS['TSFE']->fe_user->checkPid = 0;
            //do not use a particular pid
            $info = $GLOBALS['TSFE']->fe_user->getAuthInfoArray();
            $user = $GLOBALS['TSFE']->fe_user->fetchUserRecord($info['db_user'], $loginData['uname']);
            #print_r($user);
            if (isset($user) && $user != '') {
                $userId = $user['uid'];
                $userPassword = $user['password'];
                $success = false;
                if (\TYPO3\CMS\Saltedpasswords\Utility\SaltedPasswordsUtility::isUsageEnabled('FE')) {
                    $objSalt = \TYPO3\CMS\Saltedpasswords\Salt\SaltFactory::getSaltingInstance($userPassword);
                    if (is_object($objSalt)) {
                        $success = $objSalt->checkPassword($password, $userPassword);
                    }
                }
                if ($success) {
                    $GLOBALS['TSFE']->fe_user->createUserSession($user);
                    $GLOBALS['TSFE']->fe_user->user = $GLOBALS['TSFE']->fe_user->fetchUserSession();
                    # https://forge.typo3.org/issues/62194
                    # Create Session
                    $reflection = new \ReflectionClass($GLOBALS['TSFE']->fe_user);
                    $setSessionCookieMethod = $reflection->getMethod('setSessionCookie');
                    $setSessionCookieMethod->setAccessible(TRUE);
                    $setSessionCookieMethod->invoke($GLOBALS['TSFE']->fe_user);
                    echo json_encode($user);
                    return true;
                } else {
                    $error['code'] = 'error';
                    $error['msg'] = 'Ein Fehler bei der Eingabe';
                    echo json_encode($error);
                    return true;
                }
            }
            return false;
        }
    }

    /**
     * action create
     *
     * @param \Be\SmLaufliste\Domain\Model\Modul $newModul
     * @return void
     */
    public function createAction(\Be\SmLaufliste\Domain\Model\Modul $newModul)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->modulRepository->add($newModul);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Be\SmLaufliste\Domain\Model\Modul $modul
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("modul")
     * @return void
     */
    public function editAction(\Be\SmLaufliste\Domain\Model\Modul $modul)
    {
        $this->view->assign('modul', $modul);
    }

    /**
     * action update
     *
     * @param \Be\SmLaufliste\Domain\Model\Modul $modul
     * @return void
     */
    public function updateAction(\Be\SmLaufliste\Domain\Model\Modul $modul = NULL)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        // $this->modulRepository->update($modul);
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['modulid'] > 0) {
            $modulid = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['modulid'];
            $modul = $this->modulRepository->findbyUid($modulid);
        }
        $jsonarray = json_decode(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['formjson'], true);
        //   var_dump($jsonarray);
        $messungvalue = $jsonarray['wert'];
        $rundgang_aktiv = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['aktiver_rundgang'];
        $newMessung = new \Be\SmLaufliste\Domain\Model\Messung();
        $messungvalue = str_replace(',', '.',$messungvalue );

        $newMessung->setValue($messungvalue);
        $newMessung->setRundgangaktiv($rundgang_aktiv);
        // Letzte Messung in Modul eintragen
		if (is_numeric($messungvalue)) { $modul->SetLetztemessung($messungvalue);}
       
        $newMessung->setModule($modul);
        $this->messungRepository->add($newMessung);
        $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        $persistenceManager->persistAll();
        $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
        $theView->setControllerContext($this->controllerContext);
        $theView->assign('success', 'true');
        $theView->assign('message', 'Alles gespeichert');
        $theView->assign('data', $newMessung);
        $theView->assign('modul', $modul);
        $theView->setVariablesToRender(['success', 'message', 'data', 'modul']);
        return $theView->render();
    }

    /**
     * action delete
     *
     * @param \Be\SmLaufliste\Domain\Model\Modul $modul
     * @return void
     */
    public function deleteAction(\Be\SmLaufliste\Domain\Model\Modul $modul)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->modulRepository->remove($modul);
        $this->redirect('list');
    }

    /**
     * action showstat
     *
     * @return void
     */
    public function showstatAction()
    {
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('type') == '1452982644') {

            $this->view->assign('user', $GLOBALS['TSFE']->fe_user->user);
            //Auslesen der Modules aus Form
            if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['modules']) {
                $modules = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['modules'];
            }  
			if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['diff']) {
                $diff = true;
            }
            if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['moduluid']) {
                //    echo  \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['moduluid'];
                $modules = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['moduluid'];
            }
            if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['DateFrom']) {
                $startdate = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['DateFrom'];
                $enddate = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['DateUntil'];
            } else {

            }
            //     $startdate = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['DateFrom'];
            //     $enddate = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_smlaufliste_laufliste')['DateUntil'];
            //    krexx($modules);
            //     krexx($startdate);
            //    krexx($enddate);

	
            if ($startdate && $enddate && $modules) {
                $measuredates = $this->modulRepository->findByModulesAndDates($modules, $startdate, $enddate);
            }
           
		   $graph_data = [];
            $graph_labels = [];

            foreach ($measuredates as $key => $row) {
                $time[$key]    = $row['tstamp'];
                $modul[$key]    = $row['module'];
            }

			array_multisort($modul,SORT_DESC,$time,SORT_ASC,$measuredates);
   //       krexx ($measuredates);
            $axis_min_v = 10000000;
			$count=0;
            foreach ($measuredates as $m) {
                $value = str_replace(',', '.',$m['value']);
              //  number_format($number, 2, ',', ' ');
              //  $value = number_format($value, 2, ',', '');
                if ($value != '' && is_numeric($value)) {
					
					// Diff?
					if ($diff){
						if ($count>0){
						$value = $value - $measuredates[$count-1]['value'];
						   $graph_data[$m['module']][date('Y-m-d H:i', $m['tstamp'])] = $value;
                    if ($axis_min_v>$value )$axis_min_v=$value;
                    $graph_labels[$m['module']] = $m['kks'];
						}
					}
					else {
						   $graph_data[$m['module']][date('Y-m-d H:i', $m['tstamp'])] = $value;
                    if ($axis_min_v>$value )$axis_min_v=$value;
                    $graph_labels[$m['module']] = $m['kks'];
					}
					$count++;
                   // echo $value." ";
			// $value =  number_format($value, 2, '.', ' ');
                 
                }
            }
            // wenn min nicht 0
            if ($axis_min_v !=0 && $axis_min_v !=1) { $axis_min_v = $axis_min_v/1.1;} else {$axis_min_v=0;}
            require_once(\TYPO3\CMS\Core\Core\Environment::getPublicPath() . '/' . 'typo3conf/ext/sm_laufliste/Resources/Private/SVGGraph/autoloader.php');
            $graph = new \Goat1000\SVGGraph\SVGGraph(845, 480, [
                'datetime_keys' => true,
                'datetime_text_format' => [
                    'second' => 'd.m.Y H:i:s',
                    'minute' => 'd.m.Y H:i',
                    'hour' => 'd.m.Y H:i',
                    'day' => 'd.m.Y',
                    'month' => 'Y-m',
                    'year' => 'Y'
                ],
                'decimal' => ',',
                'thousands' => '.',
                'axis_min_v' => $axis_min_v,
                'minimum_grid_spacing' => 50,
                'legend_entries' => array_values($graph_labels),
                'legend_type' => 'dataset',
                'show_tooltips' => true,
                'tooltip_font_size' => 24,
                'tooltip_offset' => 20,
                'crosshairs' => true,
                'crosshairs_text_font_size' => 20,
            ]);
            $graph->colours(['#8A0808', '#61380B', '#5E610B', '#21610B', '#0B4C5F', '#4B088A', '#610B21']);
            $graph->values(array_values($graph_data));
            //   $this->view->assign('svgstat', $graph->fetch('MultiLineGraph', false));
            echo $graph->fetch('MultiLineGraph', false);
            die;
        } else {
            //   $moduls = $this->modulRepository->findAllModules();
              $moduls = $this->modulRepository->findAll();
            $this->view->assign('moduls', $moduls);
		//	krexx($moduls);
			$moduls_diff = $this->modulRepository->findAllModulesDiff();
            $this->view->assign('moduls_diff', $moduls_diff);
        }
    }
}
