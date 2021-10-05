<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Controller\Api\FAQ;

use BitBag\SyliusCmsPlugin\Entity\FrequentlyAskedQuestionInterface;
use BitBag\SyliusCmsPlugin\Repository\FrequentlyAskedQuestionRepositoryInterface;
use DH\ArtisCmsPlugin\Factory\ViewFactory\FAQ\FAQViewFactoryInterface;
use DH\ArtisCmsPlugin\View\FAQ\FAQView;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Sylius\ShopApiPlugin\Http\RequestBasedLocaleProviderInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowFAQBySectionCode
{

    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var FrequentlyAskedQuestionRepositoryInterface */
    private $frequentlyAskedQuestionRepository;

    /** @var FAQViewFactoryInterface */
    private $frequentlyAskedQuestionViewFactory;

    /** @var RequestBasedLocaleProviderInterface */
    private $requestBasedLocaleProvider;

    /** @var ParameterBagInterface $parameterBag */
    private $parameterBag;

    public function __construct(
        ViewHandlerInterface $viewHandler,
        FrequentlyAskedQuestionRepositoryInterface $frequentlyAskedQuestionRepository,
        FAQViewFactoryInterface $frequentlyAskedQuestionViewFactory,
        RequestBasedLocaleProviderInterface $requestBasedLocaleProvider,
        ParameterBagInterface $parameterBag
    ) {
        $this->viewHandler = $viewHandler;
        $this->frequentlyAskedQuestionRepository = $frequentlyAskedQuestionRepository;
        $this->frequentlyAskedQuestionViewFactory = $frequentlyAskedQuestionViewFactory;
        $this->requestBasedLocaleProvider = $requestBasedLocaleProvider;
        $this->parameterBag = $parameterBag;
    }

    public function __invoke(Request $request): Response
    {
        $localeCode = $this->requestBasedLocaleProvider->getLocaleCode($request);

        $code = $request->attributes->get('code');

        /** @var ArrayCollection|FrequentlyAskedQuestionInterface[] $frequentlyAskedQuestions */
        $frequentlyAskedQuestions = $this->frequentlyAskedQuestionRepository->findBySectionCode(
            $code,
            $localeCode
        );

        $frequentlyAskedQuestionView = [];

        foreach ($frequentlyAskedQuestions as $frequentlyAskedQuestion) {
            $frequentlyAskedQuestionView [] = $this->buildPageView($frequentlyAskedQuestion, $localeCode);
        }

        return $this->viewHandler->handle(View::create($frequentlyAskedQuestionView,  Response::HTTP_OK));
    }

    private function buildPageView(FrequentlyAskedQuestionInterface $frequentlyAskedQuestion, string $localeCode): FAQView
    {
        return $this->frequentlyAskedQuestionViewFactory->create($frequentlyAskedQuestion, $localeCode);
    }
}
