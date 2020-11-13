<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Extension;

use BitBag\SyliusCmsPlugin\Form\Type\FrequentlyAskedQuestionType;
use DH\ArtisCmsPlugin\Form\Type\FrequentlyAskedQuestionSectionAutocompleteChoiceType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class FrequentlyAskedQuestionTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('frequentlyAskedQuestionSections', FrequentlyAskedQuestionSectionAutocompleteChoiceType::class, [
                'label' => 'artis_cms_plugin.ui.faq_sections',
                'multiple' => true,
            ])
        ;
    }

    public static function getExtendedTypes(): iterable
    {
        return [FrequentlyAskedQuestionType::class];
    }
}
