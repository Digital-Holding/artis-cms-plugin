<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\Catalog;

use BitBag\SyliusCmsPlugin\Repository\MediaRepositoryInterface;
use DH\ArtisCmsPlugin\Entity\CatalogInterface;
use DH\ArtisCmsPlugin\Entity\CatalogTranslationInterface;
use DH\ArtisCmsPlugin\Factory\ViewFactory\Media\MediaViewFactoryInterface;
use DH\ArtisCmsPlugin\View\Catalog\CatalogView;
use Sylius\ShopApiPlugin\Factory\ImageViewFactoryInterface;

final class CatalogViewFactory implements CatalogViewInterface
{
    private ImageViewFactoryInterface $imageViewFactory;

    private string $catalogViewClass;

    private MediaRepositoryInterface $mediaRepository;

    private MediaViewFactoryInterface $mediaViewFactory;

    public function __construct
    (
        ImageViewFactoryInterface $imageViewFactory,
        string                    $catalogViewClass,
        MediaRepositoryInterface  $mediaRepository,
        MediaViewFactoryInterface $mediaViewFactory
    )
    {
        $this->imageViewFactory = $imageViewFactory;
        $this->catalogViewClass = $catalogViewClass;
        $this->mediaRepository = $mediaRepository;
        $this->mediaViewFactory = $mediaViewFactory;
    }

    public function create(CatalogInterface $catalog, string $locale): CatalogView
    {
        /** @var CatalogTranslationInterface $pageTranslation */
        $catalogTranslation = $catalog->getTranslation($locale);

        /** @var CatalogView $catalogView */
        $catalogView = new $this->catalogViewClass();

        $catalogView->menuCode = $catalog->getMenuCode();
        $catalogView->title = $catalogTranslation->getTitle();
        $catalogView->subTitle = $catalogTranslation->getSubtitle();
        $catalogView->year = $catalog->getYear();

        $catalogView->image = $this->imageViewFactory->create(
            $catalog->getImage()
        );

        $catalogView->attachment = $this->mediaViewFactory->create($catalog->getAttachment());

        return $catalogView;
    }
}
