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
    protected string $type;

    /** @var \SplFileInfo|null */
    protected $file;

    /** @ORM\Column(name="path", type="text", nullable=false) */
    protected $path;


    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function getFile(): ?\SplFileInfo
    {
        return $this->file;
    }

    public function setFile(?\SplFileInfo $file): void
    {
        $this->file = $file;
    }

    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    public function hasPath(): bool
    {
        return null !== $this->path;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner($owner): void
    {
        $this->owner = $owner;
    }
}
