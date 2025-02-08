<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Machine extends Model
{
    public function resets(): HasMany
    {
        return $this->hasMany(MachineReset::class);
    }

    public function operations(): HasMany
    {
        return $this->hasMany(MachineOperation::class);
    }
}
