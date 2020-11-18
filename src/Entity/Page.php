<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use BitBag\SyliusCmsPlugin\Entity\Page as BasePage;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;

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

    /**
     * @ORM\ManyToMany(targetEntity="Sylius\Component\Product\Model\ProductVariant")
     * @ORM\JoinTable(name="artis_cms_page_product_variants",
     *      joinColumns={@ORM\JoinColumn(name="map_point_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_variant_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     */
    private $productVariants;

    public function __construct()
    {
        parent::__construct();

        $this->images = new ArrayCollection();
        $this->productVariants = new ArrayCollection();
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

    public function getProductVariants(): Collection
    {
        return $this->productVariants;
    }

    public function hasProductVariant(ProductVariantInterface $productVariant): bool
    {
        return $this->productVariants->contains($productVariant);
    }

    public function addProductVariant(ProductVariantInterface $productVariant): void
    {
        if (false === $this->hasProductVariant($productVariant)) {
            $this->productVariants->add($productVariant);
        }
    }

    public function removeProductVariant(ProductVariantInterface $productVariant): void
    {
        if (true === $this->hasProductVariant($productVariant)) {
            $this->productVariants->removeElement($productVariant);
        }
    }
}
