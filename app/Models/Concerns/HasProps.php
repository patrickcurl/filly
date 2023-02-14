<?php declare(strict_types=1);

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasProps
{
    public function getProps()
    {
        $table    = $this->getTable();
        $cacheKey = 'model.props.' . $table;

        return Cache::remember(
            $cacheKey,
            now()->addMinutes(5),
            function () use ($table) {
                Schema::getColumnListing($table);
            }
        );
    }

    public function hasProp(string $key)
    {
        return collect($this->getProps())->values()->contains($key);
    }

    public function matchingProp(array $props)
    {
        return collect($props)
            ->filter(fn ($value, $key) => $this->hasProp($key));
    }

    public function hasAllProps(array $props)
    {
        return $this->matchingProps($props)->count() === \count($props);
    }
}
