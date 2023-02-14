<?php declare(strict_types=1);

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\ClassMorphViolationException;

trait HasRelations
{
    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public static function getMorphName(): string
    {
        $morphMap = Relation::morphMap();
        $model    = new static();
        if (!empty($morphMap) && \in_array(static::class, $morphMap, true)) {
            return array_search(static::class, $morphMap, true);
        }

        if (static::class === Pivot::class) {
            return static::class;
        }

        if (Relation::requiresMorphMap()) {
            throw new ClassMorphViolationException($model);
        }

        return static::class;
    }
}
