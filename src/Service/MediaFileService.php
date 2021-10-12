<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Service;

use DH\ArtisCmsPlugin\Entity\CatalogAttachmentInterface;
use Gaufrette\Filesystem;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Webmozart\Assert\Assert;

final class MediaFileService implements MediaFileServiceInterface
{
    private Filesystem $filesystem;

    private string $filePrefix;

    public function __construct(
        Filesystem $filesystem,
        string $filePrefix
    ) {
        $this->filesystem = $filesystem;
        $this->filePrefix = $filePrefix;
    }

    public function has(string $path): bool
    {
        return $this->filesystem->has($path);
    }

    public function remove(string $path): bool
    {
        if ($this->filesystem->has($path)) {
            return $this->filesystem->delete($path);
        }

        return false;
    }

    public function getFilesystem(): Filesystem
    {
        return $this->filesystem;
    }

    public function getFileAsResponse(CatalogAttachmentInterface $media, string $filesystemName): Response
    {
        Assert::notNull($media->getHash());
        $filepath = $this->expandPath($media->getHash());

        if (!$this->filesystem->has($filepath)) {
            throw new NotFoundHttpException('Not find file od this file path ' . $filepath);
        }

        $response = new BinaryFileResponse('data://' . $filesystemName . '/' . $filepath);

        Assert::notNull($media->getMimeType());
        Assert::notNull($media->getFileName());

        $response->headers->set('Content-Type', $media->getMimeType());
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $media->getFileName()
        );

        return $response;
    }

    public function expandPath(string $path): string
    {
        return sprintf(
            '%s/%s/%s/%s',
            $this->filePrefix,
            substr($path, 0, 2),
            substr($path, 2, 2),
            substr($path, 4)
        );
    }
}
