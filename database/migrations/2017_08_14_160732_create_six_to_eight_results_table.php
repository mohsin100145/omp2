<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSixToEightResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('six_to_eight_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->integer('year_id')->unsigned();
            $table->integer('term_id')->unsigned();
            
            $table->float('ban_1st')->nullable();
            $table->float('ban_2nd')->nullable();
            $table->float('ban_total')->nullable();
            $table->float('ban_percentage')->nullable();
            $table->float('ban_gp')->nullable();
            $table->string('ban_grade')->nullable();

            $table->float('eng_1st')->nullable();
            $table->float('eng_2nd')->nullable();
            $table->float('eng_total')->nullable();
            $table->float('eng_percentage')->nullable();
            $table->float('eng_gp')->nullable();
            $table->string('eng_grade')->nullable();

            $table->float('math')->nullable();
            $table->float('math_percentage')->nullable();
            $table->float('math_gp')->nullable();
            $table->string('math_grade')->nullable();

            $table->float('science')->nullable();
            $table->float('science_percentage')->nullable();
            $table->float('science_gp')->nullable();
            $table->string('science_grade')->nullable();

            $table->float('bangladesh')->nullable();
            $table->float('bangladesh_percentage')->nullable();
            $table->float('bangladesh_gp')->nullable();
            $table->string('bangladesh_grade')->nullable();

            $table->float('religion')->nullable();
            $table->float('religion_percentage')->nullable();
            $table->float('religion_gp')->nullable();
            $table->string('religion_grade')->nullable();

            $table->float('ict')->nullable();
            $table->float('ict_percentage')->nullable();
            $table->float('ict_gp')->nullable();
            $table->string('ict_grade')->nullable();

            $table->float('work')->nullable();
            $table->float('work_percentage')->nullable();
            $table->float('work_gp')->nullable();
            $table->string('work_grade')->nullable();

            $table->float('physical')->nullable();
            $table->float('physical_percentage')->nullable();
            $table->float('physical_gp')->nullable();
            $table->string('physical_grade')->nullable();

            $table->float('arts')->nullable();
            $table->float('arts_percentage')->nullable();
            $table->float('arts_gp')->nullable();
            $table->string('arts_grade')->nullable();

            $table->float('optional')->nullable();
            $table->float('optional_percentage')->nullable();
            $table->float('optional_gp')->nullable();
            $table->string('optional_grade')->nullable();

            $table->float('marks_total_except_optional')->nullable();
            $table->float('marks_total')->nullable();
            $table->float('gp_total_except_optional')->nullable();
            $table->float('gp_total')->nullable();
            $table->float('gpa_except_optional')->nullable();
            $table->float('gpa')->nullable();
            $table->string('grade')->nullable();
            $table->string('status')->nullable();
            $table->integer('fail_subjects')->unsigned()->nullable();

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
        Schema::dropIfExists('six_to_eight_results');
    }
}
