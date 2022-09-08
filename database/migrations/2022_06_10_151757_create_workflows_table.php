<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Sprint;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflows', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->boolean('initial_workflow')->default(false);
            $table->boolean('final_workflow')->default(false);
            $table->foreignIdFor(User::class)->constrained()->onDelete('CASCADE');
            $table->foreignIdFor(Sprint::class)->constrained()->onDelete('CASCADE');
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
        Schema::dropIfExists('workflows');
    }
};
