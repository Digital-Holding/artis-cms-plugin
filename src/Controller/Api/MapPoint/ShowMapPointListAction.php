<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Controller\Api\MapPoint;

use DH\ArtisCmsPlugin\Entity\MapPointInterface;
use DH\ArtisCmsPlugin\Factory\ViewFactory\MapPoint\MapPointViewFactoryInterface;
use DH\ArtisCmsPlugin\Repository\MapPointRepositoryInterface;
use DH\ArtisCmsPlugin\View\MapPoint\MapPointView;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\ShopApiPlugin\Http\RequestBasedLocaleProviderInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowMapPointListAction
{
    /** @var RequestBasedLocaleProviderInterface */
    private $requestBasedLocaleProvider;

    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var MapPointRepositoryInterface */
    private $mapPointRepository;

    /** @var MapPointViewFactoryInterface */
    private $mapPointViewFactory;

    /** @var ChannelContextInterface */
    private $channelContext;

    /** @var ParameterBagInterface $parameterBag */
    private $parameterBag;

    public function __construct(
        RequestBasedLocaleProviderInterface $requestBasedLocaleProvider,
        ViewHandlerInterface $viewHandler,
        MapPointRepositoryInterface $mapPointRepository,
        MapPointViewFactoryInterface $mapPointViewFactory,
        ChannelContextInterface $channelContext,
        ParameterBagInterface $parameterBag
    )
    {
        $this->requestBasedLocaleProvider = $requestBasedLocaleProvider;
        $this->viewHandler = $viewHandler;
        $this->mapPointRepository = $mapPointRepository;
        $this->mapPointViewFactory = $mapPointViewFactory;
        $this->channelContext = $channelContext;
        $this->parameterBag = $parameterBag;
    }

    public function __invoke(Request $request)
    {
        /** @var ChannelInterface $channel */
        $channel = $this->channelContext->getChannel();
        $localeCode = $this->requestBasedLocaleProvider->getLocaleCode($request);

        /** @var ArrayCollection|MapPointInterface $mapPoints */
        $mapPoints = $this->mapPointRepository->findAll();

        $mapPointView = [];

        /** @var MapPointInterface $view */
        foreach ($mapPoints as $view) {
            $mapPointView [] = $this->buildSectionList($view, $channel, $localeCode);
        }

        return $this->viewHandler->handle(View::create($mapPointView, Response::HTTP_OK));
    }

    private function buildSectionList(MapPointInterface $mapPoint, ChannelInterface $channel, string $localeCode): MapPointView
    {
        return $this->mapPointViewFactory->create($mapPoint, $channel, $localeCode);
    }
}
