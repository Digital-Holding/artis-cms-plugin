<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Extension;

use BitBag\SyliusCmsPlugin\Form\Type\PageType;
use DH\ArtisCmsPlugin\Form\Type\PageImagesType;
use DH\ArtisCmsPlugin\Form\Type\ProductVariantAutocompleteChoiceType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

final class PageTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('images', CollectionType::class, [
                'entry_type' => PageImagesType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'sylius.ui.images',
                'block_name' => 'entry',
            ])
            ->add('productVariants', ProductVariantAutocompleteChoiceType::class, [
                'multiple' => true,
                'by_reference' => false,
                'required' => false,
                'label' => 'sylius.ui.product_variants'
            ])
        ;
    }

    public static function getExtendedTypes(): iterable
    {
        return [PageType::class];
    }
}
