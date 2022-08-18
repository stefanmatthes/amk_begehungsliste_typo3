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
 * TagController
 */
class TagController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * tagRepository
     *
     * @var \Be\SmLaufliste\Domain\Repository\TagRepository
     * @inject
     */
    protected $tagRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $tags = $this->tagRepository->findAll();
        $this->view->assign('tags', $tags);
    }

    /**
     * action show
     *
     * @param \Be\SmLaufliste\Domain\Model\Tag $tag
     * @return void
     */
    public function showAction(\Be\SmLaufliste\Domain\Model\Tag $tag)
    {
        $this->view->assign('tag', $tag);
    }
}
