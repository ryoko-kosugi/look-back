@extends('layouts.app')

@section('content')

<div class="text-center mt-3 mb-3 ">
  <h1>Every week</h1>
</div>

<div class="row justify-content-center">
  <div class="col-md-9 col-lg-7 col-xl-6">
    
      <ul>
        <div class="list-group">
          @foreach($weeks as $week)
            <div class="week" id="{{ $week['monday'] }}">
              <a href="/reports?date={{ $week['monday'] }}">
                <div class="list-group-item list-group-item-action">
                  <div class="d-none d-sm-block">
                  {{ ($week['monday'])->formatLocalized('%Y/%m/%d(%a)') }} week &ensp; &ensp; &ensp;
                  {{ floor($week['sum'] / 60) }} : {{ $week['sum'] % 60 }}min
                  </div>
                  <div class="d-block d-sm-none">
                  {{ ($week['monday'])->formatLocalized('%Y/%m/%d(%a)') }} week &ensp; &ensp; &ensp;
                  <div class="text-left">{{ floor($week['sum'] / 60) }} : {{ $week['sum'] % 60 }}min </div>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </ul>
    
  </div>
</div>

<div class="page-btn">
  <nav aria-label="ページャー">
    <ul class="pagination justify-content-center">
      @if($n > 1)
      <li>
        <!--<a class="btn page-link rounded-pill" href="#">next &rarr;</a>-->
        {!! link_to_route('reports.every_week', '&larr; Return ', ['page' => $n - 1], ['class' => 'btn page-link rounded-pill']) !!}  
      </li>
      @endif      
      @if($n > 2)
      <li class="mx-2">
        <!--<a class="btn page-link rounded-pill" href="http://70571cdcebd84e0285c3fb0ff4805519.vfs.cloud9.us-east-1.amazonaws.com/reports/every_week">（仮）最近</a>-->
        {!! link_to_route('reports.every_week', 'Recent', ['page' => 1], ['class' => 'btn page-link rounded-pill']) !!}
      </li>
      @endif
      <li>
        <!--<a class="btn page-link rounded-pill" href="http://70571cdcebd84e0285c3fb0ff4805519.vfs.cloud9.us-east-1.amazonaws.com/reports/every_week1">&larr; （仮）前の10週</a>-->
         <!--link_to_route('reports.every_week1', '&larr;（仮）前の10週', [], ['class' => 'btn page-link rounded-pill']) !!}-->
        {!! link_to_route('reports.every_week', ' Backward &rarr;', ['page' => $n + 1], ['class' => 'btn page-link rounded-pill']) !!} 
      </li>
    </ul>
  </nav>
</div>


@endsection