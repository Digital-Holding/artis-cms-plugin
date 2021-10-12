<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Image;

/**
 * @ORM\Entity
 * @ORM\Table(name="artis_cms_plugin_catalog_images")
 */
class CatalogImage extends Image implements CatalogImageInterface
{
    /**
     * @ORM\OneToOne(targetEntity="DH\ArtisCmsPlugin\Entity\Catalog",inversedBy="image")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $owner;
}
