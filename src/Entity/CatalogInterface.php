<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use DateTimeInterface;
use Sylius\Component\Core\Model\ImageAwareInterface;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

interface CatalogInterface extends
    ResourceInterface,
    TranslatableInterface,
    ImageAwareInterface
{
    public const MENU_MAIN = 'main_menu';

    public const MENU_ADDITIONAL = 'additional_menu';

    public function getId(): int;

    public function getTitle(): ?string;

    public function getSubtitle(): ?string;

    public function getYear(): ?DateTimeInterface;

    public function setYear(?DateTimeInterface $year);

    public function getMenuCode(): ?string;

    public function setMenuCode(string $menuCode): self;

    public function getImage(): ?ImageInterface;

    public function setImage(?ImageInterface $image): void;

    public function getTranslation(?string $locale = null): TranslationInterface;

    public function getAttachment(): ?CatalogAttachmentInterface;

    public function setAttachment(?CatalogAttachmentInterface $attachment): void;
}
