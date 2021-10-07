<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Entity;


use DateTimeInterface;
use DH\ArtisCmsPlugin\Model\Attachment;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

class CatalogAttachment extends Attachment implements CatalogAttachmentInterface
{
    /**
     * @ORM\OneToOne(targetEntity="DH\ArtisCmsPlugin\Entity\Catalog",inversedBy="attachment")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $owner;
}
