<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    protected $guarded = ['id'];

    // Relationship: An item has many savings entries
    public function tabungans(): HasMany
    {
        return $this->hasMany(Tabungan::class);
    }
    
    // Helper to get total saved for this item
    public function getTerkumpulAttribute()
    {
        return $this->tabungans->sum('nominal');
    }

    public static function dbLoadExpenses()
    {
        $data =  User::dbGetCurrentUser();
        return Barang::where('user_id', $data->id)->where('tipe','kebutuhan')->get();

    }
    public static function dbLoadWishlist()
    {
        $data =  User::dbGetCurrentUser();
        return Barang::where('user_id', $data->id)->where('tipe','wishlist')->get();

    }
}