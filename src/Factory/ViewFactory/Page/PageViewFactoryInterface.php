<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\Page;

use DH\ArtisCmsPlugin\Entity\PageInterface;
use DH\ArtisCmsPlugin\View\Page\PageView;

interface PageViewFactoryInterface
{
    public function create(PageInterface $page, string $locale): PageView;
}
