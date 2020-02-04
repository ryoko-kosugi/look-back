@extends('layouts.app')

@section('content')

<div class="text-center mt-3 mb-3 ">
<h1>Every weeks</h1>
</div>



<div class="row justify-content-center">
  <div class="col-sm-6">
    <ul>
      <div class="list-group">
        @foreach($weeks as $week)
        <div class="list-group-item list-group-item-action">
          <a href="/reports?date={{ $week['monday'] }}">
          
            {{ $week['monday'] }} week {{ floor($week['sum'] / 60) }} : {{ $week['sum'] % 60 }}min
          </a>
        </div>
        @endforeach
      </div>
    </ul>
  </div>
  </div>
</div>

<nav aria-label="ページャー">
  <ul class="pagination justify-content-center">
    <li>
      <!--<a class="btn page-link rounded-pill" href="http://70571cdcebd84e0285c3fb0ff4805519.vfs.cloud9.us-east-1.amazonaws.com/reports/every_week1">&larr; （仮）前の10週</a>-->
       <!--link_to_route('reports.every_week1', '&larr;（仮）前の10週', [], ['class' => 'btn page-link rounded-pill']) !!}-->
      {!! link_to_route('reports.every_week', '&larr;（仮）前の10週', ['page' => $n + 1], ['class' => 'btn page-link rounded-pill']) !!} 
    </li>
    @if($n > 2)
    <li class="mx-2">
      <!--<a class="btn page-link rounded-pill" href="http://70571cdcebd84e0285c3fb0ff4805519.vfs.cloud9.us-east-1.amazonaws.com/reports/every_week">（仮）最近</a>-->
      {!! link_to_route('reports.every_week', '（仮）最近の10週', ['page' => 1], ['class' => 'btn page-link rounded-pill']) !!}
    </li>
    @endif
    @if($n > 1)
    <li>
      <!--<a class="btn page-link rounded-pill" href="#">next &rarr;</a>-->
      {!! link_to_route('reports.every_week', '（仮）戻る &rarr;', ['page' => $n - 1], ['class' => 'btn page-link rounded-pill']) !!}  
    </li>
    @endif
  </ul>
</nav>

<!--テスト一覧-->
<h2>一覧テスト(削除予定)</h2>
<div class="row justify-content-center">
<div class="col-sm-6">
  @if (count($reports) > 0)
  <div class="list-group">
    @foreach ($reports as $report)
    <a href="/reports/{{ $report->id }}" class="list-group-item list-group-item-action">
      {{ $report->date }}
    </a>
    @endforeach
  </div>
  @endif
</div>
</div> 

<div class="row justify-content-center">
  <div class="mt-5 mb-3">
    {{ $reports->links('pagination::bootstrap-4') }} 
  </div>
</div>


        
@endsection