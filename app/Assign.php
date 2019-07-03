<?php
/**
 * Created by PhpStorm.
 * User: andranik.kocharyan
 * Date: 03/07/2019
 * Time: 11:17
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    protected $fillable = [
        'manager_id', 'task_id', 'developer_id', 'status'
    ];
}