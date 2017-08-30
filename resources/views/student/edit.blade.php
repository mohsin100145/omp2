@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-edit"></i> Student Update</h3>
	</div>
	<div class="panel-body">
  		@include('student._form')
	</div>
</div>
@endsection