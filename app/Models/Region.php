<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Region extends Model
{
    use HasFactory;

    public $incrementing = false;  // Since you're using UUIDs, set incrementing to false
    protected $keyType = 'string';  // UUIDs are stored as strings

    protected $fillable = ['id', 'name', 'image','map'];

    // Automatically generate UUIDs when creating a new category
    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }


    // Define a relationship to get the all Cities related to the region
    public function cities(){
        return $this->hasMany(City::class);
    }


    public function getImageAttribute($value)
{
    return $value ? asset('storage/' . $value) : null;
}
    

}
