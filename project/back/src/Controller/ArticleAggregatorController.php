<?php

namespace App\Controller;

use App\Factory\ArticleAggregatorFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAggregatorController
{

    #[Route('/articles/aggregate', name: 'aggregate_articles')]
    public function __invoke(ArticleAggregatorFactory $articleAggregatorFactory): Response
    {
        // Utilisez la fabrique pour agréger des articles
        $aggregatedArticles = $articleAggregatorFactory->build();

        dump($aggregatedArticles->getArticles());

        die;

        // Retournez une réponse, par exemple en JSON
        return new Response(
            json_encode($aggregatedArticles),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
