<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Repository;

use BitBag\SyliusCmsPlugin\Repository\MediaRepository as BaseMediaRepository;

class MediaRepository extends BaseMediaRepository implements MediaRepositoryInterface
{
    public function findByPageCode(string $code): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.pages', 'page')
            ->andWhere('page.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getResult()
            ;
    }
}
