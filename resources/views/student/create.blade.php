@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title text-center"><i class="fa fa-user-plus"></i> Student Creation form for class <code><b>Six</b></code> to <code><b>Ten</b></code></h3>
			</div>
			<div class="panel-body">
		  		@include('student._form')
			</div>
		</div>
	</div>
</div>	
@endsection