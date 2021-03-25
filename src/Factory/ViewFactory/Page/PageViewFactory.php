<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\Page;

use BitBag\SyliusCmsPlugin\Entity\PageTranslationInterface;
use BitBag\SyliusCmsPlugin\Repository\MediaRepositoryInterface;
use DH\ArtisCmsPlugin\Entity\PageInterface;
use DH\ArtisCmsPlugin\Factory\ViewFactory\Media\MediaViewFactoryInterface;
use DH\ArtisCmsPlugin\View\Page\PageView;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\ShopApiPlugin\Factory\ImageViewFactoryInterface;
use Sylius\ShopApiPlugin\Factory\Product\ProductVariantViewFactoryInterface;

final class PageViewFactory implements PageViewFactoryInterface
{
    /** @var ImageViewFactoryInterface */
    private $imageViewFactory;

    /** @var string */
    private $pageViewClass;

    /** @var MediaRepositoryInterface */
    private $mediaRepository;

    /** @var MediaViewFactoryInterface  */
    private $mediaViewFactory;

    /** @var ProductVariantViewFactoryInterface */
    private $productVariantViewFactory;

    /** @var ChannelContextInterface */
    private $channelContext;

    public function __construct
    (
        ImageViewFactoryInterface $imageViewFactory,
        string $pageViewClass,
        MediaRepositoryInterface $mediaRepository,
        MediaViewFactoryInterface $mediaViewFactory,
        ProductVariantViewFactoryInterface $productVariantViewFactory,
        ChannelContextInterface $channelContext
    )
    {
        $this->imageViewFactory = $imageViewFactory;
        $this->pageViewClass = $pageViewClass;
        $this->mediaRepository = $mediaRepository;
        $this->mediaViewFactory = $mediaViewFactory;
        $this->productVariantViewFactory = $productVariantViewFactory;
        $this->channelContext = $channelContext;
    }

    public function create(PageInterface $page, string $locale): PageView
    {
        /** @var ChannelInterface $channel */
        $channel = $this->channelContext->getChannel();

        /** @var PageTranslationInterface $pageTranslation */
        $pageTranslation = $page->getTranslation($locale);

        /** @var PageView $pageView */
        $pageView = new $this->pageViewClass();

        $pageView->code = $page->getCode();
        $pageView->name = $pageTranslation->getName();
        $pageView->content = $pageTranslation->getContent();
        $pageView->slug = $pageTranslation->getSlug();
        $pageView->metaDescription = $pageTranslation->getMetaDescription();
        $pageView->metaKeywords = $pageTranslation->getMetaKeywords();
        $pageView->nameWhenLinked = $pageTranslation->getNameWhenLinked();
        $pageView->descriptionWhenLinked = $pageTranslation->getDescriptionWhenLinked();
        $pageView->timestamp = $page->getCreatedAt();
        $pageView->shortDescription = $pageTranslation->getShortDescription();

        foreach ($page->getProductVariants() as $productVariant) {
            $pageView->variants [] = $this->productVariantViewFactory->create($productVariant, $channel, $locale);
        }

        if (false !== $page->getSections()->current()) {
            $pageView->sectionCode = $page->getSections()->current()->getCode();
            $pageView->sectionName = $page->getSections()->current()->getName();
        }

        if (null !== $pageTranslation->getImage()) {
            $pageView->image[] = $this->mediaViewFactory->create($pageTranslation->getImage());
        }

        $images = $page->getImages();

        foreach ($images as $image) {
            $pageView->images[] = $this->imageViewFactory->create($image);
        }

        $medias = $this->mediaRepository->findByPageCode($page->getCode());

        foreach ($medias as $media) {
            $pageView->medias[] = $this->mediaViewFactory->create($media);
        }

        return $pageView;
    }
}
