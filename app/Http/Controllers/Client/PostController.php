<?php

namespace App\Http\Controllers\Client;

use App\Entity\Comments;
use App\Entity\PostLikes;
use App\Entity\Posts;
use App\Entity\User\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mews\Purifier\Facades\Purifier;


class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $pageTitle = trans('user.page.home.header');

        $query = Posts::with('comments','postLikes');

        if (!is_null($author = $request->get('author'))) {
            $query->ByAuthor($author);
        }

        if (!is_null($value = $request->get('sort'))) {
            if ($value == 'created_at_asc') {
                $query->orderByDesc('created_at');
            } elseif ($value == 'created_at_desc') {
                $query->orderBy('created_at');
            } elseif ($value == 'likes_asc') {
                $query->orderByDesc('likes');
            }
        } else {
            $query = $query->orderByDesc('created_at');
        }

        $posts = $query->paginate(25) ;


        return view('client.home', compact( 'pageTitle','posts'));
    }


    public function postDelete(Request $request, Posts  $post)
    {
        try {
            $post->delete();
            return response()->json([
                'success' => true,
                'message' => trans('user.message.successDeletePost'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => true,
                'message' => trans('user.message.errorDeletePost'),
            ]);
        }
    }

    public function postFormCreate(Request $request)
    {
        $pageTitle = trans('user.page.post.create');

        $post = new Posts();
        return view('client.post.create', compact( 'pageTitle','post'));
    }

    public function postCreate(Request $request)
    {
        try {
            $post = new Posts();
            $post->title = $request->get('title');
            $post->body = Purifier::clean($request->get('PostBody'));
            $post->user_id = Auth::user()->id;
            $post->save();
            return redirect()->to(route('client.home'))->with('success', trans('user.message.successCreatePost'));
        } catch (\Exception $exception) {
            return redirect()->to(route('client.home'))->with('error', trans('user.message.errorCreatePost'));
        }
    }

    public function postFormEdit(Request $request, Posts $post)
    {
        $pageTitle = trans('user.page.post.edit');

        return view('client.post.edit', compact( 'pageTitle','post'));
    }

    public function postEdit(Request $request, Posts $post)
    {
        try {
            $post->title = $request->get('title');
            $post->body = Purifier::clean($request->get('PostBody'));
            $post->save();

            return redirect()->to(route('client.home'))->with('success', trans('user.message.successEditPost'));
        } catch (\Exception $exception) {
            return redirect()->to(route('client.home'))->with('error', trans('user.message.errorEditPost'));
        }
    }

    public function show(Request $request, Posts $post)
    {
        $pageTitle = trans('user.page.post.show');
        $query = Comments::where('post_id','=',$post->id);
        $comments = $query->paginate(25) ;

        return view('client.post.show', compact( 'pageTitle','post','comments'));
    }

    public function postLikePost(Request $request )
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Posts::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == true) {
                $post->likes = $post->likes - 1 ;

            }else
            {
                $post->likes = $post->likes + 1 ;
            }
            $post->save();
            if ($already_like == $is_like) {
                $like->delete();
                return response()->json(['success'=>"$post->likes"]);
            }

        } else {
            $like = new PostLikes();
            if ($is_like == true)
            {
                $post->likes = $post->likes + 1 ;
            }

        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        $post->save();
       return response()->json(['success'=>"$post->likes"]);
    }


    public function list(Request $request, User $users)
    {
        $pageTitle = trans('user.page.post.list');

        $query = Posts::with('comments','postLikes')->where('user_id','=',$users->id);


        if (!is_null($value = $request->get('sort'))) {
            if ($value == 'created_at_asc') {
                $query->orderByDesc('created_at');
            } elseif ($value == 'created_at_desc') {
                $query->orderBy('created_at');
            } elseif ($value == 'likes_asc') {
                $query->orderByDesc('likes');
            }
        } else {
            $query = $query->orderByDesc('created_at');
        }

        $posts = $query->paginate(25) ;


        return view('client.post.list', compact( 'pageTitle','posts'));
    }

}
