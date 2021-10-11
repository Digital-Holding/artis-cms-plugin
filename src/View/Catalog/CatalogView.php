<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\View\Catalog;

use DH\ArtisCmsPlugin\View\Media\MediaView;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Core\Model\Image;
use Sylius\ShopApiPlugin\View\ImageView;

class CatalogView
{
    public string $menuCode;

    public string $title;

    public string $subTitle;

    public \DateTimeInterface $year;

    public ImageView $image;

    public ?CatalogAttachmentView $attachment;

    public ?string $url;

    public function __construct()
    {
        $this->image = new ImageView();
    }
}
