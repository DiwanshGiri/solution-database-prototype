<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tag extends Model { protected $fillable=['name']; public function offers(){return $this->belongsToMany(Offer::class);} }
