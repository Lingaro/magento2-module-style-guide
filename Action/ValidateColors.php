<?php

/**
 * Copyright © 2023 Lingaro sp. z o.o. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace Lingaro\StyleGuide\Action;

use InvalidArgumentException;
use Lingaro\StyleGuide\Model\Color;

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
