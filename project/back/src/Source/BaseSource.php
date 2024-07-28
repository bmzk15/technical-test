<?php
declare(strict_types=1);

namespace App\Source;

use App\Interfaces\Aggregator\SourceAggregatorInterface;

/**
 * Class BaseSource
 *
 * @package App\Source
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
abstract class BaseSource implements SourceAggregatorInterface
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
