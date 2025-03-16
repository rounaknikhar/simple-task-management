<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    /**
     * Protect the fields from mass assignment.
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'complete'
    ];

    /**
     * Get the user that owns this task.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
