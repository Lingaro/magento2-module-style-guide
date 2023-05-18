<?php

/**
 * Copyright © 2023 Lingaro sp. z o.o. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace Lingaro\StyleGuide\ViewModel;

use \InvalidArgumentException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Lingaro\StyleGuide\Model\Icon;

class IconsProvider implements ArgumentInterface
{
    /**
     * @var Icon[]
     */
    private array $icons;

    public function __construct(array $icons = [])
    {
        foreach ($icons as $icon) {
            if (!$icon instanceof Icon) {
                throw new InvalidArgumentException('Array of icon models required.');
            }
        }
        $this->icons = $icons;
    }

    /**
     * @return Icon[]
     */
    public function getIcons(): array
    {
        return $this->icons;
    }
}
