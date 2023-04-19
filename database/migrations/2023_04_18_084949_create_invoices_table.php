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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('filePath');
            $table->timestamps();
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Customer::class)->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Customer::class);
        });
    }
};
