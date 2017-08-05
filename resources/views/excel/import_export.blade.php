@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <nav class="navbar navbar-default">
						<div class="container-fluid">
							<div class="navbar-header">
								<a class="navbar-brand" href="#">Import - Export in Excel and CSV Laravel 5</a>
							</div>
						</div>
					</nav>
					<div class="">
						<a href="{{ URL::to('download-excel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
						<a href="{{ URL::to('download-excel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
						<a href="{{ URL::to('download-excel/csv') }}"><button class="btn btn-success">Download CSV</button></a>
						<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('import-excel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<input type="file" name="import_file" />
							<button class="btn btn-primary">Import File</button>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection