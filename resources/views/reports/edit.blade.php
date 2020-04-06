@extends('layouts.app')

@section('content')

<div class="text-center mt-3 nb-5">
    <h1>Edit sheet</h1>
</div>

<div class="container">
    <div class="d-flex justify-content-center">
        <div class=" col-lg-9 mb-5"> 
            <div class="form">
                <!--<form action="#" method = "put">-->
                {!! Form::model($report, ['route' => ['reports.update', $report->id], 'method' => 'put']) !!} 
            
                <div class="form-group row">
                    <!--<label class="col-md-3 col-form-lavel">date</label>-->
                    {!! Form::label('date', 'date', ['class' => 'col-md-3 col-form-lavel']) !!}
                    <div class="col-md-9 col-lg-8">
                        <!--<input type="date" class="form-control" name="date" value = "{{ old('date') }}" required>-->
                        {!! Form::date('date', old('date'), ['class' => 'form-control']) !!}
                    </div>
                </div>
            
                <div class="form-group row mb-5">
                    <!--<label class="col-md-3 col-form-lavel">total work time</label>-->
                    {!! Form::label('time', 'total work time', ['class' => 'col-md-3 col-form-lavel']) !!}
                    <div class="col-4 col-lg-3">
                        <!--<input type="text" pattern="\d*" class="form-control" name="hour" placeholder="hour" value = "{{ old('hour') }}" required>-->
                        {!! Form::text('hour', floor($report->time / 60), ['class' => 'form-control', 'pattern' => '\d*', 'placeholder' => 'hour' ]) !!}
                    </div>
                    
                    <div class="col-4 col-lg-3">
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
                    
                </div>                    
            
                <div class="form-group row">
                    <!--<label class="col-md-3 col-form-label" name="title">important</label>-->
                    {!! Form::label('title', 'important', ['class' => 'col-md-3 col-form-label']) !!}
                    <!--<div class="col-md-9 col-lg-8">-->
                        <!--<textarea class="form-control" name="title" placeholder="max:280">{{ old('title') }}</textarea>-->
                    <!--</div>    -->
                    {!! Form::textarea('title', old('title'), ['class' => 'col-md-9 col-lg-8 important-form form-control', ' placeholder' => 'max:280']) !!}
                </div>
            
                <div class="form-group row">
                    <!--<label class="col-md-3 col-form-label" name="content">free</label>-->
                    {!! Form::label('content', 'free', ['class' => 'col-md-3 col-form-label']) !!}
                    <!--<div class="col-md-9 col-lg-8">-->
                    <!--    <textarea class="form-control" name="content" placeholder="max:10000" >{{ old('content') }}</textarea>-->
                    <!--</div>-->
                    {!! Form::textarea('content', old('content'), ['class' => 'col-md-9 col-lg-8 form-control', 'placeholder' => 'max:10000',]) !!}
                </div>
            
                <div class="form-group row">            
                    <div class="offset-9 col-3">           
                      <!--<button class="btn btn-outline-danger" type="submit">Delete</button>-->
                      <!--<button class="btn btn-info" type="submit">Update</button> -->
                        <div class="edit-update-button">
                        {!! Form::submit('Update', ['class' => 'btn btn-info btn-lg']) !!}
                        </div>
                    {!! Form::close() !!}
                     
                    {!! Form::model($report, ['route' => ['reports.destroy', $report->id], 'method' => 'delete']) !!}
                        <div class="edit-delete-button">
                        {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-lg']) !!}
                        </div>
                    {!! Form::close() !!}                  
                    </div>
                </div>
                <!--</form>-->
            </div>
        </div>
    </div>
</div>
      
@endsection