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
 * RundgangaktivController
 */
class RundgangaktivController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * rundgangaktivRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\RundgangaktivRepository
     * @inject
     */
    protected $rundgangaktivRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $rundgangaktivs = $this->rundgangaktivRepository->findAll();
        $this->view->assign('rundgangaktivs', $rundgangaktivs);
    }

    /**
     * action show
     *
     * @param \Be\SmLaufliste\Domain\Model\Rundgangaktiv $rundgangaktiv
     * @return void
     */
    public function showAction(\Be\SmLaufliste\Domain\Model\Rundgangaktiv $rundgangaktiv)
    {
        $this->view->assign('rundgangaktiv', $rundgangaktiv);
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
     * @param \Be\SmLaufliste\Domain\Model\Rundgangaktiv $newRundgangaktiv
     * @return void
     */
    public function createAction(\Be\SmLaufliste\Domain\Model\Rundgangaktiv $newRundgangaktiv)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->rundgangaktivRepository->add($newRundgangaktiv);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Be\SmLaufliste\Domain\Model\Rundgangaktiv $rundgangaktiv
     * @ignorevalidation $rundgangaktiv
     * @return void
     */
    public function editAction(\Be\SmLaufliste\Domain\Model\Rundgangaktiv $rundgangaktiv)
    {
        $this->view->assign('rundgangaktiv', $rundgangaktiv);
    }

    /**
     * action update
     *
     * @param \Be\SmLaufliste\Domain\Model\Rundgangaktiv $rundgangaktiv
     * @return void
     */
    public function updateAction(\Be\SmLaufliste\Domain\Model\Rundgangaktiv $rundgangaktiv)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->rundgangaktivRepository->update($rundgangaktiv);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Be\SmLaufliste\Domain\Model\Rundgangaktiv $rundgangaktiv
     * @return void
     */
    public function deleteAction(\Be\SmLaufliste\Domain\Model\Rundgangaktiv $rundgangaktiv)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->rundgangaktivRepository->remove($rundgangaktiv);
        $this->redirect('list');
    }
}
