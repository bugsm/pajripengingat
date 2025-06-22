<?php
// Pindahkan proses include ke paling atas untuk best practice
include "../koneksi.php";

$registration_success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users(username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        $registration_success = true;
    } catch (PDOException $e) {
        // Opsional: Tangani error, misalnya jika username sudah ada
        // Untuk saat ini, kita anggap selalu berhasil
    }

    if ($registration_success) {
        // Atur header untuk redirect setelah 2 detik menggunakan meta tag
        // Ini lebih baik daripada menggunakan JS di tengah-tengah body
        header("refresh:2;url=login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
</head>

<body class="bg-slate-100 flex flex-col min-h-screen">

    <?php include 'header.php'; ?>

    <main class="flex-grow flex items-center justify-center p-4">

        <div class="bg-white w-full max-w-sm rounded-2xl shadow-lg p-8 md:p-10 text-center">

            <?php
            // Tampilkan pesan sukses di sini jika registrasi berhasil
            if ($registration_success) {
                echo "
                <div class='mb-6 rounded-lg bg-green-100 p-4 text-sm text-green-800' role='alert'>
                    <span class='font-bold'>Registrasi Berhasil!</span><br>
                    Anda akan diarahkan ke halaman login...
                </div>";
            }
            ?>

            <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-slate-800">
                <span class="text-4xl text-white">&#9679;&#9679;&#9679;</span>
            </div>

            <h1 class="text-2xl font-bold text-gray-800 mb-6">Buat Akun Baru</h1>

            <form method="POST">
                <div class="mb-5 text-left">
                    <label for="username" class="mb-2 block text-sm font-bold text-gray-700">Username</label>
                    <input type="text" id="username" name="username" placeholder="Pilih username" required
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6 text-left">
                    <label for="password" class="mb-2 block text-sm font-bold text-gray-700">Password</label>
                    <input type="password" id="password" name="password" placeholder="Buat password yang kuat" required
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit"
                    class="w-full rounded-full bg-slate-800 py-3 font-bold text-white transition-colors hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                    Daftar
                </button>

                <div class="mt-6 text-sm">
                    <span class="text-gray-600">Sudah punya akun? </span>
                    <a href="login.php" class="font-bold text-slate-800 hover:underline">Masuk di sini</a>
                </div>
            </form>

        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>