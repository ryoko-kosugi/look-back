@extends('layouts.app')

@section('content')

      <div class="text-center mt-3 ">
        <h1>Edit sheet</h1>
      </div>
      
      <div class="row justify-content-center">
        <div class="col-sm-9 mt-5 mb-3"> 
     
        <!--<form action="#" method = "put">-->
        {!! Form::model($report, ['route' => ['reports.update', $report->id], 'method' => 'put']) !!} 
     
            <div class="form-group row">
                <!--<label class="col-sm-3 col-form-lavel">date</label>-->
                {!! Form::label('date', 'date', ['class' => 'col-sm-3 col-form-lavel']) !!}
                <div class="col-sm-9">
                    <!--<input type="date" class="form-control" name="date" value = "{{ old('date') }}" required>-->
                    {!! Form::date('date', old('date'), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="mb-5 form-group form-row">
                <!--<label class="col-sm-3 col-form-lavel">total work time</label>-->
                {!! Form::label('time', 'total work time', ['class' => 'col-sm-3 col-form-lavel']) !!}
                <div class="col">
                    <!--<input type="text" pattern="\d*" class="form-control" name="hour" placeholder="hour" value = "{{ old('hour') }}" required>-->
                    {!! Form::text('hour', floor($report->time / 60), ['class' => 'form-control', 'pattern' => '\d*', 'placeholder' => 'hour' ]) !!}
                </div>
                
                <div class="col">
                    <!--<select class="custom-select" name="minute" value = "{{ old('minute') }}" required>-->
                    <!--  <option selected>minute</option>-->
                    <!--  <option value="0">00</option>-->
                    <!--  <option value="1">10</option>-->
                    <!--  <option value="2">20</option>-->
                    <!--  <option value="3">30</option>-->
                    <!--  <option value="4">40</option>-->
                    <!--  <option value="5">50</option>-->
                    <!--</select>-->                   
                    {!! Form::select('minute', [
                                                '0' => '0',
                                                '10' => '10',
                                                '20' => '20',
                                                '30' => '30',
                                                '40' => '40',
                                                '50' => '50'
                                                ],
                     ($report->time % 60), ['class' => 'custom-select', 'placeholder' => 'minute' ] ) !!} 
                </div>
                
                <!--右側スペース確保-->
                <div class="col"></div> 
            </div>                    
        
            <div class="form-group row">
                <!--<label class="col-sm-3 col-form-label" name="title">important</label>-->
                {!! Form::label('title', 'important', ['class' => 'col-sm-3 col-form-label']) !!}
                <!--<div class="col-sm-9">-->
                    <!--<textarea class="form-control" name="title" placeholder="max:280">{{ old('title') }}</textarea>-->
                <!--</div>    -->
                {!! Form::textarea('title', old('title'), ['class' => 'col-sm-9 form-control', ' placeholder' => 'max:280']) !!}
            </div>

            <div class="form-group row">
                <!--<label class="col-sm-3 col-form-label" name="content">free</label>-->
                {!! Form::label('content', 'free', ['class' => 'col-sm-3 col-form-label']) !!}
                <!--<div class="col-sm-9">-->
                <!--    <textarea class="form-control" name="content" placeholder="max:10000" >{{ old('content') }}</textarea>-->
                <!--</div>-->
                {!! Form::textarea('content', old('content'), ['class' => 'col-sm-9 form-control', 'placeholder' => 'max:10000',]) !!}
            </div>

            <div class="form-group row">            
                <div class="offset-9 col-3">           
                  <!--<button class="btn btn-outline-danger" type="submit">Delete</button>-->
                                         
                  <!--<button class="btn btn-info" type="submit">Update</button> -->
                  
                    {!! Form::submit('Update', ['class' => 'btn btn-info']) !!}
                 {!! Form::close() !!}
                 
                {!! Form::model($report, ['route' => ['reports.destroy', $report->id], 'method' => 'delete']) !!}
                      {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger']) !!}
                {!! Form::close() !!}                  
                </div>
            </div>
        <!--</form>-->
        </div>
      </div>

      
@endsection