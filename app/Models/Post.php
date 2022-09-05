<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

/**
 * Class Post
 * @package App\Models
 * @property integer id
 * @property integer user_id
 * @property string title
 * @property string description
 * @property string content
 * @property string image
 * @property User author
 * @property boolean is_published
 * @property Carbon published_at
 * @method static Builder published()
 */
class Post extends Model
{
    use HasFactory, AsSource, Attachable;

    const ACCEPT_FILE_TYPES = 'image/*,application/pdf,application/xml,text/xml,application/vnd.ms-excel*';
    const MAX_FILE_SIZE = '3M';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'content',
        'image',
        'is_published',
        'published_at',
    ];

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
    ];

    protected $with = [
        'author'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now()->toDateTimeString())
            ->where('is_published', 1)
            ->orderByDesc('published_at');
    }

    public function datePublished()
    {
        return $this->published_at->format('d M Y');
    }

    public function getImage()
    {
        return $this->image ?? asset('public/assets/images/blog-post-01.jpg');
    }
}
