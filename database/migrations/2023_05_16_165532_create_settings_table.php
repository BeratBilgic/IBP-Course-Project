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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string( column: 'title', length: 150);
            $table->string( column: 'keywords')->nullable();
            $table->string( column: 'description')->nullable();
            $table->string( column: 'company', length: 150)->nullable();
            $table->string( column: 'address', length: 150)->nullable();
            $table->string( column: 'phone', length: 20)->nullable();
            $table->string( column: 'fax', length: 20)->nullable();
            $table->string( column: 'email', length: 75)->nullable();
            $table->string( column: 'facebook', length: 100)->nullable();
            $table->string( column: 'instagram', length: 100)->nullable();
            $table->string( column: 'twitter', length: 100)->nullable();
            $table->string( column: 'youtube', length: 100)->nullable();
            $table->string( column: 'github', length: 100)->nullable();
            $table->text( column: 'contact')->nullable();
            $table->text( column: 'aboutus')->nullable();
            $table->text( column: 'references') ->nullable();
            $table->string( column: 'status', length: 5)->nullable()->default ( value: 'False');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
