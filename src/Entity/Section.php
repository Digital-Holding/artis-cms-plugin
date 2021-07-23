<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use BitBag\SyliusCmsPlugin\Entity\Section as BaseSection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bitbag_cms_section")
 */
class Section extends BaseSection implements SectionInterface
{
    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $hidden = false;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default" : 0})
     */
    private $taxonable = false;

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $isHidden): void
    {
        $this->hidden = $isHidden;
    }

    public function isTaxonable(): bool
    {
        return $this->taxonable;
    }

    public function setTaxonable(bool $taxonable): void
    {
        $this->taxonable = $taxonable;
    }
}
