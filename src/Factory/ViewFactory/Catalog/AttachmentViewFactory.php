<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\Catalog;

use DH\ArtisCmsPlugin\Entity\CatalogAttachmentInterface;
use DH\ArtisCmsPlugin\View\Catalog\CatalogAttachmentView;

final class AttachmentViewFactory implements AttachmentViewFactoryInterface
{
    protected string $mediaViewClass;

    protected string $rootDir;

    public function __construct(
        string $mediaViewClass,
        string $rootDir
    ) {
        $this->mediaViewClass = $mediaViewClass;
        $this->rootDir = $rootDir;
    }

    public function create(CatalogAttachmentInterface $media): CatalogAttachmentView
    {
        /** @var CatalogAttachmentView $attachmentView */
        $attachmentView = new $this->mediaViewClass();

        $attachmentDir = $this->rootDir . '/public/uploads/' . $media->getPath();
        $attachmentView->alt = null;
        $attachmentView->path = null;
        $attachmentView->cachedPath = null;

        if (file_exists($attachmentDir)) {
            $attachmentView->alt = $media->getFileName();
            $attachmentView->path = $attachmentDir;
        }

        return $attachmentView;
    }
}
