<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use BitBag\SyliusCmsPlugin\Entity\Media as BaseMedia;

/**
 * @ORM\Entity
 * @ORM\Table(name="bitbag_cms_media")
 */
class Media extends BaseMedia implements MediaInterface
{
    /**
     * @ORM\ManyToMany(targetEntity="DH\ArtisCmsPlugin\Entity\Page")
     * @ORM\JoinTable(name="artis_cms_media_pages",
     *      joinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id", unique=false, onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="page_id", referencedColumnName="id", unique=false, onDelete="CASCADE")}
     * )
     */
    private $pages;

    public function __construct()
    {
        parent::__construct();

        $this->pages = new ArrayCollection();
    }

    public function getPages(): ?Collection
    {
        return $this->pages;
    }

    public function hasPage(PageInterface $page): bool
    {
        return $this->pages->contains($page);
    }

    public function addPage(PageInterface $page): void
    {
        if (false === $this->hasPage($page)) {
            $this->pages->add($page);
        }
    }

    public function removePage(PageInterface $page): void
    {
        if (true === $this->hasPage($page)) {
            $this->pages->removeElement($page);
        }
    }
}
