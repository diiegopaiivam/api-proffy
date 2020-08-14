<?php


namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'subject', 'cost', 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function classSchedule()
    {
        return $this->hasMany(ClassSchedule::class, 'class_id');
    }

    public $timestamps = false;


}
