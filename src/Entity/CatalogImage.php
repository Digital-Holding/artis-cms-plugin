<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Image;
use Sylius\Component\Core\Model\ImageInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="artis_cms_plugin_catalog_images")
 */
class CatalogImage extends Image implements ImageInterface
{
    /**
     * @ORM\ManyToOne(
     *     targetEntity="DH\ArtisCmsPlugin\Entity\Catalog",
     *     inversedBy="images"
     * )
     * @ORM\JoinColumn(
     *     onDelete="CASCADE",
     *     nullable=false
     * )
     */
    protected $owner;
}
