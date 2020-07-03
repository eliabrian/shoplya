<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $fillable = ['lists_id', 'name', 'quantity', 'completed'];

    public function list()
    {
        return $this->belongsTo('App\Lists', 'lists_id');
    }
}
