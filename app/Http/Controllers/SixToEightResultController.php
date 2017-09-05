<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
use App\Models\Student;
use App\Models\SixToEightResult;
use App\Models\Level;
use App\Models\Section;
use App\Models\Year;
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
    	//return view('six_to_eight_result.index');
    	$results = SixToEightResult::with([
                                    'term',
                                    'student.level',
                                    'student.section',
                                    'student.year'
                                ])
    							->orderBy('id', 'desc')
                                ->get();

        return view('six_to_eight_result.index', compact('results'));
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
        if (($student->level_id == 4) || ($student->level_id == 5)) {
        	flash()->error("This student's class may be Nine or Ten.");
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

    	$result->ict = $request->ict;
    	$ictPercentage = $request->ict * 2;
    	if ($ictPercentage < 34) {
    		$ictGP = 0;
    		$ictGrade = 'F';
    	} else if (($ictPercentage >= 80) && ($ictPercentage <= 100)) {
    		$ictGP = 5;
    		$ictGrade = 'A+';
    	} else if (($ictPercentage >= 70) && ($ictPercentage <= 79)) {
    		$ictGP = 4;
    		$ictGrade = 'A';
    	} else if (($ictPercentage >= 60) && ($ictPercentage <= 69)) {
    		$ictGP = 3.5;
    		$ictGrade = 'A-';
    	} else if (($ictPercentage >= 50) && ($ictPercentage <= 59)) {
    		$ictGP = 3;
    		$ictGrade = 'B';
    	} else if (($ictPercentage >= 40) && ($ictPercentage <= 49)) {
    		$ictGP = 2;
    		$ictGrade = 'C';
    	} else if (($ictPercentage >= 34) && ($ictPercentage <= 39)) {
    		$ictGP = 1;
    		$ictGrade = 'D';
    	} else {
    		$ictGP = 0;
    		$ictGrade = 'F';
    	}
    	$result->ict_percentage = $ictPercentage;
    	$result->ict_gp = $ictGP;
    	$result->ict_grade = $ictGrade;

    	$result->work = $request->work;
    	$workPercentage = $request->work * 2;
    	if ($workPercentage < 34) {
    		$workGP = 0;
    		$workGrade = 'F';
    	} else if (($workPercentage >= 80) && ($workPercentage <= 100)) {
    		$workGP = 5;
    		$workGrade = 'A+';
    	} else if (($workPercentage >= 70) && ($workPercentage <= 79)) {
    		$workGP = 4;
    		$workGrade = 'A';
    	} else if (($workPercentage >= 60) && ($workPercentage <= 69)) {
    		$workGP = 3.5;
    		$workGrade = 'A-';
    	} else if (($workPercentage >= 50) && ($workPercentage <= 59)) {
    		$workGP = 3;
    		$workGrade = 'B';
    	} else if (($workPercentage >= 40) && ($workPercentage <= 49)) {
    		$workGP = 2;
    		$workGrade = 'C';
    	} else if (($workPercentage >= 34) && ($workPercentage <= 39)) {
    		$workGP = 1;
    		$workGrade = 'D';
    	} else {
    		$workGP = 0;
    		$workGrade = 'F';
    	}
    	$result->work_percentage = $workPercentage;
    	$result->work_gp = $workGP;
    	$result->work_grade = $workGrade;

    	$result->physical = $request->physical;
    	$physicalPercentage = $request->physical * 2;
    	if ($physicalPercentage < 34) {
    		$physicalGP = 0;
    		$physicalGrade = 'F';
    	} else if (($physicalPercentage >= 80) && ($physicalPercentage <= 100)) {
    		$physicalGP = 5;
    		$physicalGrade = 'A+';
    	} else if (($physicalPercentage >= 70) && ($physicalPercentage <= 79)) {
    		$physicalGP = 4;
    		$physicalGrade = 'A';
    	} else if (($physicalPercentage >= 60) && ($physicalPercentage <= 69)) {
    		$physicalGP = 3.5;
    		$physicalGrade = 'A-';
    	} else if (($physicalPercentage >= 50) && ($physicalPercentage <= 59)) {
    		$physicalGP = 3;
    		$physicalGrade = 'B';
    	} else if (($physicalPercentage >= 40) && ($physicalPercentage <= 49)) {
    		$physicalGP = 2;
    		$physicalGrade = 'C';
    	} else if (($physicalPercentage >= 34) && ($physicalPercentage <= 39)) {
    		$physicalGP = 1;
    		$physicalGrade = 'D';
    	} else {
    		$physicalGP = 0;
    		$physicalGrade = 'F';
    	}
    	$result->physical_percentage = $physicalPercentage;
    	$result->physical_gp = $physicalGP;
    	$result->physical_grade = $physicalGrade;

    	$result->arts = $request->arts;
    	$artsPercentage = $request->arts * 2;
    	if ($artsPercentage < 34) {
    		$artsGP = 0;
    		$artsGrade = 'F';
    	} else if (($artsPercentage >= 80) && ($artsPercentage <= 100)) {
    		$artsGP = 5;
    		$artsGrade = 'A+';
    	} else if (($artsPercentage >= 70) && ($artsPercentage <= 79)) {
    		$artsGP = 4;
    		$artsGrade = 'A';
    	} else if (($artsPercentage >= 60) && ($artsPercentage <= 69)) {
    		$artsGP = 3.5;
    		$artsGrade = 'A-';
    	} else if (($artsPercentage >= 50) && ($artsPercentage <= 59)) {
    		$artsGP = 3;
    		$artsGrade = 'B';
    	} else if (($artsPercentage >= 40) && ($artsPercentage <= 49)) {
    		$artsGP = 2;
    		$artsGrade = 'C';
    	} else if (($artsPercentage >= 34) && ($artsPercentage <= 39)) {
    		$artsGP = 1;
    		$artsGrade = 'D';
    	} else {
    		$artsGP = 0;
    		$artsGrade = 'F';
    	}
    	$result->arts_percentage = $artsPercentage;
    	$result->arts_gp = $artsGP;
    	$result->arts_grade = $artsGrade;

    	$result->optional = $request->optional;
    	$optionalPercentage = $request->optional;
    	if ($optionalPercentage < 33) {
    		$optionalGP = 0;
    		$optionalGrade = 'F';
    	} else if (($optionalPercentage >= 80) && ($optionalPercentage <= 100)) {
    		$optionalGP = 5;
    		$optionalGrade = 'A+';
    	} else if (($optionalPercentage >= 70) && ($optionalPercentage <= 79)) {
    		$optionalGP = 4;
    		$optionalGrade = 'A';
    	} else if (($optionalPercentage >= 60) && ($optionalPercentage <= 69)) {
    		$optionalGP = 3.5;
    		$optionalGrade = 'A-';
    	} else if (($optionalPercentage >= 50) && ($optionalPercentage <= 59)) {
    		$optionalGP = 3;
    		$optionalGrade = 'B';
    	} else if (($optionalPercentage >= 40) && ($optionalPercentage <= 49)) {
    		$optionalGP = 2;
    		$optionalGrade = 'C';
    	} else if (($optionalPercentage >= 33) && ($optionalPercentage <= 39)) {
    		$optionalGP = 1;
    		$optionalGrade = 'D';
    	} else {
    		$optionalGP = 0;
    		$optionalGrade = 'F';
    	}
    	$result->optional_percentage = $optionalPercentage;
    	$result->optional_gp = $optionalGP;
    	$result->optional_grade = $optionalGrade;

//-------------------Optional Grade Count------------------//
    	$optGPremain = $optionalGP - 2;
    	if ($optGPremain > 0) {
    		$addableGP = $optGPremain;
    	} else {
    		$addableGP = 0;
    	}

    	$gpTotalExOpt = $banGP + $engGP + $mathGP + $scienceGP + $bangladeshGP + $religionGP + $ictGP + $workGP + $physicalGP + $artsGP;
		$gpTotal = $gpTotalExOpt + $addableGP;
		$marksTotalExOpt = $banTotal + $engTotal + $request->math + $request->science + $request->bangladesh + $request->religion + $request->ict + $request->work + $request->physical + $request->arts;
		$marksTotal = $marksTotalExOpt + $request->optional;
		$result->gp_total_except_optional = $gpTotalExOpt; 
		$result->gp_total = $gpTotal; 
		$result->marks_total_except_optional = $marksTotalExOpt; 
		$result->marks_total = $marksTotal; 
		$result->gpa_except_optional = $gpTotalExOpt / 10;
		$result->gpa = $gpTotal / 10; 

//-------------------Fail Subjects Count------------------//
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
		if ($scienceGP == 0) {
			$failSubjects++;
		}
		if ($bangladeshGP == 0) {
			$failSubjects++;
		}
		if ($religionGP == 0) {
			$failSubjects++;
		}
		if ($ictGP == 0) {
			$failSubjects++;
		}
		if ($workGP == 0) {
			$failSubjects++;
		}
		if ($physicalGP == 0) {
			$failSubjects++;
		}
		if ($artsGP == 0) {
			$failSubjects++;
		}
		$result->fail_subjects = $failSubjects;

//-------------------A+ Count------------------//
		$subApluseCount = 0;
		if ($banGP == 5) {
			$subApluseCount++;
		}
		if ($engGP == 5) {
			$subApluseCount++;
		}
		if ($mathGP == 5) {
			$subApluseCount++;
		}
		if ($scienceGP == 5) {
			$subApluseCount++;
		}
		if ($bangladeshGP == 5) {
			$subApluseCount++;
		}
		if ($religionGP == 5) {
			$subApluseCount++;
		}
		if ($ictGP == 5) {
			$subApluseCount++;
		}
		if ($workGP == 5) {
			$subApluseCount++;
		}
		if ($physicalGP == 5) {
			$subApluseCount++;
		}
		if ($artsGP == 5) {
			$subApluseCount++;
		}

//-------------------A Count------------------//
		$subAcount = 0;
		if ($banGP == 4) {
			$subAcount++;
		}
		if ($engGP == 4) {
			$subAcount++;
		}
		if ($mathGP == 4) {
			$subAcount++;
		}
		if ($scienceGP == 4) {
			$subAcount++;
		}
		if ($bangladeshGP == 4) {
			$subAcount++;
		}
		if ($religionGP == 4) {
			$subAcount++;
		}
		if ($ictGP == 4) {
			$subAcount++;
		}
		if ($workGP == 4) {
			$subAcount++;
		}
		if ($physicalGP == 4) {
			$subAcount++;
		}
		if ($artsGP == 4) {
			$subAcount++;
		}

//-------------------GPA & Grade------------------//
		$gpa = $gpTotal / 10;
		if ($gpa >= 5) {
    		$result->grade = 'A+';
    		if ($gpTotalExOpt == 50) {
				$result->status = 'Golden A+';
    		}
    	} else if (($gpa < 5) && ($gpa >= 4) && ($failSubjects == 0)) {
    		if (($subApluseCount == 9) && ($subAcount == 1)) {
				$result->status = 'General A+';
				$result->grade = 'A+';
    		} else if (($subApluseCount == 8) && ($subAcount == 2)) {
				$result->status = 'General A+';
				$result->grade = 'A+';
    		} else if (($subApluseCount == 7) && ($subAcount == 3)) {
				$result->status = 'General A+';
				$result->grade = 'A+';
    		} else {
    			$result->status = null;
    			$result->grade = 'A';
    		}
    	} else if (($gpa < 4) && ($gpa >= 3.50) && ($failSubjects == 0)) {
    		$result->grade = 'A-';
    		$result->status = null;
    	} else if (($gpa < 3.50) && ($gpa >= 3) && ($failSubjects == 0)) {
    		$result->grade = 'B';
    		$result->status = null;
    	} else if (($gpa < 3) && ($gpa >= 2) && ($failSubjects == 0)) {
    		$result->grade = 'C';
    		$result->status = null;
    	} else if (($gpa < 2) && ($gpa >= 1) && ($failSubjects == 0)) {
    		$result->grade = 'D';
    		$result->status = null;
    	} else {
    		$result->grade = 'F';
    		$result->status = null;
    	}

    	$result->save();

    	flash()->success('Result Successfully Created');
    	return redirect('six-to-eight-result');
    }

    public function edit($id)
    {
    	$result = SixToEightResult::find($id);
    	$termList = Term::pluck('name', 'id');

    	return view('six_to_eight_result.edit', compact('result', 'termList'));
    }

    public function show($id)
    {
    	$result = SixToEightResult::with([
                                   'term',
                                   'student.level',
                                   'student.section',
                                   'student.year'
                               ])
                            ->find($id);
        return view('six_to_eight_result.show', compact('result'));
    }

    public function update(Request $request, $id)
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
        if (($student->level_id == 4) || ($student->level_id == 5)) {
        	flash()->error("This student's class may be Nine or Ten.");
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
                                    ->where('id', '<>', $id)
                                    ->get();
        if( count($existResult) ) {
            flash()->error("This Student's Result already created in this Term.");
            return redirect()->back()
            			->withInput();
        }

        $result = SixToEightResult::find($id);
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

    	$result->ict = $request->ict;
    	$ictPercentage = $request->ict * 2;
    	if ($ictPercentage < 34) {
    		$ictGP = 0;
    		$ictGrade = 'F';
    	} else if (($ictPercentage >= 80) && ($ictPercentage <= 100)) {
    		$ictGP = 5;
    		$ictGrade = 'A+';
    	} else if (($ictPercentage >= 70) && ($ictPercentage <= 79)) {
    		$ictGP = 4;
    		$ictGrade = 'A';
    	} else if (($ictPercentage >= 60) && ($ictPercentage <= 69)) {
    		$ictGP = 3.5;
    		$ictGrade = 'A-';
    	} else if (($ictPercentage >= 50) && ($ictPercentage <= 59)) {
    		$ictGP = 3;
    		$ictGrade = 'B';
    	} else if (($ictPercentage >= 40) && ($ictPercentage <= 49)) {
    		$ictGP = 2;
    		$ictGrade = 'C';
    	} else if (($ictPercentage >= 34) && ($ictPercentage <= 39)) {
    		$ictGP = 1;
    		$ictGrade = 'D';
    	} else {
    		$ictGP = 0;
    		$ictGrade = 'F';
    	}
    	$result->ict_percentage = $ictPercentage;
    	$result->ict_gp = $ictGP;
    	$result->ict_grade = $ictGrade;

    	$result->work = $request->work;
    	$workPercentage = $request->work * 2;
    	if ($workPercentage < 34) {
    		$workGP = 0;
    		$workGrade = 'F';
    	} else if (($workPercentage >= 80) && ($workPercentage <= 100)) {
    		$workGP = 5;
    		$workGrade = 'A+';
    	} else if (($workPercentage >= 70) && ($workPercentage <= 79)) {
    		$workGP = 4;
    		$workGrade = 'A';
    	} else if (($workPercentage >= 60) && ($workPercentage <= 69)) {
    		$workGP = 3.5;
    		$workGrade = 'A-';
    	} else if (($workPercentage >= 50) && ($workPercentage <= 59)) {
    		$workGP = 3;
    		$workGrade = 'B';
    	} else if (($workPercentage >= 40) && ($workPercentage <= 49)) {
    		$workGP = 2;
    		$workGrade = 'C';
    	} else if (($workPercentage >= 34) && ($workPercentage <= 39)) {
    		$workGP = 1;
    		$workGrade = 'D';
    	} else {
    		$workGP = 0;
    		$workGrade = 'F';
    	}
    	$result->work_percentage = $workPercentage;
    	$result->work_gp = $workGP;
    	$result->work_grade = $workGrade;

    	$result->physical = $request->physical;
    	$physicalPercentage = $request->physical * 2;
    	if ($physicalPercentage < 34) {
    		$physicalGP = 0;
    		$physicalGrade = 'F';
    	} else if (($physicalPercentage >= 80) && ($physicalPercentage <= 100)) {
    		$physicalGP = 5;
    		$physicalGrade = 'A+';
    	} else if (($physicalPercentage >= 70) && ($physicalPercentage <= 79)) {
    		$physicalGP = 4;
    		$physicalGrade = 'A';
    	} else if (($physicalPercentage >= 60) && ($physicalPercentage <= 69)) {
    		$physicalGP = 3.5;
    		$physicalGrade = 'A-';
    	} else if (($physicalPercentage >= 50) && ($physicalPercentage <= 59)) {
    		$physicalGP = 3;
    		$physicalGrade = 'B';
    	} else if (($physicalPercentage >= 40) && ($physicalPercentage <= 49)) {
    		$physicalGP = 2;
    		$physicalGrade = 'C';
    	} else if (($physicalPercentage >= 34) && ($physicalPercentage <= 39)) {
    		$physicalGP = 1;
    		$physicalGrade = 'D';
    	} else {
    		$physicalGP = 0;
    		$physicalGrade = 'F';
    	}
    	$result->physical_percentage = $physicalPercentage;
    	$result->physical_gp = $physicalGP;
    	$result->physical_grade = $physicalGrade;

    	$result->arts = $request->arts;
    	$artsPercentage = $request->arts * 2;
    	if ($artsPercentage < 34) {
    		$artsGP = 0;
    		$artsGrade = 'F';
    	} else if (($artsPercentage >= 80) && ($artsPercentage <= 100)) {
    		$artsGP = 5;
    		$artsGrade = 'A+';
    	} else if (($artsPercentage >= 70) && ($artsPercentage <= 79)) {
    		$artsGP = 4;
    		$artsGrade = 'A';
    	} else if (($artsPercentage >= 60) && ($artsPercentage <= 69)) {
    		$artsGP = 3.5;
    		$artsGrade = 'A-';
    	} else if (($artsPercentage >= 50) && ($artsPercentage <= 59)) {
    		$artsGP = 3;
    		$artsGrade = 'B';
    	} else if (($artsPercentage >= 40) && ($artsPercentage <= 49)) {
    		$artsGP = 2;
    		$artsGrade = 'C';
    	} else if (($artsPercentage >= 34) && ($artsPercentage <= 39)) {
    		$artsGP = 1;
    		$artsGrade = 'D';
    	} else {
    		$artsGP = 0;
    		$artsGrade = 'F';
    	}
    	$result->arts_percentage = $artsPercentage;
    	$result->arts_gp = $artsGP;
    	$result->arts_grade = $artsGrade;

    	$result->optional = $request->optional;
    	$optionalPercentage = $request->optional;
    	if ($optionalPercentage < 33) {
    		$optionalGP = 0;
    		$optionalGrade = 'F';
    	} else if (($optionalPercentage >= 80) && ($optionalPercentage <= 100)) {
    		$optionalGP = 5;
    		$optionalGrade = 'A+';
    	} else if (($optionalPercentage >= 70) && ($optionalPercentage <= 79)) {
    		$optionalGP = 4;
    		$optionalGrade = 'A';
    	} else if (($optionalPercentage >= 60) && ($optionalPercentage <= 69)) {
    		$optionalGP = 3.5;
    		$optionalGrade = 'A-';
    	} else if (($optionalPercentage >= 50) && ($optionalPercentage <= 59)) {
    		$optionalGP = 3;
    		$optionalGrade = 'B';
    	} else if (($optionalPercentage >= 40) && ($optionalPercentage <= 49)) {
    		$optionalGP = 2;
    		$optionalGrade = 'C';
    	} else if (($optionalPercentage >= 33) && ($optionalPercentage <= 39)) {
    		$optionalGP = 1;
    		$optionalGrade = 'D';
    	} else {
    		$optionalGP = 0;
    		$optionalGrade = 'F';
    	}
    	$result->optional_percentage = $optionalPercentage;
    	$result->optional_gp = $optionalGP;
    	$result->optional_grade = $optionalGrade;

//-------------------Optional Grade Count------------------//
    	$optGPremain = $optionalGP - 2;
    	if ($optGPremain > 0) {
    		$addableGP = $optGPremain;
    	} else {
    		$addableGP = 0;
    	}

    	$gpTotalExOpt = $banGP + $engGP + $mathGP + $scienceGP + $bangladeshGP + $religionGP + $ictGP + $workGP + $physicalGP + $artsGP;
		$gpTotal = $gpTotalExOpt + $addableGP;
		$marksTotalExOpt = $banTotal + $engTotal + $request->math + $request->science + $request->bangladesh + $request->religion + $request->ict + $request->work + $request->physical + $request->arts;
		$marksTotal = $marksTotalExOpt + $request->optional;
		$result->gp_total_except_optional = $gpTotalExOpt; 
		$result->gp_total = $gpTotal; 
		$result->marks_total_except_optional = $marksTotalExOpt; 
		$result->marks_total = $marksTotal; 
		$result->gpa_except_optional = $gpTotalExOpt / 10;
		$result->gpa = $gpTotal / 10; 

//-------------------Fail Subjects Count------------------//
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
		if ($scienceGP == 0) {
			$failSubjects++;
		}
		if ($bangladeshGP == 0) {
			$failSubjects++;
		}
		if ($religionGP == 0) {
			$failSubjects++;
		}
		if ($ictGP == 0) {
			$failSubjects++;
		}
		if ($workGP == 0) {
			$failSubjects++;
		}
		if ($physicalGP == 0) {
			$failSubjects++;
		}
		if ($artsGP == 0) {
			$failSubjects++;
		}
		$result->fail_subjects = $failSubjects;

//-------------------A+ Count------------------//
		$subApluseCount = 0;
		if ($banGP == 5) {
			$subApluseCount++;
		}
		if ($engGP == 5) {
			$subApluseCount++;
		}
		if ($mathGP == 5) {
			$subApluseCount++;
		}
		if ($scienceGP == 5) {
			$subApluseCount++;
		}
		if ($bangladeshGP == 5) {
			$subApluseCount++;
		}
		if ($religionGP == 5) {
			$subApluseCount++;
		}
		if ($ictGP == 5) {
			$subApluseCount++;
		}
		if ($workGP == 5) {
			$subApluseCount++;
		}
		if ($physicalGP == 5) {
			$subApluseCount++;
		}
		if ($artsGP == 5) {
			$subApluseCount++;
		}

//-------------------A Count------------------//
		$subAcount = 0;
		if ($banGP == 4) {
			$subAcount++;
		}
		if ($engGP == 4) {
			$subAcount++;
		}
		if ($mathGP == 4) {
			$subAcount++;
		}
		if ($scienceGP == 4) {
			$subAcount++;
		}
		if ($bangladeshGP == 4) {
			$subAcount++;
		}
		if ($religionGP == 4) {
			$subAcount++;
		}
		if ($ictGP == 4) {
			$subAcount++;
		}
		if ($workGP == 4) {
			$subAcount++;
		}
		if ($physicalGP == 4) {
			$subAcount++;
		}
		if ($artsGP == 4) {
			$subAcount++;
		}

//-------------------GPA & Grade------------------//
		$gpa = $gpTotal / 10;
		if ($gpa >= 5) {
    		$result->grade = 'A+';
    		if ($gpTotalExOpt == 50) {
				$result->status = 'Golden A+';
    		}
    	} else if (($gpa < 5) && ($gpa >= 4) && ($failSubjects == 0)) {
    		if (($subApluseCount == 9) && ($subAcount == 1)) {
				$result->status = 'General A+';
				$result->grade = 'A+';
    		} else if (($subApluseCount == 8) && ($subAcount == 2)) {
				$result->status = 'General A+';
				$result->grade = 'A+';
    		} else if (($subApluseCount == 7) && ($subAcount == 3)) {
				$result->status = 'General A+';
				$result->grade = 'A+';
    		} else {
    			$result->status = null;
    			$result->grade = 'A';
    		}
    	} else if (($gpa < 4) && ($gpa >= 3.50) && ($failSubjects == 0)) {
    		$result->grade = 'A-';
    		$result->status = null;
    	} else if (($gpa < 3.50) && ($gpa >= 3) && ($failSubjects == 0)) {
    		$result->grade = 'B';
    		$result->status = null;
    	} else if (($gpa < 3) && ($gpa >= 2) && ($failSubjects == 0)) {
    		$result->grade = 'C';
    		$result->status = null;
    	} else if (($gpa < 2) && ($gpa >= 1) && ($failSubjects == 0)) {
    		$result->grade = 'D';
    		$result->status = null;
    	} else {
    		$result->grade = 'F';
    		$result->status = null;
    	}

    	$result->save();

    	flash()->success('Result Successfully Updated');
    	return redirect('six-to-eight-result');
    }

    public function classWiseResultForm()
    {
        $classList = Level::whereIn('id', [1, 2, 3])->pluck('name', 'id');
        $yearList = Year::pluck('year', 'id');
        $termList = Term::pluck('name', 'id');

        return view('six_to_eight_result.report.form', compact('classList', 'termList', 'yearList'));
    }

    public function classWiseResultShow(Request $request)
    {
        $results = SixToEightResult::with(['student.section', 'term'])
            ->where('level_id', $request->level_id)
            ->where('year_id', $request->year_id)
            ->where('term_id', $request->term_id)
            ->orderBy('gpa', 'desc')
            ->orderBy('fail_subjects', 'asc')
            ->get();
        
        if(!count($results)) {
            flash()->error('There is no result');

            return redirect()->back()->withInput();
        }
        $level = Level::find($request->level_id);
        $year = Year::find($request->year_id);

        return view('six_to_eight_result.report.show', compact('results', 'level', 'year'));
    }

    public function classWiseFailResultForm()
    {
        $classList = Level::whereIn('id', [1, 2, 3])->pluck('name', 'id');
        $yearList = Year::pluck('year', 'id');
        $termList = Term::pluck('name', 'id');
        $failSubjects = ['0' => '0. Zero Subject', '1' => '1. One Subject', '2' => '2. Two Subjects', '3' => '3. Three Subjects', '4' => '4. Four Subjects', '5' => '5. Five Subjects', '6' => '6. Six Subjects', '7' => '7. Seven Subjects', '8' => '8. Eight Subjects', '9' => '9. Nine Subjects', '10' => '10. Ten Subjects', '11' => '11. Eleven Subjects'];

        return view('six_to_eight_result.report.fail_form', compact('classList', 'termList', 'yearList', 'failSubjects'));
    }

    public function classWiseFailResultShow(Request $request)
    {
        $results = SixToEightResult::with(['student.section', 'term'])
            ->where('level_id', $request->level_id)
            ->where('year_id', $request->year_id)
            ->where('term_id', $request->term_id)
            ->where('fail_subjects', $request->fail_subjects)
            ->orderBy('gpa', 'desc')
            ->get();
        
        if(!count($results)) {
            flash()->error('There is no result');

            return redirect()->back()->withInput();
        }
        $level = Level::find($request->level_id);
        $year = Year::find($request->year_id);

        return view('six_to_eight_result.report.fail_show', compact('results', 'level', 'year'));
    }
}
