<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Controller\Api\Page;

use BitBag\SyliusCmsPlugin\Repository\PageRepositoryInterface;
use DH\ArtisCmsPlugin\Entity\PageInterface;
use DH\ArtisCmsPlugin\Factory\ViewFactory\Page\PageViewFactoryInterface;
use DH\ArtisCmsPlugin\View\Page\PageView;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Sylius\ShopApiPlugin\Http\RequestBasedLocaleProviderInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowPageBySectionCode
{
    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var PageRepositoryInterface */
    private $pageRepository;

    /** @var PageViewFactoryInterface */
    private $pageViewFactory;

    /** @var RequestBasedLocaleProviderInterface */
    private $requestBasedLocaleProvider;

    /** @var ParameterBagInterface $parameterBag */
    private $parameterBag;

    public function __construct(
        ViewHandlerInterface $viewHandler,
        PageRepositoryInterface $pageRepository,
        PageViewFactoryInterface $pageViewFactory,
        RequestBasedLocaleProviderInterface $requestBasedLocaleProvider,
        ParameterBagInterface $parameterBag
    ) {
        $this->viewHandler = $viewHandler;
        $this->pageRepository = $pageRepository;
        $this->pageViewFactory = $pageViewFactory;
        $this->requestBasedLocaleProvider = $requestBasedLocaleProvider;
        $this->parameterBag = $parameterBag;
    }

    public function __invoke(Request $request): Response
    {
        $localeCode = $this->requestBasedLocaleProvider->getLocaleCode($request);

        $code = $request->attributes->get('code');

        /** @var PageInterface $pages */
        $pages = $this->pageRepository->findBySectionCode(
            $code,
            $localeCode
        );

        $pageView = [];
        /** @var PageInterface $page */
        foreach ($pages as $page) {
            $pageView [] = $this->buildPageView($page, $localeCode);
        }

        return $this->viewHandler->handle(View::create($pageView,  Response::HTTP_OK));
    }

    private function buildPageView(PageInterface $page, string $localeCode): PageView
    {
        return $this->pageViewFactory->create($page, $localeCode);
    }
}
