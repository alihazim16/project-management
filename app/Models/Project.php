<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Pastikan ini di-import untuk relasi user
use App\Models\Task; // Pastikan ini di-import untuk relasi task

class Project extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'due_date',
        'status',
        'user_id', // Penting: pastikan user_id juga bisa diisi jika otomatis dari Auth::user()->projects()->create()
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     * Misalnya, tanggal dapat di-cast ke objek Carbon.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
    ];

    /**
     * Definisikan relasi: satu Project dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Definisikan relasi: satu Project memiliki banyak Task.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
