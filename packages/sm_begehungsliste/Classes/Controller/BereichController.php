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
 * BereichController
 */
class BereichController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * bereichRepository
     *
     * @var \Be\SmBegehungsliste\Domain\Repository\BereichRepository
     */
    protected $bereichRepository = null;

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
        $bereiches = $this->bereichRepository->findAll();
        $this->view->assign('bereiches', $bereiches);
    }

    /**
     * action show
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Bereich $bereich
     * @return string|object|null|void
     */
    public function showAction(\Be\SmBegehungsliste\Domain\Model\Bereich $bereich)
    {
        $this->view->assign('bereich', $bereich);
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
     * @param \Be\SmBegehungsliste\Domain\Model\Bereich $newBereich
     * @return string|object|null|void
     */
    public function createAction(\Be\SmBegehungsliste\Domain\Model\Bereich $newBereich)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->bereichRepository->add($newBereich);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Bereich $bereich
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("bereich")
     * @return string|object|null|void
     */
    public function editAction(\Be\SmBegehungsliste\Domain\Model\Bereich $bereich)
    {
        $this->view->assign('bereich', $bereich);
    }

    /**
     * action update
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Bereich $bereich
     * @return string|object|null|void
     */
    public function updateAction(\Be\SmBegehungsliste\Domain\Model\Bereich $bereich)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->bereichRepository->update($bereich);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Bereich $bereich
     * @return string|object|null|void
     */
    public function deleteAction(\Be\SmBegehungsliste\Domain\Model\Bereich $bereich)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->bereichRepository->remove($bereich);
        $this->redirect('list');
    }
}
