<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes , HasFactory ;
    protected $fillable = [
        'parent_id' ,
        'name',
        'slug',
        'description',
        'image',
        'status'
    ];
    public function scopeFilter(Builder $builder , $filters){

        $builder->when($filters['name'] ?? false , function () use ($builder , $filters){
            $builder->where('categories.name' , 'like' , '%' . $filters['name'] . '%');
        });
        $builder->when($filters['status'] ?? false , function () use ($builder , $filters){
            $builder->where('categories.status' , $filters['status']);
        });

    }
    public static function rules($id = 0){
        return [
            'name' => ["required" ,"string","min:3","max:255","unique:categories,name,$id",
            "filter:laravel,vue,php"
        ],
            'parent_id' => 'nullable|int|exists:categories,id',
            'image' =>[
                'image',
                'mimes:jpg,jpeg,png',
                'dimensions:min_width=100,min_height=100'
            ],
            'status' => "required|in:active,archived",
            'description' => 'required|string|min:3|max:255'

        ];
    }
}
