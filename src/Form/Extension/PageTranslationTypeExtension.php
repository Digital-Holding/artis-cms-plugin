<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Extension;

use BitBag\SyliusCmsPlugin\Form\Type\Translation\PageTranslationType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

final class PageTranslationTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('shortDescription', TextareaType::class, [
                'label' => 'artis_cms_plugin.ui.short_description',
                'required' => true,
                'empty_data' => ''
            ])

        ;
    }

    public static function getExtendedTypes(): iterable
    {
        return [PageTranslationType::class];
    }
}
