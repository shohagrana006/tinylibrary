<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function bookToMember(){
        return $this->hasOne('App\Models\Member', 'id', 'issue_member');
    }
}
