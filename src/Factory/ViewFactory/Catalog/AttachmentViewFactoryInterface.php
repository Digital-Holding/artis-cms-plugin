<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\Catalog;

use DH\ArtisCmsPlugin\Entity\CatalogAttachmentInterface;
use DH\ArtisCmsPlugin\View\Catalog\CatalogAttachmentView;

interface AttachmentViewFactoryInterface
{
    public function create(CatalogAttachmentInterface $media): CatalogAttachmentView;
}
