<?php
// app/Models/Project.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'price',
        'jobs_done'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'started',
        'finished'
    ];
}