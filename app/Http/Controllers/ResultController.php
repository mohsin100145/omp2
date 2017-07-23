<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
use App\Models\Result;
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
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $result = new Result;
    	$result->student_id = $request->student_id;
    	$result->level_id = 9;
    	$result->section_id = 8;
    	$result->year_id = 7;
    	$result->term_id = $request->term_id;
    	$result->ban_1st_wrt = $request->ban_1st_wrt;
    	$result->ban_1st_mcq = $request->ban_1st_mcq;
    	$result->ban_2nd_wrt = $request->ban_2nd_wrt;
    	$result->ban_2nd_mcq = $request->ban_2nd_mcq;

    	$banTotal = $request->ban_1st_wrt + $request->ban_1st_mcq + $request->ban_2nd_wrt + $request->ban_2nd_mcq;
    	$banAvg = $banTotal / 2;

    	$result->ban_total = $banTotal;
    	$result->ban_avg = $banAvg;

    	// if (($request->ban_1st_wrt == null) || ($request->ban_1st_wrt < 23) || ($request->ban_1st_mcq == null) || ($request->ban_1st_wrt < 10) || ($request->ban_2nd_wrt == null) || ($request->ban_2nd_wrt < 23) || ($request->ban_2nd_mcq == null) || ($request->ban_2nd_wrt < 10)) {
    	// 	$banGP = 0;
    	// 	$banGrade = 'f';}
    	if ($banAvg < 33) {
    		$banGP = 0;
    		$banGrade = 'f1';
    	} else if ( (($request->ban_1st_wrt < 23) && ($request->ban_2nd_wrt < 23)) || (($request->ban_1st_mcq < 10) && ($request->ban_2nd_mcq < 10)) ) {
    		$banGP = 0;
    		$banGrade = 'f2';
    	} else if ( (($request->ban_1st_wrt + $request->ban_2nd_wrt) < 46) || (($request->ban_1st_mcq + $request->ban_2nd_mcq) < 20) ) {
    		$banGP = 0;
    		$banGrade = 'f3';
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

}
