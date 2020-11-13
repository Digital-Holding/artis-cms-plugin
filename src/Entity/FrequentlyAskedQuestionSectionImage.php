<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Sylius\Component\Core\Model\Image;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artis_cms_plugin_faq_section_image")
 */
class FrequentlyAskedQuestionSectionImage extends Image implements FrequentlyAskedQuestionSectionImageInterface
{
    /**
     * @ORM\OneToOne(targetEntity="DH\ArtisCmsPlugin\Entity\FrequentlyAskedQuestionSection", inversedBy="image")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $owner;
}
