<?php

declare(strict_types=1);

namespace App\Interfaces\Entity;

use App\Enum\SourceTypeEnum;
use Doctrine\Common\Collections\Collection;

/**
 * Interface SourceInterface
 *
 * @package App\Interfaces\Entity
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
interface SourceInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getSlug(): string;

    /**
     * @return \App\Enum\SourceTypeEnum
     */
    public function getType(): SourceTypeEnum;
}
