@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title text-center"><i class="fa fa-pencil"></i> Result Creation form for class <code><b>Six</b></code> to <code><b>Eight</b></code></h3>
			</div>
			<div class="panel-body">
		  		@include('six_to_eight_result._form')
			</div>
		</div>
	</div>
</div>		
@endsection

@section('script')
<script src="{{ asset('js/text-only-number.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#student_id").blur(function() {
			var studentId = $("#student_id").val();
			var url = '{{ url("/six-to-eight-result/student-info-show")}}';
			$.get(url+'?student_id='+studentId, function (data) {
	            $('#student_info_show').html(data);
	        });
		});
	});
</script>	
@endsection