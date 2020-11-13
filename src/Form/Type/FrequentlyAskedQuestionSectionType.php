<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Type;

use DH\ArtisCmsPlugin\Form\Type\Translation\FrequentlyAskedQuestionSectionTranslationType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class FrequentlyAskedQuestionSectionType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'label' => 'sylius.ui.code',
                'disabled' => null !== $builder->getData()->getCode(),
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => FrequentlyAskedQuestionSectionTranslationType::class,
            ])
            ->add('image', FrequentlyAskedQuestionSectionImageType::class, [
                'label' => false,
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'artis_cms_plugin_frequently_asked_question_section';
    }
}
