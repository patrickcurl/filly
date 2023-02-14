<?php declare(strict_types=1);

namespace App\Models\Contracts;

/**
 * @mixin \Eloquent
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 */
interface BaseModelContract
{
    public static function getMorphName(): string;
}
