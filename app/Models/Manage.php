<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manage extends Model
{
  use HasFactory;
  
  protected $table = 'manages';

  protected $fillable = [
    'tittle',
    'image',
    'user_id'
  ];
 
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

  protected $appends = ['image_url'];

    public function getImageUrlAttribute(){
        if($this->image){
            return asset('storage/' . $this->image);
        }
        return null;
    }
}