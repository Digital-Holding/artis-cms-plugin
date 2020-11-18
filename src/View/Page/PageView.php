<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\View\Page;

use DH\ArtisCmsPlugin\View\Media\MediaView;

class PageView
{
    /** @var string */
    public $code;

    /** @var string */
    public $slug;

    /** @var array */
    public $image = [];

    /** @var string */
    public $name;

    /** @var string */
    public $content;

    /** @var string */
    public $metaKeywords;

    /** @var string */
    public $metaDescription;

    /** @var string */
    public $nameWhenLinked;

    /** @var string */
    public $descriptionWhenLinked;

    /** @var string */
    public $breadcrumb;

    /** @var string */
    public $timestamp;

    /** @var string */
    public $sectionCode;

    /** @var string */
    public $sectionName;

    /** @var string */
    public $shortDescription;

    /** @var DHProductVariantView[] */
    public $variants = [];

    /** @var PageImageView[] */
    public $images = [];

    /** @var MediaView[] */
    public $medias = [];
}
