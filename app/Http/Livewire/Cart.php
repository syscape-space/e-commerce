<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $cartItems = [];


    protected $listeners = ['cartUpdated' => 'onCartUpdate'];


    public function mount()
    {
        $this->cartItems = \Darryldecode\Cart\Facades\CartFacade::session(auth()->id())->getContent()->toArray();
    }

    public function onCartUpdate()
    {

        // $this->cartItems = \Cart::session(auth()->id())->getContent()->toArray();
        $this->mount();


    }
    public function render()
    {
        return view('livewire.cart');
    }
}
