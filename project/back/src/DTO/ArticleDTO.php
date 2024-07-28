<?php

declare(strict_types=1);

namespace App\DTO;

use App\Interfaces\Entity\ArticleInterface;
use DateTimeInterface;
use Symfony\Component\Serializer\Attribute\Groups;

/**
 * Class ArticleDTO
 *
 * @package App\DTO
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
class ArticleDTO implements ArticleInterface
{
    const AUTHOR_DEFAULT = 'Inconnu';

    /**
     * @var string
     */
    private string $sourceName;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $content;
    /**
     * @var string|null
     */
    private ?string $author;

    /**
     * @var \DateTimeInterface|null
     */
    private ?DateTimeInterface $date;

    /**
     * @param string                  $sourceName
     * @param string                  $title
     * @param string                  $content
     * @param \DateTimeInterface|null $date
     * @param string|null             $author
     */
    public function __construct(string $sourceName, string $title, string $content, ?DateTimeInterface $date, ?string $author)
    {
        $this->sourceName = $sourceName;
        $this->title       = $title;
        $this->content    = $content;
        $this->author     = $author;
        $this->date       = $date;
    }

    /**
     * @return string
     *
     */
    #[Groups(['source:read'])]
    public function getSourceName(): string
    {
        return $this->sourceName;
    }

    /**
     * @return string
     */
    #[Groups(['source:read'])]
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    #[Groups(['source:read'])]
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    #[Groups(['source:read'])]
    public function getAuthor(): string
    {
        return $this->author ?? self::AUTHOR_DEFAULT;
    }

    /**
     * @return \DateTimeInterface
     */
    #[Groups(['source:read'])]
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }
}
