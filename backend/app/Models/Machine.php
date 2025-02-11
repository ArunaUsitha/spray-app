<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static findOrFail($id)
 * @method static find(mixed $get)
 * @property mixed $id
 */
class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'model',
        'brand',
        'purchase_date',
        'purchase_price',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d H:i:s',
            'updated_at' => 'datetime:Y-m-d H:i:s',
        ];
    }

    public function resets(): HasMany
    {
        return $this->hasMany(MachineReset::class);
    }

    public function operations(): HasMany
    {
        return $this->hasMany(MachineOperation::class);
    }
}
