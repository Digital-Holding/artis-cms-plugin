<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use DateTimeInterface;
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

    /** @ORM\Column(name="year", type="datetime", nullable=true) */
    protected ?DateTimeInterface $year;

    /**
     * @ORM\OneToOne(
     *     targetEntity="DH\ArtisCmsPlugin\Entity\CatalogImage",
     *     mappedBy="owner",
     *     cascade={"persist"},
     *     orphanRemoval=true
     * )
     * @ORM\JoinColumn(
     *     onDelete="CASCADE",
     *     nullable=false
     * )
     */
    protected $image;

    /**
     * @ORM\OneToOne(
     *     targetEntity="DH\ArtisCmsPlugin\Entity\CatalogAttachment",
     *     mappedBy="owner",
     *     cascade={"persist"},
     *     orphanRemoval=true
     * )
     * @ORM\JoinColumn(
     *     onDelete="CASCADE",
     *     nullable=false
     * )
     */
    protected $attachment;

    public function __construct( ) {
        $this->initializeTranslationsCollection();
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
        return $this->doGetTranslation($locale);
    }

    public function getSubtitle(): ?string
    {
        return $this->getTranslation()->getSubtitle();
    }

    public function getYear(): ?DateTimeInterface
    {
        return $this->year;
    }

    protected function createTranslation(): CatalogTranslationInterface
    {
        return new CatalogTranslation();
    }

    public function setYear(?DateTimeInterface $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getImage(): ?ImageInterface
    {
        return $this->image;
    }

    public function setImage(?ImageInterface $image): void
    {
        $image->setOwner($this);
        $this->image = $image;
    }

    public function getAttachment(): ?CatalogAttachmentInterface
    {
        return $this->attachment;
    }

    public function setAttachment(?CatalogAttachmentInterface $attachment): void
    {
        $attachment->setOwner($this);

        $this->attachment = $attachment;
    }
}
