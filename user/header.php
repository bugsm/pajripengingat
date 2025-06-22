<script src="https://cdn.tailwindcss.com"></script>
<header>
    <nav class="border-gray-200 bg-gray-900 py-2.5 fixed-top">
        <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between px-4">
            <a href="index.php" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Pajri Pengingat</span>
            </a>
            <div class="flex items-center justify-end lg:order-2 space-x-4">
                <div class="hidden lg:flex">
                    <ul class="flex flex-row space-x-6">
                        <li><a class="block text-gray-400 hover:text-white lg:hover:text-white"
                                href="index.php">Home</a></li>
                        <li><a class="block text-gray-400 hover:text-white lg:hover:text-white"
                                href="dashboard.php">Ingatkan</a></li>
                    </ul>
                </div>

                <?php if (!isset($_SESSION['user'])): ?>
                    <a class="rounded-lg border-2 border-white px-4 py-2 text-sm leading-[24px] font-medium text-white hover:bg-gray-700 focus:ring-4 focus:ring-gray-800 focus:outline-none lg:px-5 lg:py-2.5"
                        href="login.php">
                        Masuk
                    </a>
                <?php else: ?>
                    <div class="relative"></div>
                    <button onclick="toggleDropdown()" class="flex items-center space-x-2 hover:bg-gray-700 rounded-lg p-1">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-800 font-bold">
                            <?= strtoupper(substr($_SESSION['user']['username'] ?? $_SESSION['user']['name'] ?? (string) $_SESSION['user'], 0, 1)) ?>
                        </div>
                        <span
                            class="text-white text-sm font-medium"><?= htmlspecialchars($_SESSION['user']['username'] ?? $_SESSION['user']['name'] ?? (string) $_SESSION['user']) ?></span>
                    </button>
                    <div id="dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                        <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                            Logout
                        </a>
                    </div>
                </div>

                <script>
                    function toggleDropdown() {
                        document.getElementById('dropdown').classList.toggle('hidden');
                    }

                    // Close dropdown when clicking outside
                    window.onclick = function (event) {
                        if (!event.target.matches('.flex') && !event.target.closest('.relative')) {
                            var dropdown = document.getElementById('dropdown');
                            if (!dropdown.classList.contains('hidden')) {
                                dropdown.classList.add('hidden');
                            }
                        }
                    }
                </script>
            </div>
        <?php endif; ?>
        </div>
        </div>
    </nav>
</header>