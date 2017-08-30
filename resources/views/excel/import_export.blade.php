@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Excel and CSV File Import & Export</div>

                <div class="panel-body">
                    <nav class="navbar navbar-default">
						<div class="container-fluid">
							<div class="navbar-header">
								<a class="navbar-brand" href="#">Import - Export Student Information in Excel and CSV File</a>
							</div>
						</div>
					</nav>
					<div class="">
						<a href="{{ URL::to('download-excel/xls') }}"><button class="btn btn-danger">Download Excel xls</button></a>
						<a href="{{ URL::to('download-excel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
						<a href="{{ URL::to('download-excel/csv') }}"><button class="btn btn-danger">Download CSV</button></a>
						<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('import-excel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="help-block">
								<input type="file" name="import_file" />
							</div>
							<button class="btn btn-primary">Import File</button>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection