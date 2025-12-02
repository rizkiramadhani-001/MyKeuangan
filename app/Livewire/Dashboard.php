<?php

namespace App\Livewire;

use App\Models\Barang;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{


    public function render()
    {
        $data = User::dbGetCurrentUser();
        $barang = Barang::dbLoadExpenses();
        $wishlist = Barang::dbLoadWishlist();
        // Sum nominal of tabungans for a single Barang
        $sum = $barang->sum('harga');
        $sumw = $wishlist->sum('harga');

        return view('livewire.dashboard', compact('data', 'barang', 'wishlist', 'sum', 'sumw'));
    }
}
