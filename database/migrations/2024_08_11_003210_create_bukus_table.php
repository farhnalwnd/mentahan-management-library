<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_buku');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->integer('jumlah');
            $table->string('upload_pdf')->nullable(); // Nullable jika PDF tidak wajib diisi
            $table->string('upload_cover')->nullable(); // Nullable jika cover tidak wajib diisi
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
        Schema::dropIfExists('bukus');
    }
}
