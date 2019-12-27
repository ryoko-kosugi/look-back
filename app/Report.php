<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Report extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'content', 'title', 'time', 'date', 'user_id',    
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function one_weeks($date)
    {
        
        $dt = new Carbon($date);
        $start = $dt->startOfWeek(); //週の初め（月曜日）を取得
        $end = $start->addDay(7); //日曜日
        
        return $this->where('date', '>=', $start)->where('date', '<=', $end);
    }    
}