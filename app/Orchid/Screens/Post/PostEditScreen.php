<?php

namespace App\Orchid\Screens\Post;

use App\Http\Requests\PostUserRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class PostEditScreen extends Screen
{
    public $post;

    /**
     * Query data.
     *
     * @param Post $post
     * @return array
     */
    public function query(Post $post): iterable
    {
        $post->load('attachment');
        return [
            'post' => $post
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->post->exists ? 'Edit post' : 'Creating a new post';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create post')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->post->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->post->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->post->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        $authorId = $this->post->exists ? $this->post->user_id : \request()->user()->id;

        return [

            Layout::rows([

                Input::make('post.user_id')
                    ->value($authorId)
                    ->hidden(),

                Input::make('post.title')
                    ->title('Title:')
                    ->placeholder('Title')
                    ->required(),

                TextArea::make('post.description')
                    ->title('Shot description')
                    ->placeholder('Shot description')
                    ->required(),

                Quill::make('post.content')
                    ->title('Description')
                    ->toolbar(['text', 'color', 'quote', 'header', 'list', 'format']),

                RadioButtons::make('post.is_published')
                    ->title('Published')
                    ->options([
                        1 => 'Enabled',
                        0 => 'Disabled',
                    ]),

                DateTimer::make('post.published_at')
                    ->title('Published at')
                    ->required()
                    ->enableTime(),

                Cropper::make('post.image')
                    ->targetRelativeUrl()
                    ->title('Large web banner image, generally in the front and center')
                    ->maxWidth(770)
                    ->maxHeight(340),

                Upload::make('post.attachment')
                    ->title('Attachments')
                ->maxFileSize(Post::MAX_FILE_SIZE)
                ->acceptedFiles(Post::ACCEPT_FILE_TYPES)
            ])
        ];
    }

    public function createOrUpdate(Post $post, PostUserRequest $request)
    {
        $post->fill($request->get('post'))->save();

        $post->attachment()->syncWithoutDetaching(
            $request->input('post.attachment', [])
        );

        Alert::info('You have successfully created a post.');

        return redirect()->route('platform.post.list');
    }

    public function remove(Post $post)
    {
        if(!empty($post->image))
            unlink(public_path() . $post->image);

        $post->delete();

        Alert::info('You have successfully deleted the post.');

        return redirect()->route('platform.post.list');
    }
}
