
<?php
	include "../tbksdk/TopSdk.php";
class chaxun{
	private $leimu;
	private $PageNo;
	private $setPageSize;
	private $startprice;
	private $endprice;
	public function getway($leimu,$PageNo,$setPageSize,$startprice=0,$endprice=9999999){
		$c = new TopClient;
		$c->appkey = '23197217';
		$c->secretKey = "7868ef1b5807a78d309d4ea0661260b0";
		$req = new TbkItemGetRequest;
		$req->setFields("num_iid,title,pict_url,reserve_price,zk_final_price,item_url,volume,user_type");
		$req->setQ($leimu);
		$req->setStartPrice($startprice);
		$req->setEndPrice($endprice);
		$req->setPageNo($PageNo);
		$req->setPageSize($setPageSize);
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
		$req1 = new TbkItemInfoGetRequest;
		$req1->setFields("volume,user_type,num_iid");
		$number=$resp->total_results;
		for($i=0;$i<$setPageSize&&$i<$number;$i++){
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
		for($i=0;$i<$setPageSize&&$i<$number;$i++){				
			if($i==0){
				$num_iids=$num_iid[$i];
				}else{$num_iids=$num_iids.",".$num_iid[$i];}
			}
		$req1->setNumIids($num_iids);
		$resp1 = $c->execute($req1);
		//print_r($resp1);
		$temp=array();
		for($i=0;$i<$setPageSize&&$i<$number;$i++){
			$volume1[$i]=$resp1->results->n_tbk_item[$i]->volume;
			$temp[$i]=$resp1->results->n_tbk_item[$i]->num_iid;	
			}
		for($i=0;$i<$setPageSize&&$i<$number;$i++){
			$num1=(string)$num_iid[$i];
			for($j=0;$j<$setPageSize;$j++){
				$num2=(string)$temp[$j];
				if($num1==$num2){
					$volume[$i]=$volume1[$j];
					break;
					}
				}
			}
			
		$qishi1='<div id="zuo" class="ui-block-a">';
		$qishi2='<div id="you" class="ui-block-b">   ';
		$jieshu1='</div>';
		$content1="";
		$content2="";
	/* for($i=0;$i<10&&$i<$number/2;$i++){
    $content1=$content1.'<div class="goodframe"><a id="'.$num_iid[$i].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank"><img data="'.$pic[$i].'" alt="" name="pic" width="210px" height="210px" src="'.$pic[$i].'"  /></a>
<p class="goodtitle"><a id="'.$num_iid[$i].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank">'.$title[$i].'</a></p>
<span class="nowprice">¥'.$finalprice[$i].'  </span><!--<span class="oldprice">¥'.$oriprice[$i].'</span>-->
<span class="salenum">销量：'.$volume[$i].'件</span></div>';
	 }
	 for($i=10;$i<20&&$i<$number;$i++){
    $content2=$content2.'  <div class="goodframe"><a id="'.$num_iid[$i].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank"><img data="'.$pic[$i].'" alt="" name="pic" width="210px" height="210px" src="'.$pic[$i].'"  /></a>
<p class="goodtitle"><a id="'.$num_iid[$i].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank">'.$title[$i].'</a></p>
<span class="nowprice">¥'.$finalprice[$i].'  </span><!--<span class="oldprice">¥'.$oriprice[$i].'</span>-->
<span class="salenum">销量：'.$volume[$i].'件</span></div>';
}*/

   for($i=0;$i<20&&$i<$number/2;$i=$i+2){
	  
		   $content1=$content1.'<div class="goodframe"><a id="'.$num_iid[$i].'" href="'.$dizhi[$i].'" isconvert="1" target="_blank"><img data="'.$pic[$i].'" alt="" name="pic" src="'.$pic[$i].'"  /></a>
<p class="goodtitle"><a id="'.$num_iid[$i].'" href="'.$dizhi[$i].'" isconvert="1" target="_blank">'.$title[$i].'</a></p>
<span class="nowprice">¥'.$finalprice[$i].'  </span><!--<span class="oldprice">¥'.$oriprice[$i].'</span>-->
<span class="salenum">销量：'.$volume[$i].'件</span></div>';		   
			if($number>1&&(($i+1)%2)==1){
				 $content2=$content2.'<div class="goodframe"><a id="'.$num_iid[$i+1].'" href="'.$dizhi[$i+1].'" isconvert="1" target="_blank"><img data="'.$pic[$i+1].'" alt="" name="pic" src="'.$pic[$i+1].'"  /></a>
<p class="goodtitle"><a id="'.$num_iid[$i+1].'" href="'.$dizhi[$i+1].'" isconvert="1" target="_blank">'.$title[$i+1].'</a></p>
<span class="nowprice">¥'.$finalprice[$i+1].'  </span><!--<span class="oldprice">¥'.$oriprice[$i+1].'</span>-->
<span class="salenum">销量：'.$volume[$i+1].'件</span></div>';
			}   
  } 
			return $qishi1.$content1.$jieshu1.$qishi2.$content2.$jieshu1;
		}	
}
class jiazai{
	private $leimu;
	private $PageNo;
	private $setPageSize;
	public function getway($leimu,$PageNo,$setPageSize,$startprice=0,$endprice=9999999){
		$c = new TopClient;
		$c->appkey = '23197217';
		$c->secretKey = "7868ef1b5807a78d309d4ea0661260b0";
		$req = new TbkItemGetRequest;
		$req->setFields("num_iid,title,pict_url,reserve_price,zk_final_price,item_url,volume,user_type");
		$req->setQ($leimu);
		$req->setStartPrice($startprice);
		$req->setEndPrice($endprice);
		$req->setPageNo($PageNo);
		$req->setPageSize($setPageSize);
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
		for($i=0;$i<$setPageSize;$i++){
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
		for($i=0;$i<$setPageSize;$i++){				
			if($i==0){
				$num_iids=$num_iid[$i];
				}else{$num_iids=$num_iids.",".$num_iid[$i];}
			}
		$req1->setNumIids($num_iids);
		$resp1 = $c->execute($req1);
		//print_r($resp1);
		$temp=array();
		for($i=0;$i<$setPageSize;$i++){
			$volume1[$i]=$resp1->results->n_tbk_item[$i]->volume;
			$temp[$i]=$resp1->results->n_tbk_item[$i]->num_iid;	
			}
		for($i=0;$i<$setPageSize;$i++){
			$num1=(string)$num_iid[$i];
			for($j=0;$j<$setPageSize;$j++){
				$num2=(string)$temp[$j];
				if($num1==$num2){
					$volume[$i]=$volume1[$j];
					break;
					}
				}
			}
		$content1="";
		$content2="";
	 for($i=0;$i<10;$i++){
    $content1=$content1.'<div class="goodframe"><a id="'.$num_iid[$i].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank"><img data="'.$pic[$i].'" alt="" name="pic" width="210px" height="210px" src="'.$pic[$i].'"  /></a>
<p class="goodtitle"><a id="'.$num_iid[$i].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank">'.$title[$i].'</a></p>
<span class="nowprice">¥'.$finalprice[$i].'  </span><!--<span class="oldprice">¥'.$oriprice[$i].'</span>-->
<span class="salenum">销量：'.$volume[$i].'件</span></div>';
	 }
	 for($i=10;$i<20;$i++){
    $content2=$content2.'  <div class="goodframe"><a id="'.$num_iid[$i].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank"><img data="'.$pic[$i].'" alt="" name="pic" width="210px" height="210px" src="'.$pic[$i].'"  /></a>
<p class="goodtitle"><a id="'.$num_iid[$i].'" href="'.$dizhi[$i+0].'" isconvert="1" target="_blank">'.$title[$i].'</a></p>
<span class="nowprice">¥'.$finalprice[$i].'  </span><!--<span class="oldprice">¥'.$oriprice[$i].'</span>-->
<span class="salenum">销量：'.$volume[$i].'件</span></div>';
}

		$tt=Array($content1,$content2);
	
			return $tt;
		}	
}
?>