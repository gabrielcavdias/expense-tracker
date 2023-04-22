<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'value', 'type', 'date', 'category_id', 'user_id'];

    protected function value(): Attribute
    {
        return Attribute::make(
            // get
            fn ($value) => $value+0,
            // set
            fn ($value) => $value,
        );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);   
    }
}
