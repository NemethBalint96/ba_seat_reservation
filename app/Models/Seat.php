<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function reserve()
    {
        if ($this->status === 'szabad') {
            $this->status = 'foglalt';
            $this->save();
            return $this->id;
        }
        return null;
    }
}
