<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value')->nullable();
            $table->timestamps();
        });

        //Add default settings
        $siteName = new Setting();
        $siteName->name = "app_name";
        $siteName->value = "Atelier MRT";
        $siteName->save();

        $mapsApiKey = new Setting();
        $mapsApiKey->name = "maps_api_key";
        $mapsApiKey->value = null;
        $mapsApiKey->save();


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
