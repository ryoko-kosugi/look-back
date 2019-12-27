<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\User;
use Carbon\Carbon;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (\Auth::check()) {
           $user = \Auth::user();
       
           $this_monday = date('Y-m-d',strtotime('Monday this week')); //今週の月曜日
           $next_sunday = date('Y-m-d',strtotime('Sunday')); //日曜日
          
           $lastweek = date('Y-m-d', strtotime('-1 week')); //今日から１週間前の日にち
           $last_monday = date('Y-m-d', strtotime('last Monday')); //今週の月曜日
           $today = date('Y-m-d'); //今日
           
           $reports = $user->reports()->where('date', '>=', $this_monday)
                                      ->where('date', '<=', $next_sunday)
                                      ->get();
           
           $sum = $reports->sum('time'); //時間の集計
        //   $reports = Report::paginate(10);
        
           return view('reports.index', [
                'reports' => $reports,
                'today' => $today,
                'last_monday' => $last_monday,
                'sum' => $sum,
                'this_monday' => $this_monday,
                'next_sunday' => $next_sunday,
           ]);
      }
       
       return view('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $report = new Report;
        // 新規作成画面を表示する
        
        // ただし日付重複する場合は新規ではなくて編集画面を表示する。
        // そのための事前準備として、インスタンスを用意してそれをViewに渡します。
        // 日付の取得
        // $date = new Carbon($request->date);
        // DBにこの組み合わせデータが存在する場合は取得し
        // $report = Report::firstOrNew([
        //     'user_id' => \Auth::id(),
        //     'date' => $date,
        // ], [
        //     'date'   => $date,
        // ]);
        // 存在しない場合はインスタンスを取得する。
        // 但し、データは保存しない(store()で保存する)
        
        return view('reports.create', [
            'report' => $report,    
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'date' => 'required|date',
            'title' => 'nullable|max:280',
            'content' => 'nullable|max:10000', 
        ]);
        
        $report = new Report;
        $report->user_id = \Auth::id();
        $report->date = $request->date;
        $report->time = (int) $request->hour * 60 + $request->minute;
        $report->title = $request->title;
        $report->content = $request->content;
        $report->save();
        
        return redirect('/');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::find($id);
        
        if (\Auth::id() === $report->user_id) {
           
            return view('reports.show', [
                    'report' => $report,
            ]);
        }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::find($id);
        
        if (\Auth::id() === $report->user_id) {
            
            return view('reports.edit', [
                'report' => $report,    
            ]);
        }
        
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'title' => 'nullable|max:280',
            'content' => 'nullable|max:10000',
        ]);
        
        $report = Report::find($id);
        
        if (\Auth::id() === $report->user_id) {
        
            $report->date = $request->date;
            $report->time = (int)$request->hour * 60 + $request->minute;
            $report->title = $request->title;
            $report->content = $request->content;
            $report->save();
            
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::find($id);
        
        if (\Auth::id() === $report->user_id) {
            
            $report->delete();
            
        }
        return redirect('/');
    }
 
    
    public function every_week()
    {
       
        if (\Auth::check()) {
            $user = \Auth::user();
            
            $reports = $user->reports()->orderBy('date', 'desc')->paginate(10); //全report取得(日付降順)
            
                // 今週の月曜を基準に考える
            $targetTime = strtotime('last Monday');  
              
            $weeks = [];            
            
            for($i = -1;$i >= -10;$i--) {
                $date = date('Y-m-d', strtotime($i .' week', $targetTime));//"2019-12-16"
                $monday = date('Y-m-d', strtotime($i .' week', $targetTime)); 
                $sunday = date('Y-m-d', strtotime('+6 day', strtotime($monday)));
               
                $totalTime = $user->reports()->whereDate('date', '>=', $monday)
                                             ->whereDate('date', '<=', $sunday)
                                             ->get(); //   １件につき月曜から日曜のreport取得
              
                $weeks[] = [
                    'date' => $date,
                    'sum' => $totalTime->sum('time'),
                ];
            }
                
            // $sum = $reports->sum('time'); //時間の集計
            
           return view('reports.every_week', [
                'reports' => $reports,
                
                'weeks' => $weeks,
           ]);      
        }   
     return view('/');
    }
}
