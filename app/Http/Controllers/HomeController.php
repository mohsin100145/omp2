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

        $sixStudentsTotal = Student::where('level_id', 1)->count();
        $sevenStudentsTotal = Student::where('level_id', 2)->count();
        $eightStudentsTotal = Student::where('level_id', 3)->count();
        $nineStudentsTotal = Student::where('level_id', 4)->count();
        $tenStudentsTotal = Student::where('level_id', 5)->count();
        $totalStudentsTotal = Student::count();

        $sixResults = SixToEightResult::where('level_id', 1)->where('year_id', $currentYear->id)->count();
        $sevenResults = SixToEightResult::where('level_id', 2)->where('year_id', $currentYear->id)->count();
        $eightResults = SixToEightResult::where('level_id', 3)->where('year_id', $currentYear->id)->count();
        $nineResults = Result::where('level_id', 4)->where('year_id', $currentYear->id)->count();
        $tenResults = Result::where('level_id', 5)->where('year_id', $currentYear->id)->count();
        $totalResults = $sixResults + $sevenResults + $eightResults + $nineResults + $tenResults;

        $sixResultsTotal = SixToEightResult::where('level_id', 1)->count();
        $sevenResultsTotal = SixToEightResult::where('level_id', 2)->count();
        $eightResultsTotal = SixToEightResult::where('level_id', 3)->count();
        $nineResultsTotal = Result::where('level_id', 4)->count();
        $tenResultsTotal = Result::where('level_id', 5)->count();
        $totalResultsTotal = $sixResultsTotal + $sevenResultsTotal + $eightResultsTotal + $nineResultsTotal + $tenResultsTotal;

        $sixResultsFirst = SixToEightResult::where('level_id', 1)->where('term_id', 1)->where('year_id', $currentYear->id)->count();
        $sevenResultsFirst = SixToEightResult::where('level_id', 2)->where('term_id', 1)->where('year_id', $currentYear->id)->count();
        $eightResultsFirst = SixToEightResult::where('level_id', 3)->where('term_id', 1)->where('year_id', $currentYear->id)->count();
        $nineResultsFirst = Result::where('level_id', 4)->where('term_id', 1)->where('year_id', $currentYear->id)->count();
        $tenResultsFirst = Result::where('level_id', 5)->where('term_id', 1)->where('year_id', $currentYear->id)->count();
        $sixResultsAnnual = SixToEightResult::where('level_id', 1)->where('term_id', 2)->where('year_id', $currentYear->id)->count();
        $sevenResultsAnnual = SixToEightResult::where('level_id', 2)->where('term_id', 2)->where('year_id', $currentYear->id)->count();
        $eightResultsAnnual = SixToEightResult::where('level_id', 3)->where('term_id', 2)->where('year_id', $currentYear->id)->count();
        $nineResultsAnnual = Result::where('level_id', 4)->where('term_id', 2)->where('year_id', $currentYear->id)->count();
        $tenResultsAnnual = Result::where('level_id', 5)->where('term_id', 2)->where('year_id', $currentYear->id)->count();

        $sixResultsFirstTotal = SixToEightResult::where('level_id', 1)->where('term_id', 1)->count();
        $sevenResultsFirstTotal = SixToEightResult::where('level_id', 2)->where('term_id', 1)->count();
        $eightResultsFirstTotal = SixToEightResult::where('level_id', 3)->where('term_id', 1)->count();
        $nineResultsFirstTotal = Result::where('level_id', 4)->where('term_id', 1)->count();
        $tenResultsFirstTotal = Result::where('level_id', 5)->where('term_id', 1)->count();
        $sixResultsAnnualTotal = SixToEightResult::where('level_id', 1)->where('term_id', 2)->count();
        $sevenResultsAnnualTotal = SixToEightResult::where('level_id', 2)->where('term_id', 2)->count();
        $eightResultsAnnualTotal = SixToEightResult::where('level_id', 3)->where('term_id', 2)->count();
        $nineResultsAnnualTotal = Result::where('level_id', 4)->where('term_id', 2)->count();
        $tenResultsAnnualTotal = Result::where('level_id', 5)->where('term_id', 2)->count();

        $levels = Level::count();
        $sections = Section::count();
        $groups = Group::count();
        $terms = Term::count();

        return view('home', compact('sixStudents', 'sevenStudents', 'eightStudents', 'nineStudents', 'tenStudents', 'totalStudents', 'sixResults', 'sevenResults', 'eightResults', 'nineResults', 'tenResults', 'totalResults', 'levels', 'sections', 'groups', 'terms', 'sixResultsFirst', 'sevenResultsFirst', 'eightResultsFirst', 'nineResultsFirst', 'tenResultsFirst', 'sixResultsAnnual', 'sevenResultsAnnual', 'eightResultsAnnual', 'nineResultsAnnual', 'tenResultsAnnual', 'sixStudentsTotal', 'sevenStudentsTotal', 'eightStudentsTotal', 'nineStudentsTotal', 'tenStudentsTotal', 'totalStudentsTotal', 'sixResultsTotal', 'sevenResultsTotal', 'eightResultsTotal', 'nineResultsTotal', 'tenResultsTotal', 'totalResultsTotal', 'sixResultsFirstTotal', 'sevenResultsFirstTotal', 'eightResultsFirstTotal', 'nineResultsFirstTotal', 'tenResultsFirstTotal', 'sixResultsAnnualTotal', 'sevenResultsAnnualTotal', 'eightResultsAnnualTotal', 'nineResultsAnnualTotal', 'tenResultsAnnualTotal'));
    }
}
