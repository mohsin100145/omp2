@extends('layouts.app')

@section('content')
    <style>
        .table-bordered>tbody>tr>td.absent {
            /*background-color: #ffffcc !important;*/
            color: green;
        }
        .table-bordered>tbody>tr>td.fail {
            /*background-color: red !important;*/
            color: red;
        }
        @media print
        {
            /*.table-bordered>tbody>tr>td.absent {*/
                /*background-color: #ffff80 !important;*/
            /*}*/
            .print-margin{
                margin-top: 0px;
                font-size: 15pt;
            }
            #pager,
            form,
            .no-print
            {
                display: none !important;
                height: 0;
            }


            .no-print, .no-print *{
                display: none !important;
                height: 0;
            }
        }
    </style>
    <div class="print-margin">
        <div class="row">
            <div class="col-xs-2">
                <div class="pull-left">
                    {{ Html::image('/images/logo.jpg', 'alt', ['width' => 100, 'height' => 100]) }}
                </div>
            </div>
            <div class="col-xs-9">
                <h3><center>Bara Moheshkhali Girls' High School</center></h3>
            <center><h4>
                <i class="fa fa-file-text-o"></i>
                Student Information & Result Details
            </h4></center>
            </div>
        </div>
    <hr>
        <div class="row">
            <div class="col-xs-4">
                <table class="table table-condensed">
                    <tr>
                        <td style="border: 0;">Student Name:</td>
                        <td style="border: none;"><strong>{{ $result->student->name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0;">Roll No.:</td>
                        <td style="border: 0;"><strong>{{ $result->student->roll_no }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0;">Class:</td>
                        <td  style="border: 0;"><strong>{{ $result->student->level->name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0;">Section:</td>
                        <td style="border: 0;"><strong>{{ $result->student->section->name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0;">Term:</td>
                        <td style="border: 0;"><strong>{{ $result->term->name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0;">Year:</td>
                        <td style="border: 0;"><strong>{{ $result->student->year->year }}</strong></td>
                    </tr>
                </table>
            </div>
            <div class="col-xs-1"></div>
            <div class="col-xs-4">
                <table class="table table-condensed">
                    <tr>
                        <td style="border: 0;">Father's Name:</td>
                        <td style="border: 0;"><strong>{{ $result->student->father_name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0;">Mother's Name:</td>
                        <td style="border: 0;"><strong>{{ $result->student->mother_name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0;">Address:</td>
                        <td style="border: 0;"><strong>{{ $result->student->address }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0;">Student ID:</td>
                        <td style="border: 0;"><strong>{{ $result->student->id }}</strong></td>
                    </tr>
                </table>
            </div>
            <div class="col-xs-3">
                <div class="pull-right">
                    {{ Html::image('/uploads/' . $result->student->image, 'alt', ['width' => 150, 'height' => 150]) }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-striped table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Subject Name</th>
                            <th>Total Mark</th>
                            <th>Pass Mark</th>
                            <th>Written</th>
                            <th>MCQ</th>
                            <th>Practical</th>
                            <th>Get Mark</th>
                            <th>GP</th>
                            <th>Grade</th>
                            <th>GPA</th>
                            <th>Total Marks</th>
                            <th>Fail Subject(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                    ?>
                        <tr>
                            <td>1</td>
                            <td>Bangla First Peper</td>
                            <td>100</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">66</td>
                            <td>{{ $result->ban_1st_wrt }}</td>
                            <td>{{ $result->ban_1st_mcq }}</td>
                            <td></td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->ban_total }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->ban_gp }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->ban_grade }}</td>
                            <td>{{ $result->gpa }}</td>
                            <td>{{ $result->marks_total_with_optional }}</td>
                            <td>{{ $result->fail_subjects }}</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Bangla Second Peper</td>
                            <td>100</td>
                            <td>{{ $result->ban_2nd_wrt }}</td>
                            <td>{{ $result->ban_2nd_mcq }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>English First Peper</td>
                            <td>100</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">66</td>
                            <td>{{ $result->eng_1st_wrt }}</td>
                            <td>{{ $result->eng_1st_mcq }}</td>
                            <td></td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->eng_total }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->eng_gp }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->eng_grade }}</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>English Second Peper</td>
                            <td>100</td>
                            <td>{{ $result->eng_2nd_wrt }}</td>
                            <td>{{ $result->eng_2nd_mcq }}</td>
                            <td></td>
                        </tr>
                                {{-- <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $details->name }}</td>
                                    <td>{{ $details->total_mark }}</td>
                                    <td>{{ $details->pass_mark }}</td>
                                    <td><strong>{{ $details->resultDetails->first()->get_mark or 'Absent' }}</strong></td>
                                    <td>{{ $details->resultDetails->first()->get_mark_percentage or ' ' }}</td>
                                    <td>{{ $details->resultDetails->first()->grade_point or ' ' }}</td>
                                    <td>{{ $details->resultDetails->first()->grade or ' ' }}</td>
                                    @if($i==1)
                                        <td style="vertical-align: middle; text-align: center; background-color: white;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalResult }}</strong></td>
                                        <td style="vertical-align: middle; text-align: center; background-color: white;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalMarks }}</strong></td>
                                        @if($totalFail > 0)
                                            <td style="vertical-align: middle; text-align: center; background-color: white;" rowspan={{ $resultDetailsBySubject->count() }}><strong>{{ $totalFail }}</strong></td>
                                        @endif
                                    @endif
                                </tr> --}}
                           

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <p>Software Developed by <strong>Mohsin Iqbal</strong></p>
    <input type="button" class="no-print btn btn-primary" value="Print this page" onClick="window.print()">
@endsection