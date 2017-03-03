<?php
$www_file='/var/www/html/';
  
//打开网站目录下的hooks.log文件 需要在服务器上创建 并给写权限
  
//$fs = fopen($www_file.'hooks.log', 'a');
  
//fwrite($fs, '================ Update Start ==============='.PHP_EOL.PHP_EOL);
  
//自定义字串掩码 用于验证
  
$access_token = 's7kjjhh8767laq29KLJK9089883hjjkgfdrrpipoinmw';
  
//接受的ip数组，也就是允许哪些IP访问这个文件 这里是gitlab服务器IP
$access_ip = array('8.8.8.8');
  
//获取请求端的ip和token
  
//$client_token = $_GET['token'];
$client_ip = $_SERVER['REMOTE_ADDR'];
  
//把请求的IP和时间写进log
  
//fwrite($fs, 'Request on ['.date("Y-m-d H:i:s").'] from ['.$client_ip.']'.PHP_EOL);
 /* 
//验证token 有错就写进日志并退出
if ($client_token !== $access_token)
{
echo "error 403";
fwrite($fs, "Invalid token [{$client_token}]".PHP_EOL);
exit(0);
}
  
//验证ip
if ( !in_array($client_ip, $access_ip))
{
echo "error 503";
fwrite($fs, "Invalid ip [{$client_ip}]".PHP_EOL);
exit(0);
}
  */
//获取请求端发送来的信息，具体格式参见gitlab的文档
  
$json = file_get_contents('php://input');
$data = json_decode($json, true);
  
//如果有需要 可以打开下面，把传送过来的信息写进log
//fwrite($fs, 'Data: '.print_r($data, true).PHP_EOL);
  
//执行shell命令并把返回信息写进日志
  
echo shell_exec("cd $www_file && git checkout master && git pull origin master 2>&1");
//fwrite($fs, 'Info:'. PHP_EOL);
  
//fwrite($fs,PHP_EOL. '================ Update End ==============='.PHP_EOL.PHP_EOL);
  
//$fs and fclose($fs);
?>
