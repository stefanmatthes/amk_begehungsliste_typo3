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
 * RundgangController
 */
class RundgangController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * rundgangRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\RundgangRepository
     * @inject
     */
    protected $rundgangRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $rundgangs = $this->rundgangRepository->findAll();
        $this->view->assign('rundgangs', $rundgangs);
    }

    /**
     * action show
     *
     * @param \Be\SmLaufliste\Domain\Model\Rundgang $rundgang
     * @return void
     */
    public function showAction(\Be\SmLaufliste\Domain\Model\Rundgang $rundgang)
    {
        $this->view->assign('rundgang', $rundgang);
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
     * @param \Be\SmLaufliste\Domain\Model\Rundgang $newRundgang
     * @return void
     */
    public function createAction(\Be\SmLaufliste\Domain\Model\Rundgang $newRundgang)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->rundgangRepository->add($newRundgang);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Be\SmLaufliste\Domain\Model\Rundgang $rundgang
     * @ignorevalidation $rundgang
     * @return void
     */
    public function editAction(\Be\SmLaufliste\Domain\Model\Rundgang $rundgang)
    {
        $this->view->assign('rundgang', $rundgang);
    }

    /**
     * action update
     *
     * @param \Be\SmLaufliste\Domain\Model\Rundgang $rundgang
     * @return void
     */
    public function updateAction(\Be\SmLaufliste\Domain\Model\Rundgang $rundgang)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->rundgangRepository->update($rundgang);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Be\SmLaufliste\Domain\Model\Rundgang $rundgang
     * @return void
     */
    public function deleteAction(\Be\SmLaufliste\Domain\Model\Rundgang $rundgang)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->rundgangRepository->remove($rundgang);
        $this->redirect('list');
    }
}
