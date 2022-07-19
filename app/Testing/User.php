<?php
namespace App\Testing;

class User
{
  // public function __construct(protected string $name, protected int $age, protected string $address)
  // {}

  public function printUser()
  {
    return [
      'name' => $this->name,
      'age' => $this->age,
      'address' => $this->address,
    ];
  }
}
