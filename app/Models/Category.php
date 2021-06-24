<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
//    protected $primaryKey = "id"; // nếu là cột id thì ko cần khai báo
//    protected $keyType = "int"; // neu la int khong can khai bao
    protected $fillable = [
        "name"
    ];
//    public $timestamps = true;// mặc định là true  -> tự động cập nhật thời gian vào 2 cột created_at và updated_at

    public function Products(){
        return $this->hasMany(Product::class);// tra ve 1 collection cac Product object
    }
}
