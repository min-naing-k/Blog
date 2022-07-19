<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStudentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('students', function (Blueprint $table) {
      $table->renameColumn('bio', 'detail')->nullable()->change();
      $table->longText('address')->change();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('students', function (Blueprint $table) {
      $table->renameColumn('detail', 'bio')->change();
      $table->string('address')->change();
    });
  }
}
