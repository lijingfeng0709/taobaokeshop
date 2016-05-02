<html>
<html>
<head>
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="../css/jquery.mobile-1.4.5.min.css">
<link rel="stylesheet" href="../css/index.css">
<script src="../Scripts/jquery.js"></script>
<script src="../Scripts/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
 <div>
<div data-role="header">
  <div data-role="navbar">
    <ul>
     <li><a href="../" target="_self">首页</a></li>
          <li><a href="../1/" target="_self">针织衫</a></li>
          <li><a href="../2/" target="_self">连衣裙</a></li>
          <li><a href="../3/" target="_self">羽绒服</a></li>
          <li><a href="../4/" target="_self">鞋</a></li>
    </ul>
  </div>
</div>

</div>
<?php
set_time_limit(0);

	include "../tbksdk/TopSdk.php";
	date_default_timezone_set('Asia/Shanghai'); 
	if(isset($_GET["page"])){
		$A=$_GET["page"];
		$getcontant=$_GET["contant"];
		$startprice=$_GET['startprice'];
				$endprice=$_GET['endprice'];
		} 
			else{
				$A=1;
				$getcontant=$_POST['title'];
				$startprice=$_POST['x1'];
				$endprice=$_POST['x2'];
				} 

if(isset($_GET["startprice"]))$startprice=$_GET["startprice"]; 
if(isset($_GET["endprice"]))$endprice=$_GET["endprice"]; 
if($startprice=="")$startprice=0;
if($endprice=="")$endprice=999999;
$c = new TopClient;
$c->appkey = '23197217';
$c->secretKey = "7868ef1b5807a78d309d4ea0661260b0";
$req = new TbkItemGetRequest;
$req->setFields("num_iid,title,pict_url,reserve_price,zk_final_price,item_url,volume,user_type");
$req->setQ($getcontant);
$req->setStartPrice($startprice);
$req->setEndPrice($endprice);
$req->setPageNo($A);
$req->setPageSize(20);
$resp = $c->execute($req);
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
$req1->setFields("volume,user_type,num_iid");
$number=$resp->total_results;
for($i=0;$i<20&&$i<$number;$i++){
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
	for($i=0;$i<20&&$i<$number;$i++){
					
		if($i==0){
			$num_iids=$num_iid[$i];
			}else{$num_iids=$num_iids.",".$num_iid[$i];}
		}
	$req1->setNumIids($num_iids);
	$resp1 = $c->execute($req1);
	//print_r($resp1);
	$temp=array();
	for($i=0;$i<20&&$i<$number;$i++){
		$volume1[$i]=$resp1->results->n_tbk_item[$i]->volume;
		$temp[$i]=$resp1->results->n_tbk_item[$i]->num_iid;	
		}
	for($i=0;$i<20&&$i<$number;$i++){
		$num1=(string)$num_iid[$i];
		for($j=0;$j<20&&$i<$number;$j++){
			$num2=(string)$temp[$j];
			if($num1==$num2){
				$volume[$i]=$volume1[$j];
				break;
				}
			}
		}
//echo $text;
?>
<div class="mainframe">
 <div class="ui-grid-a">

   <?php
   for($i=0;$i<10&&$i<$number/2;$i=$i+2){
			 echo'    <div class="ui-block-a"><div class="goodframe"><a id="'.$num_iid[$i].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank"><img data="'.$pic[$i].'" alt="" name="pic" src="'.$pic[$i].'"  /></a>
<p class="goodtitle"><a id="'.$num_iid[$i].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank">'.$title[$i].'</a></p>
<span class="nowprice">¥'.$finalprice[$i].'  </span><!--<span class="oldprice">¥'.$oriprice[$i].'</span>-->
<span class="salenum">销量：'.$volume[$i].'件</span></div></div>';
	 ?>
     <?php		
			 echo'   <div class="ui-block-b">    <div class="goodframe"><a id="'.$num_iid[$i+1].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank"><img data="'.$pic[$i+1].'" alt="" name="pic" src="'.$pic[$i+1].'"  /></a>
<p class="goodtitle"><a id="'.$num_iid[$i+1].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank">'.$title[$i+1].'</a></p>
<span class="nowprice">¥'.$finalprice[$i+1].'  </span><!--<span class="oldprice">¥'.$oriprice[$i+1].'</span>-->
<span class="salenum">销量：'.$volume[$i+1].'件</span></div></div>';			   
//}
  } 
?>

</div>
     </div>
</div>
<div class="ui-grid-c" style="text-align:center">
	<a class="ui-block-a"></a>
     <?php
	 if($A==1){echo '<a data-role="button" class="ui-block-b" href="javascript:void(0);" onclick="warn()" target="_self">上一页</a>';}
		else{echo '<a data-role="button" class="ui-block-b" href="index.php?page='.($A-1).'&contant='.$getcontant.'&startprice='.$startprice.'&endprice='.$endprice.'" target="_self">上一页</a>';}
    echo '<a data-role="button" class="ui-block-c" href="index.php?page='.($A+1).'&contant='.$getcontant.'&startprice='.$startprice.'&endprice='.$endprice.'" target="_self">下一页</a>';
	?>
    <a class="ui-block-d"></a>
</div>
<div data-role="footer">
  <h1>007</h1>
  </div>
<?php
 include "../../top/tbkjs.php";
 ?>
</body>
</html>
