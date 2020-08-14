<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Classe;

class User extends Model{

    protected $table = 'users';

    protected $fillable = [
        'name', 'whatsapp', 'avatar', 'bio', 'avaliable'
    ];

    public function classes(){
        return $this->hasMany(Classe::class, 'user_id');
    }


    public $timestamps = false;

}
