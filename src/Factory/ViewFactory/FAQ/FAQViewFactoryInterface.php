<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\FAQ;

use DH\ArtisCmsPlugin\View\FAQ\FAQView;
use BitBag\SyliusCmsPlugin\Entity\FrequentlyAskedQuestionInterface;

interface FAQViewFactoryInterface
{
    public function create(FrequentlyAskedQuestionInterface $frequentlyAskedQuestion, string $locale): FAQView;
}
