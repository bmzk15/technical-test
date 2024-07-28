<?php

declare(strict_types=1);

namespace App\Aggregator;

use App\DTO\ArticleDTO;
use App\Entity\Article;
use App\Interfaces\Aggregator\ArticleAggregatorInterface;
use App\Interfaces\Aggregator\LocalAggregatorInterface;
use App\Interfaces\Aggregator\RssAggregatorInterface;
use App\Interfaces\Aggregator\SourceAggregatorInterface;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class ArticleAggregator
 *
 * @package App\Aggregator
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
class ArticleAggregator implements ArticleAggregatorInterface
{
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private Collection $sources;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private Collection $articles;

    /**
     * @var \App\Repository\ArticleRepository
     */
    private ArticleRepository $articleRepository;

    /**
     * @param \App\Repository\ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->sources           = new ArrayCollection();
        $this->articles          = new ArrayCollection();
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param \App\Interfaces\Aggregator\SourceAggregatorInterface $source
     *
     * @return void
     */
    public function addSource(SourceAggregatorInterface $source): void
    {
        $this->sources[] = $source;

        $articles = match (true) {
            $source instanceof RssAggregatorInterface => $source->getAggregateArticles(),
            $source instanceof LocalAggregatorInterface => $this->buildDTO($this->articleRepository->findBySourceSlug($source->getSlug())),
            default => null,
        };

        if ($articles !== null) {
            $this->mergeArticles($articles);
        }
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSources(): Collection
    {
        return $this->sources;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $sourceArticles
     *
     * @return void
     */
    private function mergeArticles(Collection $sourceArticles): void
    {
        $this->articles = new ArrayCollection(array_merge($this->articles->toArray(), $sourceArticles->toArray()));
    }

    /**
     * @param array $articles
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    private function buildDTO(array $articles): ArrayCollection {
        $dto = new ArrayCollection();
        foreach ($articles as $article) {
            if(!$article instanceof Article) {
                continue;
            }
            $dto->add(new ArticleDTO((string)$article->getSource(), $article->getTitle(), $article->getContent(), $article->getCreatedAt(), $article->getAuthor()));
        }

        return $dto;
    }
}
