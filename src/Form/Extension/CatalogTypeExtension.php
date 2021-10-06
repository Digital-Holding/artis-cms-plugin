<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Extension;

use DH\ArtisCmsPlugin\Form\Type\CatalogImagesType;
use DH\ArtisCmsPlugin\Form\Type\CatalogType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Valid;

final class CatalogTypeExtension extends AbstractTypeExtension
{
    public static function getExtendedTypes(): iterable
    {
        return [CatalogType::class];
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('images', CollectionType::class, [
                'entry_type' => CatalogImagesType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'sylius.ui.images',
                'block_name' => 'entry',
                'validation_groups' => ['artis'],
                'constraints' => [new Valid()],
            ]);
    }
}
