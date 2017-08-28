@extends('layouts.app')

@section('content')
<div class="container">
<style type="text/css">
    /*@import url(http://fonts.googleapis.com/css?family=Anaheim);*/

    *{
      margin: 0;
      padding: 0;
      outline: none;
      border: none;
        box-sizing: border-box;
    }
    *:before,
    *:after{
        box-sizing: border-box;
    }
    html,
    body{
      min-height: 100%;
    }
    body{
      background-image: radial-gradient(mintcream 0%, lightgray 100%);
    }
    h1{
      display: table;
      margin: 5% auto 0;
      text-transform: uppercase;
      font-family: 'Anaheim', sans-serif;
      font-size: 4em;
      font-weight: 400;
      text-shadow: 0 1px white, 0 2px black;
    }
    .container1{
      margin: 4% auto;
      width: 210px;
      height: 140px;
      position: relative;
      perspective: 1000px;
    }
    #carousel{
      width: 100%;
      height: 100%;
      position: absolute;
      transform-style: preserve-3d;
      animation: rotation 20s infinite linear;
    }
    #carousel:hover{
      animation-play-state: paused;
    }
    #carousel figure{
      display: block;
      position: absolute;
      width: 90%;
      height: 50%px;
      left: 10px;
      top: 10px;
      background: black;
      overflow: hidden;
      border: solid 5px black;
    }
    #carousel figure:nth-child(1){transform: rotateY(0deg) translateZ(288px);}
    #carousel figure:nth-child(2) { transform: rotateY(40deg) translateZ(288px);}
    #carousel figure:nth-child(3) { transform: rotateY(80deg) translateZ(288px);}
    #carousel figure:nth-child(4) { transform: rotateY(120deg) translateZ(288px);}
    #carousel figure:nth-child(5) { transform: rotateY(160deg) translateZ(288px);}
    #carousel figure:nth-child(6) { transform: rotateY(200deg) translateZ(288px);}
    #carousel figure:nth-child(7) { transform: rotateY(240deg) translateZ(288px);}
    #carousel figure:nth-child(8) { transform: rotateY(280deg) translateZ(288px);}
    #carousel figure:nth-child(9) { transform: rotateY(320deg) translateZ(288px);}

    img{
      -webkit-filter: grayscale(0);
      cursor: pointer;
      transition: all .5s ease;
    }
    img:hover{
      -webkit-filter: grayscale(0);
      transform: scale(1.2,1.2);
    }

    @keyframes rotation{
      from{
        transform: rotateY(0deg);
      }
      to{
        transform: rotateY(360deg);
      }
    }
  </style>
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
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
            <span class="info-box-icon bg-aqua"><i class="fa fa-phone"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Messages</span>
              <span class="info-box-number">1,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-phone-square"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Bookmarks</span>
              <span class="info-box-number">410</span>
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
              <span class="info-box-text">Uploads</span>
              <span class="info-box-number">13,648</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-volume-control-phone"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">93,139</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
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
