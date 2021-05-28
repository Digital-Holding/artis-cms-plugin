<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\ViewRepository;

use Sylius\ShopApiPlugin\Model\PaginatorDetails;
use Sylius\ShopApiPlugin\View\Product\PageView;

interface PageCatalogViewRepositoryInterface
{
    public function findEnabled(string $channelCode, PaginatorDetails $paginatorDetails, ?string $localeCode): PageView;

    public function findEnabledBySectionCode(string $sectionCode, string $channelCode, PaginatorDetails $paginatorDetails, ?string $localeCode): PageView;
}
