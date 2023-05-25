<?php

/**
 * Copyright © 2023 Lingaro sp. z o.o. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace Lingaro\StyleGuide\Model;

class Icon
{
    private string $name;

    private string $cssClass;

    public function __construct(string $name, string $cssClass)
    {
        $this->name = $name;
        $this->cssClass = $cssClass;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCssClass(): string
    {
        return $this->cssClass;
    }
}
