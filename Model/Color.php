<?php

/**
 * @copyright Copyright © 2021 Orba. All rights reserved.
 * @author    info@orba.co
 */

declare(strict_types=1);

namespace Orba\StyleGuide\Model;

class Color
{
    private string $name;

    private string $cssColor;

    public function __construct(string $name, string $cssColor)
    {
        $this->name = $name;
        $this->cssColor = $cssColor;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCssColor(): string
    {
        return $this->cssColor;
    }
}
