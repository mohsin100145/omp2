@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-2">
        <div class="pull-left">
            {{ Html::image('/images/logo.jpg', 'alt', ['width' => 120, 'height' => 120]) }}
        </div>
    </div>
    <div class="col-xs-9">
        <h3><center>Bara Moheshkhali Girls' High School</center></h3>
        <center>
            <h4>
                <i class="fa fa-file-text-o"></i>
                {{ $results[0]->term->name }} @if($results[0]->term->name == "First") {{ "Term" }} @endif Examination Result, {{ $year->year }}
            </h4>
        </center>
        <center><h4>Class: <b>{{ $level->name }}</b></h4></center>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <table id="myTable" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th style="vertical-align: middle; text-align: center;">Present Roll</th>
                <th style="vertical-align: middle; text-align: center;">Student Name</th>
                <th style="vertical-align: middle; text-align: center;">Previous Roll</th>
                <th style="vertical-align: middle; text-align: center;">Section</th>
                <th style="vertical-align: middle; text-align: center; width: 120px;">GPA</th>
                <th style="vertical-align: middle; text-align: center; width: 115px;">Fail Subject(s)</th>
                <th style="vertical-align: middle; text-align: center;">Grade</th>
                <th style="vertical-align: middle; text-align: center;">Total Marks</th>
                <th style="vertical-align: middle; text-align: center;">View Details</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $key=>$result)
                <tr>
                    <td style="vertical-align: middle; text-align: center;">{{ ++$key }}</td>
                    <td style="vertical-align: middle; text-align: center;">{{ $result->student->name }}</td>
                    <td style="vertical-align: middle; text-align: center;">{{ $result->student->roll_no }}</td>
                    <td style="vertical-align: middle; text-align: center;">{{ $result->student->section->name }}</td>
                    <td style="vertical-align: middle; text-align: center;"><b>{{ $result->gpa }}</b></td>
                    <td style="vertical-align: middle; text-align: center;"><b>{{ $result->fail_subjects }}</b></td>
                    <td style="vertical-align: middle; text-align: center;"><b>{{ $result->grade }}</b></td>
                    <td style="vertical-align: middle; text-align: center;">{{ $result->marks_total_with_optional }}</td>
                    <td style="vertical-align: middle; text-align: center;">{!! Html::link("result/$result->id",' View', ['class' => 'fa fa-eye btn btn-success']) !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
</script>
@endsection