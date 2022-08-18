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
 * StandortController
 */
class StandortController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * standortRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\StandortRepository
     * @inject
     */
    protected $standortRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $standorts = $this->standortRepository->findAll();
        $this->view->assign('standorts', $standorts);
    }

    /**
     * action show
     *
     * @param \Be\SmLaufliste\Domain\Model\Standort $standort
     * @return void
     */
    public function showAction(\Be\SmLaufliste\Domain\Model\Standort $standort)
    {
        $this->view->assign('standort', $standort);
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
     * @param \Be\SmLaufliste\Domain\Model\Standort $newStandort
     * @return void
     */
    public function createAction(\Be\SmLaufliste\Domain\Model\Standort $newStandort)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->standortRepository->add($newStandort);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Be\SmLaufliste\Domain\Model\Standort $standort
     * @ignorevalidation $standort
     * @return void
     */
    public function editAction(\Be\SmLaufliste\Domain\Model\Standort $standort)
    {
        $this->view->assign('standort', $standort);
    }

    /**
     * action update
     *
     * @param \Be\SmLaufliste\Domain\Model\Standort $standort
     * @return void
     */
    public function updateAction(\Be\SmLaufliste\Domain\Model\Standort $standort)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->standortRepository->update($standort);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Be\SmLaufliste\Domain\Model\Standort $standort
     * @return void
     */
    public function deleteAction(\Be\SmLaufliste\Domain\Model\Standort $standort)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->standortRepository->remove($standort);
        $this->redirect('list');
    }
}
