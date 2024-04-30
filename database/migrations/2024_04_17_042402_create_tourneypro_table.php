<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->text('image')->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('stadiums', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('location', 60);
            $table->integer('capacity')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('referees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('last_name', 40);
            $table->string('referee_type', 35);
            $table->string('nationality', 40);
            $table->string('description')->nullable();
            $table->text('image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->text('shield')->nullable();
            $table->text('description')->nullable();
            $table->string('coach_name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('last_name', 45);
            $table->integer('dorsal');
            $table->string('position', 30);
            $table->text('image')->nullable();
            $table->date('birth_date_at');
            $table->string('nationality', 40);
            $table->foreignId('team_id')->constrained('teams');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->datetime('date_at');
            $table->string('description')->nullable();

            $table->integer('goal_local')->nullable();
            $table->integer('goal_visitor')->nullable();

            $table->foreignId('team_local_id')->constrained('teams');
            $table->foreignId('team_visitor_id')->constrained('teams');

            $table->foreignId('stadium_id')->constrained('stadiums');
            $table->foreignId('tournament_id')->constrained('tournaments');

            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('color', 10);
            $table->string('description')->nullable();
            $table->foreignId('match_id')->constrained('matches');
            $table->foreignId('team_id')->constrained('teams');
            $table->foreignId('player_id')->constrained('templates');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->foreignId('match_id')->constrained('matches');
            $table->foreignId('team_id')->constrained('teams');
            $table->foreignId('player_id')->constrained('templates');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('matches_has_referees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')
                ->nullable()
                ->constrained('matches')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('referee_id')
                ->nullable()
                ->constrained('referees')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('tournaments_has_teams', function (Blueprint $table){
            $table->id();
            $table->foreignId('tournament_id')
                ->nullable()
                ->constrained('tournaments')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('team_id')
                ->nullable()
                ->constrained('teams')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournaments_has_teams');
        Schema::dropIfExists('matches_has_referees');
        Schema::dropIfExists('goals');
        Schema::dropIfExists('cards');
        Schema::dropIfExists('matches');
        Schema::dropIfExists('templates');
        Schema::dropIfExists('teams');



        Schema::dropIfExists('referees');
        Schema::dropIfExists('stadiums');
        Schema::dropIfExists('tournaments');

    }
};
