<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
use App\Models\Result;
use App\Models\Student;
use Validator;
use Illuminate\Support\Facades\Input;

class ResultController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	return view('result.index');
    }

    public function create()
    {
    	$termList = Term::pluck('name', 'id');
    	return view('result.create', compact('termList'));
    }

    public function store(Request $request)
    {
    	//return $request->all();
    	$input = Input::all();
	    $rules = [
	    	'student_id' => 'numeric|required',
	    	'term_id' => 'required',
	    	'ban_1st_wrt' =>  'numeric|min:0|max:70|nullable',
	    	'ban_1st_mcq' =>  'numeric|min:0|max:30|nullable',
	    	'ban_2nd_wrt' =>  'numeric|min:0|max:70|nullable',
	    	'ban_2nd_mcq' =>  'numeric|min:0|max:30|nullable',
	    	'eng_1st' =>  'numeric|min:0|max:100|nullable',
	    	'eng_2nd' =>  'numeric|min:0|max:100|nullable',
	    	'math_wrt' =>  'numeric|min:0|max:70|nullable',
	    	'math_mcq' =>  'numeric|min:0|max:30|nullable',
	    	'rel_wrt' =>  'numeric|min:0|max:70|nullable',
	    	'rel_mcq' =>  'numeric|min:0|max:30|nullable',
	    	'bwi_wrt' =>  'numeric|min:0|max:70|nullable',
	    	'bwi_mcq' =>  'numeric|min:0|max:30|nullable',
	    	'phy_wrt' =>  'numeric|min:0|max:50|nullable',
	    	'phy_mcq' =>  'numeric|min:0|max:25|nullable',
	    	'phy_prac' =>  'numeric|min:0|max:25|nullable',
	    	'che_wrt' =>  'numeric|min:0|max:50|nullable',
	    	'che_mcq' =>  'numeric|min:0|max:25|nullable',
	    	'che_prac' =>  'numeric|min:0|max:25|nullable',
	    	'bio_wrt' =>  'numeric|min:0|max:50|nullable',
	    	'bio_mcq' =>  'numeric|min:0|max:25|nullable',
	    	'bio_prac' =>  'numeric|min:0|max:25|nullable',
	    	'gs_wrt' =>  'numeric|min:0|max:70|nullable',
	    	'gs_mcq' =>  'numeric|min:0|max:30|nullable',
	    	'his_wrt' =>  'numeric|min:0|max:70|nullable',
	    	'his_mcq' =>  'numeric|min:0|max:30|nullable',
	    	'civ_wrt' =>  'numeric|min:0|max:70|nullable',
	    	'civ_mcq' =>  'numeric|min:0|max:30|nullable',
	    	'geo_wrt' =>  'numeric|min:0|max:70|nullable',
	    	'geo_mcq' =>  'numeric|min:0|max:30|nullable',
	    	'acc_wrt' =>  'numeric|min:0|max:70|nullable',
	    	'acc_mcq' =>  'numeric|min:0|max:30|nullable',
	    	'fin_wrt' =>  'numeric|min:0|max:70|nullable',
	    	'fin_mcq' =>  'numeric|min:0|max:30|nullable',
	    	'bus_wrt' =>  'numeric|min:0|max:70|nullable',
	    	'bus_mcq' =>  'numeric|min:0|max:30|nullable',
	    	'optional_total' =>  'numeric|min:0|max:100|nullable',
	    	'optional_gp' =>  'numeric|min:0|max:5|nullable',
	    ];

	    $messages = [
            'term_id.required' => 'The select term field is required.',
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $student = Student::find($request->student_id);
        if(!count($student)){
            flash()->error('There is no Student in this ID');
            return redirect()->back()
            			->withInput();
        }

        if ($student->section_id == 1) {
        	if (($request->gs_wrt != null) || ($request->gs_mcq != null) || ($request->his_wrt != null) || ($request->his_mcq != null) || ($request->civ_wrt != null) || ($request->civ_mcq != null) || ($request->geo_wrt != null) || ($request->geo_mcq != null) || ($request->acc_wrt != null) || ($request->acc_mcq != null) || ($request->fin_wrt != null) || ($request->fin_mcq != null) || ($request->bus_wrt != null) || ($request->bus_mcq != null)) {
				flash()->error('You have entered Humanities or Business Studies Group subject, Please enter correctly');
            	return redirect()->back()
            				->withInput();
			}
        }

        if ($student->section_id == 2) {
        	if (($request->bwi_wrt != null) || ($request->bwi_mcq != null) || ($request->phy_wrt != null) || ($request->phy_mcq != null) || ($request->phy_prac != null) || ($request->che_wrt != null) || ($request->che_mcq != null) || ($request->che_prac != null) || ($request->bio_wrt != null) || ($request->bio_mcq != null) || ($request->bio_prac != null) || ($request->acc_wrt != null) || ($request->acc_mcq != null) || ($request->fin_wrt != null) || ($request->fin_mcq != null) || ($request->bus_wrt != null) || ($request->bus_mcq != null)) {
				flash()->error('You have entered Science or Business Studies Group subject, Please enter correctly');
            	return redirect()->back()
            				->withInput();
			}
        }

        if ($student->section_id == 3) {
        	if (($request->bwi_wrt != null) || ($request->bwi_mcq != null) || ($request->phy_wrt != null) || ($request->phy_mcq != null) || ($request->phy_prac != null) || ($request->che_wrt != null) || ($request->che_mcq != null) || ($request->che_prac != null) || ($request->bio_wrt != null) || ($request->bio_mcq != null) || ($request->bio_prac != null) || ($request->his_wrt != null) || ($request->his_mcq != null) || ($request->civ_wrt != null) || ($request->civ_mcq != null) || ($request->geo_wrt != null) || ($request->geo_mcq != null)) {
				flash()->error('You have entered Science or Humanities Group subject, Please enter correctly');
            	return redirect()->back()
            				->withInput();
			}
        }

        $result = new Result;
    	$result->student_id = $request->student_id;
    	$result->level_id = $student->level_id;
    	$result->section_id = $student->section_id;
    	$result->year_id = $student->year_id;
    	$result->term_id = $request->term_id;
    	$result->ban_1st_wrt = $request->ban_1st_wrt;
    	$result->ban_1st_mcq = $request->ban_1st_mcq;
    	$result->ban_2nd_wrt = $request->ban_2nd_wrt;
    	$result->ban_2nd_mcq = $request->ban_2nd_mcq;

    	$banTotal = $request->ban_1st_wrt + $request->ban_1st_mcq + $request->ban_2nd_wrt + $request->ban_2nd_mcq;
    	$banAvg = $banTotal / 2;

    	$result->ban_total = $banTotal;
    	$result->ban_avg = $banAvg;
    	
    	if ($banAvg < 33) {
    		$banGP = 0;
    		$banGrade = 'F';
    	} else if ( (($request->ban_1st_wrt < 23) && ($request->ban_2nd_wrt < 23)) || (($request->ban_1st_mcq < 10) && ($request->ban_2nd_mcq < 10)) ) {
    		$banGP = 0;
    		$banGrade = 'F';
    	} else if ( (($request->ban_1st_wrt + $request->ban_2nd_wrt) < 46) || (($request->ban_1st_mcq + $request->ban_2nd_mcq) < 20) ) {
    		$banGP = 0;
    		$banGrade = 'F';
    	} else if (($banAvg >= 80) && ($banAvg <= 100)) {
    		$banGP = 5;
    		$banGrade = 'A+';
    	} else if (($banAvg >= 70) && ($banAvg <= 79)) {
    		$banGP = 4;
    		$banGrade = 'A';
    	} else if (($banAvg >= 60) && ($banAvg <= 69)) {
    		$banGP = 3.5;
    		$banGrade = 'A-';
    	} else if (($banAvg >= 50) && ($banAvg <= 59)) {
    		$banGP = 3;
    		$banGrade = 'B';
    	} else if (($banAvg >= 40) && ($banAvg <= 49)) {
    		$banGP = 2;
    		$banGrade = 'C';
    	} else if (($banAvg >= 33) && ($banAvg <= 39)) {
    		$banGP = 1;
    		$banGrade = 'D';
    	} else {
    		$banGP = 0;
    		$banGrade = 'F';
    	}
    	$result->ban_gp = $banGP;
    	$result->ban_grade = $banGrade;

    	$result->eng_1st = $request->eng_1st;
    	$result->eng_2nd = $request->eng_2nd;
    	$engTotal = $request->eng_1st + $request->eng_2nd;
    	$engAvg = $engTotal / 2;
    	$result->eng_total = $engTotal;
    	$result->eng_avg = $engAvg;
    	if ($engAvg < 33) {
    		$engGP = 0;
    		$engGrade = 'f1';
    	} else if (($engAvg >= 80) && ($engAvg <= 100)) {
    		$engGP = 5;
    		$engGrade = 'A+';
    	} else if (($engAvg >= 70) && ($engAvg <= 79)) {
    		$engGP = 4;
    		$engGrade = 'A';
    	} else if (($engAvg >= 60) && ($engAvg <= 69)) {
    		$engGP = 3.5;
    		$engGrade = 'A-';
    	} else if (($engAvg >= 50) && ($engAvg <= 59)) {
    		$engGP = 3;
    		$engGrade = 'B';
    	} else if (($engAvg >= 40) && ($engAvg <= 49)) {
    		$engGP = 2;
    		$engGrade = 'C';
    	} else if (($engAvg >= 33) && ($engAvg <= 39)) {
    		$engGP = 1;
    		$engGrade = 'D';
    	} else {
    		$engGP = 0;
    		$engGrade = 'F';
    	}
    	$result->eng_gp = $engGP;
    	$result->eng_grade = $engGrade;

    	$result->math_wrt = $request->math_wrt;
    	$result->math_mcq = $request->math_mcq;
    	$mathTotal = $request->math_wrt + $request->math_mcq;
    	$result->math_total = $mathTotal;
    	if ($mathTotal < 33) {
    		$mathGP = 0;
    		$mathGrade = 'F';
    	} else if ( ($request->math_wrt == null) || ($request->math_mcq == null) || ($request->math_wrt < 23) || ($request->math_mcq < 10) ) {
    		$mathGP = 0;
    		$mathGrade = 'F';
    	} else if (($mathTotal >= 80) && ($mathTotal <= 100)) {
    		$mathGP = 5;
    		$mathGrade = 'A+';
    	} else if (($mathTotal >= 70) && ($mathTotal <= 79)) {
    		$mathGP = 4;
    		$mathGrade = 'A';
    	} else if (($mathTotal >= 60) && ($mathTotal <= 69)) {
    		$mathGP = 3.5;
    		$mathGrade = 'A-';
    	} else if (($mathTotal >= 50) && ($mathTotal <= 59)) {
    		$mathGP = 3;
    		$mathGrade = 'B';
    	} else if (($mathTotal >= 40) && ($mathTotal <= 49)) {
    		$mathGP = 2;
    		$mathGrade = 'C';
    	} else if (($mathTotal >= 33) && ($mathTotal <= 39)) {
    		$mathGP = 1;
    		$mathGrade = 'D';
    	} else {
    		$mathGP = 0;
    		$mathGrade = 'F';
    	}
    	$result->math_gp = $mathGP;
    	$result->math_grade = $mathGrade;

    	$result->rel_wrt = $request->rel_wrt;
    	$result->rel_mcq = $request->rel_mcq;
    	$relTotal = $request->rel_wrt + $request->rel_mcq;
    	$result->rel_total = $relTotal;
    	if ($relTotal < 33) {
    		$relGP = 0;
    		$relGrade = 'F';
    	} else if ( ($request->rel_wrt == null) || ($request->rel_mcq == null) || ($request->rel_wrt < 23) || ($request->rel_mcq < 10) ) {
    		$relGP = 0;
    		$relGrade = 'F';
    	} else if (($relTotal >= 80) && ($relTotal <= 100)) {
    		$relGP = 5;
    		$relGrade = 'A+';
    	} else if (($relTotal >= 70) && ($relTotal <= 79)) {
    		$relGP = 4;
    		$relGrade = 'A';
    	} else if (($relTotal >= 60) && ($relTotal <= 69)) {
    		$relGP = 3.5;
    		$relGrade = 'A-';
    	} else if (($relTotal >= 50) && ($relTotal <= 59)) {
    		$relGP = 3;
    		$relGrade = 'B';
    	} else if (($relTotal >= 40) && ($relTotal <= 49)) {
    		$relGP = 2;
    		$relGrade = 'C';
    	} else if (($relTotal >= 33) && ($relTotal <= 39)) {
    		$relGP = 1;
    		$relGrade = 'D';
    	} else {
    		$relGP = 0;
    		$relGrade = 'F';
    	}
    	$result->rel_gp = $relGP;
    	$result->rel_grade = $relGrade;

    	if ($student->section_id == 1) {
	    	$result->bwi_wrt = $request->bwi_wrt;
	    	$result->bwi_mcq = $request->bwi_mcq;
	    	$bwiTotal = $request->bwi_wrt + $request->bwi_mcq;
	    	$result->bwi_total = $bwiTotal;
	    	if ($bwiTotal < 33) {
	    		$bwiGP = 0;
	    		$bwiGrade = 'F';
	    	} else if ( ($request->bwi_wrt == null) || ($request->bwi_mcq == null) || ($request->bwi_wrt < 23) || ($request->bwi_mcq < 10) ) {
	    		$bwiGP = 0;
	    		$bwiGrade = 'F';
	    	} else if (($bwiTotal >= 80) && ($bwiTotal <= 100)) {
	    		$bwiGP = 5;
	    		$bwiGrade = 'A+';
	    	} else if (($bwiTotal >= 70) && ($bwiTotal <= 79)) {
	    		$bwiGP = 4;
	    		$bwiGrade = 'A';
	    	} else if (($bwiTotal >= 60) && ($bwiTotal <= 69)) {
	    		$bwiGP = 3.5;
	    		$bwiGrade = 'A-';
	    	} else if (($bwiTotal >= 50) && ($bwiTotal <= 59)) {
	    		$bwiGP = 3;
	    		$bwiGrade = 'B';
	    	} else if (($bwiTotal >= 40) && ($bwiTotal <= 49)) {
	    		$bwiGP = 2;
	    		$bwiGrade = 'C';
	    	} else if (($bwiTotal >= 33) && ($bwiTotal <= 39)) {
	    		$bwiGP = 1;
	    		$bwiGrade = 'D';
	    	} else {
	    		$bwiGP = 0;
	    		$mathGrade = 'F';
	    	}
	    	$result->bwi_gp = $bwiGP;
	    	$result->bwi_grade = $bwiGrade;

	    	$result->phy_wrt = $request->phy_wrt;
	    	$result->phy_mcq = $request->phy_mcq;
	    	$result->phy_prac = $request->phy_prac;
	    	$phyTotal = $request->phy_wrt + $request->phy_mcq + $request->phy_prac;
	    	$result->phy_total = $phyTotal;
	    	if ($phyTotal < 33) {
	    		$phyGP = 0;
	    		$phyGrade = 'F';
	    	} else if ( ($request->phy_wrt == null) || ($request->phy_mcq == null) || ($request->phy_prac == null) || ($request->phy_wrt < 17) || ($request->phy_mcq < 8) || ($request->phy_prac < 8) ) {
	    		$phyGP = 0;
	    		$phyGrade = 'F';
	    	} else if (($phyTotal >= 80) && ($phyTotal <= 100)) {
	    		$phyGP = 5;
	    		$phyGrade = 'A+';
	    	} else if (($phyTotal >= 70) && ($phyTotal <= 79)) {
	    		$phyGP = 4;
	    		$phyGrade = 'A';
	    	} else if (($phyTotal >= 60) && ($phyTotal <= 69)) {
	    		$phyGP = 3.5;
	    		$phyGrade = 'A-';
	    	} else if (($phyTotal >= 50) && ($phyTotal <= 59)) {
	    		$phyGP = 3;
	    		$phyGrade = 'B';
	    	} else if (($phyTotal >= 40) && ($phyTotal <= 49)) {
	    		$phyGP = 2;
	    		$phyGrade = 'C';
	    	} else if (($phyTotal >= 33) && ($phyTotal <= 39)) {
	    		$phyGP = 1;
	    		$phyGrade = 'D';
	    	} else {
	    		$phyGP = 0;
	    		$phyGrade = 'F';
	    	}
	    	$result->phy_gp = $phyGP;
	    	$result->phy_grade = $phyGrade;

	    	$result->che_wrt = $request->che_wrt;
	    	$result->che_mcq = $request->che_mcq;
	    	$result->che_prac = $request->che_prac;
	    	$cheTotal = $request->che_wrt + $request->che_mcq + $request->che_prac;
	    	$result->che_total = $cheTotal;
	    	if ($cheTotal < 33) {
	    		$cheGP = 0;
	    		$cheGrade = 'F';
	    	} else if ( ($request->che_wrt == null) || ($request->che_mcq == null) || ($request->che_prac == null) || ($request->che_wrt < 17) || ($request->che_mcq < 8) || ($request->che_prac < 8) ) {
	    		$cheGP = 0;
	    		$cheGrade = 'F';
	    	} else if (($cheTotal >= 80) && ($cheTotal <= 100)) {
	    		$cheGP = 5;
	    		$cheGrade = 'A+';
	    	} else if (($cheTotal >= 70) && ($cheTotal <= 79)) {
	    		$cheGP = 4;
	    		$cheGrade = 'A';
	    	} else if (($cheTotal >= 60) && ($cheTotal <= 69)) {
	    		$cheGP = 3.5;
	    		$cheGrade = 'A-';
	    	} else if (($cheTotal >= 50) && ($cheTotal <= 59)) {
	    		$cheGP = 3;
	    		$cheGrade = 'B';
	    	} else if (($cheTotal >= 40) && ($cheTotal <= 49)) {
	    		$cheGP = 2;
	    		$cheGrade = 'C';
	    	} else if (($cheTotal >= 33) && ($cheTotal <= 39)) {
	    		$cheGP = 1;
	    		$cheGrade = 'D';
	    	} else {
	    		$cheGP = 0;
	    		$cheGrade = 'F';
	    	}
	    	$result->che_gp = $cheGP;
	    	$result->che_grade = $cheGrade;

	    	$result->bio_wrt = $request->bio_wrt;
	    	$result->bio_mcq = $request->bio_mcq;
	    	$result->bio_prac = $request->bio_prac;
	    	$bioTotal = $request->bio_wrt + $request->bio_mcq + $request->bio_prac;
	    	$result->bio_total = $bioTotal;
	    	if ($bioTotal < 33) {
	    		$bioGP = 0;
	    		$bioGrade = 'F';
	    	} else if ( ($request->bio_wrt == null) || ($request->bio_mcq == null) || ($request->bio_prac == null) || ($request->bio_wrt < 17) || ($request->bio_mcq < 8) || ($request->bio_prac < 8) ) {
	    		$bioGP = 0;
	    		$bioGrade = 'F';
	    	} else if (($bioTotal >= 80) && ($bioTotal <= 100)) {
	    		$bioGP = 5;
	    		$bioGrade = 'A+';
	    	} else if (($bioTotal >= 70) && ($bioTotal <= 79)) {
	    		$bioGP = 4;
	    		$bioGrade = 'A';
	    	} else if (($bioTotal >= 60) && ($bioTotal <= 69)) {
	    		$bioGP = 3.5;
	    		$bioGrade = 'A-';
	    	} else if (($bioTotal >= 50) && ($bioTotal <= 59)) {
	    		$bioGP = 3;
	    		$bioGrade = 'B';
	    	} else if (($bioTotal >= 40) && ($bioTotal <= 49)) {
	    		$bioGP = 2;
	    		$bioGrade = 'C';
	    	} else if (($bioTotal >= 33) && ($bioTotal <= 39)) {
	    		$bioGP = 1;
	    		$bioGrade = 'D';
	    	} else {
	    		$bioGP = 0;
	    		$bioGrade = 'F';
	    	}
	    	$result->bio_gp = $bioGP;
	    	$result->bio_grade = $bioGrade;
    	}

    	if (($student->section_id == 2) || ($student->section_id == 3)) {
	    	$result->gs_wrt = $request->gs_wrt;
	    	$result->gs_mcq = $request->gs_mcq;
	    	$gsTotal = $request->gs_wrt + $request->gs_mcq;
	    	$result->gs_total = $gsTotal;
	    	if ($gsTotal < 33) {
	    		$gsGP = 0;
	    		$gsGrade = 'F';
	    	} else if ( ($request->gs_wrt == null) || ($request->gs_mcq == null) || ($request->gs_wrt < 23) || ($request->gs_mcq < 10) ) {
	    		$gsGP = 0;
	    		$gsGrade = 'F';
	    	} else if (($gsTotal >= 80) && ($gsTotal <= 100)) {
	    		$gsGP = 5;
	    		$gsGrade = 'A+';
	    	} else if (($gsTotal >= 70) && ($gsTotal <= 79)) {
	    		$gsGP = 4;
	    		$gsGrade = 'A';
	    	} else if (($gsTotal >= 60) && ($gsTotal <= 69)) {
	    		$gsGP = 3.5;
	    		$gsGrade = 'A-';
	    	} else if (($gsTotal >= 50) && ($gsTotal <= 59)) {
	    		$gsGP = 3;
	    		$gsGrade = 'B';
	    	} else if (($gsTotal >= 40) && ($gsTotal <= 49)) {
	    		$gsGP = 2;
	    		$gsGrade = 'C';
	    	} else if (($gsTotal >= 33) && ($gsTotal <= 39)) {
	    		$gsGP = 1;
	    		$gsGrade = 'D';
	    	} else {
	    		$gsGP = 0;
	    		$gsGrade = 'F';
	    	}
	    	$result->gs_gp = $gsGP;
	    	$result->gs_grade = $gsGrade;
    	}

    	if ($student->section_id == 2) {
	    	$result->his_wrt = $request->his_wrt;
	    	$result->his_mcq = $request->his_mcq;
	    	$hisTotal = $request->his_wrt + $request->his_mcq;
	    	$result->his_total = $hisTotal;
	    	if ($hisTotal < 33) {
	    		$hisGP = 0;
	    		$hisGrade = 'F';
	    	} else if ( ($request->his_wrt == null) || ($request->his_mcq == null) || ($request->his_wrt < 23) || ($request->his_mcq < 10) ) {
	    		$hisGP = 0;
	    		$hisGrade = 'F';
	    	} else if (($hisTotal >= 80) && ($hisTotal <= 100)) {
	    		$hisGP = 5;
	    		$hisGrade = 'A+';
	    	} else if (($hisTotal >= 70) && ($hisTotal <= 79)) {
	    		$hisGP = 4;
	    		$hisGrade = 'A';
	    	} else if (($hisTotal >= 60) && ($hisTotal <= 69)) {
	    		$hisGP = 3.5;
	    		$hisGrade = 'A-';
	    	} else if (($hisTotal >= 50) && ($hisTotal <= 59)) {
	    		$hisGP = 3;
	    		$hisGrade = 'B';
	    	} else if (($hisTotal >= 40) && ($hisTotal <= 49)) {
	    		$hisGP = 2;
	    		$hisGrade = 'C';
	    	} else if (($hisTotal >= 33) && ($hisTotal <= 39)) {
	    		$hisGP = 1;
	    		$hisGrade = 'D';
	    	} else {
	    		$hisGP = 0;
	    		$hisGrade = 'F';
	    	}
	    	$result->his_gp = $hisGP;
	    	$result->his_grade = $hisGrade;

	    	$result->civ_wrt = $request->civ_wrt;
	    	$result->civ_mcq = $request->civ_mcq;
	    	$civTotal = $request->civ_wrt + $request->civ_mcq;
	    	$result->civ_total = $civTotal;
	    	if ($civTotal < 33) {
	    		$civGP = 0;
	    		$civGrade = 'F';
	    	} else if ( ($request->civ_wrt == null) || ($request->civ_mcq == null) || ($request->civ_wrt < 23) || ($request->civ_mcq < 10) ) {
	    		$civGP = 0;
	    		$civGrade = 'F';
	    	} else if (($civTotal >= 80) && ($civTotal <= 100)) {
	    		$civGP = 5;
	    		$civGrade = 'A+';
	    	} else if (($civTotal >= 70) && ($civTotal <= 79)) {
	    		$civGP = 4;
	    		$civGrade = 'A';
	    	} else if (($civTotal >= 60) && ($civTotal <= 69)) {
	    		$civGP = 3.5;
	    		$civGrade = 'A-';
	    	} else if (($civTotal >= 50) && ($civTotal <= 59)) {
	    		$civGP = 3;
	    		$civGrade = 'B';
	    	} else if (($civTotal >= 40) && ($civTotal <= 49)) {
	    		$civGP = 2;
	    		$civGrade = 'C';
	    	} else if (($civTotal >= 33) && ($civTotal <= 39)) {
	    		$civGP = 1;
	    		$civGrade = 'D';
	    	} else {
	    		$civGP = 0;
	    		$civGrade = 'F';
	    	}
	    	$result->civ_gp = $civGP;
	    	$result->civ_grade = $civGrade;

	    	$result->geo_wrt = $request->geo_wrt;
	    	$result->geo_mcq = $request->geo_mcq;
	    	$geoTotal = $request->geo_wrt + $request->geo_mcq;
	    	$result->geo_total = $geoTotal;
	    	if ($geoTotal < 33) {
	    		$geoGP = 0;
	    		$geoGrade = 'F';
	    	} else if ( ($request->geo_wrt == null) || ($request->geo_mcq == null) || ($request->geo_wrt < 23) || ($request->geo_mcq < 10) ) {
	    		$geoGP = 0;
	    		$geoGrade = 'F';
	    	} else if (($geoTotal >= 80) && ($geoTotal <= 100)) {
	    		$geoGP = 5;
	    		$geoGrade = 'A+';
	    	} else if (($geoTotal >= 70) && ($geoTotal <= 79)) {
	    		$geoGP = 4;
	    		$geoGrade = 'A';
	    	} else if (($geoTotal >= 60) && ($geoTotal <= 69)) {
	    		$geoGP = 3.5;
	    		$geoGrade = 'A-';
	    	} else if (($geoTotal >= 50) && ($geoTotal <= 59)) {
	    		$geoGP = 3;
	    		$geoGrade = 'B';
	    	} else if (($geoTotal >= 40) && ($geoTotal <= 49)) {
	    		$geoGP = 2;
	    		$geoGrade = 'C';
	    	} else if (($geoTotal >= 33) && ($geoTotal <= 39)) {
	    		$geoGP = 1;
	    		$geoGrade = 'D';
	    	} else {
	    		$geoGP = 0;
	    		$geoGrade = 'F';
	    	}
	    	$result->geo_gp = $geoGP;
	    	$result->geo_grade = $geoGrade;
		}

		if ($student->section_id == 3) {
	    	$result->acc_wrt = $request->acc_wrt;
	    	$result->acc_mcq = $request->acc_mcq;
	    	$accTotal = $request->acc_wrt + $request->acc_mcq;
	    	$result->acc_total = $accTotal;
	    	if ($accTotal < 33) {
	    		$accGP = 0;
	    		$accGrade = 'F';
	    	} else if ( ($request->acc_wrt == null) || ($request->acc_mcq == null) || ($request->acc_wrt < 23) || ($request->acc_mcq < 10) ) {
	    		$accGP = 0;
	    		$accGrade = 'F';
	    	} else if (($accTotal >= 80) && ($accTotal <= 100)) {
	    		$accGP = 5;
	    		$accGrade = 'A+';
	    	} else if (($accTotal >= 70) && ($accTotal <= 79)) {
	    		$accGP = 4;
	    		$accGrade = 'A';
	    	} else if (($accTotal >= 60) && ($accTotal <= 69)) {
	    		$accGP = 3.5;
	    		$accGrade = 'A-';
	    	} else if (($accTotal >= 50) && ($accTotal <= 59)) {
	    		$accGP = 3;
	    		$accGrade = 'B';
	    	} else if (($accTotal >= 40) && ($accTotal <= 49)) {
	    		$accGP = 2;
	    		$accGrade = 'C';
	    	} else if (($accTotal >= 33) && ($accTotal <= 39)) {
	    		$accGP = 1;
	    		$accGrade = 'D';
	    	} else {
	    		$accGP = 0;
	    		$accGrade = 'F';
	    	}
	    	$result->acc_gp = $accGP;
	    	$result->acc_grade = $accGrade;

	    	$result->fin_wrt = $request->fin_wrt;
	    	$result->fin_mcq = $request->fin_mcq;
	    	$finTotal = $request->fin_wrt + $request->fin_mcq;
	    	$result->fin_total = $finTotal;
	    	if ($finTotal < 33) {
	    		$finGP = 0;
	    		$finGrade = 'F';
	    	} else if ( ($request->fin_wrt == null) || ($request->fin_mcq == null) || ($request->fin_wrt < 23) || ($request->fin_mcq < 10) ) {
	    		$finGP = 0;
	    		$finGrade = 'F';
	    	} else if (($finTotal >= 80) && ($finTotal <= 100)) {
	    		$finGP = 5;
	    		$finGrade = 'A+';
	    	} else if (($finTotal >= 70) && ($finTotal <= 79)) {
	    		$finGP = 4;
	    		$finGrade = 'A';
	    	} else if (($finTotal >= 60) && ($finTotal <= 69)) {
	    		$finGP = 3.5;
	    		$finGrade = 'A-';
	    	} else if (($finTotal >= 50) && ($finTotal <= 59)) {
	    		$finGP = 3;
	    		$finGrade = 'B';
	    	} else if (($finTotal >= 40) && ($finTotal <= 49)) {
	    		$finGP = 2;
	    		$finGrade = 'C';
	    	} else if (($finTotal >= 33) && ($finTotal <= 39)) {
	    		$finGP = 1;
	    		$finGrade = 'D';
	    	} else {
	    		$finGP = 0;
	    		$finGrade = 'F';
	    	}
	    	$result->fin_gp = $finGP;
	    	$result->fin_grade = $finGrade;

	    	$result->bus_wrt = $request->bus_wrt;
	    	$result->bus_mcq = $request->bus_mcq;
	    	$busTotal = $request->bus_wrt + $request->bus_mcq;
	    	$result->bus_total = $busTotal;
	    	if ($busTotal < 33) {
	    		$busGP = 0;
	    		$busGrade = 'F';
	    	} else if ( ($request->bus_wrt == null) || ($request->bus_mcq == null) || ($request->bus_wrt < 23) || ($request->bus_mcq < 10) ) {
	    		$busGP = 0;
	    		$busGrade = 'F';
	    	} else if (($busTotal >= 80) && ($busTotal <= 100)) {
	    		$busGP = 5;
	    		$busGrade = 'A+';
	    	} else if (($busTotal >= 70) && ($busTotal <= 79)) {
	    		$busGP = 4;
	    		$busGrade = 'A';
	    	} else if (($busTotal >= 60) && ($busTotal <= 69)) {
	    		$busGP = 3.5;
	    		$busGrade = 'A-';
	    	} else if (($busTotal >= 50) && ($busTotal <= 59)) {
	    		$busGP = 3;
	    		$busGrade = 'B';
	    	} else if (($busTotal >= 40) && ($busTotal <= 49)) {
	    		$busGP = 2;
	    		$busGrade = 'C';
	    	} else if (($busTotal >= 33) && ($busTotal <= 39)) {
	    		$busGP = 1;
	    		$busGrade = 'D';
	    	} else {
	    		$busGP = 0;
	    		$busGrade = 'F';
	    	}
	    	$result->bus_gp = $busGP;
	    	$result->bus_grade = $busGrade;
    	}

//-------------------Optional Grade Count------------------//
    	$result->optional_total = $request->optional_total;
    	$result->optional_note = $request->optional_note;
    	$result->optional_gp = $request->optional_gp;
    	$optionalGP = $request->optional_gp;

    	if ($optionalGP == 5) {
    		$result->optional_grade = 'A+';
    	} else if (($optionalGP < 5) && ($optionalGP >= 4)) {
    		$result->optional_grade = 'A';
    	} else if (($optionalGP < 4) && ($optionalGP >= 3.50)) {
    		$result->optional_grade = 'A-';
    	} else if (($optionalGP < 3.50) && ($optionalGP >= 3)) {
    		$result->optional_grade = 'B';
    	} else if (($optionalGP < 3) && ($optionalGP >= 2)) {
    		$result->optional_grade = 'C';
    	} else if (($optionalGP < 2) && ($optionalGP >= 1)) {
    		$result->optional_grade = 'D';
    	} else {
    		$result->optional_grade = 'F';
    	}

    	$optGPremain = $optionalGP - 2;
    	if ($optGPremain > 0) {
    		$addableGP = $optGPremain;
    	} else {
    		$addableGP = 0;
    	}

    	if ($student->section_id == 1) {
    		$gpTotalExOpt = $banGP + $engGP + $mathGP + $relGP + $bwiGP + $phyGP + $cheGP + $bioGP;
    		$gpTotalWiOpt = $gpTotalExOpt + $addableGP;
    		$marksTotalExOpt = $banTotal + $engTotal + $mathTotal + $relTotal + $bwiTotal + $phyTotal + $cheTotal + $bioTotal;
    		$marksTotalWiOpt = $marksTotalExOpt + $request->optional_total;
    		$result->gp_total_except_optional = $gpTotalExOpt; 
    		$result->gp_total_with_optional = $gpTotalWiOpt; 
    		$result->marks_total_except_optional = $marksTotalExOpt; 
    		$result->marks_total_with_optional = $marksTotalWiOpt; 
    		$result->gpa_except_optional = $gpTotalExOpt / 8;   //may be no need
    		$result->gpa_with_optional = $gpTotalWiOpt / 8; 
    	}

    	if ($student->section_id == 2) {
    		$gpTotalExOpt = $banGP + $engGP + $mathGP + $relGP + $gsGP + $hisGP + $civGP + $geoGP;
    		$gpTotalWiOpt = $gpTotalExOpt + $addableGP;
    		$marksTotalExOpt = $banTotal + $engTotal + $mathTotal + $relTotal + $gsTotal + $hisTotal + $civTotal + $geoTotal;
    		$marksTotalWiOpt = $marksTotalExOpt + $request->optional_total;
    		$result->gp_total_except_optional = $gpTotalExOpt; 
    		$result->gp_total_with_optional = $gpTotalWiOpt;
    		$result->marks_total_except_optional = $marksTotalExOpt; 
    		$result->marks_total_with_optional = $marksTotalWiOpt;
    		$result->gpa_except_optional = $gpTotalExOpt / 8; 
    		$result->gpa_with_optional = $gpTotalWiOpt / 8;  //may be no need
    	}

    	if ($student->section_id == 3) {
    		$gpTotalExOpt = $banGP + $engGP + $mathGP + $relGP + $gsGP + $accGP + $finGP + $busGP;
    		$gpTotalWiOpt = $gpTotalExOpt + $addableGP;
    		$marksTotalExOpt = $banTotal + $engTotal + $mathTotal + $relTotal + $gsTotal + $accTotal + $finTotal + $busTotal;
    		$marksTotalWiOpt = $marksTotalExOpt + $request->optional_total;
    		$result->gp_total_except_optional = $gpTotalExOpt; 
    		$result->gp_total_with_optional = $gpTotalWiOpt; 
    		$result->marks_total_except_optional = $marksTotalExOpt; 
    		$result->marks_total_with_optional = $marksTotalWiOpt;
    		$result->gpa_except_optional = $gpTotalExOpt / 8; 
    		$result->gpa_with_optional = $gpTotalWiOpt / 8;
    	}

//---------------------GPA & Grade------------------//
    	$gpa = $gpTotalWiOpt / 8;

    	$result->gpa = $gpa;

    	if ($gpa >= 5) {
    		$result->grade = 'A+';
    		if ($gpTotalExOpt == 40) {
				$result->status = 'Golden A+';
    		}
    	} else if (($gpa < 5) && ($gpa >= 4)) {
    		$result->grade = 'A';
    	} else if (($gpa < 4) && ($gpa >= 3.50)) {
    		$result->grade = 'A-';
    	} else if (($gpa < 3.50) && ($gpa >= 3)) {
    		$result->grade = 'B';
    	} else if (($gpa < 3) && ($gpa >= 2)) {
    		$result->grade = 'C';
    	} else if (($gpa < 2) && ($gpa >= 1)) {
    		$result->grade = 'D';
    	} else {
    		$result->grade = 'F';
    	}

//----------------




//-----------------Count Fail Subjects---------------//
    	if ($student->section_id == 1) {
    		$failSubjects = 0;
    		if ($banGP == 0) {
    			$failSubjects++;
    		}
    		if ($engGP == 0) {
    			$failSubjects++;
    		}
    		if ($mathGP == 0) {
    			$failSubjects++;
    		}
    		if ($relGP == 0) {
    			$failSubjects++;
    		}
    		if ($bwiGP == 0) {
    			$failSubjects++;
    		}
    		if ($phyGP == 0) {
    			$failSubjects++;
    		}
    		if ($cheGP == 0) {
    			$failSubjects++;
    		}
    		if ($bioGP == 0) {
    			$failSubjects++;
    		}
    		$result->fail_subjects = $failSubjects;
    	}

    	if ($student->section_id == 2) {
    		$failSubjects = 0;
    		if ($banGP == 0) {
    			$failSubjects++;
    		}
    		if ($engGP == 0) {
    			$failSubjects++;
    		}
    		if ($mathGP == 0) {
    			$failSubjects++;
    		}
    		if ($relGP == 0) {
    			$failSubjects++;
    		}
    		if ($gsGP == 0) {
    			$failSubjects++;
    		}
    		if ($hisGP == 0) {
    			$failSubjects++;
    		}
    		if ($civGP == 0) {
    			$failSubjects++;
    		}
    		if ($geoGP == 0) {
    			$failSubjects++;
    		}
    		$result->fail_subjects = $failSubjects;
    	}
    	if ($student->section_id == 3) {
    		$failSubjects = 0;
    		if ($banGP == 0) {
    			$failSubjects++;
    		}
    		if ($engGP == 0) {
    			$failSubjects++;
    		}
    		if ($mathGP == 0) {
    			$failSubjects++;
    		}
    		if ($relGP == 0) {
    			$failSubjects++;
    		}
    		if ($gsGP == 0) {
    			$failSubjects++;
    		}
    		if ($accGP == 0) {
    			$failSubjects++;
    		}
    		if ($finGP == 0) {
    			$failSubjects++;
    		}
    		if ($busGP == 0) {
    			$failSubjects++;
    		}
    		$result->fail_subjects = $failSubjects;
    	}
    	

    	$result->save();

    	flash()->success('Successfully Inserted');
    	return redirect('result/create');
    }

    
    public function updateeeeeee(Request $request)
    {
    	//return $id;
    	$b = Brand::find($request->id);
    	$input = Input::all();
	    $rules = [
	    	'brand_name' => 'required|unique:brands,brand_name,'.$b->id,
	    	'brand_site_url' => 'required|unique:brands,brand_site_url,'.$b->id,
	    ];
	    
    	$validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $brand = Brand::find($request->id);
    	$brand->brand_name = $request->brand_name;
    	$brand->brand_site_url = $request->brand_site_url;
    	$brand->status = "Active";
    	$brand->save();

    	flash()->success('Successfully updated');
    	return redirect('brand');
    }

    public function studentInfoShow(Request $request)
    {
    	//return $request->student_id;
    	$student = Student::with(['level', 'section'])->find($request->student_id);
    	if(!$student) {
            return '<strong style="color: red; margin-left: 15px;">Entered Wrong ID of Student.</strong>';
        }
        return view('result.student_info_show', compact('student'));
    }

    public function show($id)
    {
    	$result = Result::with([
                                   'term',
                                   'student.level',
                                   'student.section',
                                   'student.year'
                               ])
                            ->find($id);
        return view('result.show', compact('result'));
    }
}
