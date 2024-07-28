<?php

declare(strict_types=1);

namespace App\Enum;

/**
 * Class SourceTypeFields
 *
 * @package App\Enum
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
enum SourceTypeEnum: string
{
    case LOCAL_DATA_BASE = 'local';
    case RSS = 'rss';
}
