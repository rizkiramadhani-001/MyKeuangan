<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Delimiter\Bracket;

class Transaction extends Model
{

    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
