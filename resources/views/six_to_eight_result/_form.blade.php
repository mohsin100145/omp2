@if(isset($result))
    {!! Form::model($result, ['url' => "six-to-eight-result/$result->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'six-to-eight-result', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif

<div class="form-group {{ $errors->has('student_id') ? ' has-error' : '' }}">
    {!! Form::label('student_id', 'Student ID', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-6">
	        <div class="input-group">
	            {!! Form::text('student_id',null, ['id' => 'student_id', 'class' =>'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter Student ID', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57', 'autofocus']) !!}
	            <span class="input-group-btn">
	                <button type="button" id="student_id_search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
	            </span>
	        </div>
	        <span class="text-danger">
	            {!! $errors->first('student_id') !!}
	        </span>
        </div>
        <div class="col-sm-6">
		    <span id="student_info_show"></span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has('term_id') ? 'has-error' : '' }}">
    {!! Form::label('term_id', 'Select Term', ['class' => 'control-label col-sm-3']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-12">
	        {!! Form::select('term_id', $termList, null, ['class' => 'form-control', 'placeholder' => 'Select Term']) !!}
	        <span class="text-danger">
	            {{ $errors->first('term_id') }}
	        </span>
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has(['ban_1st', 'ban_2nd']) ? 'has-error' : ''}}">
    {!! Form::label('bangla', 'Bangla', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-6">
	        {!! Form::text('ban_1st', null, ['class' => 'numeric-field form-control', 'placeholder' => 'Bangla First Paper', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('ban_1st') }}
		    </span>
		</div>
		<div class="col-sm-6">
	        {!! Form::text('ban_2nd', null, ['class' => 'numeric-field form-control', 'placeholder' => 'Bangla Second Paper', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('ban_2nd') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has(['eng_1st', 'eng_2nd']) ? 'has-error' : ''}}">
    {!! Form::label('english', 'English', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-6">
	        {!! Form::text('eng_1st', null, ['class' => 'form-control numeric-field', 'placeholder' => 'English First Paper', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('eng_1st') }}
		    </span>
		</div>
		<div class="col-sm-6">
	        {!! Form::text('eng_2nd', null, ['class' => 'form-control numeric-field', 'placeholder' => 'English Second Paper', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('eng_2nd') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has('math') ? 'has-error' : ''}}">
    {!! Form::label('mathematics', 'Mathematics', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-12">
	        {!! Form::text('math', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Mathematics', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('math') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has('science') ? 'has-error' : ''}}">
    {!! Form::label('general_science', 'General Science', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-12">
	        {!! Form::text('science', null, ['class' => 'form-control numeric-field', 'placeholder' => 'General Science', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('science') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has('bangladesh') ? 'has-error' : ''}}">
    {!! Form::label('intro_of_bd_and_world', 'Introduce of Bangladesh & World', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-12">
	        {!! Form::text('bangladesh', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Introduce of Bangladesh & World', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('bangladesh') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has('religion') ? 'has-error' : ''}}">
    {!! Form::label('rel_and_mo_std', 'Religion & Moral Studies', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-12">
	        {!! Form::text('religion', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Religion & Moral Studies', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('religion') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has('ict') ? 'has-error' : ''}}">
    {!! Form::label('ict', 'ICT', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-12">
	        {!! Form::text('ict', null, ['class' => 'form-control numeric-field', 'placeholder' => 'ICT', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('ict') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has('work') ? 'has-error' : ''}}">
    {!! Form::label('work', 'Work & Life Oriented Studies', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-12">
	        {!! Form::text('work', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Work & Life Oriented Studies', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('work') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has('physical') ? 'has-error' : ''}}">
    {!! Form::label('physical', 'Physical Studies & Health', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-12">
	        {!! Form::text('physical', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Physical Studies & Health', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('physical') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has('arts') ? 'has-error' : ''}}">
    {!! Form::label('arts_and_crafts', 'Arts & Crafts', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-12">
	        {!! Form::text('arts', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Arts & Crafts', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('arts') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has('optional') ? 'has-error' : ''}}">
    {!! Form::label('optional', 'Home Economics / Agricultural Science (Optional)', ['class' => 'col-sm-4 control-label']) !!}
    <div class="col-sm-8">
    	<div class="col-sm-12">
	        {!! Form::text('optional', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Home Economics / Agricultural Science (Optional)', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('optional') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-block']) !!}
    </div>
</div>
{!! Form::close() !!}