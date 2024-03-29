<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\AbstractTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="artis_cms_plugin_catalog_translation")
 */
class CatalogTranslation extends AbstractTranslation implements CatalogTranslationInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /** @ORM\Column(name="title", type="text", nullable=true) */
    protected ?string $title;

    /** @ORM\Column(name="subtitle", type="text", nullable=true) */
    protected ?string $subtitle;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getId(): int
    {
      return $this->id;
    }
}
