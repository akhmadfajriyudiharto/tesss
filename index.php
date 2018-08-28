<?php
$host        = "host=localhost";
$port        = "port=5432";
$dbname      = "dbname=tes";
$credentials = "user=postgres password=sembarang";

$connect= pg_connect( "$host $port $dbname $credentials"  ) or die("Could not connect: " . pg_last_error());

if (!empty($_POST)) {
	$sql = "insert into tes.user (nama, email) values('" . $_POST['nama'] . "', '" . $_POST['email'] . "')";

	$result = pg_query($connect, $sql);

	if($result){
        echo "<script>alert('Berhasil menyimpan');</script>";
    }else{
        echo "<script>alert('Gagal menyimpan');</script>";;
    }
}
if (!empty($_GET['id'])) {
	$sql = "SELECT * FROM tes.user where iduser=" . $_GET['id'];

	$result = pg_query($sql) or die('Error message: ' . pg_last_error());

	while ($row = pg_fetch_row($result)) {
		$update = $row;break;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tess</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<form name="post_user" method="post">
		Nama : <input type="text" name="nama" value="<?=!empty($update[1]) ? $update[1] : ''?>"><br>
		Email : <input type="text" name="email" value="<?=!empty($update[2]) ? $update[2] : ''?>"><br>
		<input type="submit" name="act">
	</form>
	<br>
	<table class="table">
		<thead>
			<th>No.</th>
			<th>Nama</th>
			<th>Email</th>
			<th>action</th>
		</thead>
		<tbody>
			<?php
			$sql = 'SELECT * FROM tes.user';
		    $result = pg_query($sql) or die('Error message: ' . pg_last_error());

		    $i=0;
		    while ($row = pg_fetch_row($result)) {
		    ?>
		    <tr>
				<td><?= $i++?></td>
				<td><?= $row[1]?></td>
				<td><?= $row[2]?></td>
				<td><a href="http://localhost/tess/index.php?id=<?=$row[0]?>"><?= 'Edit'?></a></td>
			</tr>
		    <?php }
			?>
		</tbody>
	</table>
</body>
</html>

<?php
?>