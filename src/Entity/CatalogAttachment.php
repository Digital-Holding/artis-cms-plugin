<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use DH\ArtisCmsPlugin\Model\Attachment;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity
 * @ORM\Table(name="artis_cms_plugin_catalog_attachment")
 */
class CatalogAttachment implements CatalogAttachmentInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /**
     * @ORM\OneToOne(targetEntity="DH\ArtisCmsPlugin\Entity\Catalog",inversedBy="attachment")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $owner;

    /** @ORM\Column(name="type", type="text", nullable=true) */
    protected ?string $type;

    /** @var \SplFileInfo|null */
    protected $file;

    /** @ORM\Column(name="path", type="text", nullable=false) */
    protected ?string $path;

    /** @ORM\Column(name="hash", type="text", nullable=false) */
    protected ?string $hash;

    /** @ORM\Column(name="mime_type", type="text", nullable=false) */
    protected ?string $mimeType;

    /** @ORM\Column(name="file_name", type="text", nullable=false) */
    protected ?string $fileName;


    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function getFile(): ?\SplFileInfo
    {
        return $this->file;
    }

    public function setFile(?\SplFileInfo $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function hasPath(): bool
    {
        return null !== $this->path;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner($owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function hasFile(): bool
    {
        return null !== $this->file;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(?string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(?string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }
}
