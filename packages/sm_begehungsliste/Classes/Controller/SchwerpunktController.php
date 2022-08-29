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
 * SchwerpunktController
 */
class SchwerpunktController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * schwerpunktRepository
     *
     * @var \Be\SmBegehungsliste\Domain\Repository\SchwerpunktRepository
     */
    protected $schwerpunktRepository = null;

    /**
     * @param \Be\SmBegehungsliste\Domain\Repository\SchwerpunktRepository $schwerpunktRepository
     */
    public function injectSchwerpunktRepository(\Be\SmBegehungsliste\Domain\Repository\SchwerpunktRepository $schwerpunktRepository)
    {
        $this->schwerpunktRepository = $schwerpunktRepository;
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
        $schwerpunkts = $this->schwerpunktRepository->findAll();
        $this->view->assign('schwerpunkts', $schwerpunkts);
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
     * @param \Be\SmBegehungsliste\Domain\Model\Schwerpunkt $newSchwerpunkt
     * @return string|object|null|void
     */
    public function createAction(\Be\SmBegehungsliste\Domain\Model\Schwerpunkt $newSchwerpunkt)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->schwerpunktRepository->add($newSchwerpunkt);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Schwerpunkt $schwerpunkt
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("schwerpunkt")
     * @return string|object|null|void
     */
    public function editAction(\Be\SmBegehungsliste\Domain\Model\Schwerpunkt $schwerpunkt)
    {
        $this->view->assign('schwerpunkt', $schwerpunkt);
    }

    /**
     * action update
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Schwerpunkt $schwerpunkt
     * @return string|object|null|void
     */
    public function updateAction(\Be\SmBegehungsliste\Domain\Model\Schwerpunkt $schwerpunkt)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->schwerpunktRepository->update($schwerpunkt);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Schwerpunkt $schwerpunkt
     * @return string|object|null|void
     */
    public function deleteAction(\Be\SmBegehungsliste\Domain\Model\Schwerpunkt $schwerpunkt)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->schwerpunktRepository->remove($schwerpunkt);
        $this->redirect('list');
    }
}
