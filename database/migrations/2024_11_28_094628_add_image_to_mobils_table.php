<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToMobilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobils', function (Blueprint $table) {
            $table->string('image')->nullable(); // Menambahkan kolom image
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mobils', function (Blueprint $table) {
            $table->dropColumn('image'); // Menghapus kolom image
        });
    }
}