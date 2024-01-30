<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends BaseModel
{
    public function createdByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
