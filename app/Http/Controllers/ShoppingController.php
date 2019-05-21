<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cart;
use Session;

class ShoppingController extends Controller
{
    public function add_to_cart(){
      
        $pd = Product::find(request()->pd_id);

        $cartItem = Cart::add([
            'id' => $pd->id,
            'name' => $pd->name,
            'qty' => request()->qty,
            'price' => $pd->price,
            'weight' => 550
        ]);

        //associating our product model class for fetching image
        Cart::associate($cartItem->rowId, 'App\Product');


        Session::flash('success', 'Product added to the cart');
        return redirect()->route('cart');

    }

    public function cart(){
        return view('cart');
    }

    public function incr($id, $qty){
        
        Cart::update($id, $qty + 1);

        Session::flash('success', 'Products quantity updated');
        return redirect()->back();
    }

    public function decr($id, $qty){
        
        Cart::update($id, $qty - 1);

        Session::flash('success', 'Products quantity updated');
        return redirect()->back();
    }

    public function cart_delete($id){

        Cart::remove($id);

        Session::flash('success', 'Products removed');
        return redirect()->back();

    }

    public function rapid_add($id){

        $pd = Product::find($id);

        $cartItem = Cart::add([
            'id' => $pd->id,
            'name' => $pd->name,
            'qty' => 1,
            'price' => $pd->price,
            'weight' => 550
        ]);

        //associating our product model class for fetching image
        Cart::associate($cartItem->rowId, 'App\Product');
        
        Session::flash('success', 'Product added to the cart');
        return redirect()->route('cart');

    }
}
