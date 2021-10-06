<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Sylius\Component\Core\Model\ImagesAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

interface CatalogInterface extends
    ResourceInterface,
    TranslatableInterface,
    ImagesAwareInterface
{
    public const MENU_MAIN = 'main_menu';

    public const MENU_ADDITIONAL = 'additional_menu';

    public function getId(): int;

    public function getTitle(): ?string;

    public function getSubtitle(): ?string;

    public function getYear(): ?string;

    public function getMenuCode(): ?string;

    public function setMenuCode(string $menuCode): self;

}
