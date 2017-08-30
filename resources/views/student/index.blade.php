@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 style="margin-top: 0px;">
            <i class="fa fa-users"></i>
            Students List of <mark>Six</mark> to <mark>Ten</mark>

            <a href="{{ url('student/create') }}" class="btn btn-primary pull-right">
                <i class="fa fa-user-plus"></i> Create Student for <code><b>Six</b></code> to <code><b>Ten</b></code>
            </a>
        </h3>
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><i class="fa fa-users"></i> Students List of classes<code><b>Six</b></code> to <code><b>Ten</b></code></h3>
            </div>
            <div class="panel-body">
                <table  id="myTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Roll No.</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Year</th>
                            <th>Group</th>
                            <th>Father's Name</th>
                            <th>Mother's Name</th>
                            <th>Address</th>
                            <th>Image</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                        ?>

                        @foreach($students as $key=>$student)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td><strong>{{ $student->id }}</strong></td>
                                <td><strong>{{  $student->name  }}</strong></td>
                                <td>{{ $student->roll_no }}</td>
                                <td>{{ $student->level->name }}</td>
                                <td>{{ $student->section->name }}</td>
                                <td>{{ $student->year->year }}</td>
                                @if($student->group_id != null)
                                    <td>{{ $student->group->name }}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $student->father_name }}</td>
                                <td>{{ $student->mother_name }}</td>
                                <td>{{ $student->address }}</td>
                                @if($student->image == null)
                                    <td>{{ Html::image('/images/student_avatar.jpg', 'No Picture', ['width' => 50, 'height' => 50]) }}</td>
                                @else
                                    <td>{{ Html::image('/uploads/' . $student->image, 'No Picture', ['width' => 50, 'height' => 50]) }}</td>
                                @endif
                                
                                <td>{!! Html::link("student/$student->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-success']) !!}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
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
