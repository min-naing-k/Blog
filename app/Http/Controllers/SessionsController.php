<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
  public function create()
  {
    return view('sessions.create');
  }

  public function store()
  {
    $attributes = request()->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (!Auth::attempt($attributes)) {
      // return back()
      //   ->withInput()
      //   ->withErrors(['email' => 'Your provided credential could\'t not saved.']);

      throw ValidationException::withMessages([
        'email' => 'Your provided credential could\'t not saved.',
      ]);
    }

    // for session fixation
    session()->regenerate();

    return redirect('/')->with('success', 'Welcome Back!');
  }

  public function destroy()
  {
    Auth::logout();
    return redirect('/')->with('success', 'Goodbye!');
  }
}
