<?php

/**
 * Copyright © 2023 Lingaro sp. z o.o. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace Lingaro\StyleGuide\Block;

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
