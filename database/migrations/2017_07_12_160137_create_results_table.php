<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->integer('year_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->integer('group_id')->unsigned()->nullable();

            $table->float('ban_1st_wrt')->nullable();
            $table->float('ban_1st_mcq')->nullable();
            $table->float('ban_2nd_wrt')->nullable();
            $table->float('ban_2nd_mcq')->nullable();
            $table->float('ban_total')->nullable();
            $table->float('ban_avg')->nullable();
            $table->float('ban_gp')->nullable();
            $table->string('ban_grade')->nullable();
            
            $table->float('eng_1st')->nullable();
            $table->float('eng_2nd')->nullable();
            $table->float('eng_total')->nullable();
            $table->float('eng_gp')->nullable();
            $table->string('eng_grade')->nullable();

            $table->float('math_wrt')->nullable();
            $table->float('math_mcq')->nullable();
            $table->float('math_total')->nullable();
            $table->float('math_gp')->nullable();
            $table->string('math_grade')->nullable();

            $table->float('rel_wrt')->nullable();
            $table->float('rel_mcq')->nullable();
            $table->float('rel_total')->nullable();
            $table->float('rel_gp')->nullable();
            $table->string('rel_grade')->nullable();

            $table->float('bwi_wrt')->nullable();
            $table->float('bwi_mcq')->nullable();
            $table->float('bwi_total')->nullable();
            $table->float('bwi_gp')->nullable();
            $table->string('bwi_grade')->nullable();

            $table->float('phy_wrt')->nullable();
            $table->float('phy_mcq')->nullable();
            $table->float('phy_prac')->nullable();
            $table->float('phy_total')->nullable();
            $table->float('phy_gp')->nullable();
            $table->string('phy_grade')->nullable();

            $table->float('che_wrt')->nullable();
            $table->float('che_mcq')->nullable();
            $table->float('che_prac')->nullable();
            $table->float('che_total')->nullable();
            $table->float('che_gp')->nullable();
            $table->string('che_grade')->nullable();

            $table->float('bio_wrt')->nullable();
            $table->float('bio_mcq')->nullable();
            $table->float('bio_prac')->nullable();
            $table->float('bio_total')->nullable();
            $table->float('bio_gp')->nullable();
            $table->string('bio_grade')->nullable();

            $table->float('gs_wrt')->nullable();
            $table->float('gs_mcq')->nullable();
            $table->float('gs_total')->nullable();
            $table->float('gs_gp')->nullable();
            $table->string('gs_grade')->nullable();

            $table->float('his_wrt')->nullable();
            $table->float('his_mcq')->nullable();
            $table->float('his_total')->nullable();
            $table->float('his_gp')->nullable();
            $table->string('his_grade')->nullable();

            $table->float('civ_wrt')->nullable();
            $table->float('civ_mcq')->nullable();
            $table->float('civ_total')->nullable();
            $table->float('civ_gp')->nullable();
            $table->string('civ_grade')->nullable();

            $table->float('geo_wrt')->nullable();
            $table->float('geo_mcq')->nullable();
            $table->float('geo_total')->nullable();
            $table->float('geo_gp')->nullable();
            $table->string('geo_grade')->nullable();

            $table->float('acc_wrt')->nullable();
            $table->float('acc_mcq')->nullable();
            $table->float('acc_total')->nullable();
            $table->float('acc_gp')->nullable();
            $table->string('acc_grade')->nullable();

            $table->float('fin_wrt')->nullable();
            $table->float('fin_mcq')->nullable();
            $table->float('fin_total')->nullable();
            $table->float('fin_gp')->nullable();
            $table->string('fin_grade')->nullable();

            $table->float('bus_wrt')->nullable();
            $table->float('bus_mcq')->nullable();
            $table->float('bus_total')->nullable();
            $table->float('bus_gp')->nullable();
            $table->string('bus_grade')->nullable();

            $table->float('ps_wrt')->nullable();
            $table->float('ps_mcq')->nullable();
            $table->float('ps_prac')->nullable();
            $table->float('ps_total')->nullable();
            $table->float('ps_gp')->nullable();
            $table->string('ps_grade')->nullable();

            $table->float('ict_mcq')->nullable();
            $table->float('ict_prac')->nullable();
            $table->float('ict_total')->nullable();
            $table->float('ict_gp')->nullable();
            $table->string('ict_grade')->nullable();

            $table->float('cs_mcq')->nullable();
            $table->float('cs_prac')->nullable();
            $table->float('cs_total')->nullable();
            $table->float('cs_gp')->nullable();
            $table->string('cs_grade')->nullable();

            $table->float('optional_total')->nullable();
            $table->float('optional_gp')->nullable();
            $table->string('optional_grade')->nullable();
            $table->string('optional_note')->nullable();

            $table->float('marks_total_except_optional')->nullable();
            $table->float('marks_total_with_optional')->nullable();
            $table->float('gp_total_except_optional')->nullable();
            $table->float('gp_total_with_optional')->nullable();
            $table->float('gpa_except_optional')->nullable();
            $table->float('gpa_with_optional')->nullable();

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
        Schema::dropIfExists('results');
    }
}
