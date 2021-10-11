<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\Catalog;

use DH\ArtisCmsPlugin\Entity\CatalogInterface;
use DH\ArtisCmsPlugin\Entity\CatalogTranslationInterface;
use DH\ArtisCmsPlugin\View\Catalog\CatalogView;
use Sylius\ShopApiPlugin\Factory\ImageViewFactoryInterface;

final class CatalogViewFactory implements CatalogViewInterface
{
    private ImageViewFactoryInterface $imageViewFactory;

    private string $catalogViewClass;

    private AttachmentViewFactoryInterface $attachmentViewFactory;

    public function __construct
    (
        ImageViewFactoryInterface $imageViewFactory,
        string                    $catalogViewClass,
        AttachmentViewFactoryInterface $attachmentViewFactory
    ) {
        $this->imageViewFactory = $imageViewFactory;
        $this->catalogViewClass = $catalogViewClass;
        $this->attachmentViewFactory = $attachmentViewFactory;
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
        $catalogView->url = $catalog->getUrl();
        $catalogView->image = $this->imageViewFactory->create(
            $catalog->getImage()
        );

        $catalogView->attachment = null;
        if (null !== $catalog->getAttachment()) {
            $catalogView->attachment = $this->attachmentViewFactory->create($catalog->getAttachment());
        }

        return $catalogView;
    }
}
