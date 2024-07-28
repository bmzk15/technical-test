<?php

declare(strict_types=1);

namespace App\Interfaces\Aggregator;

use Doctrine\Common\Collections\Collection;

/**
 * Interface SourceAggregatorInterface
 *
 * @package App\Interfaces\Aggregator
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
interface SourceAggregatorInterface
{
    /**
     * @return string
     */
    public function getSlug(): string;
}
