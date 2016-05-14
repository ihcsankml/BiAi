<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Records extends Model
{
    protected $table = 'records';
    protected $fillable = array('kota', 'tanggal', 'komplain', 'resolved');
    public $timestamps = false;
}
