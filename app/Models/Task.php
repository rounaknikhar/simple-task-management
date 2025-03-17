<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
        // Format the created at date.
        'created_at' => 'datetime:d/m/Y'
    ];

    /**
     * Get the user that owns this task.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the tags attached to this task.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'task_tag')->withTimestamps();
    }
}
