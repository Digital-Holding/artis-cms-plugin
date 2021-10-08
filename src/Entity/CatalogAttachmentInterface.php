<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

interface CatalogAttachmentInterface extends ResourceInterface
{
    public function getId(): int;

    public function getType(): ?string;

    public function setType(?string $type): void;

    public function getPath(): ?string;

    public function getFile(): ?\SplFileInfo;

    public function setFile(?\SplFileInfo $file): void;

    public function setPath(?string $path): void;

    public function hasPath(): bool;

    public function getOwner();

    public function setOwner($owner): void;
}
