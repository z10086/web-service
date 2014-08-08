<?php
/**
* �������ṩ���ͻ��˽�������XML-RPC�������˵ĺ���
* ������
* $host  ��Ҫ���ӵ�����
* $port  ���������Ķ˿�
* $rpc_server XML-RPC���������ļ�
* $request  ��װ��XML������Ϣ
* ���أ����ӳɹ��ɹ������ɷ������˷��ص�XML��Ϣ��ʧ�ܷ���false
*/
function rpc_client_call($host, $port, $rpc_server, $request) {

   //��ָ���ķ�������
   $fp = fsockopen($host, $port); 

   //������Ҫ����ͨ�ŵ�XML-RPC�������˵Ĳ�ѯPOST������Ϣ
   $query = "POST $rpc_server HTTP/1.0\nUser_Agent: XML-RPC Client\nHost:
        ".$host."\nContent-Type: text/xml\nContent-Length: ".strlen($request)."\n\n".$request."\n";

   //�ѹ���õ�HTTPЭ�鷢�͸���������ʧ�ܷ���false
   if (!fputs($fp, $query, strlen($query))) 
   { 
       $err = "Write error";
       return $err;
   } 
   
   //��ȡ�ӷ������˷��ص�������Ϣ������HTTPͷ��XML��Ϣ
   $contents = ""; 
   while (!feof($fp))
   { 
       $contents .= fgets($fp); 
   } 

   //�ر�������Դ�󷵻ػ�ȡ������
   fclose($fp); 
   return $contents; 
} 

//��������RPC�������˵���Ϣ
$host  = "localhost"; 
$port  = 80; 
$rpc_server = "/xml-rpc/server/server.php";

//����Ҫ���͵�XML������б����XML����Ҫ���õķ�����rpc_server��������get
$request = xmlrpc_encode_request("foo", array(1,2));

//����rpc_client_call���������������͸�XML-RPC�������˺��ȡ��Ϣ
$response = rpc_client_call($host, $port, $rpc_server, $request); 
//print_r($response);
//�����ӷ������˷��ص�XML��ȥ��HTTPͷ��Ϣ�����Ұ�XMLתΪPHP��ʶ����ַ���
$split = "<?xml";
$xml =  explode($split, $response);
$xml = $split.array_pop($xml);

$response = xmlrpc_decode($xml);

//�����RPC�������˻�ȡ����Ϣ
print_r($response);

?> 
