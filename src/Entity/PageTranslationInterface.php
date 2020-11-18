<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use BitBag\SyliusCmsPlugin\Entity\PageTranslationInterface as BasePageTranslationInterface;

interface PageTranslationInterface extends BasePageTranslationInterface
{
    public function getShortDescription(): string;

    public function setShortDescription(string $shortDescription): void;
}
