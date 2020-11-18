<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Factory\ViewFactory\Section;

use BitBag\SyliusCmsPlugin\Entity\SectionInterface;
use BitBag\SyliusCmsPlugin\Repository\PageRepositoryInterface;
use DH\ArtisCmsPlugin\View\Section\SectionView;
use Sylius\ShopApiPlugin\Http\RequestBasedLocaleProviderInterface;

class SectionViewFactory implements SectionViewFactoryInterface
{
    /** @var string */
    private $sectionViewClass;

    /** @var PageRepositoryInterface $pageRepository */
    private $pageRepository;

    /** @var RequestBasedLocaleProviderInterface $requestBasedLocaleProvider */
    private $requestBasedLocaleProvider;

    public function __construct(
        string $sectionViewClass,
        PageRepositoryInterface $pageRepository,
        RequestBasedLocaleProviderInterface $requestBasedLocaleProvider
    )
    {
        $this->sectionViewClass = $sectionViewClass;
        $this->pageRepository = $pageRepository;
        $this->requestBasedLocaleProvider = $requestBasedLocaleProvider;
    }

    public function create(SectionInterface $section, string $locale)
    {
        /** @var SectionView $sectionView */
        $sectionView = new $this->sectionViewClass;

        $sectionView->id = $section->getId();
        $sectionView->code = $section->getCode();
        $sectionView->name = $section->getName();
        $sectionView->count = $this->getSectionItemsCount($section->getCode(), $locale);

        return $sectionView;
    }

    private function getSectionItemsCount(string $code, string $locale): int
    {
        $products = $this->pageRepository->findBySectionCode($code, $locale);
        if (!empty($products)) {
            return count($products);
        }

        return 0;
    }
}
