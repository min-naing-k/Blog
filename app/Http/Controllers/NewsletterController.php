<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Exception;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
  // new Newsletter($client)
  public function __invoke(Newsletter $newsletter)
  {
    request()->validate([
      'email' => 'required|email',
    ]);

    try {
      $newsletter->subscribe(request('email'));
    } catch (Exception $e) {
      throw ValidationException::withMessages([
        'email' => 'Your email can\'t be added to our newsletter.',
      ]);
    }

    return redirect('/')->with('success', 'Your email is added successfully to our newsletter.');
  }
}
