<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Kpi extends Model { protected $fillable=['name','description']; public function problems(){return $this->belongsToMany(Problem::class);} }
