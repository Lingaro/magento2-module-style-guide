<?php

/**
 * @copyright Copyright © 2021 Orba. All rights reserved.
 * @author    info@orba.co
 */

declare(strict_types=1);

namespace Orba\StyleGuide\Model;

class Color
{
    private string $code;

    private string $label;

    private string $cssColor;

    public function __construct(string $code, string $label, string $cssColor)
    {
        $this->code = $code;
        $this->label = $label;
        $this->cssColor = $cssColor;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getCssColor(): string
    {
        return $this->cssColor;
    }
}
