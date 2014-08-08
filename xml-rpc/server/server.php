<?php 
/**
* 函数：提供给RPC客户端调用的函数
* 参数：
* $method 客户端需要调用的函数
* $params 客户端需要调用的函数的参数数组
* 返回：返回指定调用结果
*/
function foo_func($method, $params){
    //$res = var_export($method,true);
    //return $res;
    return $params[0]+$params[1];
}

//产生一个XML-RPC的服务器端
$xmlrpc_server = xmlrpc_server_create(); 

//注册一个服务器端调用的方法foo，指向的是foo_func函数
xmlrpc_server_register_method($xmlrpc_server, "foo", "foo_func");

//接受客户端POST过来的XML数据
$request = $HTTP_RAW_POST_DATA;

//执行调用客户端的XML请求后获取执行结果
$xmlrpc_response = xmlrpc_server_call_method($xmlrpc_server, $request, null); 

//把函数处理后的结果XML进行输出
header('Content-Type: text/xml; charset=utf-8');
echo $xmlrpc_response; 

//销毁XML-RPC服务器端资源
xmlrpc_server_destroy($xmlrpc_server); 

