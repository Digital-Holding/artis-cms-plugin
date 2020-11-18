<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\Media;

use BitBag\SyliusCmsPlugin\Entity\MediaInterface;
use DH\ArtisCmsPlugin\View\Media\MediaView;
use Liip\ImagineBundle\Service\FilterService;

final class MediaViewFactory implements MediaViewFactoryInterface
{
    /** @var string */
    private $mediaViewClass;

    /** @var FilterService */
    private $filterService;

    /** @var string */
    private $filter;

    /** @var string */
    private $rootDir;

    public function __construct(
        string $mediaViewClass,
        FilterService $filterService,
        string $filter,
        string $rootDir
    )
    {
        $this->mediaViewClass = $mediaViewClass;
        $this->filterService = $filterService;
        $this->filter = $filter;
        $this->rootDir = $rootDir;
    }

    public function create(MediaInterface $media): MediaView
    {
        /** @var MediaView $mediaView */
        $mediaView = new $this->mediaViewClass();

        $imageDir = $this->rootDir . '/public/' . $media->getPath();

        if (file_exists($imageDir)) {
            $mediaView->type = $media->getType();
            $mediaView->alt = $media->getAlt();
            $mediaView->path = $media->getPath();

            if('image' == $media->getType()) {
                $mediaView->cachedPath = $this->filterService->getUrlOfFilteredImage(str_replace("/media/image/", "", $media->getPath()), $this->filter);
            }

            return $mediaView;
        }

        $mediaView->type = null;
        $mediaView->alt = null;
        $mediaView->path = null;

        $mediaView->cachedPath = null;

        return $mediaView;
    }
}
