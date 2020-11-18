<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Controller\Api\FAQSection;

use DH\ArtisCmsPlugin\Entity\FrequentlyAskedQuestionSectionInterface;
use DH\ArtisCmsPlugin\Factory\ViewFactory\FAQSection\FAQSectionViewFactoryInterface;
use DH\ArtisCmsPlugin\Repository\FrequentlyAskedQuestionSectionRepositoryInterface;
use DH\ArtisCmsPlugin\View\FAQSection\FAQSectionView;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowFAQSectionListAction
{
    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var FrequentlyAskedQuestionSectionRepositoryInterface */
    private $frequentlyAskedQuestionSectionRepository;

    /** @var FAQSectionViewFactoryInterface */
    private $frequentlyAskedQuestionSectionViewFactory;

    public function __construct(
        ViewHandlerInterface $viewHandler,
        FrequentlyAskedQuestionSectionRepositoryInterface $frequentlyAskedQuestionSectionRepository,
        FAQSectionViewFactoryInterface $frequentlyAskedQuestionSectionViewFactory
    )
    {
        $this->viewHandler = $viewHandler;
        $this->frequentlyAskedQuestionSectionRepository = $frequentlyAskedQuestionSectionRepository;
        $this->frequentlyAskedQuestionSectionViewFactory = $frequentlyAskedQuestionSectionViewFactory;
    }

    public function __invoke(Request $request)
    {
        /** @var ArrayCollection|FrequentlyAskedQuestionSectionInterface[] $frequentlyAskedQuestionSections */
        $frequentlyAskedQuestionSections = $this->frequentlyAskedQuestionSectionRepository->findAll();

        $frequentlyAskedQuestionSectionView = [];

        /** @var FrequentlyAskedQuestionSectionInterface $view */
        foreach ($frequentlyAskedQuestionSections as $view) {
            $frequentlyAskedQuestionSectionView [] = $this->buildSectionList($view);
        }

        return $this->viewHandler->handle(View::create($frequentlyAskedQuestionSectionView, Response::HTTP_OK));
    }

    private function buildSectionList(FrequentlyAskedQuestionSectionInterface $frequentlyAskedQuestionSection): FAQSectionView
    {
        return $this->frequentlyAskedQuestionSectionViewFactory->create($frequentlyAskedQuestionSection);;
    }
}
