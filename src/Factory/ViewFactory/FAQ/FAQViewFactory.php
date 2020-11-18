<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\FAQ;

use BitBag\SyliusCmsPlugin\Entity\FrequentlyAskedQuestionInterface;
use BitBag\SyliusCmsPlugin\Entity\FrequentlyAskedQuestionTranslationInterface;
use DH\ArtisCmsPlugin\View\FAQ\FAQView;

final class FAQViewFactory implements FAQViewFactoryInterface
{
    /** @var string */
    private $faqViewClass;

    public function __construct(
        string $faqViewClass
    )
    {
        $this->faqViewClass = $faqViewClass;
    }

    public function create(FrequentlyAskedQuestionInterface $frequentlyAskedQuestion, string $locale): FAQView
    {
        /** @var FrequentlyAskedQuestionTranslationInterface $frequentlyAskedQuestionTranslation */
        $frequentlyAskedQuestionTranslation = $frequentlyAskedQuestion->getTranslation($locale);

        /** @var FAQView $frequentlyAskedQuestionView */
        $frequentlyAskedQuestionView = new $this->faqViewClass();

        $frequentlyAskedQuestionView->code = $frequentlyAskedQuestion->getCode();
        $frequentlyAskedQuestionView->question = $frequentlyAskedQuestionTranslation->getQuestion();
        $frequentlyAskedQuestionView->answer = $frequentlyAskedQuestionTranslation->getAnswer();

        return $frequentlyAskedQuestionView;
    }
}
