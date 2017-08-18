@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3>
            <i class="fa fa-list-ul"></i>
            Results List of <mark>Six</mark> to <mark>Eight</mark>

            <a href="{{ url('six-to-eight-result/create') }}" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i> Create Result for <code><b>Six</b></code> to <code><b>Eight</b></code>
            </a>
        </h3>
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><i class="fa fa-list-ul"></i> Results List <code><b>Six</b></code> to <code><b>Eight</b></code></h3>
            </div>
            <div class="panel-body">
                <table id="myTable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Student Id</th>
                            <th>Student Name</th>
                            <th>Roll No</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Term</th>
                            <th>Year</th>
                            {{--<th>Total Point</th>--}}
                            <th>GPA</th>
                            <th>Fail Subject(s)</th>
                            {{--<th>Result</th>--}}
                            <th>Total Marks</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                    ?>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td><strong>{{ $result->student_id }}</strong></td>
                            <td><strong>{{ $result->student->name }}</strong></td>
                            <td>{{ $result->student->roll_no }}</td>
                            <td>{{ $result->student->level->name }}</td>
                            <td>{{ $result->student->section->name }}</td>
                            <td>{{ $result->term->name }}</td>
                            <td>{{ $result->student->year->year }}</td>
                            {{--<td>{{ $result->total_point }}</td>--}}
                            <td><strong>{{ $result->gpa }}</strong></td>
                            <td>{{ $result->fail_subjects }}</td>
                            {{--<td><strong>{{ $result->result }}</strong></td>--}}
                            <td><strong>{{ $result->marks_total }}</strong></td>
                            <td>{!! Html::link("six-to-eight-result/$result->id",' View', ['class' => 'fa fa-eye btn btn-success btn-xs']) !!}</td>
                            <td>{!! Html::link("six-to-eight-result/$result->id/edit",' Edit', ['class' => 'fa fa-eye btn btn-primary btn-xs']) !!}</td>
                            <td><a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal-{{ $result->id }}">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal-{{ $result->id }}" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">DELETE</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you want to delete this Result?</p>
                                        </div>
                                        <div class="modal-footer">
                                            {{--<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>--}}

                                            {{ Form::open(['method' => 'DELETE', 'url' => "result/$result->id"]) }}
                                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script type="text/javascript">
        $(document).ready(function(){
    $('#myTable').DataTable();
});
    </script>
@endsection