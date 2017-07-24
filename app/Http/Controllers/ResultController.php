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
    	//$result->gp_total_except_optional = $banAvg;

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
