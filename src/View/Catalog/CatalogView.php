<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\View\Catalog;

use DH\ArtisCmsPlugin\View\Media\MediaView;
use Sylius\Component\Core\Model\ImageInterface;

class CatalogView
{
    public string $menuCode;

    public string $title;

    public string $subTitle;

    public \DateTimeInterface $year;

    public ImageInterface $image;

    public MediaView $attachment;
}
