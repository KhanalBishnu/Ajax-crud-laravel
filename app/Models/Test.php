<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    public function getImageUrl()
    {
        $media = $this->getFirstMedia('test_image');
        if ($media) {
            return $media->getUrl();
        } else {
            return '';
        }
    }
    protected $fillable=[
        'name',
        'description',
        'price',
    ];
}
