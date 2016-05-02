<?php
set_time_limit(0);
header("Content-Type: text/html; charset=utf-8");
echo '<iframe src="../top/index.html" name="ifrmname" width=100% height=225px frameborder="0" scrolling="no"    ></iframe>';
	include "../tbksdk/TopSdk.php";
	date_default_timezone_set('Asia/Shanghai'); 
	$seach=$_POST['txtuser'];
	if(isset($_GET["temp"]))$temp=$_GET["temp"];
		else $temp=0;
		
	if(stripos($seach,"ttp")){
			preg_match('/id=(.*)/',$seach,$seach);
$seach=substr($seach[1],0,15);
preg_match('/\d+/',$seach,$seach);
$seach=$seach[0];
echo '<div align="center">';
echo '<div style="display:inline;">您想搜索的商品为：</div>';

echo "<br>";
echo "<br>";
echo '<a data-type="0" biz-itemid="'.$seach.'" data-style="2" data-tmpl="230x312" target="_blank"></a>';	
			}else{
		if(isset($_GET["page"]))$A=$_GET["page"]; 
			else $A=1;
$startprice=$_POST['x1'];

	$temp=1;
$endprice=$_POST['x2'];
if(isset($_GET["startprice"]))$startprice=$_GET["startprice"]; 
if(isset($_GET["endprice"]))$endprice=$_GET["endprice"]; 
if($startprice=="")$startprice=0;
if($endprice=="")$endprice=999999;
if($seach==""){
	$seach=$_GET["contant"];
	}

echo '<div align="center">';
echo '<div style="display:inline;">您想搜索的商品为：</div>'.'<div align="center" style="color:#E00000;font-family:微软雅黑; display:inline;">'.$seach.'</div></div>';

echo "<br>";

$c = new TopClient;
$c->appkey = '23197217';
$c->secretKey = "7868ef1b5807a78d309d4ea0661260b0";
$req = new TbkItemGetRequest;
$req->setFields("num_iid");
$req->setQ($seach);
$req->setStartPrice($startprice);
$req->setEndPrice($endprice);
//$req->setCat("16,18");
$req->setPageNo($A);
$req->setPageSize(40);
$resp = $c->execute($req);
$number=$resp->total_results;
//print_r($resp);
//echo $n_tbk_item[2];
$arr=array();
//echo "result:";
//print_r($resp->results->n_tbk_item[1]->item_url);

for($i=0;$i<40;$i++){
	$arr[$i]=$resp->results->n_tbk_item[$i]->num_iid;
	//$pre=strpos($arr[$i],"=");
	//$arr[$i]=substr($arr[$i],$pre+1);
	//echo $resp->results->n_tbk_item[$i]->item_url."  ".$resp->results->n_tbk_item[$i]->title;
	}
//echo $text;
?>
<?php
echo '<table align="center">';
	for($i=0;$i<40;$i+=4){
		echo'<tr>
		<td><a data-type="0" biz-itemid="'.$arr[$i].'" data-style="2" data-tmpl="230x312" target="_blank"></a></td>
		<td><a data-type="0" biz-itemid="'.$arr[$i+1].'" data-style="2" data-tmpl="230x312" target="_blank"></a></td>
		<td><a data-type="0" biz-itemid="'.$arr[$i+2].'" data-style="2" data-tmpl="230x312" target="_blank"></a></td>
		<td><a data-type="0" biz-itemid="'.$arr[$i+3].'" data-style="2" data-tmpl="230x312" target="_blank"></a></td>
		</tr>';	
		}
		echo        '</table>';		
?>
<?php
	if($number>400){
	echo '<div align="center" style="color:#f5f5f5;padding-bottom:50px;padding-top:10px; bgcolor:#FAFAFA">';
	for ($i=1;$i<=10;$i++) {  //循环显示出页面
	?>
    <?php
	if($A==$i){
		?>
	<?php 
	//echo '<span>';
	echo '<button style="width:30px;border:solid;border-width:thin;border-color:#999;background-color:transparent;width:40px;height:34px;background-color:#F33;color:#f5f5f5;cursor:default;"' 
	?>
	<?php
    echo '>';
	?>
    <?php
	echo $i ;
	echo '</button>';
	//echo '</span>';
	?>
        <?php
		}else{
			?>
            <a style="color:#000;font-size:15px;" href="index.php?page=<?php echo $i;?>&contant=<?php echo $seach;?>&startprice=<?php echo $startprice;?>&endprice=<?php echo $endprice;?>&temp=<?php echo $temp;?>" 
	<?php 
	echo '<span>';
	echo '<button style="width:30px;border:solid;border-width:thin;border-color:#999;background-color:transparent;width:40px;height:34px; color:#000"' 
	?>
	 onmouseover="this.style.background='#F33';this.style.color='#f5f5f5'" onmouseout="this.style.background='#FAFAFA';this.style.color='#000'"
	<?php
    echo '>';
	?>
    <?php
	echo $i ;
	echo '</button>';
	echo '</span>';
	?></a>
			<?php
			}
    ?>
	<?php
	}
	echo '</div>';
	}

		}
	?>
   <?php           
echo    '<script type="text/javascript">
    (function(win,doc){
        var s = doc.createElement("script"), h = doc.getElementsByTagName("head")[0];
        if (!win.alimamatk_show) {
            s.charset = "gbk";
            s.async = true;
            s.src = "http://a.alimama.cn/tkapi.js";
            h.insertBefore(s, h.firstChild);
        };
        var o = {
            pid: "mm_16381314_8700286_38814372",/*推广单元ID，用于区分不同的推广渠道*/
            appkey: "23197217",/*通过TOP平台申请的appkey，设置后引导成交会关联appkey*/
            unid: "",/*自定义统计字段*/
            type: "click" /* click 组件的入口标志 （使用click组件必设）*/
        };
        win.alimamatk_onload = win.alimamatk_onload || [];
        win.alimamatk_onload.push(o);
    })(window,document);
    </script>';
?>