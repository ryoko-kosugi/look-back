<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\User;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if (\Auth::check()) {
         
           $user = \Auth::user();//ログインユーザの取得
           
           $this_monday = Carbon::now()->startOfWeek();//今週月曜日を取得
       
           $n = null;//日付リクエストされた時の「$n」が空になるエラーを防ぐ
         
           //パラメータ切り分けテスト
           //pageリクエスト（ページ送りから）を取得し、かつ、その値が整数値であることを確認できたなら
           if($request->get('page') && is_int($request->get('page'))) {
             
               $page = $request->get('page');//リクエストされたページ数を取得
               $n = $page;  //ページ数を格納

               $from = $this_monday->subWeeks($n - 1);//ページ毎の月曜日
               $to = $from->copy()->addDay(6);//それに合わせた各日曜日
               
           //dateリクエスト（日付リストから）を受けて、かつ、日付を取得できたなら
           }elseif($request->get('date') && strtotime($request->get('date'))){
               
               $request_date = $request->get('date');//リクエストされた日付を取得"2020-01-06"
               
               $from = new Carbon($request_date);// date: 2020-01-06 00:00:00.0 Asia/Tokyo (+09:00)
               $to = $from->copy()->addDay(6);//date: 2020-01-12 00:00:00.0 Asia/Tokyo (+09:00)
             
           //pageリクエストでもdateリクエストでも無い場合 ( 「/reports」の時に「1」を取得する )        
           }else{
              $page = $request->get('page', 1);// 「/reports」の時に「1」を取得する
              $n = $page;  //ページ数を格納

              $from = $this_monday->subWeeks($n - 1);//先週の月曜日 
              $to = $from->copy()->addDay(6);//先週の日曜日   
          }
          
            $reports = $user->reports()->where('date', '>=', $from)
                                       ->where('date', '<=', $to)->orderBy('date')
                                       ->get();
                           
            $sum = $reports->sum('time'); //時間の集計
      
            return view('reports.index', [
                'reports' => $reports,
                'sum' => $sum,
                'n' => $n,
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
 
    // １０週間毎の表示ページ
    public function every_week(Request $request)
    {
        
        if (\Auth::check()) {
            $user = \Auth::user(); //ログインユーザの取得
            
            $reports = $user->reports()->orderBy('date', 'desc')->paginate(10); //全report取得(日付降順)
            
            // ページ取得
           //is_numericで数値であることを判定。intvalで整数値に変換。true->ページ数を取得。false->「1」を取得。
            $page = is_numeric($request->get('page')) ? intval($request->get('page')): 1;
            $n = $page; //ページ数を格納
        
            $last_monday = Carbon::now()->startOfWeek()->subWeeks(1);//先週の月曜  date: 2020-01-27 00:00:00.0 Asia/Tokyo (+09:00)
           
            //ページの切り分けを行う
            if($n > 1){
                $from = $last_monday->copy()->subWeeks(($n - 1) * 10);
                $to = $from->copy()->addDay(6);
            
            }else{
                $from = $last_monday->copy();//page=1 先週の月曜日
                $to = $from->copy()->addDay(6);
            }
            
            $baseFrom = $from->copy();//ページの最初の月曜
         
            $weeks = []; //１週間の配列を準備 
            
            for($i = 0;$i <= 9; $i ++){
               
                $from = $baseFrom->copy()->subWeeks($i);//for各月曜日 01-27,
                $to = $from->copy()->addDay(6);//for各日曜日 02-02,
               
                $monday = $from->copy();//各月曜日
                $total_Time = $user->reports()->where('date', '>=', $from)
                                              ->where('date', '<=', $to)->orderBy('date')
                                              ->get();
                //１週間に格納
                $weeks[] = [
                    'monday' => $monday, //各月曜日
                    'sum' => $total_Time->sum('time'), //各週worktimeの集計
                ];
            }
            
            return view('reports.every_week', [
                'reports' => $reports, //全report取得(日付降順)
                'weeks' => $weeks, //各月曜日,各週worktimeの集計(表示のみ,中身は無し)
                'n' => $n,
           ]); 
         
        }   
     return view('/');
    }

}
