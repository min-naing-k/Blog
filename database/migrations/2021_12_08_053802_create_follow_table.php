<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('follow', function (Blueprint $table) {
      $table->id();
      $table->foreignId('follower_id')->constrained('users', 'id')->cascadeOnDelete();
      $table->foreignId('followed_id')->constrained('users', 'id')->cascadeOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('follow');
  }
}
