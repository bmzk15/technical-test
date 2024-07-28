<?php
declare(strict_types=1);

namespace App\Interfaces\Entity;

use DateTimeInterface;

/**
 * Interface ArticleInterface
 *
 * @package App\Interfaces\Entity
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
interface ArticleInterface
{
    /**
     * @return string
     */
    public function getSourceName(): string;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @return string|null
     */
    public function getAuthor(): ?string;

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): DateTimeInterface;
}
