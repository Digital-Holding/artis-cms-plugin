<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Uploader;

use DH\ArtisCmsPlugin\Entity\CatalogAttachmentInterface;
use DH\ArtisCmsPlugin\Service\MediaFileServiceInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Webmozart\Assert\Assert;

final class CatalogAttachmentUploader implements CatalogAttachmentUploaderInterface
{
    public const
        FILE_PREFIX = 'catalog_attachment_media'
    ;

    private MediaFileServiceInterface $mediaFileService;

    public function __construct(MediaFileServiceInterface $mediaFileService)
    {
        $this->mediaFileService = $mediaFileService;
    }

    public function upload(CatalogAttachmentInterface $attachment): void
    {
        if (!$attachment->hasFile()) {
            return;
        }

        /** @var UploadedFile $file */
        $file = $attachment->getFile();
        Assert::notNull($file);
        Assert::isInstanceOf($file, File::class);

        $filesystem = $this->mediaFileService->getFilesystem();
        if (null !== $attachment->getPath() && $this->has($attachment->getPath())) {
            $this->remove($attachment->getPath());
        }

        if (null !== $attachment->getHash() && $this->mediaFileService->has($attachment->getHash())) {
            $this->mediaFileService->remove($attachment->getHash());
        }

        do {
            $hash = bin2hex(random_bytes(16));
            $path = $this->mediaFileService->expandPath($hash);
        } while (
            $this->mediaFileService->has($path)
        );

        $attachment->setPath($path);
        $attachment->setHash($hash);
        $attachment->setMimeType($file->getMimeType());
        $attachment->setFileName($file->getClientOriginalName());

        if (is_string(file_get_contents($file->getPathname()))) {
            $filesystem->write(
                $path,
                file_get_contents($file->getPathname())
            );
        }
    }

    public function remove(string $path): bool
    {
        if ($this->mediaFileService->has($path)) {
            return $this->mediaFileService->remove($path);
        }

        return false;
    }

    private function has(string $path): bool
    {
        return $this->mediaFileService->has($path);
    }
}
