<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\ViewRepository;

use DH\ArtisCmsPlugin\Factory\ViewFactory\Page\PageViewFactoryInterface;
use DH\ArtisCmsPlugin\Repository\PageRepositoryInterface;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\ShopApiPlugin\Factory\Product\PageViewFactoryInterface as PaginationPageViewFactoryInterface;
use Sylius\ShopApiPlugin\Model\PaginatorDetails;
use Sylius\ShopApiPlugin\Provider\SupportedLocaleProviderInterface;
use Sylius\ShopApiPlugin\View\Product\PageView;
use Webmozart\Assert\Assert;

final class PageCatalogViewRepository implements PageCatalogViewRepositoryInterface
{
    /** @var ChannelRepositoryInterface */
    private $channelRepository;

    /** @var PageRepositoryInterface */
    private $pageRepository;

    /** @var PageViewFactoryInterface */
    private $pageViewFactory;

    /** @var SupportedLocaleProviderInterface  */
    private $supportedLocaleProvider;

    /** @var PaginationPageViewFactoryInterface  */
    private $paginationPageViewFactory;

    public function __construct(
        ChannelRepositoryInterface $channelRepository,
        PageRepositoryInterface $pageRepository,
        PageViewFactoryInterface $pageViewFactory,
        SupportedLocaleProviderInterface $supportedLocaleProvider,
        PaginationPageViewFactoryInterface $paginationPageViewFactory
    ) {
        $this->channelRepository = $channelRepository;
        $this->pageRepository = $pageRepository;
        $this->pageViewFactory = $pageViewFactory;
        $this->supportedLocaleProvider = $supportedLocaleProvider;
        $this->paginationPageViewFactory = $paginationPageViewFactory;
    }

    public function findEnabled(string $channelCode, PaginatorDetails $paginatorDetails, ?string $localeCode): PageView
    {
        $channel = $this->getChannel($channelCode);
        $localeCode = $this->supportedLocaleProvider->provide($localeCode, $channel);

        $queryBuilder = $this->pageRepository->createTranslationBasedQueryBuilder($localeCode);
        $queryBuilder
            ->innerJoin('o.sections', 'section')
            ->andWhere('section.hidden = false');

        return $this->addPagination($queryBuilder, $paginatorDetails, $localeCode);
    }

    public function findEnabledBySectionCode(string $sectionCode, string $channelCode, PaginatorDetails $paginatorDetails, ?string $localeCode): PageView
    {
        $channel = $this->getChannel($channelCode);
        $localeCode = $this->supportedLocaleProvider->provide($localeCode, $channel);

        $queryBuilder = $this->pageRepository->createShopListQueryBuilder($sectionCode, $channelCode);
        $paginatorDetails->addToParameters('code', $sectionCode);

        return $this->addPagination($queryBuilder, $paginatorDetails, $localeCode);
    }

    private function addPagination(QueryBuilder $queryBuilder,PaginatorDetails $paginatorDetails, string $localeCode): PageView
    {
        $pagerfanta = new Pagerfanta(new QueryAdapter($queryBuilder));

        $pagerfanta->setMaxPerPage($paginatorDetails->limit());
        $pagerfanta->setCurrentPage($paginatorDetails->page());

        $pageView = $this->paginationPageViewFactory->create($pagerfanta, $paginatorDetails->route(), $paginatorDetails->parameters());

        foreach ($pagerfanta->getCurrentPageResults() as $currentPageResult) {
            $pageView->items[] = $this->pageViewFactory->create($currentPageResult, $localeCode);
        }

        return $pageView;
    }

    private function getChannel(string $channelCode): ChannelInterface
    {
        /** @var ChannelInterface $channel */
        $channel = $this->channelRepository->findOneByCode($channelCode);

        Assert::notNull($channel, sprintf('Channel with code %s has not been found.', $channelCode));

        return $channel;
    }
}
