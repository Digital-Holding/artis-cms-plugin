<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Controller\Api\Section;

use BitBag\SyliusCmsPlugin\Entity\SectionInterface;
use BitBag\SyliusCmsPlugin\Repository\SectionRepositoryInterface;
use DH\ArtisCmsPlugin\Factory\ViewFactory\Section\SectionViewFactoryInterface;
use DH\ArtisCmsPlugin\View\Section\SectionView;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Sylius\ShopApiPlugin\Http\RequestBasedLocaleProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowSectionListAction
{
    /** @var RequestBasedLocaleProviderInterface */
    private $requestBasedLocaleProvider;

    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var SectionViewFactoryInterface */
    private $sectionViewFactory;

    /** @var SectionRepositoryInterface */
    private $sectionRepository;

    public function __construct(
        RequestBasedLocaleProviderInterface $requestBasedLocaleProvider,
        ViewHandlerInterface $viewHandler,
        SectionRepositoryInterface $sectionRepository,
        SectionViewFactoryInterface $sectionViewFactory
    )
    {
        $this->requestBasedLocaleProvider = $requestBasedLocaleProvider;
        $this->viewHandler = $viewHandler;
        $this->sectionRepository = $sectionRepository;
        $this->sectionViewFactory = $sectionViewFactory;
    }

    public function __invoke(Request $request)
    {
        $localeCode = $this->requestBasedLocaleProvider->getLocaleCode($request);

        /** @var SectionInterface $sections */
        $sections = $this->sectionRepository->findAll();

        $sectionViews = [];

        /** @var SectionInterface $view */
        foreach ($sections as $view) {
            if($view->isHidden()) continue;
            $sectionViews [] = $this->buildSectionList($view, $localeCode);
        }

        return $this->viewHandler->handle(View::create($sectionViews, Response::HTTP_OK));
    }

    private function buildSectionList(SectionInterface $section, string $localeCode): SectionView
    {
        return $this->sectionViewFactory->create($section, $localeCode);
    }
}
