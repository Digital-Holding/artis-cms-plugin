<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\FAQSection;

use DH\ArtisCmsPlugin\Entity\FrequentlyAskedQuestionSectionInterface;
use DH\ArtisCmsPlugin\View\FAQSection\FAQSectionView;
use Sylius\ShopApiPlugin\Factory\ImageViewFactoryInterface;

class FAQSectionViewFactory implements FAQSectionViewFactoryInterface
{
    /** @var string */
    private $faqSectionViewClass;

    /** @var ImageViewFactoryInterface $imageViewFactory */
    private $imageViewFactory;

    public function __construct(
        string $faqSectionViewClass,
        ImageViewFactoryInterface $imageViewFactory
    )
    {
        $this->faqSectionViewClass = $faqSectionViewClass;
        $this->imageViewFactory = $imageViewFactory;
    }

    public function create(FrequentlyAskedQuestionSectionInterface $frequentlyAskedQuestionSection)
    {
        /** @var FAQSectionView $frequentlyAskedQuestionSectionView */
        $frequentlyAskedQuestionSectionView = new $this->faqSectionViewClass();

        $frequentlyAskedQuestionSectionView->id = $frequentlyAskedQuestionSection->getId();
        $frequentlyAskedQuestionSectionView->code = $frequentlyAskedQuestionSection->getCode();
        $frequentlyAskedQuestionSectionView->name = $frequentlyAskedQuestionSection->getName();
        $frequentlyAskedQuestionSectionView->image = $frequentlyAskedQuestionSection->getImage() ? $this->imageViewFactory->create($frequentlyAskedQuestionSection->getImage()) : null;

        return $frequentlyAskedQuestionSectionView;
    }
}
