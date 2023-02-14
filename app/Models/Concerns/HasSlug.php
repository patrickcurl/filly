<?php declare(strict_types=1);

namespace App\Models\Concerns;

use Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasSlug
{
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => $this->slugSources(),

            ],

        ];
    }

    public function slugSources(): array
    {
        $sources = [];
        foreach ($this->defaultSources() as $source) {
            if ($this->hasColumn($source)) {
                $sources[] = $source;
                break;
            }
        }

        return $sources;
    }

    public function defaultSources(): array
    {
        return [
            'name',
            'title',
            'data->name',
            'value',
        ];
    }

    public function hasColumn(string $column): bool
    {
        $columns = (array) $this->getCachedSchemaColumns() ?? [];

        return \in_array($column, $columns, true);
    }

    public function getCachedSchemaColumns(): array
    {
        /** @var array $columns */
        $columns = Cache::remember('schema_columns', now()->addMinutes(5), function () {
            return Schema::getColumnListing($this->getTable()) ?? [];
        });

        return (array) $columns ?? [];
    }

    public static function resetSlugs()
    {
        $orgs = self::all();
        foreach ($orgs as $org) {
            $org->resetSlug();
        }
    }

    public function resetSlug()
    {
        $this->slug = null;
        $this->save();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // public function url(): Attribute
    // {
    //     return Attribute::make(
    //         get: function ($value, array $attributes = []): string {
    //             if (!\is_null($attributes['slug'])) {
    //                 $permalink = Str::snake(Str::plural($this->getTable()));
    //                 $permalink . '/' . $attributes['slug'];

    //                 return api_url($permalink);
    //             }

    //             return '';
    //         }
    //     );
    // }
}
