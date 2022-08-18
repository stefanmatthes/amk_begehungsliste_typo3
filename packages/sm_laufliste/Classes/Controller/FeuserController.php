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
 * FeuserController
 */
class FeuserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * feuserRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\FeuserRepository
     */
    protected $feuserRepository = null;


    /**
     * @param \Be\SmLaufliste\Domain\FrontendUserRepository $feuserRepository
     */
    public function injectFrontendUserRepository(\Be\SmLaufliste\Domain\FrontendUserRepository $feuserRepository)
    {
        $this->feuserRepository = $feuserRepository;
    }


    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $feusers = $this->feuserRepository->findAll();
        $this->view->assign('feusers', $feusers);
    }

    /**
     * action show
     *
     * @param \Be\SmLaufliste\Domain\Model\Feuser $feuser
     * @return void
     */
    public function showAction(\Be\SmLaufliste\Domain\Model\Feuser $feuser)
    {
        $this->view->assign('feuser', $feuser);
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
     * @param \Be\SmLaufliste\Domain\Model\Feuser $newFeuser
     * @return void
     */
    public function createAction(\Be\SmLaufliste\Domain\Model\Feuser $newFeuser)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->feuserRepository->add($newFeuser);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Be\SmLaufliste\Domain\Model\Feuser $feuser
     * @ignorevalidation $feuser
     * @return void
     */
    public function editAction(\Be\SmLaufliste\Domain\Model\Feuser $feuser)
    {
        $this->view->assign('feuser', $feuser);
    }

    /**
     * action update
     *
     * @param \Be\SmLaufliste\Domain\Model\Feuser $feuser
     * @return void
     */
    public function updateAction(\Be\SmLaufliste\Domain\Model\Feuser $feuser)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->feuserRepository->update($feuser);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Be\SmLaufliste\Domain\Model\Feuser $feuser
     * @return void
     */
    public function deleteAction(\Be\SmLaufliste\Domain\Model\Feuser $feuser)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->feuserRepository->remove($feuser);
        $this->redirect('list');
    }
}
