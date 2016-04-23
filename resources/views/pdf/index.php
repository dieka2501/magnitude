<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		div { 
			  background: url('<?php echo config('app.url')?>public/img/bagde-kosong.jpg') no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			  width: 700px;
			  height: 900px;
			}
	</style>
	<title></title>
</head>
<body>

	<div>
		<table border="0" width="90%" style="margin-top:150px;margin-left:50px; ">
			<tr>
				<td align="center" valign="center" width="50%" height="200px" style=""> 
					<h1><?php echo $name?></h1>
					<br>
					<p><strong><?php echo $perusahaan?></strong></p>
					<p><strong><?php echo $posisi?></strong></p>


				</td>
				<td align="center" valign="center" width="50%">
					<img src="<?php echo config('app.url')?>public/qrcode/<?php echo str_replace(' ','', $name).'.png' ?>" width="200px" height="200px">
				</td>
			</tr>
		</table>
		
	</div>
</body>
</html>