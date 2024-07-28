<?php

declare(strict_types=1);

namespace App\Factory;

use App\Aggregator\ArticleAggregator;
use App\Enum\SourceTypeEnum;
use App\Interfaces\Aggregator\ArticleAggregatorInterface;
use App\Interfaces\Aggregator\SourceAggregatorInterface;
use App\Interfaces\Entity\SourceInterface;
use App\Interfaces\Factory\ArticleAggregatorFactoryInterface;
use App\Repository\SourceRepository;
use App\Source\LeMondeRssSource;
use App\Source\LocalDBSource;
use Exception;

/**
 * Class ArticleAggregatorFactory
 *
 * @package App\Factory
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
final class ArticleAggregatorFactory implements ArticleAggregatorFactoryInterface
{
    /**
     * @var \App\Repository\SourceRepository
     */
    private SourceRepository $sourceRepository;

    /**
     * @var \App\Aggregator\ArticleAggregator
     */
    private ArticleAggregator $aggregator;

    public function __construct(ArticleAggregator $aggregator, SourceRepository $sourceRepository)
    {
        $this->sourceRepository = $sourceRepository;
        $this->aggregator       = $aggregator;
    }

    /**
     * @param string|null $slug
     *
     * @return \App\Interfaces\Aggregator\ArticleAggregatorInterface
     * @throws \Exception
     */
    public function build(?string $slug = null): ArticleAggregatorInterface
    {
        $sources = [];
        if ($slug !== null) {
            $sources[] = $this->sourceRepository->findOneBy(['slug' => $slug]);
        } else {
            $sources = $this->sourceRepository->findAll();
        }

        if (empty($sources)) {
            throw new Exception('No available sources');
        }

        foreach ($sources as $source) {
            if (!$source instanceof SourceInterface) {
                throw new Exception('$source must to be instance of SourceInterface');
            }

            $this->aggregator->addSource($this->buildSource($source));
        }

        return $this->aggregator;
    }

    /**
     * @param \App\Interfaces\Entity\SourceInterface $source
     *
     * @return \App\Interfaces\Aggregator\SourceAggregatorInterface
     * @throws \Exception
     */
    private function buildSource(SourceInterface $source): SourceAggregatorInterface
    {
        return match ($source->getType()) {
            SourceTypeEnum::LOCAL_DATA_BASE => new LocalDBSource($source->getName(), $source->getSlug()),
            SourceTypeEnum::RSS => $this->buildRssSource($source->getSlug()),
            default => throw new Exception('Unknow source'),
        };
    }

    /**
     * @param string $slug
     *
     * @return \App\Interfaces\Aggregator\SourceAggregatorInterface
     * @throws \Exception
     */
    private function buildRssSource(string $slug): SourceAggregatorInterface
    {
        return match ($slug) {
            LeMondeRssSource::$slug => new LeMondeRssSource(),
            default => throw new Exception('Unknow source'),
        };
    }
}
