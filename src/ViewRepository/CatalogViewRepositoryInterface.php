<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\ViewRepository;

use DH\ArtisCmsPlugin\View\Catalog\CatalogView;

interface CatalogViewRepositoryInterface
{
    public function getCatalog(string $menuCode, string $channelCode, string $dateTimeYear, ?string $localeCode): CatalogView;
}
