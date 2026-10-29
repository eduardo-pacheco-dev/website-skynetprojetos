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
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('path', 255);
            $table->string('route_name')->nullable();
            $table->string('url', 2048);
            $table->string('referrer', 2048)->nullable();
            $table->string('referrer_host')->nullable();
            $table->string('visitor_hash', 64);
            $table->string('session_id', 64)->nullable();
            $table->string('device_type', 20);
            $table->string('browser', 30);
            $table->string('platform', 30);
            $table->text('user_agent')->nullable();
            $table->string('ip_hash', 64)->nullable();
            $table->timestamp('viewed_at');

            $table->timestamps();

            $table->index('viewed_at');
            $table->index(['path', 'viewed_at']);
            $table->index(['visitor_hash', 'viewed_at']);
            $table->index('referrer_host');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
