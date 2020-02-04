<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Remember;

class RememberController extends Controller
{
    public function find(Request $request)
    {
        $ip=$request->ip;
        $post=Remember::find($ip);
        //搜索相应ip
        if(empty($post)){
            return response()->json([
                'ret' => '1002',
                'desc' => '找不到该ip',
                'data' => null
            ]);
        };
        if(!empty($post)){
            return response()->json([
                'ret' => 200,
                'desc' => '成功',
                'data' => $post
            ]);
        }
    }
    public function delete(Request $request)
    {
        //从请求获取要删除的id
        $id = $request->id;
        //通过find静态方法传入实例的id尝试获取对应的实例
        $post = Remember::find($id);
        //判断这个实例存不存在，不存在则直接返回错误
        if(empty($post)){
            return response()->json([
                'ret' => '1002',
                'desc' => '找不到该痕迹',
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

    public function visit(Request $request)
    {
        return response()->json([
            'ret' => 200,
            'desc' => '成功',
            'data' => Remember::get()
        ]);
    }

    public function record(Request $request)
    {
         //获取传递的参数
         $ip = $request->ip();
         $user_agent = $request->user_agent;
         //判断是不是传值有没有缺失，如果有返回错误
         if(empty($ip) || empty($user_agent)) {
             return response()->json([
                 'ret' => '1001',
                 'desc' => '缺少参数',
                 'data' => null
             ]);
         }
         //创建一个Post的实例并且保存
         $post = new Remember;
         $post->ip = $ip;
         $post->user_agent = $user_agent;
         $post->save();
         //返回一个响应告诉客户端新建成功了
         return response()->json([
             'ret' => '200',
             'desc' => '成功',
             'data' => null
         ]);
    }

}
