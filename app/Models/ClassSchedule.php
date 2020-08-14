<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    protected $table = 'class_schedule';

    protected $fillable = [
        'week_day', 'from', 'to', 'class_id'
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'class_id');
    }

    public $timestamps = false;
}
