<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title', 'phone_number', 'description', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
