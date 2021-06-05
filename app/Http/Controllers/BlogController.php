<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * ブログ一覧を表示する
     * ああ
     * @return view
     */
    public function showList()
    {
        $blogs = Blog::all();

        return view('blog.list', ['blogs' => $blogs]);
    } 
    /**
     * ブログ詳細を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id)
    {
        $blog = Blog::find($id);
        if(is_null($blog)){
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }
        return view('blog.detail', ['blog' => $blog]);
    }
    
    /**
     * ブログ登録画面を表示する
     * 
     * @return view
     */
    public function showCreate() {
        return view('blog.form');
    }

    /**
     * ブログ投稿する
     * 
     * @return view
     */
    public function exeStore(BlogRequest $request) {
        //ブログのデータを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();
        try{
            //ブログを登録する
            Blog::create($inputs);
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }


        \Session::flash('err_msg', 'ブログを登録しました。');
        return redirect(route('blogs'));
    }
    /**
     * ブログ詳細を表示する
     * @param int $id
     * @return view
     */
    public function showEdit($id)
    {
        $blog = Blog::find($id);
        if(is_null($blog)){
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }
        return view('blog.Edit', ['blog' => $blog]);
    }
    /**
     * ブログ投稿する
     * 
     * @return view
     */
    public function exeUpdate(BlogRequest $request) {
        //ブログのデータを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();
        try{
            //ブログを登録する
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content'],
            ]);
            $blog->save();
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }


        \Session::flash('err_msg', 'ブログをkousinnしました。');
        return redirect(route('blogs'));
    }
}
