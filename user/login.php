<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit(); // Selalu tambahkan exit() setelah header redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    </head>
<body class="bg-slate-100 flex flex-col min-h-screen">

<?php include 'header.php'; ?>

    <main class="flex-grow flex items-center justify-center p-4">
        
        <div class="bg-white w-full max-w-sm rounded-2xl shadow-lg p-8 md:p-10 text-center">
            
            <div class="mx-auto mb-8 flex h-20 w-20 items-center justify-center rounded-full bg-slate-800">
                <span class="text-4xl text-white">&#9679;&#9679;&#9679;</span>
            </div>
            
            <form method="POST" action="auth.php">
                <div class="mb-5 text-left">
                    <label for="username" class="mb-2 block text-sm font-bold text-gray-700">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukan username Anda" required
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="mb-6 text-left">
                    <label for="password" class="mb-2 block text-sm font-bold text-gray-700">Password</label>
                    <input type="password" id="password" name="password" placeholder="●●●●●●●●●●" required
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <button type="submit"
                        class="w-full rounded-full bg-slate-800 py-3 font-bold text-white transition-colors hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                    Login
                </button>
                
                <div class="mt-6 text-sm">
                    <span class="text-gray-600">Belum punya akun? </span>
                    <a href="register.php" class="font-bold text-slate-800 hover:underline">Daftar di sini</a>
                </div>
            </form>
            
        </div>
    </main>
    
<?php include 'footer.php'; ?>
</body>
</html>