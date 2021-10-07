<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;
use Symfony\Component\Config\Definition\Exception\InvalidTypeException;

/**
 * @ORM\Entity
 * @ORM\Table(name="artis_cms_plugin_catalog")
 */
class Catalog implements CatalogInterface
{
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;

        getTranslation as private doGetTranslation;
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /** @ORM\Column(name="menu_code", type="text", nullable=true) */
    protected ?string $menuCode;

    /**
     * @ORM\OneToMany(
     *     targetEntity="DH\ArtisCmsPlugin\Entity\CatalogImage",
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

//    private bool $isRoot;

    public function __construct(
//        bool $isRoot
    ) {
        $this->initializeTranslationsCollection();
        $this->images = new ArrayCollection();
//        if ($this->isRoot()) {
//            $this->menuCode = self::MENU_MAIN;
//        }
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

    public function hasImage(ImageInterface $image): bool
    {
        return $this->images->contains($image);
    }

    public function getMenuCode(): ?string
    {
        return $this->menuCode;
    }

    public function setMenuCode(string $menuCode): self
    {
        $allMenuCodes = self::getAllMenuCodes();

        if (!in_array($menuCode, $allMenuCodes)) {
            throw new InvalidTypeException('Invalid type. Possible menu codes are ' . implode(', ', $allMenuCodes));
        }

        $this->menuCode = $menuCode;

        return $this;
    }

    public static function getAllMenuCodes(): array
    {
        return [
            self::MENU_MAIN,
            self::MENU_ADDITIONAL
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->getTranslation()->getTitle();
    }

    public function getTranslation(?string $locale = null): TranslationInterface
    {
        /** @var TranslationInterface $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    public function getSubtitle(): ?string
    {
        return $this->getTranslation()->getSubtitle();
    }

    public function getYear(): ?string
    {
        return $this->getTranslation()->getYear();
    }

    protected function createTranslation(): CatalogTranslationInterface
    {
        return new CatalogTranslation();
    }
}
