@extends('layouts.app')

@section('content')



@if (Auth::check())

<div class="text-center mt-3 mb-5">
  <h1>On the day</h1>
</div>

<div class="container">
  <div class="d-flex justify-content-center">
    <div class=" col-lg-9 mb-5">
      <div class="form">
        <!--<form action="#" method = "POST">-->
        {!! Form::model($report, ['route' => 'reports.store']) !!}  
          <div class="form-group row">
            <!--<label class="col-md-3 col-form-label">date</label>-->
            {!! Form::label('date', 'date', ['class' => 'col-md-3 col-form-lavel']) !!}
            <div class="col-md-9 col-lg-8">
              <!--<input type="date" class="form-control" name="date" value = "{{ old('date') }}" required>-->
              {!! Form::date('date', \ Carbon \ Carbon :: now (), ['class' => 'form-control']) !!}
            </div>
          </div>
              
          <div class="form-group row mb-5">
            
            <!--<lavel class=" col-md-3 col-form-label">total work time</lavel>-->
            {!! Form::label('time', 'total work time', ['class' => ' col-md-3 col-form-lavel']) !!}
            <div class="col-4 col-lg-3">
              <!--<input type="text" pattern="\d*" class="form-control" name="hour" placeholder="hour" value = "{{ old('hour') }}" required>-->
              {!! Form::text('hour', old('hour', $report->hour), ['class' => 'form-control', 'pattern' => '\d*', 'placeholder' => 'hour' ]) !!}
            </div>
            
            <div class="col-4 col-lg-3">
              <!--<select class="custom-select form-control " name="minute" placeholder="minute" value = "{{ old('minute') }}" required>-->
              {!! Form::select('minute', [
                                      '0' => '0',
                                      '10' => '10',
                                      '20' => '20',
                                      '30' => '30',
                                      '40' => '40',
                                      '50' => '50'
                                      ],
               'minute', ['class' => 'custom-select form-control', 'placeholder' => 'minute' ] ) !!}                  
              <!--  <option selected>minute</option>-->
              <!--  <option value="0">00</option>-->
              <!--  <option value="10">10</option>-->
              <!--  <option value="20">20</option>-->
              <!--  <option value="30">30</option>-->
              <!--  <option value="40">40</option>-->
              <!--  <option value="50">50</option>-->
              <!--</select> -->
            </div>
            
          </div>
  
         
          <div class="form-group row">
            
              <!--<label class="col-md-3 col-form-label" name="title">important</label>-->
              {!! Form::label('title', 'important', ['class' => 'col-md-3 col-form-label']) !!}
              <!--<div class=" col-md-9 col-lg-8">-->
              <!--  <textarea class="form-control" name="title" placeholder="max:280">{{ old('title') }}</textarea>-->
              <!--</div>-->
              <!--<div class="important-form border bg-info">-->
              {!! Form::textarea('title', old('title'), ['class' => ' col-md-9 col-lg-8 important-form form-control', ' placeholder' => 'max:280']) !!}
              
          <!--</div>-->
          </div>
  
          <div class="form-group row">
            
              <!--<label class=" col-md-3 col-form-label" name="content">free</label>-->
              {!! Form::label('content', 'free', ['class' => 'col-md-3 col-form-label']) !!}
              <!--<div class="col-12 col-md-9 col-lg-8">-->
              <!--    <textarea class="form-control" name="content" placeholder="max:10000" >{{ old('content') }}</textarea>-->
              <!--</div>-->
              {!! Form::textarea('content', old('content'), ['class' => ' col-md-9 col-lg-8 form-control', 'placeholder' => 'max:10000',]) !!}
            
          </div>
          
          <div class="form-group row">
              <!--<div class=" col-12 offset-md-3 col-md-9 offset-lg-3 col-lg-8">-->
              <!--    <button type="submit" class="btn btn-block btn-info">Save</button>-->
              <!--</div>-->
              {!! Form::submit('Save', ['class' => ' offset-md-3 col-md-9 offset-lg-3 col-lg-8 btn btn-block btn-info']) !!}
          </div>
        {!! Form::close() !!}  
        <!--</form>  -->
      </div>
    </div>      
  </div> 
</div>

@else
<div class="text-center mt-3 mb-5">
  <h1>Welcome!!</h1>
</div>
    
@endif        
@endsection