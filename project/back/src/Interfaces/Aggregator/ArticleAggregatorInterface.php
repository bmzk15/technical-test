<?php

declare(strict_types=1);

namespace App\Interfaces\Aggregator;

use App\Interfaces\Entity\SourceInterface;
use Doctrine\Common\Collections\Collection;

/**
 * Interface ArticleAggregatorInterface
 *
 * @package App\Interfaces\Aggregator
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
interface ArticleAggregatorInterface
{
    /**
     * @param \App\Interfaces\Aggregator\SourceAggregatorInterface $source
     *
     * @return void
     */
    public function addSource(SourceAggregatorInterface $source): void;

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSources(): Collection;

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles(): Collection;
}
