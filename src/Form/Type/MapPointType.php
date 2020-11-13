<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Type;

use DH\ArtisCmsPlugin\Form\Type\Translation\MapPointTranslationType;
use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class MapPointType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'label' => 'sylius.ui.code',
                'disabled' => null !== $builder->getData()->getCode(),
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'sylius.ui.phone_number',
            ])
            ->add('address', TextType::class, [
                'label' => 'sylius.ui.address',
            ])
            ->add('city', TextType::class, [
                'label' => 'sylius.ui.city',
            ])
            ->add('openingHours', TextType::class, [
                'label' => 'artis_cms_plugin.ui.opening_hours',
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'sylius.ui.enabled',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'label' => false,
                'entry_type' => MapPointTranslationType::class,
            ])
            ->add('channels', ChannelChoiceType::class, [
                'label' => 'sylius.ui.channels',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'artis_cms_plugin_map_point';
    }
}
