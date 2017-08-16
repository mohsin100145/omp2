@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h3>
        	<i class="fa fa-list-ul"></i>
        	Results List of <mark>Six</mark> to <mark>Eight</mark>

        	<a href="{{ url('six-to-eight-result/create') }}" class="btn btn-primary pull-right">
            	<i class="fa fa-plus"></i> Create Result for <code><b>Six</b></code> to <code><b>Eight</b></code>
        	</a>
    	</h3>
    	<hr>
    </div>
</div>
@endsection
