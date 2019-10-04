<!DOCTYPE html>
<html>
<head>
	<title>Input Palindrome | No.1</title>
</head>
<body>
	<center>
		<h2>Masukkan Jumlah Input</h2>
	</center>
	<form action="" method="post">
		<table style="margin:20px auto;">
			<tr>
				<td><input type="text" name="jumlah" placeholder="masukkan jumlah data"></td>
			</tr>
			<tr>
				<td><input type="submit" name="tambah" value="Tambah"></td>
			</tr>
		</table>
	</form>
	<hr>
	<?php if(isset($_POST["tambah"])){ ?>

    <form action="" method="post">
    	<table style="margin:20px auto;">
	        <?php
				$jumlah = $_POST['jumlah'];
				for($a=1;$a<=$jumlah;$a++){ ?>
				<tr>
					<td><b>Huruf Ke – <?php echo $a; ?></b> <input type="text" name="huruf<?php echo $jumlah; ?>" maxlength="1" required></td>
				</tr>
	        <?php } ?>
			<tr>
				<td><input type="submit" name="simpan" value="Proses"></td>
			</tr>
		</table>
	</form>

    <?php } ?>	
</body>
</html>