<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Type\Translation;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CatalogTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'sylius.ui.title',
            ])
            ->add('subtitle', TextType::class, [
                'label' => 'artis_cms_plugin.ui.subtitle',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'artis_cms_plugin_catalog_translation';
    }
}
