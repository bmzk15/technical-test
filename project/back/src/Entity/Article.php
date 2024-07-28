<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\ApiResource\ArticleDTOStateProvider;
use App\Repository\ArticleRepository;
use App\Trait\EntityDateTimeTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Source
 *
 * @package App\Entity
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ORM\Table(name: "article")]
#[ORM\Index(name: "idx_source", columns: ["source_id"])]
#[ORM\Index(name: "idx_author", columns: ["author"])]
#[ORM\Index(name: "idx_created_at", columns: ["created_at"])]
#[ApiResource(
    operations: [
        new GetCollection(),
    ],
    normalizationContext: ['groups' => ['source:read']],
    provider: ArticleDTOStateProvider::class,
)]
class Article
{
    use EntityDateTimeTrait;

    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int   $id = null;

    #[ORM\ManyToOne(targetEntity: Source::class, inversedBy: 'articles')]
    #[ORM\JoinColumn(name: 'source_id', nullable: false)]
    private Source $source;

    /**
     * @var string
     */
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $title;

    /**
     * @var string
     */
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $author;

    /**
     * @var string
     */
    #[ORM\Column(type: Types::TEXT)]
    private string $content;

    /**
     * @param \App\Entity\Source $source
     * @param string             $title
     * @param string             $author
     * @param string             $content
     */
    public function __construct(Source $source, string $title, string $author, string $content)
    {
        $this->source  = $source;
        $this->title   = $title;
        $this->author  = $author;
        $this->content = $content;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \App\Entity\Source
     */
    public function getSource(): Source
    {
        return $this->source;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
