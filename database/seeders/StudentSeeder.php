<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    foreach (range(1, 10) as $item) {
      $student = new Student();
      $student->name = Str::random(6);
      $student->age = rand(16, 20);
      $student->detail = Str::random(100);
      $student->address = Str::random(80);
      $student->save();
    }
  }
}
