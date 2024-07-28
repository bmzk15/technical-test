<?php

declare(strict_types=1);

namespace App\Interfaces\Factory;

use App\Interfaces\Aggregator\ArticleAggregatorInterface;

/**
 * Interface ArticleAggregatorFactoryInterface
 *
 * @package App\Interfaces\Factory
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
interface ArticleAggregatorFactoryInterface
{
    /**
     * @param string|null $slug
     *
     * @return \App\Interfaces\Aggregator\ArticleAggregatorInterface
     */
    public function build(?string $slug): ArticleAggregatorInterface;
}
