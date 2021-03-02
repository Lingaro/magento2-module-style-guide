<?php

/**
 * @copyright Copyright © 2021 Orba. All rights reserved.
 * @author    info@orba.co
 */

declare(strict_types=1);

namespace Orba\StyleGuide\Model;

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
