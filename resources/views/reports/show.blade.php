@extends('layouts.app')

@section('content')

<div class="container">

  <div class="row justify-content-center">
    
    <div class="col-md-8 col-xl-7 mt-5 mb-3">
      <div class="show-card"> 
        <div class="card ">
          <div class="card-header">
           <h2>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $report->date)->formatLocalized('%Y/%m/%d(%a)') }}</h2>
           <h3>{{ floor($report->time / 60) . " h "}}{{ floor($report->time % 60) . " min " }}</h3>
          </div>
          <div class="card-body">
            @if($report->title)
            <div class="important">
              <h3 class="card-title">{!! nl2br(e($report->title)) !!}</h3>
            </div>
            @endif
            <h5 class="card-text">{!! nl2br(e($report->content)) !!}</h5>
          </div>
          <div class="card-footer text-muted"></div>
        </div>
      </div>
    </div>
  </div>  
 
  
  <div class="row mb-5">
    <div class="offset-sm-7 col-sm-4 mb-5" >
      <div id="show-return-btn">
        <!--<a class="btn btn-lg btn btn-outline-secondary" href="#" role="button">Return</a>-->
        {!! link_to_route('reports.index', 'Return' , ['date' => $monday], ['class' => 'btn btn-lg btn btn-outline-secondary']) !!}
      </div>
      <div id="show-edit-btn">
        <!--編集ボタン-->
        <!--<a class="btn btn-lg btn-outline-info" href="#" role="button">Edit</a>    -->
        {!! link_to_route('reports.edit', 'edit', ['id' => $report->id], ['class' => 'btn btn-lg btn-outline-info']) !!}
      </div>
    </div>
  </div>
   <!--link_to_route('reports.edit', 'edit', ['id' => $report->id], ['class' => 'btn btn-light']) -->
   

    
</div>  
@endsection