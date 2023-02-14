<?php declare(strict_types=1);

namespace App\Models\Contracts;

interface HasSlug
{
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array;

    public function slugSources(): array;
}
