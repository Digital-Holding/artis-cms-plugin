<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Controller\Api\Catalog;

use DH\ArtisCmsPlugin\Entity\CatalogInterface;
use DH\ArtisCmsPlugin\Factory\ViewFactory\Catalog\CatalogViewFactory;
use DH\ArtisCmsPlugin\Repository\CatalogRepositoryInterface;
use DH\ArtisCmsPlugin\View\Catalog\CatalogView;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Sylius\ShopApiPlugin\Http\RequestBasedLocaleProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ShowCatalogByCode
{
    private ViewHandlerInterface $viewHandler;

    private CatalogRepositoryInterface $catalogRepository;

    private RequestBasedLocaleProviderInterface $requestBasedLocaleProvider;

    private CatalogViewFactory $catalogViewFactory;

    public function __construct(
        ViewHandlerInterface $viewHandler,
        CatalogRepositoryInterface $catalogRepository,
        RequestBasedLocaleProviderInterface $requestBasedLocaleProvider,
        CatalogViewFactory $catalogViewFactory
    ) {
        $this->viewHandler = $viewHandler;
        $this->catalogRepository = $catalogRepository;
        $this->requestBasedLocaleProvider = $requestBasedLocaleProvider;
        $this->catalogViewFactory = $catalogViewFactory;
    }

    public function __invoke(Request $request): Response
    {
        if ($request->query->has('year')) {
            $year = $request->query->get('year');
        } else {
            $datetime = new \DateTime('now');
            $year = $datetime->format('Y');
        }

        $localeCode = $this->requestBasedLocaleProvider->getLocaleCode($request);

        /** @var CatalogInterface $catalog */
        $catalog = $this->catalogRepository->findOneEnabledByCode(
            $request->query->get('menuCode'),
            $year,
            $localeCode
        );

        if (null === $catalog) {
            throw new NotFoundHttpException(sprintf('Catalog has not been found.'));
        }

        return $this->viewHandler->handle(
            View::create(
                $this->buildView($catalog, $localeCode),
                Response::HTTP_OK
            )
        );
    }

    private function buildView(CatalogInterface $catalog, string $localeCode): CatalogView
    {
        return $this->catalogViewFactory->create($catalog, $localeCode);
    }
}
