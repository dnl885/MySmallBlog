<?php

namespace App\Http\Controllers\Admin\Content;

use App\Constants\PaginationConstants;
use App\Constants\RoleConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\CreatePostRequest;
use App\Models\Photo;
use App\Models\Post;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class PostsController extends Controller
{
    private ImageUploadService $imageUploadService;


    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function index():View
    {
        $this->authorize('view',Post::class);

        $posts = Post::latest();

        $user = Auth::user();

        if($user->hasRole(RoleConstants::ROLE_CONTENT_CREATOR)){
            $posts = $posts->where('user_id',$user->id);
        }

        $posts = $posts->simplePaginate(PaginationConstants::ITEMS_PER_PAGE);

        return view('admin.posts.index',compact('posts'));
    }

    public function create():View
    {
        $this->authorize('create',Post::class);

        return view('admin.posts.create');
    }

    public function store(CreatePostRequest $request):RedirectResponse
    {
        $this->authorize('create',Post::class);

        $request->validated();

        $user = Auth::user();

        $post = new Post($request->all());

        $post->user()->associate($user);

        $post->save();

        if($file = $request->request->get('photo_path')){
            $post->photo()->save(new Photo(['path'=>$file]));
        }

        return redirect()->route('posts.index')->with('status','Post successfully created!');
    }

    public function storePhoto(Request $request){
        $request->validate([
            'file'=>'image|max:3072'
        ]);

        $path = $this->imageUploadService->uploadImage($request->file('file'),'photos');

        return response()->json(['path'=>basename($path)]);
    }

    public function uploadCkEditorImage(Request $request){
        $request->validate([
            'upload'=>'image|max:1072',
        ]);

        $dir = 'editor_images';

        $path = $this->imageUploadService->uploadImage($request->file('upload'),$dir);

        $url = asset('uploads/'.$dir.'/'.basename($path));

        return response()->json(['fileName' => basename($path), 'uploaded'=> 1, 'url' => $url]);
    }

    public function deletePhoto(Request $request)
    {
        $fileToDelete = $request->request->get('path');
        $postId = $request->request->get('post_id');

        $resp = [];

        if($postId){
            $fileToDelete = basename($fileToDelete);
        }

        $deletePath = public_path().Photo::PHOTO_DIR.$fileToDelete;

        if(File::delete($deletePath)){

            if($postId){
                $post = Post::find($postId);
                $post->photo()->delete();
            }

            $resp = ['success'=>true,'message'=>'Image successfully deleted!'];
        }else{
            $resp = ['success'=>false,'message'=>'Error while deleting image!'];
        }

        return response()->json($resp);
    }

    public function edit(int $id):View
    {
        $post = Post::findOrFail($id);

        $this->authorize('update',[Post::class,$post]);

        $photoInfos = [];

        if($post->photo){
            $size = File::size(public_path().$post->photo->path);
            $name = File::name(public_path().$post->photo->path);

            $photoInfos = [
                'size'=>$size,
                'name'=>$name,
                'path'=>$post->photo->path
            ];
        }

        return view('admin.posts.edit',compact('post','photoInfos'));
    }

    public function update(CreatePostRequest $request, int $id):RedirectResponse
    {
        $user = Auth::user();

        $request->validated();

        $post = Post::find($id);

        $this->authorize('update',[Post::class,$post]);

        if($file = $request->request->get('photo_path')){
            if(!$post->photo) {
                $post->photo()->save(new Photo(['path' => $file]));
            }
        }

        $post->editor()->associate($user);

        $post->update($request->all());

        return redirect()->route('posts.index')->with('status','Post successfully edited!');
    }

    public function destroy(int $id):RedirectResponse
    {
        $post = Post::find($id);

        $this->authorize('delete',[Post::class,$post]);

        $this->authorize('update',$post);

        $post->delete();

        if($post->photo){
            $fileToDelete = public_path().Photo::PHOTO_DIR.$post->photo->path;
            File::delete($fileToDelete);
            $post->photo->delete();
        }

        return redirect()->route('posts.index')->with('status','Post successfully deleted!');
    }
}
