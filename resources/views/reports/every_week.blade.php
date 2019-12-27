@extends('layouts.app')

@section('content')

<div class="text-center mt-3 mb-3 ">
<h1>Every weeks</h1>
</div>

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

<div class="row justify-content-center">
  <div class="col-sm-6">
    
    <ul>
      @foreach($weeks as $week)
      <li><a href="#">{{ $week['date'] }} week {{ floor($week['sum'] / 60) }} : {{ $week['sum'] % 60 }}min</a></li>
      @endforeach
    </ul>

  </div>
</div>
@endsection