<?php

/**
 * @copyright Copyright © 2021 Orba. All rights reserved.
 * @author    info@orba.co
 */

declare(strict_types=1);
 
namespace Orba\StyleGuide\Controller\Layout;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Theme\Block\Html\Breadcrumbs;

abstract class AbstractAction extends Action implements HttpGetActionInterface
{
    private PageFactory $pageFactory;

    protected string $title = '';

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute(): Page
    {
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set(__($this->title));

        /** @var Breadcrumbs */
        $breadcrumbs = $page->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb(
            'home',
            [
                'label' => __('Home'),
                'title' => __('Home'),
                'link' => $this->_url->getUrl('')
            ]
        );
        $breadcrumbs->addCrumb(
            'style_guide',
            [
                'label' => __('Style Guide'),
                'title' => __('Style Guide'),
                'link' => $this->_url->getUrl('style_guide')
            ]
        );
        $breadcrumbs->addCrumb(
            'layout',
            [
                'label' => __($this->title),
                'title' => __($this->title)
            ]
        );

        return $page;
    }
}
