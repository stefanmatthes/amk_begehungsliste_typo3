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
 * MessungController
 */
class MessungController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * messungRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\MessungRepository
     * @inject
     */
    protected $messungRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $messungs = $this->messungRepository->findAll();
        $this->view->assign('messungs', $messungs);
    }

    /**
     * action show
     *
     * @param \Be\SmLaufliste\Domain\Model\Messung $messung
     * @return void
     */
    public function showAction(\Be\SmLaufliste\Domain\Model\Messung $messung)
    {
        $this->view->assign('messung', $messung);
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
     * @param \Be\SmLaufliste\Domain\Model\Messung $newMessung
     * @return void
     */
    public function createAction(\Be\SmLaufliste\Domain\Model\Messung $newMessung)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->messungRepository->add($newMessung);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Be\SmLaufliste\Domain\Model\Messung $messung
     * @ignorevalidation $messung
     * @return void
     */
    public function editAction(\Be\SmLaufliste\Domain\Model\Messung $messung)
    {
        $this->view->assign('messung', $messung);
    }

    /**
     * action update
     *
     * @param \Be\SmLaufliste\Domain\Model\Messung $messung
     * @return void
     */
    public function updateAction(\Be\SmLaufliste\Domain\Model\Messung $messung)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->messungRepository->update($messung);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Be\SmLaufliste\Domain\Model\Messung $messung
     * @return void
     */
    public function deleteAction(\Be\SmLaufliste\Domain\Model\Messung $messung)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->messungRepository->remove($messung);
        $this->redirect('list');
    }
}
