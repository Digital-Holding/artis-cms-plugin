<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\View\MapPoint;

class MapPointView
{
    /** @var string */
    public $code;

    /** @var string */
    public $name;

    /** @var string */
    public $city;

    /** @var string */
    public $address;

    /** @var string */
    public $openingHours;

    /** @var string */
    public $phone;

    public $productVariants = [];
}
