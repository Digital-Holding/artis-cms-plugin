<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;

use Sylius\Component\Core\Model\Image;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\ImageInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="artis_cms_plugin_page_images")
 */
class PageImages extends Image implements ImageInterface
{
    /**
     * @ORM\ManyToOne(
     *     targetEntity="DH\ArtisCmsPlugin\Entity\Page",
     *     inversedBy="images"
     * )
     * @ORM\JoinColumn(
     *     onDelete="CASCADE",
     *     nullable=false
     * )
     */
    protected $owner;
}
