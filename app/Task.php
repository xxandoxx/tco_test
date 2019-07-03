<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 */
class Task extends Model
{

    const STATUS = [1 => 'assigned', 2 => 'in progress', 3 => 'done'];

    protected $fillable = [
        'title', 'description', 'deadline', 'user_id', 'status'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function assign()
    {
        return $this->hasMany(Assign::class);
    }

    public function getManagerList()
    {
        return $this
            ->where('user_id', auth()->user()->id)
            ->orDoesntHave('assign')->with('assign');
    }
}
