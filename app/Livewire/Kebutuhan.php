<?php

namespace App\Livewire;

use App\Exports\BarangExport;
use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class Kebutuhan extends Component
{
    use WithFileUploads;

    // --- 1. Properties ---

    #[Validate(['categories' => 'required|array|min:1'])]
    public $categories = ['Personal'];

    public $newCategory = '';
    public $showModal = false;
    public $prompt = '';

    #[Validate([
        'items' => 'required|array|min:1',
        'items.*.name' => 'required|string',
        'items.*.price' => 'required|numeric|min:0',
    ])]
    public $items = [
        ['name' => '', 'price' => '']
    ];

    public $editItems ;

    #[Validate(['attachments.*' => 'image|max:10240'])]
    public $attachments = [];

    public $suggestions = [

    ];


    //Variable untuk Edit
    public $nama_barang;
    public $harga_barang;



     private function getUnsplashImage($query)
    {
        $accessKey = env('UNSPLASH_ACCESS_KEY');

        if (!$accessKey) {
            return null;
        }

        try {
            $response = Http::withOptions(['verify' => false])->get("https://api.unsplash.com/search/photos", [
                'query' => $query,
                'per_page' => 1,
                'client_id' => $accessKey
            ]);

            if ($response->successful() && isset($response->json()['results'][0]['urls']['small'])) {
                return $response->json()['results'][0]['urls']['small'];
            }
        } catch (\Exception $e) {
            dd($e);
        }

        return null;
    }



    public function removeCategory($index)
    {
        unset($this->categories[$index]);
        $this->categories = array_values($this->categories);
    }


    public function addItem()
    {
        $this->items[] = ['name' => '', 'price' => ''];
    }

    public function edit($id)
    {
        $this->showModal = true;
        $data = Barang::find($id);
        $this->editItems = $data;
        $this->nama_barang = $data->nama;
        $this->harga_barang = $data->harga;


    }


    public function saveEdit($id)
    {
        $data = Barang::find($id);
        $data->nama = $this->nama_barang;
        $data->harga = $this->harga_barang;

        if($data->save())
        {
            $this->showModal = false;
        }

    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function removeAttachment($index)
    {
        array_splice($this->attachments, $index, 1);
    }

    public function useSuggestion($name, $price)
    {
        $this->items[] = ['name' => $name, 'price' => $price];
    }

    // --- 3. AI / API Integration (FULL FIXED VERSION) ---

    public function generateSuggestions()
    {
        $this->validate([
            'prompt' => 'required|string|min:3'
        ]);

        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            session()->flash('error', 'Gemini API Key is missing.');
            return;
        }

        $systemInstruction = "You are a helpful budgeting assistant for Indonesian users.
        Based on the user's prompt, generate a categorized list of estimated expenses.

        RULES:
        1. Output MUST be valid JSON only.
        2. Do NOT use markdown formatting.
        3. Structure must be:
        [
          {
            \"category\": \"String\",
            \"icon\": \"String\",
            \"color\": \"String\",
            \"items\": [
                { \"name\": \"Item Name\", \"price\": Integer }
            ]
          }
        ]
        4. Use realistic Indonesian prices.";

        // API Request
        $response = Http::withOptions([
            'verify' => false,
        ])->
            withHeaders([
                'Content-Type' => 'application/json',
            ])
            ->timeout(20)
            ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $systemInstruction . "\nUSER PROMPT: " . $this->prompt]
                        ]
                    ]
                ]
            ]);

        if ($response->failed()) {
            session()->flash('error', 'AI Request failed: ' . $response->body());
            return;
        }

        $result = $response->json();
        $rawText = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$rawText) {
            session()->flash('error', 'AI returned an empty response.');
            return;
        }

        // Clean AI output
        $cleanJson = trim(str_replace(
            ['```json', '```JSON', '```', 'json'],
            '',
            $rawText
        ));

        $decoded = json_decode($cleanJson, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
            session()->flash('error', 'Failed to parse AI response: ' . json_last_error_msg());
            return;
        }

        // Merge result with default suggestion list
        $this->suggestions = array_merge($decoded, $this->suggestions);

        $this->prompt = '';

        session()->flash('message', 'Suggestions generated successfully!');
    }


    public function getTotalProperty()
    {
        return array_reduce($this->items, function ($carry, $item) {
            return $carry + (float) ($item['price'] ?? 0);
        }, 0);
    }


    public function dbSaveExpense()
    {
        // 1. Validate Input
        $this->validate();

        $imagePath = 'placeholder.jpg';
        if (!empty($this->attachments)) {
            // Save the first file to 'public/expenses'
            $imagePath = $this->attachments[0]->store('expenses', 'public');
        }


        $itemsPayload = array_map(fn($item) => [
            'nama' => $item['name'],
            'harga' => (int) $item['price']
        ], $this->items);

        $apiKey = env('GEMINI_API_KEY');

        $systemInstruction = "You are a financial logic engine. 
        Analyze the following list of items. For each item:
        1. Determine if it is a 'kebutuhan' (Need/Essential) or 'wishlist' (Want/Luxury).
        2. Write a short 1-sentence description/justification (in Bahasa Indonesia).
        
        RULES:
        - Output strictly JSON array.
        - The 'tipe' field MUST be exactly either 'kebutuhan' or 'wishlist'.
        - Return structure: [{'nama': '...', 'harga': 1000, 'tipe': '...', 'deskripsi': '...'}]
        ";

   


        $response = Http::withOptions([
            'verify' => false,
        ])->
            withHeaders([
                'Content-Type' => 'application/json',
            ])
            ->timeout(20)
            ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $systemInstruction . "\nItems List: " . json_encode($itemsPayload)]
                        ]
                    ]
                ]
            ]);
        $processedItems = [];

        // 6. Process AI Response
        if ($response->successful()) {
            $result = $response->json();
            $rawText = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';

            // Clean Markdown
            $cleanJson = str_replace(['```json', '```'], '', $rawText);
            $processedItems = json_decode($cleanJson, true);
        }

        if (empty($processedItems) || !is_array($processedItems)) {
            $processedItems = array_map(fn($i) => [
                'nama' => $i['nama'],
                'harga' => $i['harga'],
                'tipe' => 'kebutuhan', // Default fallback
                'deskripsi' => 'Input manual'
            ], $itemsPayload);
        }

        


        foreach ($processedItems as $index=> $item) {

        $firstItemName = $this->items[$index]['name'] ?? 'budget';
        $imageUrl = $this->getUnsplashImage($firstItemName);

          if (!$imageUrl) {
            $imageUrl = 'https://source.unsplash.com/random/400x400/?money,budget';
        }
            Barang::create([
                'user_id' => auth()->user()->id, 
                'nama' => $item['nama'],
                'deskripsi' => $item['deskripsi'] ?? 'Item added via Kebutuhan App',
                'img_url' => $imageUrl,
                'tipe' => strtolower($item['tipe']), 
                'harga' => $item['harga'],
            ]);
        }

        // 8. Reset Form
        $this->reset(['items', 'categories', 'attachments', 'newCategory', 'prompt']);
        $this->items = [['name' => '', 'price' => '']];

        session()->flash('message', 'Items analyzed by AI and saved successfully!');
    }



    public function getExpenses()
    {
            return Barang::orderBy('harga', 'desc')->where('user_id', auth()->user()->id)->get();
    }


    public function delete($id)
    {
        Barang::find($id)->delete();
    }

    public function export()
    {
        $filename = 'barang-' . Carbon::now()->format('Y-m-d_H-i-s') . '.xlsx';

        
        return Excel::download(new BarangExport, $filename);

        
    }
    
    public function exportPdf()
    {
        $filename = 'barang-' . Carbon::now()->format('Y-m-d_H-i-s') . '.pdf';

        return Excel::download(new BarangExport, $filename, \Maatwebsite\Excel\Excel::DOMPDF);

    }

    public function render()
    {
        $barangs = $this->getExpenses();
        return view('livewire.kebutuhan', compact('barangs'));
    }
}
