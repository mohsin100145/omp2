<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Title -->
        <title>Result Processing System</title>

        <link href="{{ asset('css/bootstrap-3.3.7.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('css/font-awesome-4.7.0.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('css/animate-3.5.2.min.css') }}" rel="stylesheet" media="all">
        <!-- Bootstrap bootstrap-touch-slider Slider Main Style Sheet -->
        <link href="{{ asset('css/bootstrap-touch-slider.css') }}" rel="stylesheet" media="all">

    </head>

    <body>


        <!--  
        If you want to change #bootstrap-touch-slider id then you have to change Carousel-indicators and Carousel-Control  #bootstrap-touch-slider slide as well
        Slide effect: slide, fade
        Text Align: slide_style_center, slide_style_left, slide_style_right
        Add animation in text: https://daneden.github.io/animate.css/
        
        
        -->

        <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#bootstrap-touch-slider" data-slide-to="0" class="active"></li>
                <li data-target="#bootstrap-touch-slider" data-slide-to="1"></li>
                <li data-target="#bootstrap-touch-slider" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">

                <!-- Third Slide -->
                <div class="item active">

                    <!-- Slide Background -->
                    <img src="{{ asset('images/slide1.jpg') }}" alt="Bootstrap Touch Slider"  class="slide-image"/>
                    <div class="bs-slider-overlay"></div>

                    <div class="container">
                        <div class="row">
                            <!-- Slide Text Layer -->
                            <div class="slide-text slide_style_left">
                                <h1 data-animation="animated zoomInRight">Bara Moheshkhali Girls' High School</h1>
                                <p data-animation="animated fadeInLeft">Bara Moheshkhali, Moheshkhali, Cox's Bazar.</p>
                                @if (Route::has('login'))
				                    @if (Auth::check())
				                        <a href="{!! url('/home') !!}" class="btn btn-default" data-animation="animated fadeInLeft">Home</a>
                                		<a href="{!! url('/result') !!}" class="btn btn-primary" data-animation="animated fadeInRight">result</a>
				                    @else
				                        <a href="{!! url('/login') !!}" class="btn btn-default" data-animation="animated fadeInLeft">Click Me To Log In</a>
                                		<a href="#" class="btn btn-primary" data-animation="animated fadeInRight">registration</a>
				                    @endif
				            	@endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Slide -->

                <!-- Second Slide -->
                <div class="item">

                    <!-- Slide Background -->
                    <img src="{{ asset('images/slide2.jpg') }}" alt="Bootstrap Touch Slider"  class="slide-image"/>
                    <div class="bs-slider-overlay"></div>
                    <!-- Slide Text Layer -->
                    <div class="slide-text slide_style_center">
                        <h1 data-animation="animated flipInX">Students of BMGHS</h1>
                        <p data-animation="animated lightSpeedIn">Students of BMGHS.</p>
                        @if (Route::has('login'))
		                    @if (Auth::check())
		                        <a href="{!! url('/home') !!}" class="btn btn-default" data-animation="animated fadeInUp">home</a>
                        		<a href="{!! url('/result') !!}" class="btn btn-primary" data-animation="animated fadeInDown">result</a>
		                    @else
		                        <a href="{!! url('/login') !!}" class="btn btn-default" data-animation="animated fadeInUp">click me to log in</a>
                        		<a href="#" class="btn btn-primary" data-animation="animated fadeInDown">registration</a>
		                    @endif
		            	@endif                      
                    </div>
                </div>
                <!-- End of Slide -->

                <!-- Third Slide -->
                <div class="item">

                    <!-- Slide Background -->
                    <img src="{{ asset('images/slide3.jpg') }}" alt="Bootstrap Touch Slider"  class="slide-image"/>
                    <div class="bs-slider-overlay"></div>
                    <!-- Slide Text Layer -->
                    <div class="slide-text slide_style_right">
                        <h1 data-animation="animated zoomInLeft">BMGHS observing National Mourning Day</h1>
                        <p data-animation="animated fadeInRight">BMGHS observing National Mourning Day .</p>
                        @if (Route::has('login'))
		                    @if (Auth::check())
		                        <a href="{!! url('/home') !!}" class="btn btn-default" data-animation="animated fadeInLeft">home</a>
                        		<a href="{!! url('/result') !!}" class="btn btn-primary" data-animation="animated fadeInRight">result</a>
		                    @else
		                        <a href="{!! url('/login') !!}" class="btn btn-default" data-animation="animated fadeInLeft">click me to log in</a>
                        		<a href="#" class="btn btn-primary" data-animation="animated fadeInRight">registration</a>
		                    @endif
		            	@endif
                    </div>
                </div>
                <!-- End of Slide -->


            </div><!-- End of Wrapper For Slides -->

            <!-- Left Control -->
            <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
                <span class="fa fa-angle-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <!-- Right Control -->
            <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
                <span class="fa fa-angle-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div> <!-- End  bootstrap-touch-slider Slider -->


        
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-3.3.7.min.js') }}"></script>
        <script src="{{ asset('js/touchSwipe-1.6.18.min.js') }}"></script>

        <!-- Bootstrap bootstrap-touch-slider Slider Main JS File -->
        <script src="{{ asset('js/bootstrap-touch-slider.js') }}"></script>
        
        <script type="text/javascript">
            $('#bootstrap-touch-slider').bsTouchSlider();
        </script>

    </body>

</html>

<!-- End -->