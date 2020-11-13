<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use BitBag\SyliusCmsPlugin\Entity\FrequentlyAskedQuestion as BaseFrequentlyAskedQuestion;

/**
 * @ORM\Entity
 * @ORM\Table(name="bitbag_cms_faq")
 */
class FrequentlyAskedQuestion extends BaseFrequentlyAskedQuestion
{
    /**
     * @ORM\ManyToMany(targetEntity="DH\ArtisCmsPlugin\Entity\FrequentlyAskedQuestionSection")
     * @ORM\JoinTable(name="artis_cms_faq_sections",
     *      joinColumns={@ORM\JoinColumn(name="faq_id", referencedColumnName="id", unique=false, onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="section_id", referencedColumnName="id", unique=false, onDelete="CASCADE")}
     * )
     */
    private $frequentlyAskedQuestionSections;

    public function __construct()
    {
        parent::__construct();

        $this->frequentlyAskedQuestionSections = new ArrayCollection();
    }

    public function getFrequentlyAskedQuestionSections(): ?Collection
    {
        return $this->frequentlyAskedQuestionSections;
    }

    public function hasFrequentlyAskedQuestionSection(FrequentlyAskedQuestionSectionInterface $frequentlyAskedQuestionSections): bool
    {
        return $this->frequentlyAskedQuestionSections->contains($frequentlyAskedQuestionSections);
    }

    public function addFrequentlyAskedQuestionSection(FrequentlyAskedQuestionSectionInterface $frequentlyAskedQuestionSections): void
    {
        if (false === $this->hasFrequentlyAskedQuestionSection($frequentlyAskedQuestionSections)) {
            $this->frequentlyAskedQuestionSections->add($frequentlyAskedQuestionSections);
        }
    }

    public function removeFrequentlyAskedQuestionSection(FrequentlyAskedQuestionSectionInterface $frequentlyAskedQuestionSections): void
    {
        if (true === $this->hasFrequentlyAskedQuestionSection($frequentlyAskedQuestionSections)) {
            $this->frequentlyAskedQuestionSections->removeElement($frequentlyAskedQuestionSections);
        }
    }
}
