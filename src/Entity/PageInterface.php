<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use BitBag\SyliusCmsPlugin\Entity\PageInterface as BasePageInterface;
use Sylius\Component\Core\Model\ImagesAwareInterface;

interface PageInterface extends BasePageInterface, ImagesAwareInterface
{
}
