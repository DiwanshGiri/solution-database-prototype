<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Problem extends Model { protected $fillable=['name','description']; public function solutions(){return $this->belongsToMany(Solution::class);} }
