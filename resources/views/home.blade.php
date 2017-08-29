@extends('layouts.app')

@section('content')
<div class="container">
<style type="text/css">
    
  </style>
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-primary">
                <div class="panel-heading">Dashboard</div>

                <!-- <div class="panel-body" style="background-color: #ecf0f5"> -->
                <!-- <div class="panel-body" style="background-color: rebeccapurple"> -->
                <div class="panel-body" style="background-color: #c3bdca">
                    <div class="container1">
                        <div id="carousel">
                            <figure><img src="{{ asset('images/rotate_img1.jpg') }}" alt=""></figure>
                            <figure><img src="{{ asset('images/rotate_img2.jpg') }}" alt=""></figure>
                            <figure><img src="{{ asset('images/rotate_img3.jpg') }}" alt=""></figure>
                            <figure><img src="{{ asset('images/rotate_img4.jpg') }}" alt=""></figure>
                            <figure><img src="{{ asset('images/rotate_img5.jpg') }}" alt=""></figure>
                            <figure><img src="{{ asset('images/rotate_img6.jpg') }}" alt=""></figure>
                            <figure><img src="{{ asset('images/rotate_img7.jpg') }}" alt=""></figure>
                            <figure><img src="{{ asset('images/rotate_img8.jpg') }}" alt=""></figure>
                            <figure><img src="{{ asset('images/rotate_img9.jpg') }}" alt=""></figure>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text" style="font-size: 18px;">VI Students</span>
                                    <span class="info-box-number" style="font-size: 33px;">{{ $sixStudents }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-user-circle"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text" style="font-size: 18px;">VII Students</span>
                                    <span class="info-box-number" style="font-size: 33px;">{{ $sevenStudents }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-user-o"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text" style="font-size: 18px;">VIII Students</span>
                                    <span class="info-box-number" style="font-size: 33px;">{{ $eightStudents }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-user-circle-o"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text" style="font-size: 18px;">IX Students</span>
                                    <span class="info-box-number" style="font-size: 33px;">{{ $nineStudents }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- =========================================================== -->

                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-user-plus"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text" style="font-size: 18px;">X Students</span>
                              <span class="info-box-number" style="font-size: 33px;">{{ $tenStudents }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-user-secret"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text" style="font-size: 16px;">Total Students</span>
                              <span class="info-box-number" style="font-size: 33px;">{{ $totalStudents }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-area-chart"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text" style="font-size: 18px;">VI Results</span>
                              <span class="info-box-number" style="font-size: 33px;">{{ $sixResults }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text" style="font-size: 18px;">VII Results</span>
                              <span class="info-box-number" style="font-size: 33px;">{{ $sevenResults }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- =========================================================== -->

                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-bar-chart"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text" style="font-size: 18px;">VIII Results</span>
                              <span class="info-box-number" style="font-size: 33px;">{{ $eightResults }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-file-text"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text" style="font-size: 18px;">IX Results</span>
                              <span class="info-box-number" style="font-size: 33px;">{{ $nineResults }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text" style="font-size: 18px;">X Results</span>
                              <span class="info-box-number" style="font-size: 33px;">{{ $tenResults }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-clipboard"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text" style="font-size: 18px;">Total Results</span>
                              <span class="info-box-number" style="font-size: 33px;">{{ $totalResults }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- =========================================================== -->

                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa fa-file-o"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text" style="font-size: 18px;">Classes</span>
                              <span class="info-box-number" style="font-size: 33px;">{{ $levels }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa fa-outdent"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text" style="font-size: 18px;">Sections</span>
                              <span class="info-box-number" style="font-size: 33px;">{{ $sections }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text" style="font-size: 18px;">Groups</span>
                              <span class="info-box-number" style="font-size: 33px;">{{ $groups }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa fa-file"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text" style="font-size: 18px;">Terms</span>
                              <span class="info-box-number" style="font-size: 33px;">{{ $terms }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- =========================================================== -->
                    
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <!-- small box -->
                          <div class="small-box bg-aqua" style="background-color: #008080 !important;">
                            <div class="inner">
                              <h3>{{ date('d/m/Y') }}</h3>

                              <p>Something something</p>
                            </div>
                            <div class="icon">
                              <i class="fa fa-hand-o-right"></i>
                            </div>
                            
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <!-- small box -->
                          <div class="small-box bg-aqua" style="background-color: #008080 !important;">
                            <div class="inner">
                              <!-- <h3>00<sup style="font-size: 20px">%</sup></h3> -->
                              <h3>{{ date('Y') }}</h3>

                              <p>Nothing nothing</p>
                            </div>
                            <div class="icon">
                              <i class="fa fa-address-card"></i>
                            </div>
                            
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <!-- small box -->
                          <div class="small-box bg-aqua" style="background-color: #008080 !important;">
                            <div class="inner">
                              <h3>{{ date('Y') }}</h3>

                              <p>Something something</p>
                            </div>
                            <div class="icon">
                              <i class="fa fa-address-card-o"></i>
                            </div>
                            
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <!-- small box -->
                          <div class="small-box bg-aqua" style="background-color: #008080 !important;">
                            <div class="inner">
                              <h3>{{ date('Y') }}</h3>

                              <p>Nothing nothing</p>
                            </div>
                            <div class="icon">
                              <i class="fa fa-users"></i>
                            </div>
                            
                          </div>
                        </div>
                        <!-- ./col -->
                      </div>
                      <!-- /.row -->

                      <!-- =========================================================== -->

                    <!-- <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="circle-tile ">
                            <a href="#"><div class="circle-tile-heading green"><i class="fa fa-share fa-fw fa-3x"></i></div></a>
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded"> <h3 style="margin-top: 0; margin-bottom: 0;"> New </h3> </div>
                                <div class="circle-tile-number text-faded" id="new_total">50</div>
                                
                            </div>
                          </div>
                        </div>
                     
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="circle-tile ">
                            <a href="index.php/ticket_dashboard/show_pending"><div class="circle-tile-heading red"><i class="fa fa-clock-o fa-fw fa-3x"></i></div></a>
                            <div class="circle-tile-content red">
                                  <div class="circle-tile-description text-faded"> <h3 style="margin-top: 5px; margin-bottom: 5px;"> Pending </h3> </div>
                                  <div class="circle-tile-number text-faded" id="pending_total">70</div>
                                  
                              </div>
                            </div>
                        </div> 

                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="circle-tile ">
                            <a href="index.php/ticket_dashboard/show_answered"><div class="circle-tile-heading dark-blue"><i class="fa fa-reply fa-fw fa-3x"></i></div></a>
                                <div class="circle-tile-content dark-blue">
                                  <div class="circle-tile-description text-faded"> <h3 style="margin-top: 0; margin-bottom: 0;"> Answered </h3></div>
                                  <div class="circle-tile-number text-faded" id="answered_total">100</div>
                                  
                              </div>
                          </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <div class="circle-tile ">
                            <a href="index.php/ticket_dashboard/show_new"><div class="circle-tile-heading green"><i class="fa fa-share fa-fw fa-3x"></i></div></a>
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded"> <h3 style="margin-top: 0; margin-bottom: 0;"> New </h3> </div>
                                <div class="circle-tile-number text-faded" id="new_total">50</div>
                                
                            </div>
                          </div>
                        </div> -->
                                <!-- /.col -->
                      <!-- </div> -->
                                 <!-- /.row -->

                      <!-- =========================================================== -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="">
    <iframe src="{{ asset('/') }}" height="382" width="100%"></iframe>
</div> -->
@endsection

@section('style')
<link href="{{ asset('css/rotate_img.css') }}" rel="stylesheet">
<link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/style_dash.css') }}" rel="stylesheet">
@endsection
