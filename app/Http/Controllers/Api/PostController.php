<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function add(Request $request)
    {
        //获取传递的参数
        $title = $request->title;
        $content = $request->content;
        //判断是不是传值有没有缺失，如果有返回错误
        if(empty($title) || empty($content)) {
            return response()->json([
                'ret' => '1001',
                'desc' => '缺少参数',
                'data' => null
            ]);
        }
        //创建一个Post的实例并且保存
        $post = new Post;
        $post->title = $title;
        $post->content = $content;
        $post->save();
        //返回一个响应告诉客户端新建成功了
        return response()->json([
            'ret' => '200',
            'desc' => '成功',
            'data' => null
        ]);
    }

    public function list(Request $request)
    {
        return response()->json([
            'ret' => 200,
            'desc' => '成功',
            'data' => Post::get()
        ]);
    }

    public function delete(Request $request)
    {
        //从请求获取要删除的id
        $id = $request->id;
        //通过find静态方法传入实例的id尝试获取对应的实例
        $post = Post::find($id);
        //判断这个实例存不存在，不存在则直接返回错误
        if(empty($post)){
            return response()->json([
                'ret' => '1002',
                'desc' => '找不到该文章',
                'data' => null
            ]);
        }
        //调用delete方法删除实例
        $post->delete();
        //返回成功的响应
        return response()->json([
            'ret' => 200,
            'desc' => '成功',
            'data' => null
        ]);
    }

    public function modify(Request $request)
    {
        //用请求获取数据
        $id = $request->id;
        $title = $request->title;
        $content = $request->content;
        //通过find静态方法传入实例的id尝试获取对应的实例
        $post = Post::find($id);
        //判断这个实例存不存在，不存在则直接返回错误
        if(empty($post)){
            return response()->json([
                'ret' => '1002',
                'desc' => '找不到该文章',
                'data' => $request->all()
            ]);
        }
        //判断用户有没有传入对应的数据，有的话就更新model实例的对应项。
        if(!empty($title)){
            $post->title = $title;
        }
        if(!empty($content)){
            $post->content = $content;
        }
        //把更改应用进数据库
        $post->save();
        return response()->json([
            'ret' => 200,
            'desc' => '成功',
            'data' => null
        ]);
    }
}