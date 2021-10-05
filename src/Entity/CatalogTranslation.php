<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;
use Doctrine\ORM\Mapping as ORM;

class CatalogTranslation implements CatalogTranslationInterface
{

    /** @ORM\Column(name="title", type="text", nullable=true) */
    protected ?string $title;

    /** @ORM\Column(name="year", type="text", nullable=true) */
    protected ?string $year;

    /** @ORM\Column(name="subtitle", type="text", nullable=true) */
    protected ?string $subtitle;

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
}
