<?php

declare(strict_types=1);

use App\Enum\GameStatusEnum;
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
        Schema::create('game', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('first_representative_id')->constrained('representative');
            $table->foreignUuid('second_representative_id')->constrained('representative');
            $table->foreignUuid('winner_representative_id')->nullable()->constrained('representative');
            $table->enum('status', GameStatusEnum::VALUES);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game');
    }
};
