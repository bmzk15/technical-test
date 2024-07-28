<?php

declare(strict_types=1);

namespace App\Interfaces\Aggregator;

use Doctrine\Common\Collections\Collection;
use Generator;

/**
 * Interface RssAggregatorInterface
 *
 * @package App\Interfaces\Aggregator
 * @author Boris MALEZYK <contact@borismalezyk.com>
 */
interface RssAggregatorInterface extends SourceAggregatorInterface
{
    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAggregateArticles(): Collection;
}
