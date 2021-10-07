<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Model;

use Sylius\Component\Resource\Model\ResourceInterface;

interface AttachmentInterface extends ResourceInterface
{
    public function getType(): ?string;

    public function setType(?string $type): void;

    public function getFile(): ?\SplFileInfo;

    public function setFile(?\SplFileInfo $file): void;

    public function hasFile(): bool;

    public function getPath(): ?string;

    public function setPath(?string $path): void;

    public function getOwner(): object;

    public function setOwner(?object $owner): void;
}
