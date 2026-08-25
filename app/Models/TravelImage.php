<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelImage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'travel_images';

    protected $fillable = [
        'travel_id',
        'image_path',
        'order',
    ];

    /**
     * Get the travel that owns this image.
     */
    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
}
