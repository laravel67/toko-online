<?php

namespace App\Livewire\Shop;

use Midtrans\Snap;
use App\Facades\Cart;
use Livewire\Component;

class Checkout extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $address;
    public $city;
    public $postal_code;
    public $formCheckOut;
    public $snapToken;

    protected $listeners = [
        'emptyCart' => 'emptyCartHandler'
    ];

    public function mount()
    {
        $this->formCheckOut = true;
        $this->first_name = 'Murtaki';
        $this->last_name = 'Shihab';
        $this->email = 'murtaki@gmail.com';
        $this->phone = '088889898';
        $this->address = 'Muara siau';
        $this->city = 'Bangko';
        $this->postal_code = '909090';
    }
    public function render()
    {
        return view('livewire.shop.checkout');
    }

    public function checkout()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
        ]);
        $cart = Cart::get()['products'];
        $amount = array_sum(
            array_column($cart, 'price')
        );

        $costumerDetails = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
        ];

        $transactionDetails = [
            'order_id' => uniqid(),
            'gross_amount' => $amount,
        ];
        $payload = [
            'transaction_details' => $transactionDetails,
            'costumer_details' => $costumerDetails
        ];
        $this->formCheckOut = false;

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $snapToken = \Midtrans\Snap::getSnapToken($payload);
        $this->snapToken = $snapToken;
    }

    public function emptyCartHandlere()
    {
        Cart::clear();
        $this->dispatch('cartClear');
    }
}
