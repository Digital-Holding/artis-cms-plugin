<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\Catalog;

use DH\ArtisCmsPlugin\Entity\CatalogInterface;
use DH\ArtisCmsPlugin\View\Catalog\CatalogView;

interface CatalogViewInterface
{
    public function create(CatalogInterface $page, string $locale): CatalogView;
}
