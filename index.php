<?php  
    session_start();
    if (!isset($_SESSION["email"])) {
        header("Location: ./login.php");
        exit; 
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // print_r($_POST);
        $data = [];
        $data["namaLengkap"] = $_POST["namaLengkap"];
        $data["tanggalLahir"] = $_POST["tanggalLahir"];
        $data["telp"] = $_POST["telp"];
        $data["deskripsi"] = $_POST["deskripsi"];
        $data["skill"] = [];
        foreach ($_POST["skill"] as $key => $value) {
            $data["skill"][$key] = $value;
        }
        $data["pendidikan"] = [];
        foreach ($_POST["pendidikan"] as $key => $value) {
            $data["pendidikan"][$key] = [
                "tanggalAwal" => $_POST["pendidikanAwal"][$key],
                "tanggalAkhir" => $_POST["pendidikanAkhir"][$key],
                "pendidikan" => $value,
                "deskripsi" => $_POST["pendidikanDeskripsi"][$key]
            ];
        }
        $file = $_FILES["image"]["tmp_name"];
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $type = $finfo->file($file);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($file));
        $data["image"] = $base64;

        $_SESSION["data"] = $data;
        // print_r($data);
        header("Location: ./cv.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="p-5">
    <div class="container p-3 d-flex justify-content-center align-items-center">
        <div class="card">
            <div class="card-body p-4 d-flex flex-column flex-lg-row gap-3 align-items-center">
                <div style="width: fit-content;">
                    <h3 style="position: sticky;top:0;background-color: white;padding:20px 0;">Form Input Data CV</h3>
                    <form method="post" id="form-cv" enctype="multipart/form-data">
                        <div class="mb-3 d-flex flex-column flex-sm-row gap-2">
                            <div class="w-100">
                                <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" name="namaLengkap" class="form-control" id="namaLengkap" placeholder="Masukkan Nama Lengkap" required>
                            </div>
                            <div class="w-100">
                                <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" required>
                            </div>
                        </div>
                        <div class="mb-3 d-flex flex-column flex-sm-row gap-2">
                            <div class="w-100">
                                <label for="telp" class="form-label">No Telp</label>
                                <input type="text" maxlength="12" name="telp" class="form-control" id="telp" placeholder="Masukkan No Telp" required>
                            </div>
                            <div class="w-100">
                                <label for="profile-picture" class="form-label">Foto</label>
                                <input class="form-control" name="image" type="file" id="profile-picture" accept="image/*" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="floatingTextarea" style="height:8rem;" required></textarea>
                        </div>
                        <div class="mb-3" id="pendidikan">
                            <div class="d-flex justify-content-between mb-2">
                                <label for="pendidikan" class="form-label">Pendidikan</label>
                                <button type="button" class="btn btn-primary" onclick="addPendidikan()"><i class="bi bi-plus-square"></i></button>
                            </div>
                            <div class="mb-3 d-flex gap-3 align-items-center" id="pendidikan[0]">
                                <div>
                                    <div class="d-flex gap-3 mb-3">
                                        <input type="month" name="pendidikanAwal[0]" class="form-control" required>
                                        <input type="month" name="pendidikanAkhir[0]" class="form-control" required>
                                        <input type="text" name="pendidikan[0]" class="form-control" placeholder="Masukkan Pendidikan" required>
                                    </div>
                                    <textarea class="w-100 form-control" style="height: 5em;" name="pendidikanDeskripsi[0]" id="pendidikanDeskripsi[0]" placeholder="Deskripsi Pendidikan" required></textarea>
                                </div>
                                <button type="button" class="btn btn-danger" style="height: fit-content;" onclick="removePendidikan(0)"><i class="bi bi-trash"></i></i></button>
                            </div>
                        </div>
                        <div class="mb-3" id="skill">
                            <div class="d-flex justify-content-between mb-2">
                                <label for="skill" class="form-label">Skill</label>
                                <button type="button" class="btn btn-primary" onclick="addSkill()"><i class="bi bi-plus-square"></i></button>
                            </div>
                            <div class="d-flex gap-4 mb-3" id="skill[0]">
                                <input type="text" name="skill[0]" class="form-control" placeholder="Masukkan skill" required>
                                <button type="button" class="btn btn-danger" onclick="removeSkill(0)"><i class="bi bi-trash"></i></i></button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-danger position-fixed" style="bottom:30px;right:30px;" onclick="logout()" title="keluar">
        <i class="bi bi-box-arrow-right"></i>
    </button>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function logout() {
        window.location.href = "./auth.php?logout=true";
    }

    function addPendidikan() {
        document.getElementById("pendidikan").insertAdjacentHTML("beforeend", `
            <div class="mb-3 d-flex gap-3 align-items-center" id="pendidikan[${document.querySelectorAll("#pendidikan input").length}]">
                <div>
                    <div class="d-flex gap-3 mb-3">
                        <input type="month" name="pendidikanAwal[${document.querySelectorAll("#pendidikan input").length}]" class="form-control" required>
                        <input type="month" name="pendidikanAkhir[${document.querySelectorAll("#pendidikan input").length}]" class="form-control" required>
                        <input type="text" name="pendidikan[${document.querySelectorAll("#pendidikan input").length}]" class="form-control" placeholder="Masukkan Pendidikan" required>
                    </div>
                    <textarea class="w-100 form-control" style="height: 5em;" name="pendidikanDeskripsi[${document.querySelectorAll("#pendidikan input").length}]" id="pendidikanDeskripsi[0]" placeholder="Deskripsi Pendidikan" required></textarea>
                </div>
                <button type="button" class="btn btn-danger" style="height: fit-content;" onclick="removePendidikan(${document.querySelectorAll("#pendidikan input").length})"><i class="bi bi-trash"></i></i></button>
            </div>
        `);

    }

    function removePendidikan(x) {  
        const el = document.getElementById(`pendidikan[${x}]`);
        if (el) {
            el.remove();
        }
    }

    function addSkill() {
        document.getElementById("skill").insertAdjacentHTML("beforeend", `
            <div class="d-flex gap-4 mb-3" id="skill[${document.querySelectorAll("#skill input").length}]">
                <input type="text" name="skill[${document.querySelectorAll("#skill input").length}]" 
                    class="form-control" 
                    placeholder="Masukkan Skill" required>
                <button type="button" class="btn btn-danger" 
                        onclick="removeSkill(${document.querySelectorAll("#skill input").length})"><i class="bi bi-trash"></i></i></button>
            </div>
        `);

    }

    function removeSkill(x) {  
        const el = document.getElementById(`skill[${x}]`);
        if (el) {
            el.remove();
        }
    }
</script>
<?php 
    if (isset($_SESSION["message"])) {
        echo "<script>alert('".$_SESSION["message"]."')</script>";
        unset($_SESSION["message"]);
    }
?>
</html>