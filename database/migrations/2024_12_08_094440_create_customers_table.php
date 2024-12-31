<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama pelanggan
            $table->string('email')->unique(); // Email pelanggan
            $table->string('phone'); // Nomor telepon pelanggan
            $table->string('address')->nullable(); // Alamat pelanggan
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}