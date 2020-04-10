<?php
/*-------------------------------------------------------------------------
|	@desc:		HTML5 Canvas - Convert Color Image To Black and White  Online
|	@author:	Aravind Buddha
|	@url:		http://www.techumber.com
|	@date:		30 June 2013
|	@email:     aravind@techumber.com
|	@license:	Free! to Share,copy, distribute and transmit , 
|               but i'll be glad if my name listed in the credits'
---------------------------------------------------------------------------*/
if(isset($_POST['submit'])){
	$err="";
	$path = "uploads/";
	$source='';
	//delete all existing  images in upload dir
	array_map('unlink', glob("uploads/*"));
	//alled image format will be used for filter	
	$allowed_formats = array("jpg","png", "gif");
	//collecting our image data.
	$imgname = $_FILES['img']['name'];
	$tmpname = $_FILES['img']['tmp_name'];
	$size = $_FILES['img']['size'];
  $ext=end(explode(".", $imgname));

	if(!$imgname){
		$err="<strong>Oh snap!</strong>Please select image..!";
	}
	elseif (!in_array($ext,$allowed_formats)) {
		$err="<strong>Oh snap!</strong>Invalid file formats(jpg,png only..)!";
	}
	elseif ($size>(1024*1024)) {
		$err="<strong>Oh snap!</strong>Please upload small image..!";
	}
	else{
		if($ext=="jpg" || $ext=="jpeg" ){ 
			$source = imagecreatefromjpeg($tmpname);
		}
		else if($ext=="png"){
			$source = imagecreatefrompng($tmpname);
		}
		else{
			$source = imagecreatefromgif($tmpname);
		}

		list($ow,$oh)=getimagesize($tmpname);
		$aratio= $ow/$oh;
		$newWidth=410;
		$newHeight=$newWidth/$aratio;

		$temp=imagecreatetruecolor($newWidth,$newHeight);
		imagecopyresampled($temp,$source,0,0,0,0,$newWidth,$newHeight,$ow,$oh);
		$image=$path.$imgname;
		imagejpeg($temp,$image,100);
		imagedestroy($source);
		imagedestroy($temp);
	}
}
?>
<!DOCTYPE html>
 <!--
    o           		                      			    o8      
   o8                   		             			    88      
  o88oo ooooooo   oooo 88	  88	ooo  ooo  oo   oo    oo 88oooo.  ooooooo  ooooodb
   88   88	     88	   88	  88    88   88   88P"Y8bP"Y8b  d8   8b  88  	   88 
   88   8888888  88	   888888888    88   88   88   88  88   88   88  88888     88
   88   88 		 88	   88	  88	88   88   88   88   88  88   88  88   	   88    
   888  ooooooo   8ooo 88	  88	 V888V   o88o o88o o88o  Y8b8P   oooooooo   d88b   

@url: www.techumber.com
-->
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title> HTML5 Canvas - Convert Color Image To Black and White Online: techumber.com</title>
	<style type="text/css">
.container{
	width: 940px;
	margin: 0 auto;
}
.logo{
	text-align: center;
}
.mini-layout {
	border: 1px solid #DDD;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.075);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,.075);
	box-shadow: 0 1px 2px rgba(0,0,0,.075);
	margin-bottom: 20px;
	padding: 9px;
	width: 900px;
	margin: 0 auto;
}
.span4,.span5{
	width: 49%;
	float: left;
}
.span4{
	border-right: 1px solid #ddd;
}
.span5{
	width: 45%;
	padding:0 1em;
}
.span7{
	clear: both;
	border: 1px solid #ddd;
	margin: 0 auto;
	width: 320px;
	padding: 5px;
	border-radius: 5px;
}
#imgc,#bwimg{
	margin: 0 0.3em; 
	border:5px solid #eee;
	max-width: 400px;
}
canvas{
	display: none;
}
div.frame {
	background: #fff;
	padding: 5px;
	border: solid 2px #ddd;
}
input[type="file"],button{
	padding: 5px 20px;
	background: #333;
	color: #fff;
	border: 0;
	border-radius: 4px;
	cursor: pointer;
}
h1{
color: #0089ca;
}
</style>
</head>
<body>
	<div class="container">
		<div class="logo">
			<a href="http:/www.techumber.com">
				<img src="../asserts/img/logostd.png" alt="techumber.com logo"/> 
			</a>
		</div>
			<div class="mini-layout">
				<div class="span4">
					<?php 
					//if image uploaded this section will shown
						if($image)
						{
							echo "<h1>Orginal image</h1><img style='' src='".$image."' id=\"imgc\" style='width:100%' >";
						}
					?>
				</div>
				<div class="span5">
						<?php 
						//if image uploaded this section will shown
						if($image)
						{	echo "<h1>Black and White image</h1>
								  <canvas id='canvas' width='410'></canvas><img id='bwimg' />";
						}
					?>
				</div>	
				<div class="span7">
					<?php
					//if any error while uploading
					if($err)
					{
						echo '<div class="alert alert-error">'.$err.'</div>';
					}
					?>
					<form id="imgcrop" method="post" enctype="multipart/form-data">
						Upload image: <input type="file" name="img" id="img" />
						<input type="hidden" name="imgName" id="imgName" value="<?php echo($imgname) ?>" />
						<button name="submit">Submit</button>
					</form>
				</div>
				<div style="clear:both"></div>
			</div>
<?php
if($image)
{
	?>			
<script type="text/javascript">
function convertBW(img) {
	var newimg=document.getElementById('bwimg');
  var canvas = document.getElementById('canvas');
  var context = canvas.getContext('2d');
  var x = 0;
  var y = 0;
  canvas.height=<?php echo $newHeight ?>;
  context.drawImage(img, x, y);
  var imgData = context.getImageData(x, y, img.width, img.height);
  //data is an array it cantais rgb value data[0],data[1],data[2] respectively
  var data = imgData.data;
  //Searchin each pixel and replacing it with constra
  for(var i = 0; i < data.length; i += 4) {
    var constra = 0.34 * data[i] + 0.5 * data[i + 1] + 0.16 * data[i + 2];
    data[i]     = constra;
    data[i + 1] = constra;
    data[i + 2] = constra;
  }
  // replace with original image on canvas
 context.putImageData(imgData, x, y);
 	// This code make generated image downloadable. 
	var savedData = canvas.toDataURL();
  newimg.src = savedData;
	}
  var img = new Image();
  img.onload = function() {
    convertBW(this);
  };
  img.src ="<?php echo $image ?>" ;
</script>
<?php  } ?>
</body>
</html>

