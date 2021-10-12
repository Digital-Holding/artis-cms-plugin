<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\ViewRepository;

use DH\ArtisCmsPlugin\Factory\ViewFactory\Category\CatalogViewFactory;
use DH\ArtisCmsPlugin\Repository\CatalogRepositoryInterface;
use DH\ArtisCmsPlugin\View\Catalog\CatalogView;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\ShopApiPlugin\Provider\SupportedLocaleProviderInterface;
use Webmozart\Assert\Assert;

final class CatalogViewRepository implements CatalogViewRepositoryInterface
{
    private ChannelRepositoryInterface  $channelRepository;

    private SupportedLocaleProviderInterface $supportedLocaleProvider;

    private CatalogRepositoryInterface $catalogRepository;

    private CatalogViewFactory $catalogViewFactory;

    public function __construct(
        ChannelRepositoryInterface $channelRepository,
        SupportedLocaleProviderInterface $supportedLocaleProvider,
        CatalogRepositoryInterface $catalogRepository,
        CatalogViewFactory $catalogViewFactory
    ) {
        $this->channelRepository = $channelRepository;
        $this->supportedLocaleProvider = $supportedLocaleProvider;
        $this->catalogRepository = $catalogRepository;
        $this->catalogViewFactory = $catalogViewFactory;
    }

    public function getCatalog(string $menuCode, string $channelCode, string $dateTimeYear, ?string $localeCode): CatalogView
    {
        $channel = $this->getChannel($channelCode);
        $localeCode = $this->supportedLocaleProvider->provide($localeCode, $channel);

        $catalog = $this->catalogRepository->findOneEnabledByCode($menuCode, $dateTimeYear, $localeCode);

        if (null === $catalog) {
            Assert::notNull($catalog, sprintf('Catalog with menu code %d and year %s has not been found.', $menuCode, $dateTimeYear));
        }

        return $this->catalogViewFactory->create($catalog, $localeCode);
    }

    private function getChannel(string $channelCode): ChannelInterface
    {
        /** @var ChannelInterface $channel */
        $channel = $this->channelRepository->findOneByCode($channelCode);

        Assert::notNull($channel, sprintf('Channel with code %s has not been found.', $channelCode));

        return $channel;
    }
}
