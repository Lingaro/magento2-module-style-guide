<?php

/**
 * @copyright Copyright © 2021 Orba. All rights reserved.
 * @author    info@orba.co
 */

declare(strict_types=1);

namespace Orba\StyleGuide\ViewModel;

use \InvalidArgumentException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Orba\StyleGuide\Model\Color;

class ColorsProvider implements ArgumentInterface
{
    /**
     * @var Color[]
     */
    private array $colors;

    public function __construct(array $colors = [])
    {
        foreach ($colors as $color) {
            if (!$color instanceof Color) {
                throw new InvalidArgumentException('Array of color models required.');
            }
        }
        $this->colors = $colors;
    }

    /**
     * @return Color[]
     */
    public function getColors(): array
    {
        return $this->colors;
    }
}
