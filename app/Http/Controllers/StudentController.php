<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Section;
use App\Models\Student;
use App\Models\Year;
use App\Models\Group;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\Input;
use File;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $students = Student::with(['level', 'section', 'year', 'group'])
            ->orderBy('id', 'desc')
            ->get();
        //dd($students);
       //return $students;
        return view('student.index', compact('students'));
    }

    public function create()
    {
        $classList = Level::pluck('name', 'id');
        $sectionList = Section::pluck('name', 'id');
        $yearList = Year::pluck('year', 'id');
        $groupList = Group::pluck('name', 'id');

        return view('student.create', compact('classList', 'sectionList', 'yearList', 'groupList'));
    }

    public function store(StudentRequest $request)
    {
        //return $request->all();
        $addedStudent = Student::where('roll_no', $request->roll_no)
                               ->where('level_id', $request->level_id)
                               ->where('section_id', $request->section_id)
                               ->get();
        if (!count($addedStudent)) {

            if ($request->image == null) {
                $student = Student::create(
                    [
                        'name' => $request->name,
                        'roll_no' => $request->roll_no,
                        'level_id' => $request->level_id,
                        'section_id' => $request->section_id,
                        'year_id' => $request->year_id,
                        'group_id' => $request->group_id,
                        'father_name' => $request->father_name,
                        'mother_name' => $request->mother_name,
                        'address' => $request->address,
                        'image' => $request->image
                    ]
                );
            } else {
                if (Input::file('image')->isValid()) {
                    $destinationPath = 'uploads';
                    $extension = Input::file('image')->getClientOriginalExtension();
                    $fileName = date("Y-m-d_H-i-s").'_'.rand(11111, 99999) . '.' . $extension;
                    Input::file('image')->move($destinationPath, $fileName);
                } else {
                    flash()->error('uploaded file is not valid');

                    return redirect()->back();
                }
                $student = Student::create(
                    [
                        'name' => $request->name,
                        'roll_no' => $request->roll_no,
                        'level_id' => $request->level_id,
                        'section_id' => $request->section_id,
                        'year_id' => $request->year_id,
                        'group_id' => $request->group_id,
                        'father_name' => $request->father_name,
                        'mother_name' => $request->mother_name,
                        'address' => $request->address,
                        'image' => $fileName
                    ]
                );
            }
            flash()->message($student->name . "'s information Successfully inserted");
        }
        else {
            flash()->error('This Student with Roll No. '. $request->roll_no . ' already in exist that Class and Section.');
            return redirect()->back()->withInput();
        }
        return redirect('student');
    }

    public function edit($id)
    {
        $student = Student::find($id);
        $classList = Level::pluck('name', 'id');
        $sectionList = Section::pluck('name', 'id');
        $yearList = Year::pluck('year', 'id');
        $groupList = Group::pluck('name', 'id');

        return view('student.edit', compact('student', 'classList', 'sectionList', 'yearList', 'groupList'));
    }

    public function update(StudentRequest $request, $id)
    {
        //return $request->all();
        $student = Student::find($id);
        $addedStudent = Student::where('roll_no', $request->roll_no)
                               ->where('level_id', $request->level_id)
                               ->where('section_id', $request->section_id)
                               ->where('id', '!=', $student->id)
                               ->get();
        //return count($addedStudent);

        if (!count($addedStudent)) {

            //File::delete('uploads/' . $student->image);
            if ($request->image == null) {
                $student->update(
                    [
                        'name' => $request->name,
                        'roll_no' => $request->roll_no,
                        'level_id' => $request->level_id,
                        'section_id' => $request->section_id,
                        'year_id' => $request->year_id,
                        'group_id' => $request->group_id,
                        'father_name' => $request->father_name,
                        'mother_name' => $request->mother_name,
                        'address' => $request->address,
                       
                    ]
                );
            } else {
                if (Input::file('image')->isValid()) {
                    $destinationPath = 'uploads';
                    $extension = Input::file('image')->getClientOriginalExtension();
                    $fileName = date("Y-m-d_H-i-s").'_'.rand(11111, 99999) . '.' . $extension;
                    Input::file('image')->move($destinationPath, $fileName);
                } else {
                    flash()->error('uploaded file is not valid');

                    return redirect()->back();
                }
                File::delete('uploads/' . $student->image);
                $student->update(
                    [
                        'name' => $request->name,
                        'roll_no' => $request->roll_no,
                        'level_id' => $request->level_id,
                        'section_id' => $request->section_id,
                        'year_id' => $request->year_id,
                        'group_id' => $request->group_id,
                        'father_name' => $request->father_name,
                        'mother_name' => $request->mother_name,
                        'address' => $request->address,
                        'image' => $fileName
                    ]
                );
            }
        }
        else {
            flash()->error('This Student with Roll No. '. $request->roll_no . ' already in exist that Class and Section.');
            return redirect()->back();
        }
        flash()->message($student->name . "'s information successfully updated");

        return redirect('student');
    }
}