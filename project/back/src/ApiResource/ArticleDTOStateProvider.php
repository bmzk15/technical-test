<?php

declare(strict_types=1);

namespace App\ApiResource;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Factory\ArticleAggregatorFactory;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ArticleDTOStateProvider
 *
 * @package App\ApiResource
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
class ArticleDTOStateProvider implements ProviderInterface
{
    /**
     * @var \App\Factory\ArticleAggregatorFactory
     */
    private ArticleAggregatorFactory $factory;

    /**
     * @param \App\Factory\ArticleAggregatorFactory $factory
     */
    public function __construct(ArticleAggregatorFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param \ApiPlatform\Metadata\Operation $operation
     * @param array                           $uriVariables
     * @param array                           $context
     *
     * @return object|array|null
     * @throws \Exception
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $slug = null;
        if (($request = $context['request']) !== null && $request instanceof Request) {
            $slug = $request->query->get('source');
        }

        $aggregator = $this->factory->build($slug);

        return $aggregator->getArticles();
    }
}
