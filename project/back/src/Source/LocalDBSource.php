<?php
declare(strict_types=1);

namespace App\Source;

use App\DTO\ArticleDTO;
use App\Interfaces\Aggregator\LocalAggregatorInterface;
use App\Repository\ArticleRepository;

/**
 * Class LocalDBSource
 *
 * @package App\Source
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
final class LocalDBSource extends BaseSource implements LocalAggregatorInterface
{
    /**
     * @var string
     */
    private string $slug;

    /**
     * @param string $name
     * @param string $slug
     */
    public function __construct(string $name, string $slug)
    {
        parent::__construct($name);
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}
