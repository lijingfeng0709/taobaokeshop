<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>007</title><link rel="shortcut icon" href="../icon.png" >
<link href="../css/goods.css" rel="stylesheet" type="text/css" />
<link href="../css/buttom.css" rel="stylesheet" type="text/css"  />
<link href="../css/top.css" rel="stylesheet" type="text/css"  />
</head>
<script src="../Scripts/zh.js"></script>
<body style="margin:0px; padding:0px;">
    <?php
include '../top/index.html';
?>
<?php
set_time_limit(0);
	include "../tbksdk/TopSdk.php";
	date_default_timezone_set('Asia/Shanghai'); 
	
	if(!isset($_GET['page']))$seach=$_POST['txtuser']; 
		else	$seach=$_GET['contant'];

	/*第一部分*/
	if(stripos($seach,"ttp")){
		$number=1;
		preg_match('/id=(.*)/',$seach,$seach);
		$seach=substr($seach[1],0,15);
		preg_match('/\d+/',$seach,$seach);
		$seach=$seach[0];
		$c = new TopClient;
		$c->appkey = '23197217';
		$c->secretKey = "7868ef1b5807a78d309d4ea0661260b0";
		$req = new TbkItemInfoGetRequest;
		$req->setFields("num_iid,seller_id,nick,title,reserve_price,zk_final_price,volume,pict_url,item_url,shop_url,user_type");
		//$req->setFields("volume,user_type,num_iid");
		$req->setNumIids($seach);
		$resp = $c->execute($req);
		//print_r($resp);
		if($number){
			$dizhi=$resp->results->n_tbk_item[0]->item_url;
			$pic=$resp->results->n_tbk_item[0]->pict_url;
			$title=$resp->results->n_tbk_item[0]->title;
			$oriprice=$resp->results->n_tbk_item[0]->reserve_price;
			$finalprice=$resp->results->n_tbk_item[0]->zk_final_price;
			$volume=$resp->results->n_tbk_item[0]->volume;
			$user_type=$resp->results->n_tbk_item[0]->user_type;
			$num_iid=$resp->results->n_tbk_item[0]->num_iid;
			echo '<div align="center"><div style="display:inline;">您想搜索的商品为：</div>'.'<div align="center" style="color:#E00000;font-family:微软雅黑; display:inline;">'.$title.'</div></div>';
		echo "<br>";
		echo "<br>";
		echo '<div class="goodsframe" style="display:block; margin:0 auto;">';
	echo '<div class="cell"><a id="'.$num_iid.'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank"><img data="'.$pic.'" alt="" name="pic" width="210" height="210" class="pic" /></a>
<p class="bt"><a id="'.$num_iid.'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank">'.$title.'</a></p>
<span class="jiage">¥'.$finalprice.'</span><span class="jiage y">¥'.$oriprice.'</span>
<p class="xiaoliang">销量：'.$volume.'件<img name="user_type" src="" data="'.$user_type.'" class="dianpustyle" /></p></div>';
echo '</div>';
			}else{
				echo '<div align="center">您想搜索的商品未找到</div>';
		echo "<br>";
		echo "<br>";
				}
		
		
		}else{
	/*第二部分*/	
	if(isset($_GET["page"]))$A=$_GET["page"]; 
			else{
				$A=1;
		$startprice=$_POST['x1'];
			//$temp=1;
		$endprice=$_POST['x2'];
	} 
if(isset($_GET["startprice"]))$startprice=$_GET["startprice"]; 
		if(isset($_GET["endprice"]))$endprice=$_GET["endprice"]; 
		if($startprice=="")$startprice=0;
		if($endprice=="")$endprice=999999;
		if($seach==""){
			$seach=$_GET["contant"];
			}
	echo '<div align="center"><div style="display:inline;">您想搜索的商品为：</div>'.'<div align="center" style="color:#E00000;font-family:微软雅黑; display:inline;">'.$seach.'</div></div>';
$c = new TopClient;
$c->appkey = '23197217';
$c->secretKey = "7868ef1b5807a78d309d4ea0661260b0";
$req = new TbkItemGetRequest;
$req->setFields("num_iid,title,pict_url,reserve_price,zk_final_price,item_url,volume,user_type");
$req->setQ($seach);
$req->setPageNo($A);
$req->setPageSize(40);
$resp = $c->execute($req);
$number=$resp->total_results;
//print_r($resp);
//echo $n_tbk_item[2];
$dizhi=array();
$pic=array();
$title=array();
$volume1=array();
$volume=array();
$oriprice=array();
$finalprice=array();
$num_iid=array();
$user_type=array();
//echo "result:";
//print_r($resp->results->n_tbk_item[1]->user_type);
$req1 = new TbkItemInfoGetRequest;
$req1->setFields("volume,num_iid,user_type");
for($i=0;$i<40&&$i<$number;$i++){
	$dizhi[$i]=$resp->results->n_tbk_item[$i]->item_url;
	$pic[$i]=$resp->results->n_tbk_item[$i]->pict_url;
	$title[$i]=$resp->results->n_tbk_item[$i]->title;
	$oriprice[$i]=$resp->results->n_tbk_item[$i]->reserve_price;
	$finalprice[$i]=$resp->results->n_tbk_item[$i]->zk_final_price;
	$num_iid[$i]=$resp->results->n_tbk_item[$i]->num_iid;
	$user_type[$i]=$resp->results->n_tbk_item[$i]->user_type;
	//$pre=strpos($arr[$i],"=");
	//$arr[$i]=substr($arr[$i],$pre+1);
	//echo $resp->results->n_tbk_item[$i]->item_url."  ".$resp->results->n_tbk_item[$i]->title;
	}
	for($i=0;$i<40&&$i<$number;$i++){
					
		if($i==0){
			$num_iids=$num_iid[$i];
			}else{$num_iids=$num_iids.",".$num_iid[$i];}
		}
	$req1->setNumIids($num_iids);
	$resp1 = $c->execute($req1);
	//print_r($resp1);
	$temp=array();
	for($i=0;$i<40&&$i<$number;$i++){
		$volume1[$i]=$resp1->results->n_tbk_item[$i]->volume;
		$temp[$i]=$resp1->results->n_tbk_item[$i]->num_iid;	
		}
	for($i=0;$i<40&&$i<$number;$i++){
		$num1=(string)$num_iid[$i];
		for($j=0;$j<40&&$i<$number;$j++){
			$num2=(string)$temp[$j];
			if($num1==$num2){
				$volume[$i]=$volume1[$j];
				break;
				}
			}
		}
//echo $text;
?>
<?php
if($number<4){
	echo '<div class="goodsframe">';
	for($i=0;$i<$number;$i++){
		echo '<div class="cell cellfirst"><a id="'.$num_iid[$i+0].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank"><img data="'.$pic[$i+0].'" alt="" name="pic" width="210" height="210" class="pic" /></a>
<p class="bt"><a id="'.$num_iid[$i+0].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank">'.$title[$i+0].'</a></p>
<span class="jiage">¥'.$finalprice[$i+0].'</span><span class="jiage y">¥'.$oriprice[$i+0].'</span>
<p class="xiaoliang">销量：'.$volume[$i+0].'件<img name="user_type" src="" data="'.$user_type[$i+0].'" class="dianpustyle" /></p></div>';
		}
	echo '</div>';
	}else{
		for($i=0;$i<40&&$i<$number;$i+=4){
			echo '<div class="goodsframe">';
			echo '<div class="cell cellfirst"><a id="'.$num_iid[$i+0].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank"><img data="'.$pic[$i+0].'" alt="" name="pic" width="210" height="210" class="pic" /></a>
		<p class="bt"><a id="'.$num_iid[$i+0].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank">'.$title[$i+0].'</a></p>
		<span class="jiage">¥'.$finalprice[$i+0].'</span><span class="jiage y">¥'.$oriprice[$i+0].'</span>
		<p class="xiaoliang">销量：'.$volume[$i+0].'件<img name="user_type" src="" data="'.$user_type[$i+0].'" class="dianpustyle" /></p></div>
		
		<div class="cell"><a id="'.$num_iid[$i+1].'" href="'.$dizhi[$i+1].'" isconvert="1" target="_blank"><img data="'.$pic[$i+1].'" alt="" name="pic" width="210" height="210" class="pic" /></a>
		<p class="bt"><a id="'.$num_iid[$i+1].'" href="'.$dizhi[$i+1].'" isconvert="1" target="_blank">'.$title[$i+1].'</a></p>
		<span class="jiage">¥'.$finalprice[$i+1].'</span><span class="jiage y">¥'.$oriprice[$i+1].'</span>
		<p class="xiaoliang">销量：'.$volume[$i+1].'件<img name="user_type" src="" data="'.$user_type[$i+1].'" class="dianpustyle" /></p></div>
		
		<div class="cell"><a id="'.$num_iid[$i+2].'" href="'.$dizhi[$i+2].'" isconvert="1" target="_blank"><img data="'.$pic[$i+2].'" alt="" name="pic" width="210" height="210" class="pic" /></a>
		<p class="bt"><a id="'.$num_iid[$i+2].'" href="'.$dizhi[$i+2].'" isconvert="1" target="_blank">'.$title[$i+2].'</a></p>
		<span class="jiage">¥'.$finalprice[$i+2].'</span><span class="jiage y">¥'.$oriprice[$i+2].'</span>
		<p class="xiaoliang">销量：'.$volume[$i+2].'件<img name="user_type" src="" data="'.$user_type[$i+2].'" class="dianpustyle" /></p></div>
		
		<div class="cell celllast"><a id="'.$num_iid[$i+3].'" href="'.$dizhi[$i+3].'" isconvert="1" target="_blank"><img data="'.$pic[$i+3].'" alt="" name="pic" width="210" height="210" class="pic" /></a>
		<p class="bt"><a id="'.$num_iid[$i+3].'" href="'.$dizhi[$i+3].'" isconvert="1" target="_blank">'.$title[$i+3].'</a></p>
		<span class="jiage">¥'.$finalprice[$i+3].'</span><span class="jiage y">¥'.$oriprice[$i+3].'</span>
		<p class="xiaoliang">销量：'.$volume[$i+3].'件<img name="user_type" src="" data="'.$user_type[$i+3].'" class="dianpustyle" /></p></div>';
		echo '</div>';
			}
		}		

}	
?>
<?php
	if($number>400){
		include "../top/buttom1.php";
		}
	echo '<script>
