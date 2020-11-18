<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Repository;

use BitBag\SyliusCmsPlugin\Repository\FrequentlyAskedQuestionRepository as BaseFrequentlyAskedQuestionRepository;

class FrequentlyAskedQuestionRepository extends BaseFrequentlyAskedQuestionRepository implements FrequentlyAskedQuestionRepositoryInterface
{
    public function findBySectionCode(string $sectionCode, ?string $localeCode): array
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.translations', 'translation')
            ->innerJoin('o.frequentlyAskedQuestionSections', 'section')
            ->where('translation.locale = :localeCode')
            ->andWhere('section.code = :sectionCode')
            ->andWhere('o.enabled = true')
            ->setParameter('sectionCode', $sectionCode)
            ->setParameter('localeCode', $localeCode)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByQuestionPart(string $phrase, string $locale, ?int $limit = null): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('translation.question LIKE :question')
            ->setParameter('question', '%' . $phrase . '%')
            ->setParameter('locale', $locale)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }
}
