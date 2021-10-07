<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

final class CatalogAttachmentType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', FileType::class, [
                'label' => 'sylius.form.attachment.file',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'artis_cms_plugin_catalog_attachment';
    }
}
