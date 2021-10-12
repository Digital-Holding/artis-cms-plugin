<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\EventListener;

use DH\ArtisCmsPlugin\Entity\Catalog;
use DH\ArtisCmsPlugin\Entity\CatalogInterface;
use DH\ArtisCmsPlugin\Uploader\CatalogAttachmentUploaderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class AttachmentUploaderListener
{
    private CatalogAttachmentUploaderInterface $uploader;

    public function __construct(CatalogAttachmentUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    public function uploadAttachment(GenericEvent $event): void
    {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, CatalogInterface::class);

        $this->uploadSubjectAttachment($subject);
    }

    private function uploadSubjectAttachment(CatalogInterface $subject): void
    {
        $attachment = $subject->getAttachment();
        if (null !== $attachment) {
            if ($attachment->hasFile()) {
                $this->uploader->upload($attachment);
            }
        }
    }
}
