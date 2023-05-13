<?php
  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;

  class CreateForeignTableCategoryProperty extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
      Schema::create('foreign_table_category_property', function (Blueprint $table) {
        $table->increments('id_foreign');
        $table->unsignedInteger('id_category');
        $table->unsignedInteger('id_property');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
      Schema::dropIfExists('foreign_table_category_property');
    }
  }