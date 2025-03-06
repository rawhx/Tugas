<?php  
    session_start();
    if (!isset($_SESSION["email"])) {
        header("Location: ./login.php");
        exit; 
    } else if (!isset($_SESSION["data"])) {
        header("Location: ./index.php");
        exit;
    }
    function formatTanggalRange($tanggalAwal, $tanggalAkhir) {
        $bulan = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];
        $dateAwal = new DateTime($tanggalAwal);
        $dateAkhir = new DateTime($tanggalAkhir);

        $bulanTahunAwal = $bulan[$dateAwal->format('F')] . ' ' . $dateAwal->format('Y');
        $bulanTahunAkhir = $bulan[$dateAkhir->format('F')] . ' ' . $dateAkhir->format('Y');

        return $bulanTahunAwal . ' - ' . $bulanTahunAkhir;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container p-5 d-flex justify-content-center align-items-center">
        <div class="card p-5" style="width: 100%;height: fit-content;overflow-y: auto;">
            <div class="card-body d-flex flex-column gap-5">
                <div class="d-flex flex-column flex-lg-row gap-4 align-items-center">
                    <div style="width:120px;height:120px;border-radius: 100%;background-color: red;overflow: hidden;">
                        <img src="<?= $_SESSION['data']['image'] ?>" alt="login" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <div>
                        <!-- <h3 class="fw-bold mb-4"><?= $_SESSION["data"]["namaLengkap"] ?></h3> -->
                        <h3 class="fw-bold mb-4 text-center">Achmad Hasbil Wafi Rahmawan</h3>
                        <p class="m-0 text-center text-lg-start d-flex flex-column flex-lg-row gap-3">
                            <span>
                                <?= $_SESSION["data"]["telp"] ?>
                            </span>
                            <span class="d-none d-lg-block">|</span>
                            <span>
                                <?= $_SESSION["email"] ?>
                            </span>
                        </p>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold">About Me</h4>
                    <hr>
                    <p class="m-0" style="text-align: justify;"><?= $_SESSION["data"]["deskripsi"] ?></p>
                </div>
                <div>
                    <h5 class="fw-bold">Education</h4>
                    <hr>
                    <div class="d-flex flex-column gap-4">
                        <?php  
                        foreach ($_SESSION["data"]["pendidikan"] as $key => $value) {
                                echo "<div>";
                                echo "<h6 class='fw-bold'>" . formatTanggalRange($value['tanggalAwal'], $value['tanggalAkhir']) . " | " . htmlspecialchars($value['pendidikan']) . "</h6>";
                                echo "<p class='m-0' style='text-align: justify;'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda aperiam maiores quisquam omnis ex sit velit ullam, earum officia nam? Quisquam corrupti atque porro vel est expedita ea. Architecto et ab minima natus praesentium iure deleniti, aperiam possimus culpa corrupti? Temporibus, dicta officiis.</p>";
                                echo "</div>";
                            }                    
                        ?>

                    </div>
                </div>
                <div>
                    <h5 class="fw-bold">Skill</h4>
                    <hr>
                    <div class="d-flex flex-wrap">
                        <?php 
                            $skills = $_SESSION["data"]["skill"];
                            $lastSkill = end($skills);
                            
                            foreach ($skills as $key => $value) { 
                                $border = ($value !== $lastSkill) ? "border-right: 1px solid black;" : ""; 
                            ?>
                                <h6 class="fw-bold px-3" style="<?= $border ?> width: fit-content;">
                                    <?= htmlspecialchars($value) ?>
                                </h6>
                            <?php } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-danger position-fixed" style="bottom:30px;right:30px;" onclick="logout()" title="keluar">
        <i class="bi bi-box-arrow-right"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function logout() {
            window.location.href = "./auth.php?logout=true";
        }
    </script>
</body>
</html>