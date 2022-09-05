<?php

namespace App\Orchid\Layouts\Post;

use App\Models\Post;
use App\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'posts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', 'Title')
                ->render(function (Post $post) {
                    return Link::make($post->title)
                        ->route('platform.post.edit', $post);
                }),
            TD::make('id', 'Pub. page')
                ->render(function (Post $post) {
                    return Link::make()
                        ->route('post.detail', $post)
                        ->icon('monitor')
                        ->target('_blank');
                }),
            TD::make('author', 'Author')
                ->render(function (Post $post) {
                    return $post->author->name;
                })
                ->canSee(request()->user()->inRole('admin')),
            TD::make('is_published', 'Published')
                ->render(function (Post $post) {
                    return $post->is_published ? 'enable' : 'disable';
                }),
            TD::make('published_at', 'Published at')
                ->render(function (Post $post) {
                    return $post->published_at->format('Y-m-d H:i');
                }),
            TD::make('updated_at', 'Last edit')
                ->render(function (Post $post) {
                    return $post->updated_at->format('Y-m-d H:i');
                }),
        ];
    }
}
