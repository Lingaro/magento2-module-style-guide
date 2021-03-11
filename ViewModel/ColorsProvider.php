<?php

/**
 * @copyright Copyright © 2021 Orba. All rights reserved.
 * @author    info@orba.co
 */

declare(strict_types=1);

namespace Orba\StyleGuide\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Orba\StyleGuide\Action\ValidateColors;
use Orba\StyleGuide\Model\Color;

class ColorsProvider implements ArgumentInterface
{
    /**
     * @var Color[]
     */
    private array $colors;

    public function __construct(ValidateColors $validateColors, array $colors = [])
    {
        $validateColors->execute($colors);
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
