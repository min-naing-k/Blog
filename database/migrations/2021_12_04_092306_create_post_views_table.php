<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostViewsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('post_views', function (Blueprint $table) {
      $table->id();
      $table->foreignId('post_id')->constrained()->cascadeOnDelete();
      $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
      $table->string('ip')->nullable();
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
    Schema::dropIfExists('post_views');
  }
}
