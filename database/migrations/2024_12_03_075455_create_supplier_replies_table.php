<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supplier_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_contact_id');
            $table->text('message');
            $table->timestamps();

            $table->foreign('supplier_contact_id')->references('id')->on('supplier_contacts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_replies');
    }
};
