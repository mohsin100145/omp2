@if(isset($result))
    {!! Form::model($result, ['url' => "result/$result->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'result', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif
<div class="form-group {{ $errors->has('student_id') ? ' has-error' : '' }}">
    {!! Form::label('student_id', 'Student ID', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-6">
	        <div class="input-group">
	            {!! Form::text('student_id',null, ['id' => 'student_id', 'class' =>'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter Student ID', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57']) !!}
	            <span class="input-group-btn">
	                <button type="button" id="student_id_search" data-url="{{url('/result/student-name-show')}}" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
	            </span>
	        </div>
	        <span class="text-danger">
	            {!! $errors->first('student_id') !!}
	        </span>
        </div>
        <div class="col-sm-6">
		    <span id="student_name_show"></span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has('term_id') ? 'has-error' : '' }}">
    {!! Form::label('term_id', 'Select Term', ['class' => 'control-label col-sm-3']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-6">
	        {!! Form::select('term_id', $termList, null, ['class' => 'form-control', 'placeholder' => 'Select Term']) !!}
	        <span class="text-danger">
	            {{ $errors->first('term_id') }}
	        </span>
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has(['ban_1st_wrt', 'ban_1st_mcq']) ? 'has-error' : ''}}">
    {!! Form::label('bangla_first_paper', 'Bangla First Paper', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-6">
	        {!! Form::text('ban_1st_wrt', null, ['class' => 'numeric-field form-control', 'placeholder' => 'Bangla 1st Written', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('ban_1st_wrt') }}
		    </span>
		</div>
		<div class="col-sm-6">
	        {!! Form::text('ban_1st_mcq', null, ['class' => 'numeric-field form-control', 'placeholder' => 'Bangla 1st MCQ', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('ban_1st_mcq') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has(['ban_2nd_wrt', 'ban_2nd_mcq']) ? 'has-error' : ''}}">
    {!! Form::label('bangla_Second_paper', 'Bangla Second Paper', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-6">
	        {!! Form::text('ban_2nd_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Bangla 2nd Written', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('ban_2nd_wrt') }}
		    </span>
		</div>
		<div class="col-sm-6">
	        {!! Form::text('ban_2nd_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Bangla 2nd MCQ', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('ban_2nd_mcq') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has('eng_1st') ? 'has-error' : ''}}">
    {!! Form::label('english_first_paper', 'English First Paper', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-12">
	        {!! Form::text('eng_1st', null, ['class' => 'form-control numeric-field', 'placeholder' => 'English 1st', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('eng_1st') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has('eng_2nd') ? 'has-error' : ''}}">
    {!! Form::label('english_second_paper', 'English Second Paper', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-12">
	        {!! Form::text('eng_2nd', null, ['class' => 'form-control numeric-field', 'placeholder' => 'English 2nd', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('eng_2nd') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has(['math_wrt', 'math_mcq']) ? 'has-error' : ''}}">
    {!! Form::label('mathematics', 'Mathematics', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-6">
	        {!! Form::text('math_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Mathematics Written', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('math_wrt') }}
		    </span>
		</div>
		<div class="col-sm-6">
	        {!! Form::text('math_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Mathematics MCQ', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('math_mcq') }}
		    </span>
		</div>
    </div>
</div>

<div class="form-group {{ $errors->has(['rel_wrt', 'rel_mcq']) ? 'has-error' : ''}}">
    {!! Form::label('religion_studies', 'Religion Studies', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-6">
	        {!! Form::text('rel_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Religion Studies Written', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('rel_wrt') }}
		    </span>
		</div>
		<div class="col-sm-6">
	        {!! Form::text('rel_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Religion Studies MCQ', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('rel_mcq') }}
		    </span>
		</div>
    </div>
</div>

<div class="thumbnail">
	<div class="text-center bg-success"><b><i>For Science Students</i></b></div>
	<!-- <div class="center-block" style="background-color:yellow; width: 200px;">This div will be centered.</div> -->
	<div class="form-group {{ $errors->has(['bwi_wrt', 'bwi_mcq']) ? 'has-error' : ''}}">
	    {!! Form::label('bangladesh', 'Intro. of Bangladesh & World', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    	<div class="col-sm-6">
		        {!! Form::text('bwi_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Intro. of Bangladesh & World Written', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('bwi_wrt') }}
			    </span>
			</div>
			<div class="col-sm-6">
		        {!! Form::text('bwi_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Intro. of Bangladesh & World MCQ', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('bwi_mcq') }}
			    </span>
			</div>
	    </div>
	</div>

	<div class="form-group {{ $errors->has(['phy_wrt', 'phy_mcq', 'phy_prac']) ? 'has-error' : ''}}">
	    {!! Form::label('physics', 'Physics', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    	<div class="col-sm-4">
		        {!! Form::text('phy_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Physics Written', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('phy_wrt') }}
			    </span>
			</div>
			<div class="col-sm-4">
		        {!! Form::text('phy_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Physics MCQ', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('phy_mcq') }}
			    </span>
			</div>
			<div class="col-sm-4">
		        {!! Form::text('phy_prac', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Physics Practical', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('phy_prac') }}
			    </span>
			</div>
	    </div>
	</div>

	<div class="form-group {{ $errors->has(['che_wrt', 'phy_mcq', 'che_prac']) ? 'has-error' : ''}}">
	    {!! Form::label('chemistry', 'Chemistry', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    	<div class="col-sm-4">
		        {!! Form::text('che_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Chemistry Written', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('che_wrt') }}
			    </span>
			</div>
			<div class="col-sm-4">
		        {!! Form::text('che_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Chemistry MCQ', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('phy_mcq') }}
			    </span>
			</div>
			<div class="col-sm-4">
		        {!! Form::text('che_prac', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Chemistry Practical', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('che_prac') }}
			    </span>
			</div>
	    </div>
	</div>

	<div class="form-group {{ $errors->has(['bio_wrt', 'bio_mcq', 'bio_prac']) ? 'has-error' : ''}}">
	    {!! Form::label('biology', 'Biology', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    	<div class="col-sm-4">
		        {!! Form::text('bio_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Biology Written', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('bio_wrt') }}
			    </span>
			</div>
			<div class="col-sm-4">
		        {!! Form::text('bio_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Biology MCQ', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('bio_mcq') }}
			    </span>
			</div>
			<div class="col-sm-4">
		        {!! Form::text('bio_prac', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Biology Practical', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('bio_prac') }}
			    </span>
			</div>
	    </div>
	</div>
</div>

<div class="form-group {{ $errors->has(['gs_wrt', 'gs_mcq']) ? 'has-error' : ''}}">
    {!! Form::label('general_science', 'General Science', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-6">
	        {!! Form::text('gs_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'General Science Written', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('gs_wrt') }}
		    </span>
		</div>
		<div class="col-sm-6">
	        {!! Form::text('gs_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'General Science MCQ', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('gs_mcq') }}
		    </span>
		</div>
    </div>
</div>

<div class="thumbnail">
	<div class="text-center bg-info"><b><i>For Humanities Students</i></b></div>
	<div class="form-group {{ $errors->has(['his_wrt', 'his_mcq']) ? 'has-error' : ''}}">
	    {!! Form::label('history', 'History', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    	<div class="col-sm-6">
		        {!! Form::text('his_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'History Written', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('his_wrt') }}
			    </span>
			</div>
			<div class="col-sm-6">
		        {!! Form::text('his_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'History MCQ', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('his_mcq') }}
			    </span>
			</div>
	    </div>
	</div>
	<div class="form-group {{ $errors->has(['civ_wrt', 'civ_mcq']) ? 'has-error' : ''}}">
	    {!! Form::label('civics', 'Civics', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    	<div class="col-sm-6">
		        {!! Form::text('civ_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Civics Written', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('civ_wrt') }}
			    </span>
			</div>
			<div class="col-sm-6">
		        {!! Form::text('civ_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Civics MCQ', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('civ_mcq') }}
			    </span>
			</div>
	    </div>
	</div>
	<div class="form-group {{ $errors->has(['geo_wrt', 'geo_mcq']) ? 'has-error' : ''}}">
	    {!! Form::label('geography', 'Geography', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    	<div class="col-sm-6">
		        {!! Form::text('geo_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Geography Written', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('geo_wrt') }}
			    </span>
			</div>
			<div class="col-sm-6">
		        {!! Form::text('geo_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Geography MCQ', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('geo_mcq') }}
			    </span>
			</div>
	    </div>
	</div>
</div>

<div class="thumbnail">
	<div class="text-center bg-danger"><b><i>For Business Studies Students</i></b></div>
	<div class="form-group {{ $errors->has(['acc_wrt', 'acc_mcq']) ? 'has-error' : ''}}">
	    {!! Form::label('accounting', 'Accounting', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    	<div class="col-sm-6">
		        {!! Form::text('acc_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Accounting Written', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('acc_wrt') }}
			    </span>
			</div>
			<div class="col-sm-6">
		        {!! Form::text('acc_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Accounting MCQ', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('acc_mcq') }}
			    </span>
			</div>
	    </div>
	</div>
	<div class="form-group {{ $errors->has(['fin_wrt', 'fin_mcq']) ? 'has-error' : ''}}">
	    {!! Form::label('finance_and_banking', 'Finance and Banking', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    	<div class="col-sm-6">
		        {!! Form::text('fin_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Finance and Banking Written', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('fin_wrt') }}
			    </span>
			</div>
			<div class="col-sm-6">
		        {!! Form::text('fin_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Finance and Banking MCQ', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('fin_mcq') }}
			    </span>
			</div>
	    </div>
	</div>
	<div class="form-group {{ $errors->has(['bus_wrt', 'bus_mcq']) ? 'has-error' : ''}}">
	    {!! Form::label('business', 'Business', ['class' => 'col-sm-3 control-label']) !!}
	    <div class="col-sm-9">
	    	<div class="col-sm-6">
		        {!! Form::text('bus_wrt', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Business Written', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('bus_wrt') }}
			    </span>
			</div>
			<div class="col-sm-6">
		        {!! Form::text('bus_mcq', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Business MCQ', 'autocomplete' => 'off']) !!}
		        <span class="text-danger">
				    {{ $errors->first('bus_mcq') }}
			    </span>
			</div>
	    </div>
	</div>
</div>

<div class="form-group {{ $errors->has(['optional_total', 'optional_gp', 'optional_note']) ? 'has-error' : ''}}">
    {!! Form::label('optional_subject', 'Optional Subject', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
    	<div class="col-sm-4">
	        {!! Form::text('optional_total', null, ['class' => 'form-control numeric-field', 'placeholder' => 'Total Mark of opt. sub.', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('optional_total') }}
		    </span>
		</div>
		<div class="col-sm-4">
	        {!! Form::text('optional_gp', null, ['class' => 'form-control numeric-field', 'placeholder' => 'GP of opt. sub.', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('optional_gp') }}
		    </span>
		</div>
		<div class="col-sm-4">
	        {!! Form::text('optional_note', null, ['class' => 'form-control', 'placeholder' => 'opt. sub.(Written, MCQ, Practical)', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('optional_note') }}
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