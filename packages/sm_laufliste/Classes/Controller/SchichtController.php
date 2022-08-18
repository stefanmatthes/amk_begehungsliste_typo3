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
 * SchichtController
 */
class SchichtController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * schichtRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\SchichtRepository
     * @inject
     */
    protected $schichtRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $schichts = $this->schichtRepository->findAll();
        $this->view->assign('schichts', $schichts);
    }

    /**
     * action show
     *
     * @param \Be\SmLaufliste\Domain\Model\Schicht $schicht
     * @return void
     */
    public function showAction(\Be\SmLaufliste\Domain\Model\Schicht $schicht)
    {
        $this->view->assign('schicht', $schicht);
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
     * @param \Be\SmLaufliste\Domain\Model\Schicht $newSchicht
     * @return void
     */
    public function createAction(\Be\SmLaufliste\Domain\Model\Schicht $newSchicht)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->schichtRepository->add($newSchicht);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Be\SmLaufliste\Domain\Model\Schicht $schicht
     * @ignorevalidation $schicht
     * @return void
     */
    public function editAction(\Be\SmLaufliste\Domain\Model\Schicht $schicht)
    {
        $this->view->assign('schicht', $schicht);
    }

    /**
     * action update
     *
     * @param \Be\SmLaufliste\Domain\Model\Schicht $schicht
     * @return void
     */
    public function updateAction(\Be\SmLaufliste\Domain\Model\Schicht $schicht)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->schichtRepository->update($schicht);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Be\SmLaufliste\Domain\Model\Schicht $schicht
     * @return void
     */
    public function deleteAction(\Be\SmLaufliste\Domain\Model\Schicht $schicht)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->schichtRepository->remove($schicht);
        $this->redirect('list');
    }
}
