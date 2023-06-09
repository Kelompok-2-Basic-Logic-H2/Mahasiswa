<?php
session_start();
	include 'koneksi.php';
	if($_SESSION['stat_login'] != true){
		echo '<script>window.loction="login.php"</script>';
	}
?>
<?php
	function getGrade($nilai_akhir) {
		if($nilai_akhir == 100) {
			return "S";
		} elseif($nilai_akhir >= 85 && $nilai_akhir <= 99) {
			return "A";
		} elseif($nilai_akhir >= 75 && $nilai_akhir <= 84) {
			return "B";
		} elseif($nilai_akhir >= 60 && $nilai_akhir <= 74) {
			return "C";
		} elseif($nilai_akhir >= 50 && $nilai_akhir <= 59) {
			return "D";
		} elseif($nilai_akhir >= 1 && $nilai_akhir <= 49) {
			return "E";
		} elseif($nilai_akhir == 0) {
			return "F"; 
		} else {
			return "Tidak Valid";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pendaftaran Online | Administrator</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">

</head>
<body>
	<header>
		<h1><a href="beranda.php">Admin</h1>
		<ul>
			<li><a href="beranda.php">Beranda</li>
			<li><a href="data-peserta.php">Data Peserta</li>
			<li><a href="keluar.php">Keluar</li>
		</ul>
	</header>

	<section class="content">
		<h2>Data Peserta</h2>
		<div class="box">
			<a href="cetak-peserta.php" target="_blank" class="btn-cetak">Print</a>
			<table class="table" border="1">
				<thead>
					<tr>
						<th>No</th>
						<th>ID Pendaftaran</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Nilai Akhir</th>
						<th>Grade</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$list_peserta = mysqli_query($conn, "SELECT * FROM tb_pendaftaran ORDER BY nilai_akhir DESC");
						while($row = mysqli_fetch_array($list_peserta)){
					?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $row['id_pendaftaran'] ?></td>
						<td><?php echo $row['nm_peserta'] ?></td>
						<td><?php echo $row['jk'] ?></td>
						<td><?php echo $row['nilai_akhir'] ?></td>
						<td><?php echo getGrade($row['nilai_akhir']) ?></td>
						<td>
							<a href="detail-peserta.php?id=<?php echo $row['id_pendaftaran'] ?>">Detail</a> ||
							<a href="hapus-peserta.php?id=<?php echo $row['id_pendaftaran'] ?>" onclick="return confirm('Yakin Anda Ingin Hapus?')">Hapus</a>
						</td>
					</tr>
					<?php } 
					?>
				</tbody>
			</table>
		</div>
	</section>
</body>
</html>