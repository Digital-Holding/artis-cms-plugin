<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Extension;

use BitBag\SyliusCmsPlugin\Form\Type\SectionType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

final class SectionTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hidden', CheckboxType::class, [
                'label' => 'artis_cms_plugin.ui.is_hidden'
            ])
        ;
    }

    public static function getExtendedTypes(): iterable
    {
        return [SectionType::class];
    }
}
