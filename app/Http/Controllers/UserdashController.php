<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class UserdashController extends Controller
{
    public function index()
    {
       $user = Auth::user();

        // // Exemple de données (tu pourras remplacer par des requêtes à ta DB)
        $ordersCount = 5;
        $offersCount = 3;
        $messagesCount = 2;

        return view('users.dashboard', compact('user', 'ordersCount', 'offersCount', 'messagesCount'));

        // return view('users.dashboard',compact('user'));
    }

    public function profil() {
         $user = Auth::user();
          $orders= 5;
        $offersCount = 3;
        $messagesCount = 2;
        return view('profil.profil', compact('user', 'orders', 'offersCount', 'messagesCount'));
        
    }
}
