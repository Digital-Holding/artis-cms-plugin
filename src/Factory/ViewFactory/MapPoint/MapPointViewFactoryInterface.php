<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\MapPoint;

use DH\ArtisCmsPlugin\Entity\MapPointInterface;
use Sylius\Component\Core\Model\ChannelInterface;

interface MapPointViewFactoryInterface
{
    public function create(MapPointInterface $mapPoint, ChannelInterface $channel, string $locale);
}
