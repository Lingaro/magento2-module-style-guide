<?php

/**
 * @copyright Copyright © 2021 Orba. All rights reserved.
 * @author    info@orba.co
 */

declare(strict_types=1);

namespace Orba\StyleGuide\ViewModel;

use \InvalidArgumentException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Orba\StyleGuide\Model\Icon;

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
