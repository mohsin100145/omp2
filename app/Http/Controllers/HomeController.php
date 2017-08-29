<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
use App\Models\Result;
use App\Models\SixToEightResult;
use App\Models\Student;
use App\Models\Level;
use App\Models\Section;
use App\Models\Year;
use App\Models\Group;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentYear = Year::where('year', date('Y'))->first();
        $sixStudents = Student::where('level_id', 1)->where('year_id', $currentYear->id)->count();
        $sevenStudents = Student::where('level_id', 2)->where('year_id', $currentYear->id)->count();
        $eightStudents = Student::where('level_id', 3)->where('year_id', $currentYear->id)->count();
        $nineStudents = Student::where('level_id', 4)->where('year_id', $currentYear->id)->count();
        $tenStudents = Student::where('level_id', 5)->where('year_id', $currentYear->id)->count();
        $totalStudents = Student::where('year_id', $currentYear->id)->count();
        $sixResults = SixToEightResult::where('level_id', 1)->where('year_id', $currentYear->id)->count();
        $sevenResults = SixToEightResult::where('level_id', 2)->where('year_id', $currentYear->id)->count();
        $eightResults = SixToEightResult::where('level_id', 3)->where('year_id', $currentYear->id)->count();
        $nineResults = Result::where('level_id', 4)->where('year_id', $currentYear->id)->count();
        $tenResults = Result::where('level_id', 5)->where('year_id', $currentYear->id)->count();
        $totalResults = $sixResults + $sevenResults + $eightResults + $nineResults + $tenResults;
        $levels = Level::count();
        $sections = Section::count();
        $groups = Group::count();
        $terms = Term::count();

        return view('home', compact('sixStudents', 'sevenStudents', 'eightStudents', 'nineStudents', 'tenStudents', 'totalStudents', 'sixResults', 'sevenResults', 'eightResults', 'nineResults', 'tenResults', 'totalResults', 'levels', 'sections', 'groups', 'terms'));
    }
}
