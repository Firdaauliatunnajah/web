<?php
require_once 'function.php';

// jika sudah pernah login
if (isset($_SESSION['id_user']))
{
    header('Location: index.php');
    exit;
}

// jika tombol login ditekan
if (isset($_POST['btnLogin']))
{
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    // cek email
    $cek_email = mysqli_query($conn, "SELECT * FROM user where email = '$email'");
    // jika email ada
    if ($data_user = mysqli_fetch_assoc($cek_email)) {
        // verifikasi password yang di-hash, jika berhasil login ke index
        if (password_verify($password, $data_user['password'])) {
            $_SESSION['id_user'] = $data_user['id_user'];
            header('Location: index.php');
            exit;
        } else {
            setAlert("Gagal", "Email atau Password salah", "error");
            header('Location: login.php');
            exit;
        }
    } else {
        setAlert("Gagal", "Email atau Password salah", "error");
        header('Location: login.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <?php include_once 'head.php'; ?>
    <style>
        body {
            background-color:  #f5a3cc;
        }
    </style>
</head>
<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <h2 class="text-center font-weight-light my-4">PLAUSE INVENTORY</h2>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" required />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" required />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" name="btnLogin">Login </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
