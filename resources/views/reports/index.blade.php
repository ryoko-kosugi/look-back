@extends('layouts.app')

@section('content')

   
<div class="text-center mt-3 mb-3 ">
  <h1>One week</h1>
</div>
                
<div class="container">
    
    <div class="row">
        @if (count($reports) > 0)
          @foreach ($reports as $report)
         
      <div class= "col-sm-6">
          <div class="card border-dark mb-3 mr-3">
            <a href="/reports/{{ $report->id }}">
                <div class="card-header">
                  <h2>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $report->date)->formatLocalized('%Y/%m/%d(%a)') }}</h2>
                  <h3>{{ floor($report->time / 60) . " h "}}{{ floor($report->time % 60) . " min " }}</h3>
                </div>
            </a>
                <div class="card-body text-dark">
                  <h4 class="card-title">{!! nl2br(e($report->title)) !!}</h4>
                  <p class="card-text">{!! nl2br(e($report->content)) !!}</p>
                </div>
          </div>
      </div>

      @endforeach
      @endif
    </div>
  
    <div class="row justify-content-center">
      <div class="col-sm-6">
       <!--左に余白-->
      </div>
      
      <div class="col-6">
        <div class="card border-dark mb-3 mr-3">
          <div class="card-header">total work time of this week</div>
          <div class="card-body text-dark">
            <h4 class="card-title">{{ floor($sum / 60) }}h : {{ $sum % 60  }}min</h4>
            <p class="card-text">  </p>
          </div>
        </div>
      </div>
    </div>
    
</div>

 
  <table class="table table-striped">
    <thead>
      <tr>
        <th>last_monday</th>
        <th>today</th>
        <th>total of worktime</th>
        <th>minute</th>
        <th>this_monday</th>
        <th>next_sunday</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ $last_monday }}</td>
        <td>{{ $today }}</td>
        <td>{{ floor($sum / 60) }}hour</td>
        <td>{{ $sum % 60  }}minute</td>
        <td>{{ $this_monday }}</td>
        <td>{{ $next_sunday }}</td>
      </tr>
    </tbody>
  </table>

        <nav aria-label="ページャー">
          <ul class="pagination justify-content-center">
            <li>
              <a class="btn page-link rounded-pill" href="#">&larr; back</a>
               <!--$reports->links('pagination::bootstrap-4') -->
            </li>
            <li class="mx-2">
              <a class="btn page-link rounded-pill" href="#">this week</a>
               <!--$reports->links('pagination::bootstrap-4') -->
            </li>
            <li>
              <a class="btn page-link rounded-pill" href="#">next &rarr;</a>
               <!--$reports->links('pagination::bootstrap-4') -->
            </li>
          </ul>
        </nav>
  

@endsection