<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icategory extends Model
{
    use HasFactory;
    protected $table = 'icategory';
    protected $primaryKey = 'cid';
    public $guarded = ['cid','cname'];//書き込み禁止フィールド
}
