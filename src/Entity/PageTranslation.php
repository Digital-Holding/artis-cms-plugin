<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use BitBag\SyliusCmsPlugin\Entity\PageTranslation as BasePageTranslation;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bitbag_cms_page_translation")
 */
class PageTranslation extends BasePageTranslation implements PageTranslationInterface
{
    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $shortDescription;

    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }
}
