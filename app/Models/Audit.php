<?php declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\HasRelations;
use App\Models\Contracts\BaseModelContract;
use OwenIt\Auditing\Models\Audit as AuditModel;

final class Audit extends AuditModel implements \OwenIt\Auditing\Contracts\Audit, BaseModelContract
{
    use HasRelations;
    use \OwenIt\Auditing\Audit;

    /**
     * {@inheritdoc}
     */
    protected $guarded = [];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'old_values' => 'json',
        'new_values' => 'json',
        // Note: Please do not add 'auditable_id' in here, as it will break non-integer PK models
    ];

    public static function first(): ?self
    {
        return static::query()->orderBy('id')->first();
    }

    /**
     * {@inheritdoc}
     */
    public function getSerializedDate($date) // @phpstan-ignore-line
    {
        return $this->serializeDate($date);
    }
}
