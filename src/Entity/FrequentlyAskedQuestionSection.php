<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Sylius\Component\Core\Model\ImageInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\TranslationInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="artis_cms_plugin_faq_section")
 */
class FrequentlyAskedQuestionSection implements FrequentlyAskedQuestionSectionInterface
{
    use TranslatableTrait {
        __construct as private initializeFrequentlyAskedQuestionSectionsCollection;
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
     * @ORM\OneToOne(
     *     targetEntity="DH\ArtisCmsPlugin\Entity\FrequentlyAskedQuestionSectionImage",
     *     mappedBy="owner",
     *     cascade={"persist"},
     *     orphanRemoval=true
     * )
     */
    protected $image;

    public function __construct()
    {
        $this->initializeFrequentlyAskedQuestionSectionsCollection();
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

    public function getName(): ?string
    {
        return $this->getSectionTranslation()->getName();
    }

    public function setName(?string $name): void
    {
        $this->getSectionTranslation()->setName($name);
    }

    /**
     * @return TranslationInterface|FrequentlyAskedQuestionSectionTranslationInterface
     */
    protected function getSectionTranslation(): TranslationInterface
    {
        return $this->getTranslation();
    }

    protected function createTranslation(): TranslationInterface
    {
        return new FrequentlyAskedQuestionSectionTranslation();
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
}
