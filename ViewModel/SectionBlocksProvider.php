<?php

/**
 * @copyright Copyright © 2021 Orba. All rights reserved.
 * @author    info@orba.co
 */

declare(strict_types=1);

namespace Orba\StyleGuide\ViewModel;

use Generator;
use InvalidArgumentException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Orba\StyleGuide\Block\Section as SectionBlock;
use Orba\StyleGuide\Block\SectionFactory as SectionBlockFactory;
use Orba\StyleGuide\Model\Section;

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
