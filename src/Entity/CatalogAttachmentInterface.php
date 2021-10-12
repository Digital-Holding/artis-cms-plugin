<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

interface CatalogAttachmentInterface extends ResourceInterface
{
    public function getId(): int;

    public function getType(): ?string;

    public function setType(?string $type): self;

    public function getPath(): ?string;

    public function hasFile(): bool;

    public function getFile(): ?\SplFileInfo;

    public function setFile(?\SplFileInfo $file): self;

    public function setPath(?string $path): self;

    public function hasPath(): bool;

    public function getOwner();

    public function setOwner($owner): self;

    public function getHash(): ?string;

    public function setHash(?string $hash): self;

    public function getMimeType(): ?string;

    public function setMimeType(?string $mimeType): self;

    public function getFileName(): ?string;

    public function setFileName(?string $fileName): self;
}
