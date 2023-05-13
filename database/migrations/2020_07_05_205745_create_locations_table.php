<?php
  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;

  class CreateLocationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
      Schema::create('locations', function (Blueprint $table) {
        $table->bigIncrements('id_location');
        $table->string('name');
        $table->boolean('favorite')->default(false);
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
      Schema::dropIfExists('locations');
    }
  }