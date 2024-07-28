<?php

namespace App\Source;

use App\Enum\SourceTypeEnum;
use App\Interfaces\Aggregator\RssAggregatorInterface;
use Exception;
use SimpleXMLElement;

/**
 * Class RssSource
 *
 * @package App\Source
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
abstract class RssSource extends BaseSource implements RssAggregatorInterface
{
    public static string $slug;

    /**
     * @var string
     */
    protected string $url;

    /**
     * @param string $name
     * @param string $url
     */
    public function __construct(string $name, string $url)
    {
        parent::__construct($name);
        $this->url = $url;
    }

    /**
     * @return \SimpleXMLElement
     * @throws \Exception
     */
    protected function loadXmlData(): SimpleXMLElement
    {
        $xmlContent = file_get_contents($this->url);
        if ($xmlContent === false) {
            throw new Exception("Impossible de charger le contenu XML de l'URL: {$this->url}");
        }

        $xmlData = simplexml_load_string($xmlContent);
        if ($xmlData === false) {
            throw new Exception("Erreur lors de l'analyse du contenu XML.");
        }

        return $xmlData;
    }

    public function getSlug(): string
    {
        return static::$slug;
    }
}
