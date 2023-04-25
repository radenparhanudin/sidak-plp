<?php

namespace Modules\MasterData\Entities;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asn extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
