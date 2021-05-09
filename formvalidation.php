<!DOCTYPE HTML>
<html>
<head>
<!--pengaturan tampilan form dengan css bootstrap-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style>
.warning {color:#FF000;}
</style>
</head>
<body>
<?php
//pendeklarasian variabel error dan data dari database
$error_nama="";
$error_email="";
$error_web="";
$error_pesan="";
$error_telp="";

$nama="";
$email="";
$web="";
$pesan="";
$telp="";

//pengecekan kondisi jika halaman mengeksekusi sebuah form
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //pengecekan bahwa variabel terisi atau kosong
    if (empty($_POST["nama"]))
    {//jika bernilai true maka akan menampilkan kalimat dibawah
        $error_nama = "Nama tidak boleh kosong";
    }
    else {
        $nama= cek_input($_POST["nama"]);
        //pengecekan apabila data inputan yang dimasukkan sudah berformat benar
        if (!preg_match("/^[a-zA-Z]*$/",$nama))
        {
            $nameErr = "Inputan hanya boleh huruf dan spasi";
        }
    }
    if (empty($_POST["email"]))
    {
        $error_email = "Email tidak boleh kosong";
    }
    else {
        $email = cek_input($_POST["email"]);
        //pengecekan format email
        if (!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $error_email = "Format email Invalid";
        }
    }
    if (empty($_POST["pesan"]))
    {
        $error_pesan = "Pesan tidak boleh kosong";
    }
    else {
        $pesan= cek_input($_POST["pesan"]);
    }
    if (empty($_POST["web"]))
    {
        $error_web = "Website tidak boleh kosong";
    }
    else {
        $web = cek_input($_POST["web"]);
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$web))
        {
            $error_web = "URL tidak valid";
        }
    }
    if (empty($_POST["telp"]))
    {
        $error_telp = "Telp tidak boleh kosong";
    }
    else
    {
        $telp = cek_input ($_POST["telp"]);
        //pengecekan format hanya boleh angka
        if(!is_numeric($telp))
        {
            $error_telp = 'Nomor HP hanya boleh angka';
        }
    }
}
//method function jika terdapat karakter inputan yang tidak tepat
function cek_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!--tampilan area div dengan class yang dipanggil dari css bootstrap-->
<div class="row">
<div class="col-md-6">
<div class="card">
    <div class="card-header">
        Contoh Validasi Form dengan PHP
    </div>
    <!--pembuatan rangka form-->
<div class="card-body">
    <!--form akan dikirim dengan perantara post--> 
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group row">
    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
    <!--panjang field-->
    <div class="col-sm-10">
    <input type="text" name="nama" class="form-control <?php echo ($error_nama !="" ? "is-invalid" : "");?>"
    id="nama" placeholder="Nama" value="<?php echo $nama; ?>"><span class="warning"><?php echo $error_nama; ?></span>
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
    <input type="text" name="email" class="form-control <?php echo($error_email !="" ? "is-invalid":""); ?>"
    id="email" placeholder="email" value="<?php echo $email;?>"><span class="warning"><?php echo $error_email; ?></span>
    </div>
</div>

<div class="form-group row">
    <label for="web" class="col-sm-2 col-form-label">Website</label>
    <div class="col-sm-10">
    <input type="text" name="web" class="form-control <?php echo($error_web !="" ? "is-invalid" : ""); ?>" id="web"
    placeholder="web" value="<?php echo $web; ?>"><span class="warning"><?php echo $error_web; ?></span>
    </div>
</div>

<div class="form-group row">
    <label for="telp" class="col-sm-2 col-form-label">Telp</label>
    <div class="col-sm-10">
    <input type="text" name="telp" class="form-control <?php echo ($error_telp !="" ? "is-invalid" : ""); ?>"<?php echo $telp; ?>>
    <span class="warning"><?php echo $error_telp; ?></span>
    </div>
</div>

<div class="form-group row">
    <label for="pesan" class="col-sm-2 col-form-label">Pesan</label>
    <div class="col-sm-10">
    <textarea name="pesan" class="form-control <?php echo ($error_pesan !="" ? "is-invalid" : ""); ?>"><?php echo $pesan; ?>
    </textarea><span class="warning"><?php echo $error_pesan; ?></span>
    </div>
</div>

<div class="form-group row">
<div class="col-sm-10">
<!--pengaturan untuk membuat tombol-->
<button type="submit"class="btn btn-primary">Sign in</button>
</div>
</div>
</form>

    </div>
</div>
</div>
</div>

<?php 
//menampilkan inputan form yang telah dikirim
echo "<h2>Your Input:</h2>";
echo "Nama=".$nama;
echo "<br>";
echo "Email=".$email;
echo "<br>";
echo "Website=".$web;
echo "<br>";
echo "Telp=".$telp;
echo "<br>";
echo "Pesan=".$pesan;
?>

</body>
</html>