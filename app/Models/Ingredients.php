<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    use HasFactory;
    protected $table = 'ingredients';
    protected $primaryKey = 'iid';
    public $guarded = ['iid','cid','iname','salt','protein','carbo','fat','unit','pergram'];//書き込み禁止フィールド
}
