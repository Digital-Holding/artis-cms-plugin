<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\Section;

use BitBag\SyliusCmsPlugin\Entity\SectionInterface;

interface SectionViewFactoryInterface
{
    public function create(SectionInterface $section, string $locale);
}
