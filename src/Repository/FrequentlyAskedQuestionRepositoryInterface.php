<?php

declare(strict_types=1);

namespace DH\ArtisCmsPlugin\Repository;

use BitBag\SyliusCmsPlugin\Repository\FrequentlyAskedQuestionRepositoryInterface as BaseFrequentlyAskedQuestionRepositoryInterface;

interface FrequentlyAskedQuestionRepositoryInterface extends BaseFrequentlyAskedQuestionRepositoryInterface
{
    public function findBySectionCode(string $sectionCode, ?string $localeCode): array;

    public function findByQuestionPart(string $phrase, string $locale, ?int $limit = null): array;
}
