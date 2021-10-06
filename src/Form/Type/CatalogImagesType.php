<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Type;

use Sylius\Bundle\CoreBundle\Form\Type\ImageType;

final class CatalogImagesType  extends ImageType
{
    public function getBlockPrefix(): string
    {
        return 'artis_cms_plugin_catalog_images';
    }
}
