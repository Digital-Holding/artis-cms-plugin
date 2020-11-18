<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\MapPoint;

use DH\ArtisCmsPlugin\Entity\MapPointInterface;
use DH\ArtisCmsPlugin\View\MapPoint\MapPointView;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\ShopApiPlugin\Factory\Product\ProductVariantViewFactoryInterface;

class MapPointViewFactory implements MapPointViewFactoryInterface
{
    /** @var string */
    private $mapPointViewClass;

    /** @var ProductVariantViewFactoryInterface */
    private $productVariantViewFactory;

    public function __construct(
        string $mapPointViewClass,
        ProductVariantViewFactoryInterface $productVariantViewFactory
    )
    {
        $this->mapPointViewClass = $mapPointViewClass;
        $this->productVariantViewFactory = $productVariantViewFactory;
    }

    public function create(MapPointInterface $mapPoint, ChannelInterface $channel, string $locale)
    {
        /** @var MapPointView $mapPointView */
        $mapPointView = new $this->mapPointViewClass();

        $mapPointView->code = $mapPoint->getCode();
        $mapPointView->name = $mapPoint->getName();
        $mapPointView->address = $mapPoint->getAddress();
        $mapPointView->city = $mapPoint->getCity();
        $mapPointView->openingHours = $mapPoint->getOpeningHours();
        $mapPointView->phone = $mapPoint->getPhoneNumber();

        foreach ($mapPoint->getProductVariants() as $productVariant)
        {
           $mapPointView->productVariants [] = $this->productVariantViewFactory->create($productVariant, $channel, $locale);
        }

        return $mapPointView;
    }
}
