<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id' ,
        'name',
        'slug',
        'description',
        'image',
        'status'
    ];
    public static function rules($id = 0){
        return [
            'name' => ["required" ,"string","min:3","max:255","unique:categories,name,$id",
            new Filter
        ],
            'parent_id' => 'nullable|int|exists:categories,id',
            'image' =>[
                'image',
                'mimes:jpg,jpeg,png',
                'dimensions:min_width=100,min_height=100'
            ],
            'status' => "required|in:active,archived",

        ];
    }
}
