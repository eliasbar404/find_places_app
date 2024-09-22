<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory,SoftDeletes;

    public $incrementing = false;  // Since you're using UUIDs, set incrementing to false
    protected $keyType = 'string';  // UUIDs are stored as strings

    protected $fillable = ['id', 'name', 'description','slug','map','address','phone_number','email','website','city_id','status','view_count','latitude','longitude'];

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
    public function city(){
        return $this->belongsTo(City::class);
    }


    public function images(){
        return $this->hasMany(Image::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_place');
    }


    public function getImageAttribute($value)
{
    return $value ? asset('storage/' . $value) : null;
}
    

}
