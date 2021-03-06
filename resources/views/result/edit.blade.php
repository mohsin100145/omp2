@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-pencil"></i> Result Update</h3>
	</div>
	<div class="panel-body">
  		@include('result._form')
	</div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/text-only-number.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#student_id").blur(function() {
			var studentId = $("#student_id").val();
			var url = '{{ url("/result/student-info-show")}}';
			console.log(url);
			$.get(url+'?student_id='+studentId, function (data) {
	            $('#student_info_show').html(data);
	        });
		});
	});
</script>

<script>
	$(document).ready(function(){
	    $("#science_btn").click(function(){
	        //$("#science_div").fadeToggle();
	        //$("#science_div").fadeToggle("slow");
	        $("#humanities_div").fadeOut(2000);
	        $("#business_div").fadeOut(2000);
	        $("#gs_div").fadeOut(2000);
	    });
	    $("#humanities_btn").click(function(){
	        $("#science_div").fadeOut(2000);
	        $("#business_div").fadeOut(2000);
	    });
	    $("#business_btn").click(function(){
	        $("#science_div").fadeOut(2000);
	        $("#humanities_div").fadeOut(2000);
	    });
	});
</script>

<script>
	function validateForm() {
	    var optionalTotal = document.forms["myForm"]["optional_total"].value;
	    var optionalGp = document.forms["myForm"]["optional_gp"].value;
	    if ( (optionalTotal != "") && (optionalGp == "") || (optionalTotal == "") && (optionalGp != "") ) {
	        alert("Total Mark & GP of Optional Subject both must be filled out");
		    return false;   
	    }
	}
</script>
@endsection