<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

interface CatalogTranslationInterface extends ResourceInterface
{
    public function getTitle(): ?string;

    public function setTitle(?string $title): self;

    public function getYear(): ?string;

    public function setYear(?string $year): self;

    public function getSubtitle(): ?string;

    public function setSubtitle(?string $subtitle): self;
}