var t=document.getElementsByName("user_type");
for(var i=0;i<t.length;i++){
	if(t[i].getAttribute("data")==1){
		t[i].src="../1.png";
		}else{
			t[i].src="../2.png";
			}
	}
</script>';
    echo '<script type="text/javascript">';
	echo 'var Browser=new Object();  
		Browser.userAgent=window.navigator.userAgent.toLowerCase();  
		Browser.ie=/msie/.test(Browser.userAgent);  
		Browser.Moz=/gecko/.test(Browser.userAgent);  
  
//判断是否加载完成  
function Imagess(url,imgid,callback){      
    var val=url;  
    var img=new Image();  
    if(Browser.ie){  
        img.onreadystatechange =function(){    
            if(img.readyState=="complete"||img.readyState=="loaded"){  
                callback(img,imgid);  
            }  
        }          
    }else if(Browser.Moz){  
        img.onload=function(){  
            if(img.complete==true){  
                callback(img,imgid);  
            }  
        }          
    }      
    //如果因为网络或图片的原因发生异常，则显示该图片  
    img.onerror=function(){img.src="http://www.86y.org/images/failed.png"}  
    img.src=val;  
}  
  
//显示图片  
function checkimg(obj,imgid){  
document.getElementById(imgid).style.cssText="";  
document.getElementById(imgid).src=obj.src;  
}  
//初始化需要显示的图片，并且指定显示的位置  
window.onload=function(){  
var imglist=document.getElementsByName("pic");  
for(i=0;i<imglist.length;i++)  
{  
    imglist[i].id="img0"+i;  
    //imglist[i].src="loading.gif";  
    imglist[i].style.cssText="background:url(../loading.gif) no-repeat center center;"  
    Imagess(imglist[i].getAttribute("data"),imglist[i].id,checkimg);  
}  
} 
</script>  ';
	?>
<?php
 include "../top/tbkjs.php";
 ?>    
</body>
</html>
