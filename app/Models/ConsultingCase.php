<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ConsultingCase extends Model { protected $fillable=['client_name','need_summary','problem_id','solution_id','kpi_id']; }
