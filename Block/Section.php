<?php

/**
 * @copyright Copyright © 2021 Orba. All rights reserved.
 * @author    info@orba.co
 */

declare(strict_types=1);

namespace Orba\StyleGuide\Block;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\Element\Template;

class Section extends Template
{
    public function getTitle(): string
    {
        return $this->getData('title') ?? '';
    }

    public function setTitle(string $title): void
    {
        $this->setData('title', $title);
    }

    public function getViewModel(): ?ArgumentInterface
    {
        return $this->getData('view_model');
    }

    public function setViewModel(?ArgumentInterface $viewModel)
    {
        return $this->setData('view_model', $viewModel);
    }
}
