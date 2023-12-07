<?php

namespace App\Livewire\Shop;

use App\Facades\Cart;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $paginate = 15;
    protected $updatesQueryString = [
        ['search' => ['except' => '']]
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }
    public function render()
    {
        return view('livewire.shop.shop', [
            'products' => $this->search == null ?
                Product::latest()->paginate($this->paginate) :
                Product::latest()->where('title', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        Cart::add($product);
        // dd(Cart::get()['products']);
        $this->dispatch('addToCart');
    }
}