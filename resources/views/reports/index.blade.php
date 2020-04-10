@extends('layouts.app')

@section('content')

<div class="text-center mt-3 mb-3 ">
  <h1>One week</h1>
</div>
                
<div class="container">
    
  <div class="row">
      @if (count($reports) > 0)
        @foreach ($reports as $report)
    <div class= "col-md-6">
      <div class="report-card">
        <div class="card">
          <a href="/reports/{{ $report->id }}">
              <div class="card-header">
                <h2>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $report->date)->formatLocalized('%Y/%m/%d(%a)') }}</h2>
                <h3>{{ floor($report->time / 60) . " h "}}{{ floor($report->time % 60) . " min " }}</h3>
              </div>
              <div class="report-index">
                <div class="card-body text-dark">
                  @if($report->title)
                  <div class="important">
                    <h4 class="card-title">{!! nl2br(e($report->title)) !!}</h4>
                  </div>
                  @endif
                  @if(mb_strwidth($report -> content) >= 300)
                  <p class="card-text">{!! mb_substr( nl2br(e($report->content)), 0, 300) !!}<div id="continue"> ▶&ensp;▶</div>︎</p>
                  @else
                  <p class="card-text">{!! nl2br(e($report->content)) !!}</p>
                  @endif
                </div>
              </div>
          </a>
        </div>
      </div>
    </div>
    @endforeach
    @endif
  </div>

  <div class="row justify-content-center">
    <!--<div class="col-lg-offset-5 col-lg-5 ">-->
     <!--左に余白-->
    <!--</div>-->
    <div class="offset-md-7 col-md-5">
      <div id="total-time">
        <div class="card border-dark mb-3">
          <div id="total-time-title">
            <div class="card-header">total work time of this week</div>
          </div>
          <div id="total-time-body">
            <div class="card-body text-dark">
              <h4 class="card-title text-right text-md-left">{{ floor($sum / 60) }}h : {{ $sum % 60  }}min</h4>
              <p class="card-text">  </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="page-btn">
    <nav aria-label="ページャー">
      <ul class="pagination justify-content-center">
        @if($n > 1)
        <li>
          <!--<a class="btn page-link rounded-pill" href="#">next week &rarr;</a>-->
          {!! link_to_route('reports.index', '&larr; Return ', ['page' => $n - 1], ['class' => 'btn page-link rounded-pill']) !!}
        </li>
        <li class="mx-2">
          <!--<a class="btn page-link rounded-pill" href="#">this week</a>-->
          {!! link_to_route('reports.index', 'This week', ['page' => 1], ['class' => 'btn page-link rounded-pill']) !!}
        </li>
        @endif
        <li>
          <!--<a class="btn page-link rounded-pill" href="#">&larr; last week</a>-->
          {!! link_to_route('reports.index', ' Last week &rarr;', ['page' => $n + 1], ['class' => 'btn page-link rounded-pill']) !!} 
        </li>        
      </ul>
    </nav>
  </div>
      
</div>

@endsection