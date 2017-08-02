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
                font-size: 14pt;
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
    <div class="print-margin" style=" border: 0px solid black;">
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
    <hr style="margin-top: 10px; margin-bottom: 10px;">
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
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Subject Name</th>
                            <th>Total Mark</th>
                            <th>Pass Mark</th>
                            <th>Written</th>
                            <th>MCQ</th>
                            <th>Prac- tical</th>
                            <th>Get Mark</th>
                            <th>GP</th>
                            <th>Grade</th>
                            <th>GPA <strike>(Opt)</strike></th>
                            <th>GPA (Opt)</th>
                            <th>Total Marks</th>
                            @if($result->fail_subjects > 0)
                                <th>Fail Subject(s)</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $grandGPA = $result->gpa;
                        if ($grandGPA > 5) {
                            $GPA = number_format(5.00, 2);
                        } else {
                           $GPA = $result->gpa; 
                        }


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
                            <td rowspan="10" style="vertical-align: middle; text-align: center;">{{ $result->gpa_except_optional }}</td>
                            <td rowspan="11" style="vertical-align: middle; text-align: center;">{{  $GPA }} <br> ({{ $result->grade }} grade)<br> {{ $result->status }}</td>
                            <td rowspan="11" style="vertical-align: middle; text-align: center;">{{ $result->marks_total_with_optional }}</td>
                            @if($result->fail_subjects > 0)
                                <td rowspan="11" style="vertical-align: middle; text-align: center;">{{ $result->fail_subjects }}</td>
                            @endif
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
                            <td>{{ $result->eng_1st }}</td>
                            <td></td>
                            <td></td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->eng_total }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->eng_gp }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->eng_grade }}</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>English Second Peper</td>
                            <td style="vertical-align: middle; text-align: center;">100</td>
                            <td>{{ $result->eng_2nd }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Mathematics</td>
                            <td>100</td>
                            <td style="vertical-align: middle; text-align: center;">33 (23+10)</td>
                            <td>{{ $result->math_wrt }}</td>
                            <td>{{ $result->math_mcq }}</td>
                            <td></td>
                            <td>{{ $result->math_total }}</td>
                            <td>{{ $result->math_gp }}</td>
                            <td>{{ $result->math_grade }}</td> 
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Religion Studies</td>
                            <td>100</td>
                            <td>33</td>
                            <td>{{ $result->rel_wrt }}</td>
                            <td>{{ $result->rel_mcq }}</td>
                            <td></td>
                            <td>{{ $result->rel_total }}</td>
                            <td>{{ $result->rel_gp }}</td>
                            <td>{{ $result->rel_grade }}</td>   
                        </tr>
                        @if($result->section_id == 1)
                        <tr>
                            <td>6</td>
                            <td>Introduction of Bangladesh & World</td>
                            <td>100</td>
                            <td>33</td>
                            <td>{{ $result->bwi_wrt }}</td>
                            <td>{{ $result->bwi_mcq }}</td>
                            <td></td>
                            <td>{{ $result->bwi_total }}</td>
                            <td>{{ $result->bwi_gp }}</td>
                            <td>{{ $result->bwi_grade }}</td>   
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Physics</td>
                            <td>100</td>
                            <td style="vertical-align: middle; text-align: center;">33(17+8+8)</td>
                            <td>{{ $result->phy_wrt }}</td>
                            <td>{{ $result->phy_mcq }}</td>
                            <td>{{ $result->phy_prac }}</td>
                            <td>{{ $result->phy_total }}</td>
                            <td>{{ $result->phy_gp }}</td>
                            <td>{{ $result->phy_grade }}</td>   
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Chemistry</td>
                            <td>100</td>
                            <td style="vertical-align: middle; text-align: center;">33(17+8+8)</td>
                            <td>{{ $result->che_wrt }}</td>
                            <td>{{ $result->che_mcq }}</td>
                            <td>{{ $result->che_prac }}</td>
                            <td>{{ $result->che_total }}</td>
                            <td>{{ $result->che_gp }}</td>
                            <td>{{ $result->che_grade }}</td>   
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Biology</td>
                            <td>100</td>
                            <td style="vertical-align: middle; text-align: center;">33(17+8+8)</td>
                            <td>{{ $result->bio_wrt }}</td>
                            <td>{{ $result->bio_mcq }}</td>
                            <td>{{ $result->bio_prac }}</td>
                            <td>{{ $result->bio_total }}</td>
                            <td>{{ $result->bio_gp }}</td>
                            <td>{{ $result->bio_grade }}</td>   
                        </tr>
                        @endif
<!--*********** Addablae GP  ***************-->
                        <?php 
                            $remainGP = $result->optional_gp - 2;
                            if ($remainGP > 0) {
                                $addableGP = $remainGP;
                            } else {
                                $addableGP = 0;
                            }
                        ?>

                        <tr>
                            <td>10</td>
                            <td>Optional Subject</td>
                            <td>100</td>
                            <td colspan="4" style="vertical-align: middle; text-align: center;">{{ $result->optional_note }}</td>
                            
                            <td>{{ $result->optional_total }}</td>
                            <td>{{ $result->optional_gp }}</td>
                            <td>{{ $result->optional_grade }}</td>   
                            <td><small>Addable GP:</small>{{ number_format($addableGP, 2) }}</td>   
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
    <div class="row">
        <div class="col-xs-6">
            <div>
                {{ Html::image('/images/signature.jpg', 'alt', ['width' => 200, 'height' => 50]) }}
            </div>
            <div class="pull-left">
                <h4 class="">Head Master</h4>
                <p class="">Bara Moheshkhali Girls' High School</p>
            </div>
            
            <!-- <p>Software Developed by <strong>Mohsin Iqbal</strong></p> -->
        </div>
        <div class="col-xs-6">
            <div style="margin-top: 70px;"></div>
            <h4 class="pull-right">Signature and date of guardian</h4>
        </div>
    </div>
    <center><p>&copy; 2017, Software Developed by <strong>Mohsin Iqbal</strong></p></center>
    <input type="button" class="no-print btn btn-primary" value="Print this page" onClick="window.print()">
@endsection