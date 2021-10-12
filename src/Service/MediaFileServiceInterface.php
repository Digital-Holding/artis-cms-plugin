<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Service;


use DH\ArtisCmsPlugin\Entity\CatalogAttachmentInterface;
use Gaufrette\Filesystem;
use Symfony\Component\HttpFoundation\Response;

interface MediaFileServiceInterface
{
    public function has(string $path): bool;

    public function remove(string $path): bool;

    public function getFilesystem(): Filesystem;

    public function getFileAsResponse(CatalogAttachmentInterface $media, string $filesystemName): Response;

    public function expandPath(string $path): string;
}
