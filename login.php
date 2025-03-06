<?php  
session_start();
if (isset($_SESSION["email"])) {
    header("location: ./");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container p-5 d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card">
            <div class="card-body p-4 d-flex flex-column flex-md-row gap-3 align-items-center">
                <img class="img-fluid w-50 w-md-75 w-lg-90" src="https://img.freepik.com/free-vector/mobile-login-concept-illustration_114360-135.jpg?ga=GA1.1.185465092.1737781406&semt=ais_hybrid" alt="login">
                <div class="w-100">
                    <h3>Login</h3>
                    <form method="post" action="auth.php" id="form-login" class="">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan kata sandi">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php 
    if (isset($_SESSION["message"])) {
        echo "<script>alert('".$_SESSION["message"]."')</script>";
        unset($_SESSION["message"]);
    }
?>
</html>