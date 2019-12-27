@extends('layouts.app')

@section('content')

      <div class="row justify-content-center">
        <div class="col-sm-5 mt-5 mb-3"> 
          <div class="card border-dark">
            <div class="card-header">
             <h2>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $report->date)->formatLocalized('%Y/%m/%d(%a)') }}</h2>
             <h3>{{ floor($report->time / 60) . " h "}}{{ floor($report->time % 60) . " min " }}</h3>
            </div>
            <div class="card-body">
              <h3 class="card-title">{!! nl2br(e($report->title)) !!}</h3>
              <h5 class="card-text">{!! nl2br(e($report->content)) !!}</h5>
            </div>
            <div class="card-footer text-muted"></div>
          </div>
        </div>
      </div>  
      
      
      <div class="row">
        <div class="offset-sm-7 col-sm-5" >
          <!--<a class="btn btn-lg btn btn-outline-secondary" href="#" role="button">Return</a>-->
          {!! link_to_route('reports.index', 'Return' , [], ['class' => 'btn btn-lg btn btn-outline-secondary']) !!}
          <!--<a class="btn btn-lg btn-outline-info" href="#" role="button">Edit</a>    -->
          {!! link_to_route('reports.edit', 'edit', ['id' => $report->id], ['class' => 'btn btn-lg btn-outline-info']) !!}
        </div>
      </div>
       <!--link_to_route('reports.edit', 'edit', ['id' => $report->id], ['class' => 'btn btn-light']) -->
      
@endsection