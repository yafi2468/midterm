<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✨ To-Do List Wafi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @layer utilities {
            .task-item:hover .task-actions {
                opacity: 1;
                transform: translateY(0);
            }
            .task-actions {
                opacity: 0;
                transform: translateY(10px);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 h-screen flex">
    <!-- Sidebar -->
    <aside class="w-72 bg-white dark:bg-gray-800 p-6 shadow-xl border-r border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">✨ Wafi Tasks</h1>
            <button id="themeToggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"></path>
                </svg>
            </button>
        </div>
        
        <nav>
            <ul class="space-y-2">
                <li>
                    <button onclick="showCategory('all')" class="w-full flex items-center gap-3 p-3 rounded-xl transition-all hover:bg-indigo-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Semua Tugas
                    </button>
                </li>
                <li>
                    <button onclick="showCategory('today')" class="w-full flex items-center gap-3 p-3 rounded-xl transition-all bg-indigo-100 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Hari Ini
                    </button>
                </li>
                <li>
                    <button onclick="showCategory('upcoming')" class="w-full flex items-center gap-3 p-3 rounded-xl transition-all hover:bg-indigo-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Mendatang
                    </button>
                </li>
                <li>
                    <button onclick="showCategory('completed')" class="w-full flex items-center gap-3 p-3 rounded-xl transition-all hover:bg-indigo-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Selesai
                    </button>
                </li>
            </ul>
            
            <button onclick="openTaskModal()" class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-xl transition-all flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Tugas
            </button>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 dark:bg-gray-900">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200" id="categoryTitle">Hari Ini</h2>
            
            <!-- Task Stats -->
            <div class="grid grid-cols-3 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Tugas</div>
                    <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400" id="totalTasks">0</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Terselesaikan</div>
                    <div class="text-2xl font-bold text-green-600 dark:text-green-400" id="completedTasks">0</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Tertunda</div>
                    <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400" id="pendingTasks">0</div>
                </div>
            </div>

            <!-- Task List -->
            <ul id="taskList" class="space-y-3"></ul>
        </div>
    </main>

    <!-- Modal -->
    <div id="taskModal" class="fixed inset-0 bg-black bg-opacity-50 hidden transition-opacity z-50">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-2xl w-full max-w-md transition-all">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">✏️ Tambah Tugas Baru</h3>
                <button onclick="closeTaskModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form id="taskForm" onsubmit="event.preventDefault(); addTask()">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Judul Tugas</label>
                        <input type="text" id="taskTitle" required class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-transparent focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                        <select id="taskCategory" class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-transparent focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="today">Hari Ini</option>
                            <option value="upcoming">Mendatang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Deadline</label>
                        <input type="date" id="taskDeadline" class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-transparent focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>
                
                <div class="mt-6 flex gap-3">
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg transition-all">
                        Simpan
                    </button>
                    <button type="button" onclick="closeTaskModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 px-6 py-3 rounded-lg transition-all">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>