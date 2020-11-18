<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Controller\Api\Page;

use DH\ArtisCmsPlugin\Entity\PageInterface;
use BitBag\SyliusCmsPlugin\Repository\PageRepositoryInterface;
use DH\ArtisCmsPlugin\Factory\ViewFactory\Page\PageViewFactoryInterface;
use DH\ArtisCmsPlugin\View\Page\PageView;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Sylius\ShopApiPlugin\Http\RequestBasedLocaleProviderInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ShowPageByIdAction
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
        /** @var PageInterface $page */
        $page = $this->pageRepository->find(
            $request->attributes->get('id')
        );

        $localeCode = $this->requestBasedLocaleProvider->getLocaleCode($request);

        if (null === $page) {
            throw new NotFoundHttpException(sprintf('Page list has not been found.'));
        }

        return $this->viewHandler->handle(View::create($this->buildPageView($page, $localeCode),  Response::HTTP_OK));
    }

    private function buildPageView(PageInterface $page, string $localeCode): PageView
    {
        return $this->pageViewFactory->create($page, $localeCode);
    }
}
