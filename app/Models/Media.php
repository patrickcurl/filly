<?php declare(strict_types=1);

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\IsSorted;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\CustomMediaProperties;

/**
 * @property-read string $type
 * @property-read string $extension
 * @property-read string $humanReadableSize
 * @property-read string $previewUrl
 * @property-read string $originalUrl
 */
final class Media extends SpatieMedia
{
    use IsSorted;
    use CustomMediaProperties;
    use HasUuid;
}
