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

        return 'hamba';
    }
}
