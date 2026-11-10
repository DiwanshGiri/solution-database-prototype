<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Offer extends Model { protected $fillable=['name','type','description','url']; public function solutions(){return $this->belongsToMany(Solution::class);} public function tags(){return $this->belongsToMany(Tag::class);} }
