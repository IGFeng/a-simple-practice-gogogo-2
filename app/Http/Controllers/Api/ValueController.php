<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Value;

class ValueController extends Controller
{
    public function add(Request $request)//添加功能实现
    {
        //获取传递的参数
        $stg = $request->stg;
        $sen = $request->sen;
        if(empty($stg) || empty($sen)) {
            return response()->json([
                'ret' => '1001',
                'desc' => '缺少参数',
                'data' => null
            ]);
        }
        $value = new Value;
        $value->stg = $stg;
        $value->sen = $sen;
        $value->save();
        return response()->json([
            'ret' => '200',
            'desc' => '成功',
            'data' => null
        ]);
    }

    public function read(Request $request)//读取功能实现
    {


        $value=Value::where('stg',$request->stg)->first();

        if(empty($value)){
            return response()->json([
                'ret' => '1002',
                'desc' => '找不到数据',
                'data' => $request->all()
            ]);
        }
            return response()->json([
                'ret' => 200,
                'desc' => '成功',
                'data' => $value->sen
            ]);


    }

    public function delete(Request $request)
    {
        //从请求获取要删除的id
        $id = $request->id;
        //通过find静态方法传入实例的id尝试获取对应的实例
        $value = Value::find($id);
        //判断这个实例存不存在，不存在则直接返回错误
        if(empty($value)){
            return response()->json([
                'ret' => '1002',
                'desc' => '找不到数据',
                'data' => null
            ]);
        }
        //调用delete方法删除实例
        $value->delete();
        //返回成功的响应
        return response()->json([
            'ret' => 200,
            'desc' => '成功',
            'data' => null
        ]);
    }

    public function modify(Request $request)//修改功能实现
    {
        //用请求获取数据
        $id = $request->id;
        $stg = $request->stg;
        $sen = $request->sen;
        //通过find静态方法传入实例的id尝试获取对应的实例
        $value = Value::find($id);
        //判断这个实例存不存在，不存在则直接返回错误
        if(empty($value)){
            return response()->json([
                'ret' => '1002',
                'desc' => '找不到数据',
                'data' => $request->all()
            ]);
        }
        //判断用户有没有传入对应的数据，有的话就更新model实例的对应项。
        if(!empty($stg)){
            $value->stg = $stg;
        }
        if(!empty($sen)){
            $value->sen = $sen;
        }
        //把更改应用进数据库
        $value->save();
        return response()->json([
            'ret' => 200,
            'desc' => '成功',
            'data' => null
        ]);
    }
    public function connect(Request $request)//合并功能实现
    {
      $name1=Value::where('stg','like',"%$request->value1%")->first();
      $name2=Value::where('stg','like',"%$request->value2%")->first();
      if(empty($name1)||empty($name2))
      {
        return response()->json([
            'ret' => 1004,
            'desc' => '找不到数据',
            'data' => $request->all()
        ]);
      }
      if(!empty($name1)&&!empty($name2))
      {
        return response()->json([
            'ret' => 200,
            'desc' => '成功合并',
            'data' => "$name1->sen$name2->sen"
            ]);
      }
    }
}
