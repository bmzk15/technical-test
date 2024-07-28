<?php

declare(strict_types=1);

namespace App\Trait;

use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trait EntityDateTimeTrait
 *
 * @package App\Trait
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
trait EntityDateTimeTrait
{
    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?DateTimeInterface $createdAt = null;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $updatedAt = null;

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt ?? new DateTime();
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt ?? new DateTime();
    }
}
