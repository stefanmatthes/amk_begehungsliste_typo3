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
    public function updateAction(\Be\SmBegehungsliste\Domain\Model\Problem $problem)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->problemRepository->update($problem);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Be\SmBegehungsliste\Domain\Model\Problem $problem
     * @return string|object|null|void
     */
    public function deleteAction(\Be\SmBegehungsliste\Domain\Model\Problem $problem)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->problemRepository->remove($problem);
        $this->redirect('list');
    }
}
