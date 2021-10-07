<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Type;

use DH\ArtisCmsPlugin\Form\Type\Translation\CatalogTranslationType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CatalogType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('menu_code', TextType::class, [
                'label' => 'sylius.ui.code',
                'disabled' => null,
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'label' => false,
                'entry_type' => CatalogTranslationType::class,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'artis_cms_plugin_catalog';
    }
}
