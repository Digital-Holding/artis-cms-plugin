<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

interface CatalogImageInterface
{
    public function setOwnerId(?int $id): self;

    public function getOwnerId(): ?int;

    public function setType(?string $type): self;

    public function getType(): ?string;

    public function setPath(?string $path): self;

    public function getPath(): ?string;
}
