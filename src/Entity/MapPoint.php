<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\TranslationInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="artis_cms_plugin_map_point")
 */
class MapPoint implements MapPointInterface
{
    use ToggleableTrait;
    use TimestampableTrait;
    use TranslatableTrait {
        __construct as protected initializeTranslationsCollection;
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $code;

    /**
     * @ORM\Column(type="string")
     */
    protected $phoneNumber;

    /**
     * @ORM\Column(type="string")
     */
    protected $address;

    /**
     * @ORM\Column(type="string")
     */
    protected $city;

    /**
     * @ORM\Column(type="string")
     */
    protected $openingHours;

    /**
     * @ORM\ManyToMany(targetEntity="Sylius\Component\Product\Model\ProductVariant")
     * @ORM\JoinTable(name="artis_cms_map_point_product_variants",
     *      joinColumns={@ORM\JoinColumn(name="map_point_id", referencedColumnName="id", unique=false, onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_variant_id", referencedColumnName="id", unique=false, onDelete="CASCADE")}
     * )
     */
    private $productVariants;

    /**
     * @ORM\ManyToMany(targetEntity="Sylius\Component\Channel\Model\Channel")
     * @ORM\JoinTable(name="artis_cms_map_point_channels",
     *      joinColumns={@ORM\JoinColumn(name="map_point_id", referencedColumnName="id", unique=false, onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="channel_id", referencedColumnName="id", unique=false, onDelete="CASCADE")}
     * )
     */
    private $channels;

    public function __construct()
    {
        $this->initializeTranslationsCollection();

        $this->productVariants = new ArrayCollection();
        $this->channels = new ArrayCollection();

        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getOpeningHours(): ?string
    {
        return $this->openingHours;
    }

    public function setOpeningHours(?string $openingHours): void
    {
        $this->openingHours = $openingHours;
    }

    public function getName(): ?string
    {
        return $this->getMapPointTranslation()->getName();
    }

    public function setName(?string $name): void
    {
        $this->getMapPointTranslation()->setName($name);
    }

    /**
     * @return MapPointTranslationInterface|TranslationInterface|null
     */
    protected function getMapPointTranslation(): MapPointTranslationInterface
    {
        return $this->getTranslation();
    }

    protected function createTranslation(): ?MapPointTranslationInterface
    {
        return new MapPointTranslation();
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

    public function getChannels(): Collection
    {
        return $this->channels;
    }

    public function addChannel(ChannelInterface $channel): void
    {
        if (!$this->hasChannel($channel)) {
            $this->channels->add($channel);
        }
    }

    public function removeChannel(ChannelInterface $channel): void
    {
        if ($this->hasChannel($channel)) {
            $this->channels->removeElement($channel);
        }
    }

    public function hasChannel(ChannelInterface $channel): bool
    {
        return $this->channels->contains($channel);
    }
}
