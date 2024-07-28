<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Enum\SourceTypeEnum;
use App\Interfaces\Entity\SourceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Attribute\Groups;

/**
 * Class Source
 *
 * @package App\Entity
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
#[ORM\Entity]
#[ORM\Index(name: "idx_name", columns: ["name"])]
#[ORM\Table(name: "source")]
#[ApiResource(
    operations: [
        new GetCollection(),
    ],
    normalizationContext: ['groups' => ['source:read']],
)]
class Source implements SourceInterface
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Groups(['source:read'])]
    private ?string $name;

    /**
     * @var SourceTypeEnum
     */
    #[ORM\Column(type: Types::STRING, enumType: SourceTypeEnum::class)]
    private SourceTypeEnum $type;

    /**
     * @var string
     */
    #[ORM\Column(length: 128, unique: true)]
    #[Gedmo\Slug(fields: ['name'])]
    #[Groups(['source:read'])]
    private string $slug;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'source', cascade: ['persist', 'remove'])]
    private Collection $articles;

    /**
     * @param string         $name
     * @param SourceTypeEnum $type
     */
    public function __construct(string $name, SourceTypeEnum $type)
    {
        $this->name     = $name;
        $this->type     = $type;
        $this->articles = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return \App\Enum\SourceTypeEnum
     */
    public function getType(): SourceTypeEnum
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}
