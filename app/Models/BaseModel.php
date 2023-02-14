<?php declare(strict_types=1);

namespace App\Models;

use App\Support\Database\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Tpetry\PostgresqlEnhanced\Eloquent\Concerns\RefreshDataOnSave;

/**
 * @mixin \Eloquent
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin \Illuminate\Database\Query\Builder
 */
abstract class BaseModel extends Model
{
    use RefreshDataOnSave;
    use Concerns\HasProps;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    // public static function booted()
    // {
    //     // static::saved(function ($model) {
    //     //     $table = $model->getTable();
    //     //     if (Schema::hasColumn($table, 'id')) {
    //     //         DB::statement("select setval('{$table}_id_seq', (select max(id) + 1 from {$table}));");
    //     //     }

    //     //     $model->flushCache();
    //     // });
    // }

    final public function error(string $message, array $context = []): void
    {
        $this->log($message, $context, 'error');
    }

    final public function warn(string $message, array $context = []): void
    {
        $this->log($message, $context, 'warn');
    }

    final public function debug(string $message, array $context = []): void
    {
        $this->log($message, $context, 'debug');
    }

    final public function info(string $message, array $context = []): void
    {
        $this->log($message, $context, 'info');
    }

    final public function log(string $message, array $context = [], string $level = 'info'): void
    {
        Log::channel('stack')->{$level}($message, [ // @phpstan-ignore-line
            'model' => $this->getMorphClass(),
            'id'    => $this->id,
        ]);
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return \App\Support\Database\Builder|\Illuminate\Database\Eloquent\Builder|static
     */
    final public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }

    final public function getMorph(string|Model $morph): string
    {
        return \is_string($morph) ? $morph : $morph->getMorphClass();
    }

    final public function mergeField(string $field, mixed $value): void
    {
        if (property_exists($this, $field)) {
            if ($this->hasProp($field)) {
                $this->{$field} = $value; // @phpstan-ignore-line
            }

            return;
        }
        /** @phpstan-ignore-next-line */
        $this->data->{$field} = \is_array($this->data->{$field})
        /** @phpstan-ignore-next-line */
        ? array_merge($this->data->{$field}, [$value])
        : $value;
    }
}
