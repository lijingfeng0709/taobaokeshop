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
	include "selectclass.php";
//面向对象过程
	set_time_limit(0);
	date_default_timezone_set('Asia/Shanghai'); 
	
$getcontant=$_POST['title'];
$startprice=$_POST['x1'];
$endprice=$_POST['x2'];

if($startprice=="")$startprice=0;
if($endprice=="")$endprice=999999;
echo '<p id="startprice" style="display:none">'.$startprice.'</p>';
echo '<p id="endprice" style="display:none">'.$endprice.'</p>';
echo '<p id="getcontant" style="display:none">'.$getcontant.'</p>';
$jieguo=new chaxun();

//echo $text;

echo '<div class="mainframe">
 <div class="ui-grid-a">
     ';


echo $jieguo->getway($getcontant,1,20,$startprice,$endprice);


 echo    '</div></div>';
?>
<div data-role="footer">
  <h1>007</h1>
  </div>
<?php
 include "../../top/tbkjs.php";
 ?>
 <script>
 var pageno=1;
 var startprice=document.getElementById("startprice").innerHTML;
 var endprice=document.getElementById("endprice").innerHTML;
  var getcontant=document.getElementById("getcontant").innerHTML;
$(window).scroll(function(){
		var scrollheight=$(this).scrollTop();
		var docheight=$(document).height();
		var winheight=$(window).height();
		//alert(winheight);
		if(docheight<=(scrollheight+winheight+25)){
			htmlobj=$.ajax({
  			url:"postdata.php?callback1=datado&pageno="+pageno+"&contant="+getcontant+"&startprice="+startprice+"&endprice="+endprice,
  			async:false,
			dataType: "jsonp",
  			jsonp: "datado",
  			});
		}
	})
	function datado(data){
		$("#zuo").append(data[0]);
		$("#you").append(data[1]);
		pageno++;
		}
 </script>
</body>
</html>
