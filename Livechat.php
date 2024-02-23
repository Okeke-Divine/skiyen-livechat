<!-- This Script is from skiyen, Coded by: Okeke Divine-Vessel-->
<!-- It's 2017 (first php code :)) -->
<title>Live Chat</title>
<?php
if (isset($_GET['enSubmit']) && isset($_GET['uname']) && isset($_GET['rname'])){
	echo'<meta http-equiv="refresh" content="30">';
	$room=$_GET['rname'];
	$uname=$_GET['uname'];
	if (!is_dir($room)) mkdir($room);
	$files = scandir($room);
	foreach ($files as $user){
		if ($user=='.' || $user=='..') continue;
		$handle=fopen("$room/$user",'r');
		$time = fread($handle, filesize("$room/$user"));
		fclose($handle);
		if ((time()-$time)>20) unlink("$room/$user");
	}
	$contents='';
	$filename="$room.txt";
	if (file_exists($filename)){
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		fclose($handle);
	}
	$handle = fopen("$room/$uname", "w");
	fwrite($handle, time());
	fclose($handle);

	$files = scandir($room);
	$users='';
	foreach ($files as $user) if ($user!='.' && $user!='..') $users.=$user."\n";

	if (isset($_POST['Send'])){
		$text=$_POST['txt'];
		$contents.="$uname: $text";
		$handle = fopen("$filename", "a");
		fwrite($handle, "$uname: $text\n");
		fclose($handle);
	}
?>
<body Onload="document.myform.txt.focus()">
<form action="" method="post" name="myform">
<table style="border: 1px solid #000000; width: 752px;" align="center">
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif; font-size: 17pt; text-align: center; width: 537; color: #2214B9; border-style: solid;border-width: 1px; height: 350px;">
				<textarea readonly="readonly" name="txtchat" style="width: 830px; color: #000000; height: 400px; background-color: #F4F8D1; font-family: 'Times New Roman, Times, serif;font-size: 12pt;"> <?php echo "Welcome to the $room chatroom..." . "                                                                                                                                                                                                                   " . "This site will auto refresh in 30 seconds after last refresh" ."                                                                                                                                                             :" . "\n$contents"?> </textarea>
			</td>
			<td style="font-family: 'Times New Roman, Times, serif;font-size: 17pt; text-align: center; color: #2214B9; border-style:solid; border-width: 1px; height: 349px; width: 143px;">
					<textarea readonly="readonly" contenteditable="false" name="txtuser" style=";width: 163px; height: 402px; background-color: #D1F8D8; font-family: 'Times New Roman, Times, serif; font-size: 12pt; font-weight:bold; text-align:center;"> <?php echo  "People active in $room Chatroom..." . "                            " . "$users" ?> </textarea></td>
				</tr>
				<table style="border: 1px solid #000000; width: 1006px;" align="center">

				<tr>
					<td style="width: 532; border-style: solid; border-width: 1px; text-align: left; height: 39px; font-size: 14px;">
						<textarea id="txtt" name="txt" style="width: 932px; height: 79px; font-family: 'Times New Roman, Times, serif; font-size: 12pt;;"></textarea></td>
						<td style="border-style: solid; border-width: 1px; height: 39px; padding-left: -8px; width: 50px; text-align: center;">
							<input type="submit" name="Send" style="width: 50px; height: 30px; font-size: 15px; font-family: 'Times New Roman, Times, serif; color: rgb(20,240,240);" value="Send"></td>
						</tr>
					</table>
				</form>

			<?php
			}else {
			?>
			<form method="get" action="">
			<table style="border: 1px solid rgb(20,200,200); width: 358px;" align="center">
				<tr>
					<td style="font-family: 'Times New Roman, Times, serif; font-size: 17pt; text-align: left; width: 432px; color: #2214B9; width: 430px;">Name:</td>
					<td style="border-style: solid; border-width: 1px; font-family: 'Times New Roman, Times, serif; font-size: 17pt; text-align: left; color: #2214B9; width: 430px;">
						<input name="uname" style="border: 1px solid rgb(20,200,200); font-size: medium; width: 260px; color: #B01919;" required></td>
					</tr>
					<tr>
						<td style="font-family: 'Times New Roman, Times, serif;  font-size: 17pt; text-align:left; width: 432px; color: #2214B9; border-style: solid; border-width: 1px;">Select Room</td>
						<td style="border-style: solid; border-width: 1px; font-family: 'Times New Roman, Times, serif; font-size: 17pt; text-align:left; color: #2214B9; width: 430px; ">
							<select name="rname" style="width: 260px; font-size: medium; color: #B01919; border: 1px solid rgb(20,200,200);">
								<option selected="">Worldwide</option>
							</select></td>
						</tr>
						<tr>
							<td style=";font-family: 'Times New Roman, Times, serif; font-size: 17pt; text-align: center; color: #2214B9;  padding-top:10px; padding-bottom:10px;" colspan="2"><center>
								<input name="enSubmit" style="border: 1px solid rgb(20,200,200); cursor: pointer; width: 118px; height: 30px; font-size: 15pt; font-family: 'Times New Roman, Times, serif;  color: #19B024;" type="submit" value="Enter">			<div style="text-align: center;">
					<p> <a href="http://192.168.191.1/Skiy/Index.php" style=" text-decoration: none;"> Skiy.com </a> </p>
				</div></td></center><br>
							</tr>
						</table>
					</form>
				<?php
				}
				?>
				<script>
					el=document.myform.txtt
						if (typeof el.selectionStart == "number") {
							el.selectionStart = el.selectionEnd = el.value.lenght;
						} else if (typeof el.createTextRange != "undefined") {
							el.focus();
							var range = el.createTextRange();
							range.collapse(false);
							range.select();
						}</script>
						

			</body>