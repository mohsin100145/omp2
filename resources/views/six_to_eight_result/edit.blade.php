@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-pencil"></i> Result Update</h3>
	</div>
	<div class="panel-body">
  		@include('six_to_eight_result._form')
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
			console.log(url);
			$.get(url+'?student_id='+studentId, function (data) {
	            $('#student_info_show').html(data);
	        });
		});
	});
</script>
@endsection