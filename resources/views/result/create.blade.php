@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-pencil"></i> Panel Heading</h3>
    </div>
    <div class="panel-body">
      @include('result._form')
    </div>
  </div>
</div>
@endsection

@section('script')
	<script src="{{ asset('js/text-only-number.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#student_id_search").click(function() {
				var studentId = $("#student_id").val();
				console.log(studentId);
			});
		});
	</script>
@endsection