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
 * MassnahmeController
 */
class MassnahmeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * massnahmeRepository
     *
     * @var \Be\SmBegehungsliste\Domain\Repository\MassnahmeRepository
     */
    protected $massnahmeRepository = null;

    /**
     * @param \Be\SmBegehungsliste\Domain\Repository\MassnahmeRepository $massnahmeRepository
     */
    public function injectMassnahmeRepository(\Be\SmBegehungsliste\Domain\Repository\MassnahmeRepository $massnahmeRepository)
    {
        $this->massnahmeRepository = $massnahmeRepository;
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
        $massnahmes = $this->massnahmeRepository->findAll();
        $this->view->assign('massnahmes', $massnahmes);
    }

    /**
     * action show
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Massnahme $massnahme
     * @return string|object|null|void
     */
    public function showAction(\Be\SmBegehungsliste\Domain\Model\Massnahme $massnahme)
    {
        $this->view->assign('massnahme', $massnahme);
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
     * @param \Be\SmBegehungsliste\Domain\Model\Massnahme $newMassnahme
     * @return string|object|null|void
     */
    public function createAction(\Be\SmBegehungsliste\Domain\Model\Massnahme $newMassnahme)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->massnahmeRepository->add($newMassnahme);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Massnahme $massnahme
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("massnahme")
     * @return string|object|null|void
     */
    public function editAction(\Be\SmBegehungsliste\Domain\Model\Massnahme $massnahme)
    {
        $this->view->assign('massnahme', $massnahme);
    }

    /**
     * action update
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Massnahme $massnahme
     * @return string|object|null|void
     */
    public function updateAction(\Be\SmBegehungsliste\Domain\Model\Massnahme $massnahme)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->massnahmeRepository->update($massnahme);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Massnahme $massnahme
     * @return string|object|null|void
     */
    public function deleteAction(\Be\SmBegehungsliste\Domain\Model\Massnahme $massnahme)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->massnahmeRepository->remove($massnahme);
        $this->redirect('list');
    }
}
