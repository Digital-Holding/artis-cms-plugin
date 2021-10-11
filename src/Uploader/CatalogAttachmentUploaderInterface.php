<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Uploader;

use DH\ArtisCmsPlugin\Entity\CatalogAttachmentInterface;

interface CatalogAttachmentUploaderInterface
{
    public function upload(CatalogAttachmentInterface $attachment): void;
}
