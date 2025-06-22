<script src="https://cdn.tailwindcss.com"></script>
<header>
    <nav class="bg-gray-900 w-full fixed top-0 left-0 z-50 border-b border-gray-700">
        <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between px-4 py-2.5">
            <a href="index.php" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Admin Pengingat</span>
            </a>

            <div class="flex items-center lg:order-2">

                <?php if (!isset($_SESSION['admin'])): ?>
                    <div class="hidden lg:flex items-center space-x-6 mr-6">
                        <a class="block text-gray-400 hover:text-white" href="index.php">Home</a>
                    </div>
                    <a class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-800"
                        href="login.php">
                        Masuk
                    </a>

                <?php else: ?>
                    <div class="flex items-center space-x-6">
                        <div class="hidden lg:flex">
                            <ul class="flex flex-row items-center space-x-6">
                                <li>
                                    <a class="block text-gray-400 hover:text-white" href="index.php">Home</a>
                                </li>
                                <li class="relative group">
                                    <a class="cursor-pointer flex items-center text-gray-400 hover:text-white" href="#">
                                        <span>Kelola</span>
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </a>
                                    <div
                                        class="absolute z-50 hidden group-hover:block bg-white rounded-md shadow-lg mt-2 py-1 w-48">
                                        <a href="kelola_kategori.php"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Kelola
                                            Kategori</a>
                                        <a href="kelola_prioritas.php"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Kelola
                                            Prioritas</a>
                                        <a href="kelola_status.php"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Kelola
                                            Status</a>
                                        <div class="border-t border-gray-100 my-1"></div>
                                        <a href="index.php"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Kelola User</a>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="relative ml-4">
                            <button onclick="toggleDropdown()"
                                class="flex items-center space-x-2 hover:bg-gray-700 rounded-lg p-1">
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-800 font-bold">
                                    <?= strtoupper(substr($_SESSION['admin']['username'] ?? 'A', 0, 1)) ?>
                                </div>
                                <span
                                    class="hidden md:block text-white text-sm font-medium"><?= htmlspecialchars($_SESSION['admin']['username'] ?? 'Admin') ?></span>
                            </button>
                            <div id="dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                                <a href="logout.php"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<script>
    function toggleDropdown() {
        document.getElementById('dropdown').classList.toggle('hidden');
    }

    // Menutup dropdown jika klik di luar area dropdown
    window.addEventListener('click', function (event) {
        const dropdownButton = document.querySelector('button[onclick="toggleDropdown()"]');
        const dropdownMenu = document.getElementById('dropdown');

        if (dropdownButton && dropdownMenu) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        }
    });
</script>