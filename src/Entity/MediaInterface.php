<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use BitBag\SyliusCmsPlugin\Entity\MediaInterface as BaseMediaInterface;

interface MediaInterface extends BaseMediaInterface, PagesAwareInterface
{
}
