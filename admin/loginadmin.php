<?php 
include "../koneksi.php";


if($_SERVER['REQUEST_METHOD']==='POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $dataUser = mysqli_query($konek, "SELECT * FROM `admin` WHERE username = '$username'");
    if($dataUser->num_rows > 0){
        $getData = $dataUser->fetch_assoc();
        if ($getData['username'] === $username && $getData['password'] === $password) {
            session_start();
            $_SESSION['username'] = $getData['username'];
            echo "<script>alert('Login Berhasil'); window.location='admin.php'; </script>";
        } else {
            echo "<script>alert('Password atau ID user salah!'); window.location='loginadmin.php'; </script>";
        }
    } else {
        echo "<script>alert('Pengguna tidak diitemukan!'); window.location='loginadmin.php'; </script>";
    }
}

?>
<!doctype html>
<html lang="en">
<head>
  <title>Login Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable">
</head>

<body>
  <div class="login-box">
    <h2>Login</h2>
    <form action="" method="POST">
      <div class="user-box">
        <input type="text" name="username" required="">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required="">
        <label>Password</label>
      </div>
      <button type="submit">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Submit
</button>
    </form>
  </div>
</body>
</html>

<style>
  /* Reset CSS */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.login-box {
  width: 300px;
  margin: 0 auto;
  margin-top: 100px;
  background: #fff;
  padding: 40px;
  border-radius: 8px;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1);
}

.login-box h2 {
  margin-bottom: 20px;
  text-align: center;
}

.user-box {
  position: relative;
  margin-bottom: 25px;
}

.user-box input {
  width: 100%;
  padding: 10px 0;
  border: none;
  outline: none;
  border-bottom: 1px solid #999;
  background: transparent;
  font-size: 16px;
  color: #333;
}

.user-box label {
  position: absolute;
  top: 0;
  left: 0;
  pointer-events: none;
  transition: 0.5s;
  font-size: 16px;
  color: #999;
}

.user-box input:focus ~ label,
.user-box input:valid ~ label {
  top: -20px;
  font-size: 14px;
  color: #007bff;
}

button[type="submit"] {
  position: relative;
  display: inline-block;
  padding: 10px 20px;
  color: #fff;
  background-color: #007bff;
  border: none;
  outline: none;
  cursor: pointer;
  border-radius: 5px;
  overflow: hidden;
}

button[type="submit"] span {
  position: absolute;
  display: block;
  width: 100%;
  height: 100%;
  background: linear-gradient(45deg, #007bff, #0099ff, #00ccff, #00ffff);
  top: 0;
  left: -100%;
  transition: 0.5s;
}

button[type="submit"]:hover span {
  left: 100%;
}

</style>