<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Repository;

use BitBag\SyliusCmsPlugin\Repository\SectionRepository as BaseSectionRepository;

class SectionRepository extends BaseSectionRepository implements SectionRepositoryInterface
{
    public function findByTaxonable(bool $taxonable): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.taxonable = :taxonable')
            ->setParameter('taxonable', $taxonable)
            ->getQuery()
            ->getResult()
            ;
    }
}
