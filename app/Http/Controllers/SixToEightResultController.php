<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
use App\Models\Student;
use App\Models\SixToEightResult;
use Validator;
use Illuminate\Support\Facades\Input;

class SixToEightResultController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	return view('six_to_eight_result.index');
    }

    public function create()
    {
    	$termList = Term::pluck('name', 'id');
    	return view('six_to_eight_result.create', compact('termList'));
    }

    public function studentInfoShow(Request $request)
    {
    	//return $request->student_id;
    	$student = Student::with(['level'])->find($request->student_id);
    	if(!$student) {
            return '<strong style="color: red; margin-left: 15px;">Entered Wrong ID of Student.</strong>';
        }
        if ($student->group_id != null) {
        	return '<strong style="color: red; margin-left: 15px;">This student has Group, this may be class Nine or Ten student.</strong>';
        }
        return view('six_to_eight_result.student_info_show', compact('student'));
    }

    public function store(Request $request)
    {
    	//return $request->all();
    	$input = Input::all();
	    $rules = [
	    	'student_id' => 'numeric|required',
	    	'term_id' => 'required',
	    	'ban_1st' =>  'numeric|min:0|max:100|nullable',
	    	'ban_2nd' =>  'numeric|min:0|max:50|nullable',
	    	'eng_1st' =>  'numeric|min:0|max:100|nullable',
	    	'eng_2nd' =>  'numeric|min:0|max:50|nullable',
	    	'math' =>  'numeric|min:0|max:100|nullable',
	    	'science' =>  'numeric|min:0|max:100|nullable',
	    	'bangladesh' =>  'numeric|min:0|max:100|nullable',
	    	'religion' =>  'numeric|min:0|max:100|nullable',
	    	'ict' =>  'numeric|min:0|max:50|nullable',
	    	'work' =>  'numeric|min:0|max:50|nullable',
	    	'physical' =>  'numeric|min:0|max:50|nullable',
	    	'arts' =>  'numeric|min:0|max:50|nullable',
	    	'optional' =>  'numeric|min:0|max:100|nullable',
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
        if ($student->group_id != null) {
        	flash()->error('This student has Group, this may be class Nine or Ten student.');
            return redirect()->back()
            			->withInput();
        }

        $existResult = SixToEightResult::where('student_id', $request->student_id)
                                    ->where('level_id', $student->level_id)
                                    ->where('section_id', $student->section_id)
                                    ->where('year_id', $student->year_id)
                                    ->where('term_id', $request->term_id)
                                    ->get();
        if( count($existResult) ) {
            flash()->error("This Student's Result already created in this Term.");
            return redirect()->back()
            			->withInput();
        }

     //    $banTotal = $request->ban_1st + $request->ban_2nd;
    	// echo $banPercentage = (51.745333333333).'<br>';
    	// echo $banPercentage = round($banPercentage, 2, PHP_ROUND_HALF_UP).'<br>';
    	// exit();
        $result = new SixToEightResult;
    	$result->student_id = $request->student_id;
    	$result->level_id = $student->level_id;
    	$result->section_id = $student->section_id;
    	$result->year_id = $student->year_id;
    	$result->term_id = $request->term_id;
    	$result->ban_1st = $request->ban_1st;
    	$result->ban_2nd = $request->ban_2nd;
    	
    	$banTotal = $request->ban_1st + $request->ban_2nd;
    	$result->ban_total = $banTotal;

    	$banPer = ($banTotal * 100) / 150;
    	$banPercentage = round($banPer, 2, PHP_ROUND_HALF_UP);

    	if ($banPercentage < 33.33) {
    		$banGP = 0;
    		$banGrade = 'F';
    	} else if (($banPercentage >= 80) && ($banPercentage <= 100)) {
    		$banGP = 5;
    		$banGrade = 'A+';
    	} else if (($banPercentage >= 70) && ($banPercentage <= 79)) {
    		$banGP = 4;
    		$banGrade = 'A';
    	} else if (($banPercentage >= 60) && ($banPercentage <= 69)) {
    		$banGP = 3.5;
    		$banGrade = 'A-';
    	} else if (($banPercentage >= 50) && ($banPercentage <= 59)) {
    		$banGP = 3;
    		$banGrade = 'B';
    	} else if (($banPercentage >= 40) && ($banPercentage <= 49)) {
    		$banGP = 2;
    		$banGrade = 'C';
    	} else if (($banPercentage >= 33.33) && ($banPercentage <= 39)) {
    		$banGP = 1;
    		$banGrade = 'D';
    	} else {
    		$banGP = 0;
    		$banGrade = 'F';
    	}
    	$result->ban_percentage = $banPercentage;
    	$result->ban_gp = $banGP;
    	$result->ban_grade = $banGrade;


    	$result->eng_1st = $request->eng_1st;
    	$result->eng_2nd = $request->eng_2nd;
    	
    	$engTotal = $request->eng_1st + $request->eng_2nd;
    	$result->eng_total = $engTotal;

    	$engPer = ($engTotal * 100) / 150;
    	$engPercentage = round($engPer, 2, PHP_ROUND_HALF_UP);

    	if ($engPercentage < 33.33) {
    		$engGP = 0;
    		$engGrade = 'F';
    	} else if (($engPercentage >= 80) && ($engPercentage <= 100)) {
    		$engGP = 5;
    		$engGrade = 'A+';
    	} else if (($engPercentage >= 70) && ($engPercentage <= 79)) {
    		$engGP = 4;
    		$engGrade = 'A';
    	} else if (($engPercentage >= 60) && ($engPercentage <= 69)) {
    		$engGP = 3.5;
    		$engGrade = 'A-';
    	} else if (($engPercentage >= 50) && ($engPercentage <= 59)) {
    		$engGP = 3;
    		$engGrade = 'B';
    	} else if (($engPercentage >= 40) && ($engPercentage <= 49)) {
    		$engGP = 2;
    		$engGrade = 'C';
    	} else if (($engPercentage >= 33.33) && ($engPercentage <= 39)) {
    		$engGP = 1;
    		$engGrade = 'D';
    	} else {
    		$engGP = 0;
    		$engGrade = 'F';
    	}
    	$result->eng_percentage = $engPercentage;
    	$result->eng_gp = $engGP;
    	$result->eng_grade = $engGrade;


    	$result->math = $request->math;
    	$mathPercentage = $request->math;

    	if ($mathPercentage < 33) {
    		$mathGP = 0;
    		$mathGrade = 'F';
    	} else if (($mathPercentage >= 80) && ($mathPercentage <= 100)) {
    		$mathGP = 5;
    		$mathGrade = 'A+';
    	} else if (($mathPercentage >= 70) && ($mathPercentage <= 79)) {
    		$mathGP = 4;
    		$mathGrade = 'A';
    	} else if (($mathPercentage >= 60) && ($mathPercentage <= 69)) {
    		$mathGP = 3.5;
    		$mathGrade = 'A-';
    	} else if (($mathPercentage >= 50) && ($mathPercentage <= 59)) {
    		$mathGP = 3;
    		$mathGrade = 'B';
    	} else if (($mathPercentage >= 40) && ($mathPercentage <= 49)) {
    		$mathGP = 2;
    		$mathGrade = 'C';
    	} else if (($mathPercentage >= 33) && ($mathPercentage <= 39)) {
    		$mathGP = 1;
    		$mathGrade = 'D';
    	} else {
    		$mathGP = 0;
    		$mathGrade = 'F';
    	}
    	$result->math_percentage = $mathPercentage;
    	$result->math_gp = $mathGP;
    	$result->math_grade = $mathGrade;


    	$result->science = $request->science;

    	$sciencePercentage = $request->science;

    	if ($sciencePercentage < 33) {
    		$scienceGP = 0;
    		$scienceGrade = 'F';
    	} else if (($sciencePercentage >= 80) && ($sciencePercentage <= 100)) {
    		$scienceGP = 5;
    		$scienceGrade = 'A+';
    	} else if (($sciencePercentage >= 70) && ($sciencePercentage <= 79)) {
    		$scienceGP = 4;
    		$scienceGrade = 'A';
    	} else if (($sciencePercentage >= 60) && ($sciencePercentage <= 69)) {
    		$scienceGP = 3.5;
    		$scienceGrade = 'A-';
    	} else if (($sciencePercentage >= 50) && ($sciencePercentage <= 59)) {
    		$scienceGP = 3;
    		$scienceGrade = 'B';
    	} else if (($sciencePercentage >= 40) && ($sciencePercentage <= 49)) {
    		$scienceGP = 2;
    		$scienceGrade = 'C';
    	} else if (($sciencePercentage >= 33) && ($sciencePercentage <= 39)) {
    		$scienceGP = 1;
    		$scienceGrade = 'D';
    	} else {
    		$scienceGP = 0;
    		$scienceGrade = 'F';
    	}
    	$result->science_percentage = $sciencePercentage;
    	$result->science_gp = $scienceGP;
    	$result->science_grade = $scienceGrade;


    	$result->bangladesh = $request->bangladesh;

    	$bangladeshPercentage = $request->bangladesh;

    	if ($bangladeshPercentage < 33) {
    		$bangladeshGP = 0;
    		$bangladeshGrade = 'F';
    	} else if (($bangladeshPercentage >= 80) && ($bangladeshPercentage <= 100)) {
    		$bangladeshGP = 5;
    		$bangladeshGrade = 'A+';
    	} else if (($bangladeshPercentage >= 70) && ($bangladeshPercentage <= 79)) {
    		$bangladeshGP = 4;
    		$bangladeshGrade = 'A';
    	} else if (($bangladeshPercentage >= 60) && ($bangladeshPercentage <= 69)) {
    		$bangladeshGP = 3.5;
    		$bangladeshGrade = 'A-';
    	} else if (($bangladeshPercentage >= 50) && ($bangladeshPercentage <= 59)) {
    		$bangladeshGP = 3;
    		$bangladeshGrade = 'B';
    	} else if (($bangladeshPercentage >= 40) && ($bangladeshPercentage <= 49)) {
    		$bangladeshGP = 2;
    		$bangladeshGrade = 'C';
    	} else if (($bangladeshPercentage >= 33) && ($bangladeshPercentage <= 39)) {
    		$bangladeshGP = 1;
    		$bangladeshGrade = 'D';
    	} else {
    		$bangladeshGP = 0;
    		$bangladeshGrade = 'F';
    	}
    	$result->bangladesh_percentage = $bangladeshPercentage;
    	$result->bangladesh_gp = $bangladeshGP;
    	$result->bangladesh_grade = $bangladeshGrade;


    	$result->religion = $request->religion;
    	$religionPercentage = $request->religion;

    	if ($religionPercentage < 33) {
    		$religionGP = 0;
    		$religionGrade = 'F';
    	} else if (($religionPercentage >= 80) && ($religionPercentage <= 100)) {
    		$religionGP = 5;
    		$religionGrade = 'A+';
    	} else if (($religionPercentage >= 70) && ($religionPercentage <= 79)) {
    		$religionGP = 4;
    		$religionGrade = 'A';
    	} else if (($religionPercentage >= 60) && ($religionPercentage <= 69)) {
    		$religionGP = 3.5;
    		$religionGrade = 'A-';
    	} else if (($religionPercentage >= 50) && ($religionPercentage <= 59)) {
    		$religionGP = 3;
    		$religionGrade = 'B';
    	} else if (($religionPercentage >= 40) && ($religionPercentage <= 49)) {
    		$religionGP = 2;
    		$religionGrade = 'C';
    	} else if (($religionPercentage >= 33) && ($religionPercentage <= 39)) {
    		$religionGP = 1;
    		$religionGrade = 'D';
    	} else {
    		$religionGP = 0;
    		$religionGrade = 'F';
    	}
    	$result->religion_percentage = $religionPercentage;
    	$result->religion_gp = $religionGP;
    	$result->religion_grade = $religionGrade;

    	$result->save();

    	flash()->success('Result Successfully Created');
    	return redirect('six-to-eight-result/create');
    }
}
