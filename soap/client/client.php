<?php
try{ 
    //在non-wsdl方式中option location系必须提供的,而服务端的location是选择性的，可以不提供
    $soap = new SoapClient(null,array('location'=>"http://192.168.1.109/Server.php",'uri'=>'Server.php'));
 
    //两种调用方式，直接调用方法，和用__soapCall简接调用
    $result1 = $soap->getName('eeee');
    $result2 = $soap->__soapCall("getName",array('ssss'));
    echo $result1."<br/>";
    echo $result2;
 
}catch(SoapFault $e){
    echo $e->getMessage();
}catch(Exception $e){
    echo $e->getMessage();
}
 
?>