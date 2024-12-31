<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToMobilsTable extends Migration
{
    public function up()
    {
        Schema::table('mobils', function (Blueprint $table) {
            $table->string('status')->default('tersedia'); // Menambahkan kolom status dengan default 'tersedia'
        });
    }

    public function down()
    {
        Schema::table('mobils', function (Blueprint $table) {
            $table->dropColumn('status'); // Menghapus kolom status jika migrasi dibatalkan
        });
    }
}