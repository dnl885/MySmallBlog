<?php

namespace App\Http\Controllers\AppPublic\AppDefault;

use App\Constants\PaginationConstants;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(?int $year = null,?string $month = null){
        $posts = Post::latest();

        if($year && $month){
            $posts = $posts->whereYear('created_at','=',$year)->whereMonth('created_at','=',$month);
        }

        $posts = $posts->simplePaginate(PaginationConstants::ITEMS_PER_PAGE);

        return view('public.index',compact('posts'));
    }

    public function postComment(Request $request){
        $post = Post::find($request->route('post'));

        $user = Auth::user();

        $content = $request->request->get('fa-comment');

        $Comment = new Comment(['content'=>$content]);

        $commentUser = $Comment->user();
        $commentUser->associate($user);

        $commentPost = $Comment->post();
        $commentPost->associate($post);

        $Comment->save();

        return redirect()->route('posts.show',['post'=>$request->route('post')]);
    }

    public function showPost(int $id):View
    {
        $post = Post::findOrFail($id);

        return view('public.posts.show',compact('post'));
    }
}
