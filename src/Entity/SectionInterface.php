<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use BitBag\SyliusCmsPlugin\Entity\SectionInterface as BaseSectionInterface;

interface SectionInterface extends BaseSectionInterface
{
    public function isHidden(): bool;

    public function setHidden(bool $isHidden): void;

    public function isTaxonable(): bool;

    public function setTaxonable(bool $taxonable): void;
}
