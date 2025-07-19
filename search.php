<?php
$servername = "localhost";
$username = "root";
$password = ""; // Kendine göre değiştir
$dbname = "ctf_lab";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$user = isset($_GET['user']) ? $_GET['user'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

$sql = "SELECT u.username AS u, u.info AS i FROM users u WHERE u.username LIKE '%$user%' AND u.id = '$id'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Arama Sonuçları - Orta Seviye CTF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #111;
            color: #eee;
            padding: 20px;
        }
        input[type=text], input[type=number] {
            padding: 10px;
            margin: 5px 10px 10px 0;
            border-radius: 5px;
            border: none;
            width: 200px;
        }
        input[type=submit] {
            padding: 10px 20px;
            background-color: #ff9800;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            color: #222;
        }
        input[type=submit]:hover {
            background-color: #e68a00;
        }
        .result {
            margin-top: 20px;
            background-color: #222;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 8px #ff9800;
        }
    </style>
</head>
<body>

<h2>Kullanıcı Arama</h2>
<form method="GET" action="search.php">
    <input type="text" name="user" placeholder="Kullanıcı adı girin" value="<?php echo htmlspecialchars($user); ?>" required />
    <input type="number" name="id" placeholder="ID girin" value="<?php echo htmlspecialchars($id); ?>" required />
    <input type="submit" value="Ara" />
</form>

<div class="result">
<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><b>Kullanıcı:</b> " . htmlspecialchars($row['u']) . "</p>";

        
        if ($row['u'] === 'admin' && $id == 1) {
            $flag_base64 = $row['i'];
            $flag_hex = bin2hex(base64_decode($flag_base64));
            echo "<p><b>Flag (hex kodu):</b> " . htmlspecialchars($flag_hex) . "</p>";
        } else {
            echo "<p><i>Özel bilgi mevcut değil.</i></p>";
        }
    }
} else {
    echo "<p>Sonuç bulunamadı.</p>";
}
$conn->close();
?>
</div>

</body>
</html>
