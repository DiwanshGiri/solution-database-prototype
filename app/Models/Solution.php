<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Solution extends Model { protected $fillable=['name','description']; public function problems(){return $this->belongsToMany(Problem::class);} public function offers(){return $this->belongsToMany(Offer::class);} }
