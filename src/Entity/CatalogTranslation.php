<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artis_cms_plugin_catalog_translation")
 */
class CatalogTranslation implements CatalogTranslationInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /** @ORM\Column(name="title", type="text", nullable=true) */
    protected ?string $title;

    /** @ORM\Column(name="year", type="text", nullable=true) */
    protected ?string $year;

    /** @ORM\Column(name="subtitle", type="text", nullable=true) */
    protected ?string $subtitle;

    /** @ORM\Column(name="locale", type="text", nullable=true) */
    protected ?string $locale;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getYear(): ?string
    {
        return $this->year;
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

    public function setYear(?string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function setLocale(?string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function getId(): int
    {
      return $this->id;
    }
}
