<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Extension;

use BitBag\SyliusCmsPlugin\Form\Type\MediaType;
use DH\ArtisCmsPlugin\Form\Type\PageAutocompleteChoiceType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class MediaTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pages', PageAutocompleteChoiceType::class, [
                'label' => 'bitbag_sylius_cms_plugin.ui.pages',
                'multiple' => true,
            ])
        ;
    }

    public static function getExtendedTypes(): iterable
    {
        return [MediaType::class];
    }
}
