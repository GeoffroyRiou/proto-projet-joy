<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkTool extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $increments = true;

    protected $fillable = [
        'name',
        'description',
        'category',
        'ages',
        'skills',
        'type',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
