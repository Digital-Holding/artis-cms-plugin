<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

final class CatalogImagesType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', FileType::class, [
                'label' => 'sylius.form.image.file',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'artis_cms_plugin_catalog_images';
    }
}
