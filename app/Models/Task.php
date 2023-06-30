<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    /**
     * Relationship to table projects
     *
     * @return BelongsTo
     */
    public function belongsTo(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function scopeFilterDataProject($model, $request)
    {
        if ($request->has('key') && $request->has('value')) {
            $model->whereHas('project', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('value') . '%');
            });
        }
    }
}
