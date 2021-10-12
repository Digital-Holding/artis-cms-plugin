<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Type;

use DH\ArtisCmsPlugin\Entity\Catalog;
use DH\ArtisCmsPlugin\Form\Type\Translation\CatalogTranslationType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CatalogType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('menu_code', ChoiceType::class, [
                'label' => 'sylius.ui.menus',
                'choices' => Catalog::getAllMenuCodes(),
                'choice_label' => function ($choice) {
                    return 'artis.form.catalog.' . $choice;
                }
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'label' => false,
                'entry_type' => CatalogTranslationType::class,
            ])
            ->add('year', DateType::class, [
                'html5' => false,
                'widget' => 'single_text',
                'format' => 'y',
                'label' => 'sylius.ui.year',
            ])
            ->add('image', CatalogImagesType::class, [
                'label' => false,
                'required' => true,
            ])
            ->add('url', TextType::class, [
                'label' => 'sylius.ui.url',
                'required' => false,
            ])
            ->add('attachment', CatalogAttachmentType::class, [
                'label' => false,
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'artis_cms_plugin_catalog';
    }
}
