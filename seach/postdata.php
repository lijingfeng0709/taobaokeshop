
<?php
	include "selectclass.php";
	
//面向对象过程
	set_time_limit(0);
	date_default_timezone_set('Asia/Shanghai'); 
	$callback=$_GET['callback1'];
	$pageno=$_GET['pageno'];	
	$contant=$_GET['contant'];	
	$startprice=$_GET['startprice'];	
	$endprice=$_GET['endprice'];		
$jieguo=new jiazai();

//echo $text;
$gettt=$jieguo->getway($contant,$pageno,20,$startprice,$endprice);
echo $callback.'('.json_encode($gettt).')';;
?>
