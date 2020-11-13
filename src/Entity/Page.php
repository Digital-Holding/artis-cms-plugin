<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use BitBag\SyliusCmsPlugin\Entity\Page as BasePage;
use Sylius\Component\Core\Model\ImageInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="bitbag_cms_page")
 */
class Page extends BasePage implements PageInterface
{
    /**
     * @ORM\OneToMany(
     *     targetEntity="DH\ArtisCmsPlugin\Entity\PageImages",
     *     mappedBy="owner",
     *     cascade={"persist", "remove"},
     *     orphanRemoval=true
     * )
     * @ORM\JoinColumn(
     *     onDelete="CASCADE",
     *     nullable=false
     * )
     */
    protected $images;

    public function __construct()
    {
        parent::__construct();

        $this->images = new ArrayCollection();
    }

    public function getImages(): Collection
    {
        return $this->images;
    }

    public function getImagesByType(string $type): Collection
    {
        return $this->images->filter(function (ImageInterface $image) use ($type): bool {
            return $type === $image->getType();
        });
    }

    public function hasImages(): bool
    {
        return !$this->images->isEmpty();
    }

    public function hasImage(ImageInterface $image): bool
    {
        return $this->images->contains($image);
    }

    public function addImage(ImageInterface $image): void
    {
        $image->setOwner($this);
        $this->images->add($image);
    }

    public function removeImage(ImageInterface $image): void
    {
        if ($this->hasImage($image)) {
            $image->setOwner(null);
            $this->images->removeElement($image);
        }
    }
}
