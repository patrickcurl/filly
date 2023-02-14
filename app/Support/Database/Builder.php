<?php declare(strict_types=1);

namespace App\Support\Database;

use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

final class Builder extends EloquentBuilder
{
    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    public function first($columns = '*')
    {
        return $this->orderBy('id')
            ->take(1)
            ->get($columns ?? '*')
            ->first();
    }
}
