@extends('layouts.app')

@section('content')

<div class="mt-5 mb-5 row justify-content-center">
    <div class="offset-col-3 col-sm-9">
        
        <!--<form action="#" method = "POST">-->
        {!! Form::model($report, ['route' => 'reports.store']) !!}    
            <div class="form-group row">
                <!--<label class="col-sm-3 col-form-lavel">date</label>-->
                {!! Form::label('date', 'date', ['class' => 'col-sm-3 col-form-lavel']) !!}

                <div class="col-sm-9">
                    <!--<input type="date" class="form-control" name="date" value = "{{ old('date') }}" required>-->
                    {!! Form::date('date', \ Carbon \ Carbon :: now (), ['class' => 'form-control']) !!}

                </div>
            </div>

            <div class="mb-5 form-group form-row">
                <!--<label class="col-sm-3 col-form-lavel">total work time</label>-->
                {!! Form::label('time', 'total work time', ['class' => 'col-sm-3 col-form-lavel']) !!}

                <div class="col">
                    <!--<input type="text" pattern="\d*" class="form-control" name="hour" placeholder="hour" value = "{{ old('hour') }}" required>-->
                    {!! Form::text('hour', old('hour', $report->hour), ['class' => 'form-control', 'pattern' => '\d*', 'placeholder' => 'hour' ]) !!}
                </div>
                
                <div class="col">
                    <!--<select class="custom-select" name="minute" value = "{{ old('minute') }}" required>-->
                    {!! Form::select('minute', [
                                            '0' => '0',
                                            '10' => '10',
                                            '20' => '20',
                                            '30' => '30',
                                            '40' => '40',
                                            '50' => '50'
                                            ],
                     'minute', ['class' => 'custom-select', 'placeholder' => 'minute' ] ) !!}  
                    <!--  <option selected>minute</option>-->
                    <!--  <option value="0">00</option>-->
                    <!--  <option value="10">10</option>-->
                    <!--  <option value="20">20</option>-->
                    <!--  <option value="30">30</option>-->
                    <!--  <option value="40">40</option>-->
                    <!--  <option value="50">50</option>-->
                    <!--</select>-->
                </div>
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
                    <!--<textarea class="form-control" name="content" placeholder="max:10000" >{{ old('content') }}</textarea>-->
                <!--</div>-->
                {!! Form::textarea('content', old('content'), ['class' => 'col-sm-9 form-control', 'placeholder' => 'max:10000',]) !!}
            </div>

            <div class="form-group row">
                <!--<div class="offset-3 col-9">-->
                <!--    <button type="submit" class="btn btn-block btn-info">Save</button>-->
                <!--</div>-->
                {!! Form::submit('Save', ['class' => 'offset-3 col-9 btn btn-block btn-info']) !!}
            </div>
        <!--</form>-->
        {!! Form::close() !!}
    </div>
</div>

    
@endsection