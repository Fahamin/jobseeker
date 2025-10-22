// database/migrations/create_exam_results_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamResultsTable extends Migration
{
    public function up()
    {
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('total_questions');
            $table->integer('correct_answers');
            $table->integer('wrong_answers');
            $table->decimal('score', 5, 2);
            $table->timestamp('exam_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_results');
    }
}