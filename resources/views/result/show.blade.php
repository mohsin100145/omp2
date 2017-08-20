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
            <div class="col-xs-1"></div>
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
                    <tr>
                        <td style="border: none; width: 110px;">Group:</td>
                        <td style="border: none;"><strong>{{ $result->student->group->name }}</strong></td>
                    </tr>
                </table>
            </div>
            <div class="col-xs-3">
                <div class="pull-right">
                @if($result->student->image == null)
                    {{ Html::image('/images/student_avatar.jpg', 'No Picture', ['width' => 150, 'height' => 150]) }}
                    <div>(Picture not uploaded)</div>
                @else
                    {{ Html::image('/uploads/' . $result->student->image, 'No Picture', ['width' => 150, 'height' => 150]) }}
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
                            <th>Pass Mark</th>
                            <th>Written</th>
                            <th>MCQ</th>
                            @if ($result->group_id == 1)
                                <th>Prac- tical</th>
                            @endif
                            <th>Get Mark</th>
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
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">66</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->ban_1st_wrt }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->ban_1st_mcq }}</td>
                            @if ($result->group_id == 1)
                                <td></td>
                            @endif
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->ban_total }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->ban_gp }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->ban_grade }}</td>
                            <td rowspan="10" style="vertical-align: middle; text-align: center;">{{ number_format($result->gpa_except_optional, 2) }}</td>
                            <td rowspan="11" style="vertical-align: middle; text-align: center;"><b>{{  number_format($GPA, 2) }} <br> ({{ $result->grade }} grade)<br> {{ $result->status }}</b></td>
                            <td rowspan="11" style="vertical-align: middle; text-align: center;">{{ $result->marks_total_with_optional }}</td>
                            @if($result->fail_subjects > 0)
                                <td rowspan="11" style="vertical-align: middle; text-align: center;"><b>{{ $result->fail_subjects }}</b></td>
                            @endif
                        </tr>
                        <tr>
                            
                            <td>Bangla Second Peper</td>
                            <td style="vertical-align: middle; text-align: center;">100</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->ban_2nd_wrt }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->ban_2nd_mcq }}</td>
                            @if ($result->group_id == 1)
                                <td></td>
                            @endif
                        </tr>
                        <tr>
                            <td rowspan="2" style="vertical-align: middle; text-align: center;">2</td>
                            <td>English First Peper</td>
                            <td style="vertical-align: middle; text-align: center;">100</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">66</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->eng_1st }}</td>
                            <td></td>
                            @if ($result->group_id == 1)
                                <td></td>
                            @endif
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->eng_total }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->eng_gp }}</td>
                            <td style="vertical-align: middle; text-align: center;" rowspan="2">{{ $result->eng_grade }}</td>
                        </tr>
                        <tr>
                            
                            <td>English Second Peper</td>
                            <td style="vertical-align: middle; text-align: center;">100</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->eng_2nd }}</td>
                            <td></td>
                            @if ($result->group_id == 1)
                                <td></td>
                            @endif
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: center;">3</td>
                            <td>Mathematics</td>
                            <td style="vertical-align: middle; text-align: center;">100</td>
                            <td style="vertical-align: middle; text-align: center;">33 (23+10)</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->math_wrt }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->math_mcq }}</td>
                            @if ($result->group_id == 1)
                                <td></td>
                            @endif
                            <td style="vertical-align: middle; text-align: center;">{{ $result->math_total }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->math_gp }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->math_grade }}</td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: center;">4</td>
                            <td>Religion Studies</td>
                            <td style="vertical-align: middle; text-align: center;">100</td>
                            <td style="vertical-align: middle; text-align: center;">33</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->rel_wrt }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->rel_mcq }}</td>
                            @if ($result->group_id == 1)
                                <td></td>
                            @endif
                            <td style="vertical-align: middle; text-align: center;">{{ $result->rel_total }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->rel_gp }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->rel_grade }}</td>   
                        </tr>
                        @if($result->group_id == 1)
                            <tr>
                                <td style="vertical-align: middle; text-align: center;">5</td>
                                <td>Introduction of Bangladesh & World</td>
                                <td style="vertical-align: middle; text-align: center;">100</td>
                                <td style="vertical-align: middle; text-align: center;">33</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bwi_wrt }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bwi_mcq }}</td>
                                <td></td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bwi_total }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bwi_gp }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bwi_grade }}</td>   
                            </tr>
                            <tr>
                                <td style="vertical-align: middle; text-align: center;">6</td>
                                <td>Physics</td>
                                <td style="vertical-align: middle; text-align: center;">100</td>
                                <td style="vertical-align: middle; text-align: center;">33(17+8+8)</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->phy_wrt }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->phy_mcq }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->phy_prac }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->phy_total }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->phy_gp }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->phy_grade }}</td>   
                            </tr>
                            <tr>
                                <td style="vertical-align: middle; text-align: center;">7</td>
                                <td>Chemistry</td>
                                <td style="vertical-align: middle; text-align: center;">100</td>
                                <td style="vertical-align: middle; text-align: center;">33(17+8+8)</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->che_wrt }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->che_mcq }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->che_prac }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->che_total }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->che_gp }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->che_grade }}</td>   
                            </tr>
                            <tr>
                                <td style="vertical-align: middle; text-align: center;">8</td>
                                <td>Biology</td>
                                <td style="vertical-align: middle; text-align: center;">100</td>
                                <td style="vertical-align: middle; text-align: center;">33(17+8+8)</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bio_wrt }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bio_mcq }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bio_prac }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bio_total }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bio_gp }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bio_grade }}</td>   
                            </tr>
                        @endif

                        @if ($result->group_id == 2)
                            <tr>
                                <td style="vertical-align: middle; text-align: center;">5</td>
                                <td>General Science</td>
                                <td style="vertical-align: middle; text-align: center;">100</td>
                                <td style="vertical-align: middle; text-align: center;">33</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->gs_wrt }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->gs_mcq }}</td>
                                @if ($result->group_id == 1)
                                    <td></td>
                                @endif
                                <td style="vertical-align: middle; text-align: center;">{{ $result->gs_total }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->gs_gp }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->gs_grade }}</td>   
                            </tr>
                            <tr>
                                <td style="vertical-align: middle; text-align: center;">6</td>
                                <td>History</td>
                                <td style="vertical-align: middle; text-align: center;">100</td>
                                <td style="vertical-align: middle; text-align: center;">33</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->his_wrt }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->his_mcq }}</td>
                                @if ($result->group_id == 1)
                                    <td></td>
                                @endif
                                <td style="vertical-align: middle; text-align: center;">{{ $result->his_total }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->his_gp }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->his_grade }}</td>   
                            </tr>
                            <tr>
                                <td style="vertical-align: middle; text-align: center;">7</td>
                                <td>Civics</td>
                                <td style="vertical-align: middle; text-align: center;">100</td>
                                <td style="vertical-align: middle; text-align: center;">33</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->civ_wrt }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->civ_mcq }}</td>
                                @if ($result->group_id == 1)
                                    <td></td>
                                @endif
                                <td style="vertical-align: middle; text-align: center;">{{ $result->civ_total }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->civ_gp }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->civ_grade }}</td>   
                            </tr>
                            <tr>
                                <td style="vertical-align: middle; text-align: center;">8</td>
                                <td>Geography</td>
                                <td style="vertical-align: middle; text-align: center;">100</td>
                                <td style="vertical-align: middle; text-align: center;">33</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->geo_wrt }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->geo_mcq }}</td>
                                @if ($result->group_id == 1)
                                    <td></td>
                                @endif
                                <td style="vertical-align: middle; text-align: center;">{{ $result->geo_total }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->geo_gp }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->geo_grade }}</td>   
                            </tr>
                        @endif

                        @if ($result->group_id == 3)
                            <tr>
                                <td style="vertical-align: middle; text-align: center;">5</td>
                                <td>General Science</td>
                                <td style="vertical-align: middle; text-align: center;">100</td>
                                <td style="vertical-align: middle; text-align: center;">33</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->gs_wrt }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->gs_mcq }}</td>
                                @if ($result->group_id == 1)
                                    <td></td>
                                @endif
                                <td style="vertical-align: middle; text-align: center;">{{ $result->gs_total }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->gs_gp }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->gs_grade }}</td>   
                            </tr>
                            <tr>
                                <td style="vertical-align: middle; text-align: center;">6</td>
                                <td>Accounting</td>
                                <td style="vertical-align: middle; text-align: center;">100</td>
                                <td style="vertical-align: middle; text-align: center;">33</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->acc_wrt }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->acc_mcq }}</td>
                                @if ($result->group_id == 1)
                                    <td></td>
                                @endif
                                <td style="vertical-align: middle; text-align: center;">{{ $result->acc_total }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->acc_gp }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->acc_grade }}</td>   
                            </tr>
                            <tr>
                                <td style="vertical-align: middle; text-align: center;">7</td>
                                <td>Finance and Banking</td>
                                <td style="vertical-align: middle; text-align: center;">100</td>
                                <td style="vertical-align: middle; text-align: center;">33</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->fin_wrt }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->fin_mcq }}</td>
                                @if ($result->group_id == 1)
                                    <td></td>
                                @endif
                                <td style="vertical-align: middle; text-align: center;">{{ $result->fin_total }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->fin_gp }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->fin_grade }}</td>   
                            </tr>
                            <tr>
                                <td style="vertical-align: middle; text-align: center;">8</td>
                                <td>Business</td>
                                <td style="vertical-align: middle; text-align: center;">100</td>
                                <td style="vertical-align: middle; text-align: center;">33</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bus_wrt }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bus_mcq }}</td>
                                @if ($result->group_id == 1)
                                    <td></td>
                                @endif
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bus_total }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bus_gp }}</td>
                                <td style="vertical-align: middle; text-align: center;">{{ $result->bus_grade }}</td>   
                            </tr>
                        @endif
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
                            <td colspan="3" style="vertical-align: middle; text-align: center;">{{ $result->optional_note }}</td>
                            @if ($result->group_id == 1)
                                <td></td>
                            @endif
                            <td style="vertical-align: middle; text-align: center;">{{ $result->optional_total }}</td>
                            <td style="vertical-align: middle; text-align: center;">{{ $result->optional_gp }}</td>
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
            <h4 class="pull-right">Signature and date of guardian</h4>
        </div>
    </div>
    <center><p>&copy; 2017, Software Developed by <strong>Mohsin Iqbal</strong></p></center>
    <input type="button" class="no-print btn btn-primary" value="Print this page" onClick="window.print()">
@endsection