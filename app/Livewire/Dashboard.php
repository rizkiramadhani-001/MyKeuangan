<?php

namespace App\Livewire;

use App\Exports\TransactionExport;
use App\Models\Barang;
use App\Models\Tabungan;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Date;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Dashboard extends Component
{
    public $fundModal = false;
    public $barangId;
    public $amount;
    public $amountSudden;
    public function goToTokopedia($id)
    {
        $item = Barang::find($id);
        $url = 'https://www.tokopedia.com/search?st=&q=' . $item->nama . '&srp_component_id=02.01.00.00&srp_page_id=&srp_page_title=&navsource=';
        $this->dispatch('open-new-tab', url: $url);


        Transaction::create([
            'user_id' => auth()->user()->id,
            'barang_id' => $id,
            'amount' => $item->harga
        ]);


        $this->dispatch('transaction');


    }

    function openModal($id)
    {
        $this->barangId = $id;
        $this->fundModal = true;
    }


    public function saveSaving($id)
    {
        Tabungan::create([
            'barang_id' => $id,
            'nominal' => $this->amount
        ]);



        Transaction::create([
            'user_id' => auth()->user()->id,
            'barang_id' => $id,
            'amount' => $this->amount
        ]);


        $this->fundModal = false;

    }



    public function delete($id)
    {
        Transaction::find($id)->delete();
    }

    public function render()
    {
        $data = User::dbGetCurrentUser();
        $barang = Barang::dbLoadExpenses();
        
        $wishlist = Barang::dbLoadWishlist();
        $transactions = Transaction::orderBy('created_at', 'desc')->where('user_id', auth()->user()->id)->paginate(4);
        $sum = $barang->sum('harga');
        $sumw = $wishlist->sum('harga');
        $tsc = Transaction::where('user_id', auth()->user()->id)
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->whereHas('barang', function ($q) {
            $q->where('tipe', 'wishlist');
        });
        $tsc2 = Transaction::where('user_id', auth()->user()->id)->get();

        $sumf = $tsc->sum('amount');
        $sumf2 = $tsc2->sum('amount');

        return view('livewire.dashboard', compact('data', 'barang', 'wishlist', 'sum', 'sumw', 'transactions', 'sumf', 'sumf2'));
    }

    public function export()
    {
         $filename = 'transaction-' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new TransactionExport, $filename);
    }
}
