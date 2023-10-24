<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class Cart extends Model
{
    use HasFactory;

    public static function getCartItems(){
        if(Auth::check()){
            // If user logged in / pick auth id of the user
            $getCartItems = Cart::where('user_id',Auth::user()->id)->get()->toArray();
        }else{
            // If user not logged in / pick session id of the user
            $getCartItems = Cart::Where('session_id',Session::get('session_id'))->get()->toArray();
        }

        return $getCartItems;
    }
}
