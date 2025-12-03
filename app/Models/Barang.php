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
        return Barang::where('tipe', 'kebutuhan')->where('user_id', auth()->user()->id)->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

    }
    public static function dbLoadWishlist()
    {
        $data =  User::dbGetCurrentUser();
        return Barang::where('tipe', 'wishlist')->where('user_id', auth()->user()->id)
            ->get();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);  
        // foreign key di transactions = barang_id
    }
}