<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Collection;
class ProfileController extends Controller
{


public function dashboard(Request $request)
{
    $user = User::count();
    $category = Category::count();
    $product = Product::count();
    $collection = Collection::count();

    $query = \App\Models\Answer::with(['question','option','user']);

    // search by user id
    if($request->filled('user_id')){
        $query->where('user_id', $request->user_id);
    }

    $answers = $query->orderBy('created_at','desc')->get();

    return view('dashboard', compact('user','category','product','collection','answers'));
}
    /**
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request->post());
        // dd($request->user());
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        User::where('id', $request->user()->id)->update(['mode'=>$request->mode]);

        $request->user()->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
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
    
}
