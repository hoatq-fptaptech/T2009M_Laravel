<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = [
        "name",
        "image",
        "description",
        "price",
        "qty",
        "category_id",
    ];

    public function Category(){
//        return $this->belongsTo(Category::class,"category_id","id");
        return $this->belongsTo(Category::class);// phai khoa ngoai la category_id va khoa chinh ben category la id
        // return $this->belongsTo(Model::class,"model_id","id") -> return $this->belongsTo(Model::class)
    }
}
