<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable = [
        'title',
        'image',
        'description',
        'content',
    ];

    //Làm thuộc tính created theo định dạng d/m/Y
    protected function createdDate(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>date('d/m/Y',strtotime($this->created_at)),
        );
    }
}
