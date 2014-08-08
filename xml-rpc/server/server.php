<?php 
/**
* �������ṩ��RPC�ͻ��˵��õĺ���
* ������
* $method �ͻ�����Ҫ���õĺ���
* $params �ͻ�����Ҫ���õĺ����Ĳ�������
* ���أ�����ָ�����ý��
*/
function foo_func($method, $params){
    //$res = var_export($method,true);
    //return $res;
    return $params[0]+$params[1];
}

//����һ��XML-RPC�ķ�������
$xmlrpc_server = xmlrpc_server_create(); 

//ע��һ���������˵��õķ���foo��ָ�����foo_func����
xmlrpc_server_register_method($xmlrpc_server, "foo", "foo_func");

//���ܿͻ���POST������XML����
$request = $HTTP_RAW_POST_DATA;

//ִ�е��ÿͻ��˵�XML������ȡִ�н��
$xmlrpc_response = xmlrpc_server_call_method($xmlrpc_server, $request, null); 

//�Ѻ��������Ľ��XML�������
header('Content-Type: text/xml; charset=utf-8');
echo $xmlrpc_response; 

//����XML-RPC����������Դ
xmlrpc_server_destroy($xmlrpc_server); 

