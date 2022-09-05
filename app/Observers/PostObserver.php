<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function deleting(Post $post)
    {
        $post->attachment->each->delete();
    }
}
