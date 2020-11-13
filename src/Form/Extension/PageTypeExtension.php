<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Extension;

use BitBag\SyliusCmsPlugin\Form\Type\PageType;
use DH\ArtisCmsPlugin\Form\Type\PageImagesType;
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
                'label' => 'bitbag_sylius_cms_plugin.ui.images',
                'block_name' => 'entry',
            ])
        ;
    }

    public static function getExtendedTypes(): iterable
    {
        return [PageType::class];
    }
}
