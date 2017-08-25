@extends('layouts.app')

@section('content')
    <style>
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
                    {{ Html::image('/images/logo.jpg', 'No Logo', ['width' => 100, 'height' => 100]) }}
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
                        <td style="border: 0; width: 110px;">Student Name:</td>
                        <td style="border: none;"><strong>{{ $result->student->name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 110px;">Roll No.:</td>
                        <td style="border: 0;"><strong>{{ $result->student->roll_no }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 110px;">Class:</td>
                        <td  style="border: 0;"><strong>{{ $result->student->level->name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 110px;">Section:</td>
                        <td style="border: 0;"><strong>{{ $result->student->section->name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 110px;">Term:</td>
                        <td style="border: 0;"><strong>{{ $result->term->name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 110px;">Year:</td>
                        <td style="border: 0;"><strong>{{ $result->student->year->year }}</strong></td>
                    </tr>
                </table>
            </div>
            <div class="col-xs-4">
                <table class="table table-condensed">
                    <tr>
                        <td style="border: 0; width: 110px;">Father's Name:</td>
                        <td style="border: 0;"><strong>{{ $result->student->father_name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 110px;">Mother's Name:</td>
                        <td style="border: 0;"><strong>{{ $result->student->mother_name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 110px;">Address:</td>
                        <td style="border: 0;"><strong>{{ $result->student->address }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 0; width: 110px;">Student ID:</td>
                        <td style="border: 0;"><strong>{{ $result->student->id }}</strong></td>
                    </tr>
                </table>
            </div>
            <div class="col-xs-1"></div>
            <div class="col-xs-3">
                <div class="pull-right">
                @if($result->student->image == null)
                    {{ Html::image('/images/student_avatar.jpg', 'No Picture', ['width' => 130, 'height' => 150]) }}
                    <div>(Picture not uploaded)</div>
                @else
                    {{ Html::image('/uploads/' . $result->student->image, 'No Picture', ['width' => 130, 'height' => 150]) }}
                @endif
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
                            <th>Mark</th>
                            <th>Pass Mark (%)</th>
                            <th>Get Mark</th>
                            <th>Get Mark(%)</th>
                            <th>GP</th>
                            <th>Grade</th>
                            <th>GPA <strike>(Opt)</strike></th>
                            <th style="width: 125px;">GPA (Opt)</th>
                            <th>Total Marks</th>
                            @if($result->fail_subjects > 0)
                                <th>Fail Sub.</th>
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
                            <td rowspan="2" style="vertical-align: middle; text-align: center;">1</td>
                            <td>Bangla First Peper</td>
                            <td style="vertical-align: middle; text-align: center;">100</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">50 (33.33%)</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->ban_1st }}</td>
                            
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->ban_percentage."%" }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ number_format($result->ban_gp, 2) }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->ban_grade }}</td>
                            <td rowspan="12" style="vertical-align: middle; text-align: center;">{{ number_format($result->gpa_except_optional, 2) }}</td>
                            <td rowspan="13" style="vertical-align: middle; text-align: center;"><b>{{ number_format($GPA, 2) }} <br> ({{ $result->grade }} grade)<br> {{ $result->status }}</b></td>
                            <td rowspan="13" style="vertical-align: middle; text-align: center;">{{ $result->marks_total }}</td>
                            @if($result->fail_subjects > 0)
                                <td rowspan="13" style="vertical-align: middle; text-align: center;"><b>{{ $result->fail_subjects }}</b></td>
                            @endif
                        </tr>
                        <tr> 
                            <td>Bangla Second Peper</td>
                            <td style="vertical-align: middle; text-align: center;">50</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->ban_2nd }}</td>
                        </tr>
                        <tr>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;">2</td>
                            <td>English First Peper</td>
                            <td style="vertical-align: middle; text-align: center;">100</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">50 (33.33%)</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->eng_1st }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->eng_percentage."%" }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ number_format($result->eng_gp, 2) }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->eng_grade }}</td>
                        </tr>
                        <tr>
                            
                            <td>English Second Peper</td>
                            <td style="vertical-align: middle; text-align: center;">50</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->eng_2nd }}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: center;">3</td>
                            <td>Mathematics</td>
                            <td style="vertical-align: middle; text-align: center;">100</td>
                            <td style="vertical-align: middle; text-align: center;">33 (33%)</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->math }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->math_percentage."%" }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ number_format($result->math_gp, 2) }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->math_grade }}</td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: center;">4</td>
                            <td>General Science</td>
                            <td style="vertical-align: middle; text-align: center;">100</td>
                            <td style="vertical-align: middle; text-align: center;">33 (33%)</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->science }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->science_percentage."%" }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ number_format($result->science_gp, 2) }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->science_grade }}</td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: center;">5</td>
                            <td>Introduce of Bangladesh & World</td>
                            <td style="vertical-align: middle; text-align: center;">100</td>
                            <td style="vertical-align: middle; text-align: center;">33 (33%)</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->bangladesh }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->bangladesh_percentage."%" }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ number_format($result->bangladesh_gp, 2) }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->bangladesh_grade }}</td>   
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: center;">6</td>
                            <td>Religion & Moral Studies</td>
                            <td style="vertical-align: middle; text-align: center;">100</td>
                            <td style="vertical-align: middle; text-align: center;">33 (33%)</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->religion }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->religion_percentage."%" }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ number_format($result->religion_gp, 2) }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->religion_grade }}</td>   
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: center;">7</td>
                            <td>ICT</td>
                            <td style="vertical-align: middle; text-align: center;">50</td>
                            <td style="vertical-align: middle; text-align: center;">17 (34%)</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->ict }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->ict_percentage."%" }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ number_format($result->ict_gp, 2) }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->ict_grade }}</td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: center;">8</td>
                            <td>Work & Life Oriented Studies</td>
                            <td style="vertical-align: middle; text-align: center;">50</td>
                            <td style="vertical-align: middle; text-align: center;">17 (34%)</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->work }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->work_percentage."%" }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ number_format($result->work_gp, 2) }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->work_grade }}</td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: center;">9</td>
                            <td>Physical Studies & Health</td>
                            <td style="vertical-align: middle; text-align: center;">50</td>
                            <td style="vertical-align: middle; text-align: center;">17 (34%)</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->physical }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->physical_percentage."%" }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ number_format($result->physical_gp, 2) }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->physical_grade }}</td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: center;">10</td>
                            <td>Arts & Crafts</td>
                            <td style="vertical-align: middle; text-align: center;">50</td>
                            <td style="vertical-align: middle; text-align: center;">17 (34%)</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->arts }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->arts_percentage."%" }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ number_format($result->arts_gp, 2) }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->arts_grade }}</td> 
                        </tr>
                                           
<!--*********** Addable GP  ***************-->
                        <?php 
                            $remainGP = $result->optional_gp - 2;
                            if ($remainGP > 0) {
                                $addableGP = $remainGP;
                            } else {
                                $addableGP = 0;
                            }
                        ?>

                        <tr>
                            <td></td>
                            <td>Optional Subject</td>
                            <td style="vertical-align: middle; text-align: center;">100</td>
                            <td style="vertical-align: middle; text-align: center;"></td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->optional }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->optional_percentage."%" }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ number_format($result->optional_gp, 2) }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->optional_grade }}</td>   
                            <td style="vertical-align: middle; text-align: center;"><small>Addable GP:</small>{{ number_format($addableGP, 2) }}</td>   
                        </tr>

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
            <h4 class="pull-right">Signature of guardian (with date)</h4>
        </div>
    </div>
    <center><p>&copy; 2017, Software Developed by <strong>Mohsin Iqbal</strong></p></center>
    <input type="button" class="no-print btn btn-primary" value="Print this page" onClick="window.print()">
@endsection