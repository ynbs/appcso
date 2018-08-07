<html>
<head>
<title>Update Data Konsumen</title>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
	
	<!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
</head>
<body>
<?php
//membuat koneksi ke database
mysql_connect('localhost','root','');
mysql_select_db('smsdrc');
 
if (isset($_POST['submit'])) {//Script akan berjalan jika di tekan tombol submit..
 
//Script upload file csv..
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<h1>" . "File ". $_FILES['filename']['name'] ." Berhasil di Upload" . "</h1>";
        echo "<h2>Menampilkan Hasil Upload:</h2>";
        readfile($_FILES['filename']['tmp_name']);
    }
 
    //Import uploaded file ke Database, Letakan dibawah sini..
    $handle = fopen($_FILES['filename']['tmp_name'], "r"); //Membuka file dan membacanya
    while (($data = fgetcsv($handle, 900, ",")) !== FALSE) {
        $import="INSERT into pbk (ID,GroupID, Name, Number) values('$data[0]','$data[1]','$data[2]','$data[3]')"; //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari �0� bukan �1�
        mysql_query($import) or die(mysql_error()); //Melakukan Import
    }
 
    fclose($handle); //Menutup CSV file
    echo "<br><strong>Import data selesai.</strong>";
    
}else { //Jika belum menekan tombol upload, form dibawah akan muncul.. ?>
 
<!-- Form Untuk Upload File CSV-->

<div class="container" style="margin-top: 60px;">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">UPDATE data KONSUMEN</h3></div>
            <div class="panel-body">
            <b>Pilih  file csv yang ingin diupload</b><br /> 
                <form enctype='multipart/form-data' action='' method='post'>
                   <strong>Cari File CSV :</strong><br />
                    <input type='file' name='filename' size='100' class="form-control" required="" /><br />
                    <input type='submit' name='submit' value='Upload' class="btn btn-primary btn-sm" />
                </form>
            </div>
    </div>
</div>
<?php } mysql_close(); //Menutup koneksi SQL?>
</body>
</html><br><br><br>