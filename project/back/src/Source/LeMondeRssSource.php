<?php
declare(strict_types=1);

namespace App\Source;

use App\DTO\ArticleDTO;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Exception;

/**
 * Class LeMondeXMLSource
 *
 * @package App\Source
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
final class LeMondeRssSource extends RssSource
{
    public static string $slug = 'le-monde';

    public function __construct()
    {
        parent::__construct('Le Monde', 'https://www.lemonde.fr/rss/une.xml');
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAggregateArticles(): Collection
    {
        try {
            $xmlData  = $this->loadXmlData();
            $articles = new ArrayCollection();
            foreach ($xmlData->channel->item as $item) {
                $title       = (string)$item->title;
                $description = (string)$item->description;
                $author      = $item->creator ?? null;
                $date        = new DateTime((string)$item->pubDate);

                $articles->add(new ArticleDTO($this->name, $title, $description, $date, $author));
            }

            return $articles;
        } catch (Exception $e) {
            echo "Erreur lors de l'agrégation des articles : ".$e->getMessage();
        }
    }
}
