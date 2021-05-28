<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Controller\Api\Page;

use DH\ArtisCmsPlugin\ViewRepository\PageCatalogViewRepositoryInterface;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Channel\Context\ChannelNotFoundException;
use Sylius\ShopApiPlugin\Model\PaginatorDetails;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Webmozart\Assert\Assert;

final class ShowPageBySectionCode
{
    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var PageCatalogViewRepositoryInterface */
    private $pageCatalogViewRepository;

    /** @var ChannelContextInterface */
    private $channelContext;

    public function __construct(
        ViewHandlerInterface $viewHandler,
        PageCatalogViewRepositoryInterface $pageCatalogViewRepository,
        ChannelContextInterface $channelContext
    ) {
        $this->viewHandler = $viewHandler;
        $this->pageCatalogViewRepository = $pageCatalogViewRepository;
        $this->channelContext = $channelContext;
    }

    public function __invoke(Request $request): Response
    {
        try {
            $channel = $this->channelContext->getChannel();
            Assert::notNull($channel->getCode());

            return $this->viewHandler->handle(View::create($this->pageCatalogViewRepository->findEnabledBySectionCode(
                $request->attributes->get('code'),
                $channel->getCode(),
                new PaginatorDetails($request->attributes->get('_route'), $request->query->all()),
                $request->query->get('locale')
            ), Response::HTTP_OK));
        } catch (ChannelNotFoundException $exception) {
            throw new NotFoundHttpException('Channel has not been found.');
        } catch (\InvalidArgumentException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }
    }
}
