<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $table = 'recipes';
    protected $primaryKey = 'rid';
    protected $fillable = [
        'image',
    ];
    public $guarded = ['rid','created_at','updated_at'];//書き込み禁止フィールド


}
