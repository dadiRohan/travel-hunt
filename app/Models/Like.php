<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'likes';

    protected $fillable = [
        'user_id',
        'travel_id',
    ];

    /**
     * Get the user that liked the travel.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the travel that was liked.
     */
    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
}
