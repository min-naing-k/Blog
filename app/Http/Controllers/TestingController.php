<?php

namespace App\Http\Controllers;

use App\Testing\User;

class TestingController extends Controller
{
  public function __invoke(User $user)
  {
    $user->name = "Min Naing Kyaw";
    $user->age = 22;
    $user->address = "Address";
    return $user->printUser();
  }
}
