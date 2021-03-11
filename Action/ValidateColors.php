<?php

/**
 * @copyright Copyright © 2021 Orba. All rights reserved.
 * @author    info@orba.co
 */

declare(strict_types=1);

namespace Orba\StyleGuide\Action;

use InvalidArgumentException;
use Orba\StyleGuide\Model\Color;

class ValidateColors
{
    public function execute(array $colors)
    {
        foreach ($colors as $color) {
            if (!$color instanceof Color) {
                throw new InvalidArgumentException('Array of color models required.');
            }
            if (!\preg_match('/^[a-z0-9\-_]+$/', $color->getCode())) {
                throw new InvalidArgumentException('Color code can use only lowercase letters, digits, underscores and hyphens.');
            }
        }
    }
}
