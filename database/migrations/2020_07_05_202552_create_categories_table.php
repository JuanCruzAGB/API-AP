<?php
  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;

  class CreateCategoriesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
      Schema::create('categories', function (Blueprint $table) {
        $table->bigIncrements('id_category');
        $table->string('name');
        $table->unsignedInteger('id_parent')->nullable();
        $table->string('slug');
        $table->unsignedInteger('id_created_by');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
      Schema::dropIfExists('categories');
    }
  }