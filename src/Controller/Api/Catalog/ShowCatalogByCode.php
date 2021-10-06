<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Controller\Api\Catalog;

use DH\ArtisCmsPlugin\Repository\CatalogRepositoryInterface;
use FOS\RestBundle\View\ViewHandlerInterface;

final class ShowCatalogByCode
{
    private ViewHandlerInterface $viewHandler;

    private CatalogRepositoryInterface $catalogRepository;

    public function __construct(
        ViewHandlerInterface $viewHandler,
        CatalogRepositoryInterface $catalogRepository
    ) {
        $this->viewHandler = $viewHandler;
        $this->catalogRepository = $catalogRepository;
    }
}
