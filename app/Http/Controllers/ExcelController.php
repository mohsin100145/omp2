<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Student;
use DB;
use Excel;

class ExcelController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function importExport()
	{
		return view('excel.import_export');
	}
	public function downloadExcel($type)
	{
		$data = Student::get()->toArray();
		return Excel::create('student', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}
	public function importExcel()
	{
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					$insert[] = [
						'name' => $value->name,
						'roll_no' => $value->roll_no,
						'level_id' => $value->level_id,
						'section_id' => $value->section_id,
						'year_id' => $value->year_id,
						'group_id' => $value->group_id,
						'father_name' => $value->father_name,
						'mother_name' => $value->mother_name,
						'address' => $value->address,
					];
				}
				if(!empty($insert)){
					DB::table('students')->insert($insert);
					//dd('Insert Record successfully.');
					flash()->success('Excel file imported successfully');
            		return redirect()->back();
				}
			}
		}
		flash()->error('File not selected.');
        return redirect()->back();
	}
}
