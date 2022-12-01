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
 * ProblemController
 */
class ProblemController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

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
     * action index
     *
     * @return string|object|null|void
     */
    public function indexAction()
    {
    }

    /**
     * action list
     *
     * @return string|object|null|void
     */
    public function listAction()
    {
        $problems = $this->problemRepository->findAll();
        $this->view->assign('problems', $problems);
    }

    /**
     * action show
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Problem $problem
     * @return string|object|null|void
     */
    public function showAction(\Be\SmBegehungsliste\Domain\Model\Problem $problem)
    {
        $this->view->assign('problem', $problem);
    }

    /**
     * action new
     *
     * @return string|object|null|void
     */
    public function newAction()
    {
    }

    /**
     * action create
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Problem $newProblem
     * @return string|object|null|void
     */
    public function createAction(\Be\SmBegehungsliste\Domain\Model\Problem $newProblem)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->problemRepository->add($newProblem);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Problem $problem
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("problem")
     * @return string|object|null|void
     */
    public function editAction(\Be\SmBegehungsliste\Domain\Model\Problem $problem)
    {
        $this->view->assign('problem', $problem);
    }

    /**
     * action update
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Problem $problem
     * @return string|object|null|void
     */
    public function updateAction(\Be\SmBegehungsliste\Domain\Model\Problem $problem = NULL)
    {


        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
    // echo "update ".\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('problemUid');


        $problem = $this->problemRepository->findByUid(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('problemUid'));
    //    if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('status') ){
          //  echo "setstatus";

      //  }


        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('type') == '1452982642') {
           // was soll gemacht werden?
            // Status setzen

     //       echo "modus: ".\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('modus');
            if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('modus') == 'status')
            {
                $new_status = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('status') ;
                $problem->setStatus(intval($new_status));
         //       echo "new status ".$new_status;
            }

            if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('modus') == 'deleteimage')
            {
                foreach ($problem->getImage() as $image) {
                    $problem->removeImage($image);
                //    echo "11";

                }
         //       echo "new status ".$new_status;
            }

            $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
            $theView->setControllerContext($this->controllerContext);

            $theView->assign('mangel', $problem);

            //   $theView->assign('rundgaenge', $rundgange_array);
         //   $theView->setVariablesToRender(['rundgaenge']);
            $this->problemRepository->update($problem);

            $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
            $persistenceManager->persistAll();

            return $theView->render();

        }

        die();

    //    $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Problem $problem
     * @return string|object|null|void
     */
    public function deleteAction(\Be\SmBegehungsliste\Domain\Model\Problem $problem = NULL)
    {
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('type') == '1452982642') {
            $problem = $this->problemRepository->findByUid(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('problemUid'));

            $theView = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView');
            $theView->setControllerContext($this->controllerContext);


            //   $theView->assign('rundgaenge', $rundgange_array);
            //   $theView->setVariablesToRender(['rundgaenge']);
            $this->problemRepository->remove($problem);

            $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
            $persistenceManager->persistAll();

            return $theView->render();
die();
        }

        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->problemRepository->remove($problem);
        $this->redirect('list');
    }
}
