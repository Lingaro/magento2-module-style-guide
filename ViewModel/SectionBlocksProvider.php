<?php

/**
 * Copyright © 2023 Lingaro sp. z o.o. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace Lingaro\StyleGuide\ViewModel;

use Generator;
use InvalidArgumentException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Lingaro\StyleGuide\Block\Section as SectionBlock;
use Lingaro\StyleGuide\Block\SectionFactory as SectionBlockFactory;
use Lingaro\StyleGuide\Model\Section;

class SectionBlocksProvider implements ArgumentInterface
{
    private SectionBlockFactory $sectionBlockFactory;

    /**
     * @var Section[]
     */
    private array $sections;

    public function __construct(SectionBlockFactory $sectionBlockFactory, array $sections = [])
    {
        foreach ($sections as $section) {
            if (!$section instanceof Section) {
                throw new InvalidArgumentException('Array of section models required.');
            }
        }
        $this->sections = $sections;
        $this->sectionBlockFactory = $sectionBlockFactory;
    }

    public function getSectionBlocks(): Generator
    {
        foreach ($this->sections as $section) {
            if ($section->isRemoved()) {
                continue;
            }
            /** @var SectionBlock $block */
            $block = $this->sectionBlockFactory->create();
            $block->setTemplate($section->getTemplate());
            $block->setTitle($section->getTitle());
            $block->setViewModel($section->getViewModel());
            yield $block;
        }
    }
}
