<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $table = 'connections';

    protected $fillable = [
        'user_id', 'created_at',
    ];

    protected $casts = [
        'created_at' => 'Timestamp',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    /**
     * @param  mixed  $value
     * @return $this
     */
    public function setUpdatedAt($value)
    {
        return $this;
    }
}
