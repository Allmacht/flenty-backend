<?php

use App\Models\Issue;
use App\Models\Sprint;
use App\Models\Workflow;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues_per_sprints', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sprint::class)->constrained()->onDelete('CASCADE');
            $table->foreignIdFor(Issue::class)->constrained()->onDelete('CASCADE');
            $table->foreignIdFor(Workflow::class)->constrained()->onDelete('CASCADE');
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
        Schema::dropIfExists('issues_per_sprints');
    }
};
