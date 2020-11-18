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
    public $hidden = false;

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $isHidden): void
    {
        $this->hidden = $isHidden;
    }
}
