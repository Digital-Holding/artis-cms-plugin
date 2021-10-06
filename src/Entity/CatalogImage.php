<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artis_cms_plugin_catalog_images")
 */
class CatalogImage implements CatalogImageInterface
{
    /** @ORM\Column(name="owner_id", type="integer", nullable=true) */
    private ?int $ownerId;

    /** @ORM\Column(name="type", type="text", nullable=true) */
    private ?string $type;

    /** @ORM\Column(name="path", type="text", nullable=true) */
    private ?string $path;

    public function setOwnerId(?int $id): self
    {
        $this->ownerId = $id;

        return $this;
    }

    public function getOwnerId(): ?int
    {
        return $this->ownerId;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }
}
