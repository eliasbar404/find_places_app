<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    public $incrementing = false;  // Since you're using UUIDs, set incrementing to false
    protected $keyType = 'string';  // UUIDs are stored as strings
        // Automatically generate UUIDs when creating a new category
        protected static function boot() {
            parent::boot();
            static::creating(function ($model) {
                if (!$model->getKey()) {
                    $model->{$model->getKeyName()} = (string) Str::uuid();
                }
            });
        }

    protected $fillable = ['id', 'name', 'parent_id'];




    // Define a relationship to get the parent category
    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
    
    // Define a relationship to get child categories
    public function children(){
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function places()
    {
        return $this->belongsToMany(Place::class, 'category_place');
    }
}
