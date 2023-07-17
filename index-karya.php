<!DOCTYPE html>
<html>
<head>
  <title>Upload Media</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f2f2f2;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333;
      text-align: center;
      margin-bottom: 30px;
    }

    .upload-form {
      text-align: center;
      margin-bottom: 30px;
    }

    .upload-form label {
      font-weight: bold;
      font-size: 18px;
    }

    .upload-form input[type="file"] {
      display: block;
      margin: 10px auto;
    }

    .upload-form input[type="submit"] {
      display: block;
      margin: 20px auto;
      padding: 10px 20px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 3px;
      font-size: 16px;
      cursor: pointer;
    }

    .upload-form input[type="submit"]:hover {
      background-color: #45a049;
    }

    .media-list {
      list-style: none;
      padding: 0;
    }

    .media-item {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      padding: 10px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .media-item img {
      width: 100px;
      height: auto;
      margin-right: 20px;
      border-radius: 5px;
    }

    .media-details {
      flex: 1;
    }

    .media-details p {
      margin: 5px 0;
    }

    .media-actions a {
      margin-right: 10px;
      text-decoration: none;
      color: #333;
      font-size: 14px;
      font-weight: bold;
    }

    .media-actions a:hover {
      color: #000;
    }

    .error-message {
      color: red;
      margin-bottom: 10px;
      text-align: center;
    }

    .Kemblai{
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Upload Media</h2>

    <form method="POST" action="ADMIN/upload.php" enctype="multipart/form-data" class="upload-form">
      <label for="file">Pilih file:</label>
      <input type="file" name="file" id="file" accept="image/*, video/*" required>
      <input type="submit" name="submit" value="Upload">
    </form>

    <hr>

    <h2>Daftar Media</h2>

    <h3 class="Kemblai"><a href="index.html">Beranda</a></h3>

    <?php
    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "media");

    // Periksa koneksi
    if (!$conn) {
      die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Ambil data file dari database
    $sql = "SELECT id, filename, filetype FROM files";
    $result = mysqli_query($conn, $sql);

    // Tampilkan data file
    if (mysqli_num_rows($result) > 0) {
      echo "<ul class='media-list'>";
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $filename = $row['filename'];
        $filetype = $row['filetype'];

        echo "<li class='media-item'>";
        echo "<img src='ADMIN/view.php?id=$id' alt='$filename'>";
        echo "<div class='media-details'>";
        echo "<p><strong>Nama File:</strong> $filename</p>";
        echo "<p><strong>Tipe File:</strong> $filetype</p>";
        echo "</div>";
        echo "<div class='media-actions'>";
        echo "<a href='ADMIN/edit.php?id=$id'>Edit</a>";
        echo "<a href='ADMIN/login-2.php?id=$id' onclick=\"return confirm('Anda harus masuk dahulu untuk mengedit/menghapus file');\">Hapus</a>";
        echo "</div>";
        echo "</li>";
      }
      echo "</ul>";
    } else {
      echo "<p class='error-message'>Tidak ada file.</p>";
    }

    // Tutup koneksi
    mysqli_close($conn);
    ?>
  </div>
</body>
</html>
