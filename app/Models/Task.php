<?php

namespace App\Models; // <-- Pastikan namespace ini benar

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project; // <-- Tambahkan ini untuk relasi project
use App\Models\User;    // <-- Tambahkan ini untuk relasi user (assignee)

class Task extends Model // <-- Pastikan nama kelas adalah 'Task'
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'assigned_to',
        'status',
        'due_date',
        'priority',
    ];

    // Definisikan relasi
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}