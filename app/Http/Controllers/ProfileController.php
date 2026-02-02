<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; 
use Illuminate\View\View;
use App\Models\User;


class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $path = $request->file('profile_photo')->store('profile', 'public');
        $user->update(['profile_photo' => $path]);

        return back()->with('success', 'Photo de profil mise à jour !');
    }

    public function deletePhoto()
    {
      /** @var \App\Models\User $user */
       $user = Auth::user();

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
            $user->update(['profile_photo' => null]);
        }

        return back()->with('success', 'Photo de profil supprimée !');
    }
}
