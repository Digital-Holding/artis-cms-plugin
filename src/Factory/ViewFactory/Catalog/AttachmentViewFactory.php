<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\Catalog;

use DH\ArtisCmsPlugin\Entity\CatalogAttachmentInterface;
use DH\ArtisCmsPlugin\View\Catalog\CatalogAttachmentView;
use Gaufrette\Filesystem;
use Symfony\Component\Routing\RouterInterface;

final class AttachmentViewFactory implements AttachmentViewFactoryInterface
{
    protected string $mediaViewClass;

    protected string $rootDir;

    private Filesystem $filesystem;

    private string $filePath;

    private RouterInterface $router;

    public function __construct(
        string $mediaViewClass,
        string $rootDir,
        Filesystem $filesystem,
        string $filePath,
        RouterInterface $router
    ) {
        $this->mediaViewClass = $mediaViewClass;
        $this->rootDir = $rootDir;
        $this->filesystem = $filesystem;
        $this->filePath = $filePath;
        $this->router = $router;
    }

    public function create(CatalogAttachmentInterface $media): CatalogAttachmentView
    {
        /** @var CatalogAttachmentView $attachmentView */
        $attachmentView = new $this->mediaViewClass();

        $filePath = $this->expandPath($media->getHash());

        $attachmentView->alt = null;
        $attachmentView->path = null;
        $attachmentView->cachedPath = null;

        if ($this->filesystem->has($filePath)) {
            $attachmentView->alt = $media->getFileName();
            $attachmentView->path = $this->resolvePath($media->getPath());
        }

        return $attachmentView;
    }

    private function resolvePath(string $path): string
    {
        $scheme = $this->router->getContext()->getScheme();
        $schemeAndHttpHost = $scheme . "://" . $this->router->getContext()->getHost();

        $port = '';

        if ('https' === $this->router->getContext()->getScheme() && 443 !== $this->router->getContext()->getHttpsPort()) {
            $port = ":{$this->router->getContext()->getHttpsPort()}";
        }
        if ('http' === $this->router->getContext()->getScheme() && 80 !== $this->router->getContext()->getHttpPort()) {
            $port = ":{$this->router->getContext()->getHttpPort()}";
        }

        return $schemeAndHttpHost . $port . '/uploads/' . $path;
    }

    public function expandPath(string $path): string
    {
        return sprintf(
            '%s/%s/%s/%s',
            $this->filePath,
            substr($path, 0, 2),
            substr($path, 2, 2),
            substr($path, 4)
        );
    }
}
