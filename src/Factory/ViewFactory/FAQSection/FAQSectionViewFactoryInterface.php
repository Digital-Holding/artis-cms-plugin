<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\FAQSection;

use DH\ArtisCmsPlugin\Entity\FrequentlyAskedQuestionSectionInterface;

interface FAQSectionViewFactoryInterface
{
    public function create(FrequentlyAskedQuestionSectionInterface $frequentlyAskedQuestionSection);
}
