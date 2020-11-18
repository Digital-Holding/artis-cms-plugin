<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Repository;

use BitBag\SyliusCmsPlugin\Repository\MediaRepositoryInterface as BaseMediaRepositoryInterface;

interface MediaRepositoryInterface extends BaseMediaRepositoryInterface
{
    public function findByPageCode(string $code): array;
}
