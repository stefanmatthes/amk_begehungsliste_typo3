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
 * LauflisteController
 */
class LauflisteController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * lauflisteRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\LauflisteRepository
     * @inject
     */
    protected $lauflisteRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $lauflistes = $this->lauflisteRepository->findAll();
    }

    /**
     * action show
     *
     * @param \Be\SmLaufliste\Domain\Model\Laufliste $laufliste
     * @return void
     */
    public function showAction(\Be\SmLaufliste\Domain\Model\Laufliste $laufliste)
    {
        $this->view->assign('laufliste', $laufliste);
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
     * @param \Be\SmLaufliste\Domain\Model\Laufliste $newLaufliste
     * @return void
     */
    public function createAction(\Be\SmLaufliste\Domain\Model\Laufliste $newLaufliste)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->lauflisteRepository->add($newLaufliste);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Be\SmLaufliste\Domain\Model\Laufliste $laufliste
     * @ignorevalidation $laufliste
     * @return void
     */
    public function editAction(\Be\SmLaufliste\Domain\Model\Laufliste $laufliste)
    {
        $this->view->assign('laufliste', $laufliste);
    }

    /**
     * action update
     *
     * @param \Be\SmLaufliste\Domain\Model\Laufliste $laufliste
     * @return void
     */
    public function updateAction(\Be\SmLaufliste\Domain\Model\Laufliste $laufliste)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->lauflisteRepository->update($laufliste);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Be\SmLaufliste\Domain\Model\Laufliste $laufliste
     * @return void
     */
    public function deleteAction(\Be\SmLaufliste\Domain\Model\Laufliste $laufliste)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->lauflisteRepository->remove($laufliste);
        $this->redirect('list');
    }
}
