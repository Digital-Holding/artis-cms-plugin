<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\Media;

use BitBag\SyliusCmsPlugin\Entity\MediaInterface;
use DH\ArtisCmsPlugin\View\Media\MediaView;

interface MediaViewFactoryInterface
{
    public function create(MediaInterface $media): MediaView;
}
