<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ListUserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->latest()->get();
        return view('listU.listUser', compact('users'));
    }

   public function toggleBlock(User $user)
{
    $user->is_blocked = !$user->is_blocked;
    
    $user->save();

    return back()->with('success', $user->name . ($user->is_blocked ? ' a été bloqué.' : ' a été débloqué.'));
}

    public function contact(Request $request, User $user)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::raw($request->message, function ($mail) use ($user, $request) {
            $mail->to($user->email)
                ->subject($request->subject)
                ->from(config('mail.from.address'), config('mail.from.name'));
        });

        return back()->with('success', 'Message envoyé à ' . $user->name);
    }
}
