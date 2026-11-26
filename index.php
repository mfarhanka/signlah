<?php
declare(strict_types=1);

$appName = 'SignLah';
$pageTitle = $appName . ' - Belajar Bahasa Isyarat Malaysia (BIM)';
$pageLanguage = 'ms';
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($pageLanguage, ENT_QUOTES, 'UTF-8') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Nunito & Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800;900&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Nunito', 'sans-serif'],
                        body: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        duoGreen: '#58CC02',
                        duoGreenDark: '#46A302',
                        duoBlue: '#1CB0F6',
                        duoBlueDark: '#1899D6',
                        duoYellow: '#FFC800',
                        duoYellowDark: '#E5B400',
                        duoRed: '#FF4B4B',
                        duoRedDark: '#EA2B2B',
                        duoPurple: '#CE82FF',
                        duoPurpleDark: '#A560E8',
                        duoGray: '#E5E5E5',
                        duoGrayDark: '#AFAFAF',
                    }
                }
            }
        }
    </script>

    <style>
        /* Gaya Khas Butang 3D Tactile ala Duolingo */
        * {
            -webkit-tap-highlight-color: transparent;
            user-select: none;
        }
        
        body {
            background-color: #f0f4f8;
            font-family: 'Nunito', sans-serif;
            overflow-x: hidden;
        }

        /* Butang 3D Tebal */
        .btn-3d {
            transition: transform 0.1s ease, box-shadow 0.1s ease;
            position: relative;
        }
        .btn-3d:active:not(:disabled) {
            transform: translateY(4px);
            box-shadow: 0 0px 0 transparent !important;
        }

        .btn-green {
            background-color: #58CC02;
            box-shadow: 0 5px 0 #46A302;
            color: white;
        }
        .btn-blue {
            background-color: #1CB0F6;
            box-shadow: 0 5px 0 #1899D6;
            color: white;
        }
        .btn-yellow {
            background-color: #FFC800;
            box-shadow: 0 5px 0 #E5B400;
            color: #4B3800;
        }
        .btn-red {
            background-color: #FF4B4B;
            box-shadow: 0 5px 0 #EA2B2B;
            color: white;
        }
        .btn-white {
            background-color: #FFFFFF;
            border: 2px solid #E5E5E5;
            box-shadow: 0 4px 0 #E5E5E5;
            color: #4B4B4B;
        }
        .btn-white.selected {
            background-color: #DDF4FF;
            border-color: #1CB0F6;
            box-shadow: 0 4px 0 #1CB0F6;
            color: #1899D6;
        }
        .btn-disabled {
            background-color: #E5E5E5;
            box-shadow: 0 5px 0 #CECECE;
            color: #AFAFAF;
            cursor: not-allowed;
        }

        /* Animasi Isyarat Tangan SVG */
        @keyframes handMoveUpDown {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        @keyframes handMoveForward {
            0%, 100% { transform: translate(0px, 0px) rotate(0deg); }
            50% { transform: translate(8px, 6px) rotate(10deg); }
        }
        @keyframes handWave {
            0%, 100% { transform: rotate(-10deg); }
            50% { transform: rotate(15deg); }
        }
        @keyframes handTapChest {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(0.92) translateY(3px); }
        }
        @keyframes floatMascot {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        @keyframes pulseRing {
            0% { transform: scale(0.95); opacity: 0.7; }
            70% { transform: scale(1.18); opacity: 0; }
            100% { transform: scale(1.18); opacity: 0; }
        }

        .anim-updown { animation: handMoveUpDown 1.8s infinite ease-in-out; }
        .anim-forward { animation: handMoveForward 1.8s infinite ease-in-out; }
        .anim-wave { animation: handWave 1.4s infinite ease-in-out; transform-origin: bottom center; }
        .anim-chest { animation: handTapChest 1.6s infinite ease-in-out; }
        .anim-mascot { animation: floatMascot 2.8s infinite ease-in-out; }
        .pulse-node::before {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 9999px;
            border: 4px solid #58CC02;
            animation: pulseRing 2s infinite;
        }

        /* Sembunyikan Scrollbar untuk pengalaman aplikasi Android tulen */
        ::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }

        /* Drawer Maklum Balas */
        .feedback-drawer {
            transition: transform 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
    </style>
</head>
<body class="flex justify-center min-h-screen bg-slate-200">

    <!-- Bekas Utama Aplikasi Android (Max-width 480px pada desktop, penuh pada mudah alih) -->
    <div id="app-container" class="w-full max-w-[480px] bg-white min-h-screen shadow-2xl relative flex flex-col overflow-hidden">

        <!-- 1. BAR ATAS (TOP STATS BAR) -->
        <header id="top-stats-bar" class="sticky top-0 z-30 bg-white/95 backdrop-blur-sm border-b-2 border-gray-100 px-4 py-3 flex items-center justify-between">
            <!-- Logo & Bendera BIM -->
            <div class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-xl bg-duoGreen flex items-center justify-center shadow-sm border-b-2 border-duoGreenDark">
                    <span class="text-white font-black text-lg">🤟</span>
                </div>
                <span class="font-black text-xl tracking-tight text-gray-800">Sign<span class="text-duoGreen">Lah</span></span>
            </div>

            <!-- Statistik: Streak, XP/Permata, Nyawa, & Butang Bunyi -->
            <div class="flex items-center gap-3">
                <!-- Streak -->
                <div class="flex items-center gap-1 bg-orange-50 px-2.5 py-1 rounded-xl border border-orange-200" title="Streak Harian">
                    <span class="text-base">🔥</span>
                    <span id="stat-streak" class="font-extrabold text-orange-500 text-sm">1</span>
                </div>

                <!-- XP / Permata -->
                <div class="flex items-center gap-1 bg-sky-50 px-2.5 py-1 rounded-xl border border-sky-200" title="Mata XP">
                    <span class="text-base">💎</span>
                    <span id="stat-xp" class="font-extrabold text-duoBlue text-sm">0</span>
                </div>

                <!-- Nyawa / Hearts -->
                <div class="flex items-center gap-1 bg-rose-50 px-2.5 py-1 rounded-xl border border-rose-200" title="Nyawa">
                    <span class="text-base">❤️</span>
                    <span id="stat-hearts" class="font-extrabold text-duoRed text-sm">5</span>
                </div>

                <!-- Butang Bunyi -->
                <button id="btn-sound-toggle" onclick="toggleSound()" class="w-8 h-8 rounded-xl bg-gray-100 flex items-center justify-center text-gray-600 active:scale-95 transition" title="Tukar Bunyi">
                    <span id="sound-icon" class="text-base">🔊</span>
                </button>
            </div>
        </header>

        <!-- KANDUNGAN UTAMA (TAB VIEWS) -->
        <main class="flex-1 overflow-y-auto pb-24">

            <!-- TAB 1: LALUAN PEMBELAJARAN (HOME PATH) -->
            <section id="view-learn" class="px-4 pt-4 pb-8">
                <!-- Kad Maskot Enggang Malaysia -->
                <div class="bg-gradient-to-r from-emerald-50 to-sky-50 border-2 border-emerald-200 rounded-3xl p-4 mb-6 flex items-center gap-3 shadow-sm">
                    <div class="w-16 h-16 flex-shrink-0 anim-mascot" id="mascot-container">
                        <!-- SVG Maskot Burung Enggang Kenyalang Comel -->
                        <svg viewBox="0 0 100 100" class="w-full h-full drop-shadow">
                            <!-- Badan -->
                            <ellipse cx="50" cy="65" rx="26" ry="25" fill="#2D3748"/>
                            <ellipse cx="50" cy="68" rx="18" ry="18" fill="#FFFFFF"/>
                            <!-- Kepak Melambai -->
                            <path d="M24 58 Q10 42 18 32 Q28 40 28 55 Z" fill="#1A202C" class="anim-wave"/>
                            <path d="M76 58 Q88 65 80 75 Q72 70 72 60 Z" fill="#1A202C"/>
                            <!-- Kepala -->
                            <circle cx="50" cy="36" r="20" fill="#2D3748"/>
                            <!-- Paruh Enggang Kuning & Merah -->
                            <path d="M45 34 Q78 26 84 42 Q65 46 45 42 Z" fill="#FFC800" stroke="#E5B400" stroke-width="2"/>
                            <path d="M46 28 Q68 20 73 30 Q58 33 46 32 Z" fill="#FF4B4B"/>
                            <!-- Mata Comel -->
                            <circle cx="43" cy="32" r="4.5" fill="#FFFFFF"/>
                            <circle cx="44" cy="32" r="2.2" fill="#1A202C"/>
                            <circle cx="45" cy="31" r="0.8" fill="#FFFFFF"/>
                            <!-- Pipi Merah -->
                            <ellipse cx="38" cy="39" rx="3.5" ry="2" fill="#FF8787" opacity="0.8"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="inline-block bg-duoGreen text-white text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-full mb-1">
                            Tuah Si Enggang
                        </div>
                        <p id="mascot-speech" class="text-sm font-bold text-gray-700 leading-snug">
                            "Apa khabar! Jom belajar Bahasa Isyarat Malaysia hari ini. Klik nod bulat di bawah!"
                        </p>
                    </div>
                </div>

                <!-- Bekas Laluan Unit & Nod Pelajaran -->
                <div id="learning-path-container" class="space-y-8">
                    <!-- Dijana secara dinamik melalui JS -->
                </div>
            </section>

            <!-- TAB 2: KAMUS PANTAS BIM (DICTIONARY) -->
            <section id="view-dictionary" class="hidden px-4 pt-4 pb-8">
                <div class="mb-4">
                    <h1 class="text-2xl font-black text-gray-800">Kamus Pantas BIM 📖</h1>
                    <p class="text-xs font-semibold text-gray-500 font-body">Rujukan segera isyarat tangan & mimik muka untuk komunikasi harian.</p>
                </div>

                <!-- Bar Carian -->
                <div class="relative mb-4">
                    <input type="text" id="dict-search" oninput="renderDictionary()" placeholder="Cari perkataan (cth: Terima Kasih, Sakit)..." 
                        class="w-full bg-gray-100 border-2 border-gray-200 focus:border-duoBlue focus:bg-white rounded-2xl py-3 pl-11 pr-4 text-sm font-bold text-gray-700 outline-none transition">
                    <span class="absolute left-4 top-3.5 text-gray-400 text-base">🔍</span>
                </div>

                <!-- Penapis Kategori -->
                <div class="flex gap-2 overflow-x-auto pb-2 mb-4" id="dict-filters">
                    <button onclick="setDictFilter('Semua')" class="dict-filter-btn active px-3.5 py-1.5 rounded-xl text-xs font-extrabold bg-duoBlue text-white whitespace-nowrap">Semua</button>
                    <button onclick="setDictFilter('NomborAbjad')" class="dict-filter-btn px-3.5 py-1.5 rounded-xl text-xs font-extrabold bg-gray-100 text-gray-600 whitespace-nowrap">1. Abjad & Nombor</button>
                    <button onclick="setDictFilter('Sapaan')" class="dict-filter-btn px-3.5 py-1.5 rounded-xl text-xs font-extrabold bg-gray-100 text-gray-600 whitespace-nowrap">2. Ucapan & Sapaan</button>
                    <button onclick="setDictFilter('GantiNama')" class="dict-filter-btn px-3.5 py-1.5 rounded-xl text-xs font-extrabold bg-gray-100 text-gray-600 whitespace-nowrap">3. Kata Ganti Nama</button>
                    <button onclick="setDictFilter('KataTanya')" class="dict-filter-btn px-3.5 py-1.5 rounded-xl text-xs font-extrabold bg-gray-100 text-gray-600 whitespace-nowrap">4. Kata Tanya</button>
                    <button onclick="setDictFilter('Warna')" class="dict-filter-btn px-3.5 py-1.5 rounded-xl text-xs font-extrabold bg-gray-100 text-gray-600 whitespace-nowrap">5. Warna</button>
                </div>

                <!-- Kotak Latihan Ejaan Jari Nama Sendiri (Fingerspelling Studio) -->
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 border-2 border-duoYellow rounded-3xl p-4 mb-5 shadow-2xs">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-black text-amber-700 uppercase tracking-wider">✍️ Latihan Ejaan Jari BIM (A–Z)</span>
                        <span class="text-[11px] font-extrabold bg-duoYellow text-amber-950 px-2 py-0.5 rounded-full">Interaktif</span>
                    </div>
                    <p class="text-xs font-semibold text-gray-600 mb-2.5 font-body">Taip nama atau perkataan anda untuk melihat ejaan jari BIM secara langsung:</p>
                    <div class="flex gap-2 mb-3">
                        <input type="text" id="fingerspell-input" maxlength="12" oninput="renderFingerspelling()" placeholder="Contoh: AISYAH" 
                            class="flex-1 bg-white border-2 border-amber-300 focus:border-duoYellowDark rounded-xl px-3 py-2 text-sm font-black uppercase text-gray-800 outline-none">
                        <button onclick="document.getElementById('fingerspell-input').value='MALAYSIA'; renderFingerspelling(); playSound('tap');" 
                            class="btn-3d btn-white px-3 py-2 rounded-xl text-xs font-black">CUBA</button>
                        <button onclick="startFingerspellQuiz()" 
                            class="btn-3d btn-yellow px-3 py-2 rounded-xl text-xs font-black whitespace-nowrap">⚡ KUIZ A-Z</button>
                    </div>
                    <div id="fingerspell-output" class="flex gap-2.5 overflow-x-auto pb-1.5 min-h-[112px] items-center">
                        <!-- Paparan kad ejaan jari setiap huruf -->
                    </div>
                </div>

                <!-- Senarai Kad Kamus -->
                <div id="dictionary-list" class="grid grid-cols-1 gap-3">
                    <!-- Dijana secara dinamik -->
                </div>
            </section>

            <!-- TAB 2B: KENALI BIM & KOMUNITI PEKAK (INFO & SEJARAH) -->
            <section id="view-info" class="hidden px-4 pt-4 pb-8 space-y-5">
                <div class="bg-gradient-to-br from-emerald-500 to-duoGreen text-white rounded-3xl p-5 shadow-md">
                    <div class="inline-block bg-white/20 text-[10px] font-black uppercase px-2.5 py-0.5 rounded-full mb-2">
                        Sumber: UiTM Press (2022)
                    </div>
                    <h1 class="text-2xl font-black leading-tight">Kenali BIM & Komuniti Pekak 🤟</h1>
                    <p class="text-xs font-semibold text-emerald-50 mt-1.5 font-body">
                        Memahami bahasa, sejarah, dan budaya komuniti pekak di Malaysia untuk komunikasi yang lebih inklusif.
                    </p>
                </div>

                <!-- Fakta Sejarah Pengiktirafan BIM -->
                <div class="bg-white border-2 border-gray-200 rounded-3xl p-4 shadow-2xs">
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="w-9 h-9 rounded-xl bg-sky-100 text-duoBlue flex items-center justify-center text-lg">🇲🇾</span>
                        <h2 class="text-base font-black text-gray-800">Sejarah & Pengiktirafan BIM</h2>
                    </div>
                    <p class="text-xs font-semibold text-gray-600 leading-relaxed font-body">
                        <strong>Bahasa Isyarat Malaysia (BIM)</strong> ialah bahasa ibunda dan bahasa komunikasi utama komuniti pekak di Malaysia. Ia diwujudkan seiring penubuhan <em>Persekutuan Orang Pekak Malaysia (MFD)</em> pada tahun <strong>1998</strong>, dan telah diiktiraf secara rasmi oleh Kerajaan Malaysia di bawah Akta Orang Kurang Upaya pada tahun <strong>2008</strong>.
                    </p>
                </div>

                <!-- Perbezaan BIM vs KTBM -->
                <div class="bg-white border-2 border-gray-200 rounded-3xl p-4 shadow-2xs">
                    <div class="flex items-center gap-2.5 mb-3">
                        <span class="w-9 h-9 rounded-xl bg-purple-100 text-duoPurple flex items-center justify-center text-lg">⚖️</span>
                        <h2 class="text-base font-black text-gray-800">Perbezaan BIM vs KTBM</h2>
                    </div>
                    <div class="grid grid-cols-1 gap-2.5">
                        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-3">
                            <div class="text-xs font-black text-duoGreenDark uppercase mb-1">🤟 BIM (Bahasa Isyarat Malaysia)</div>
                            <p class="text-xs font-semibold text-gray-700 font-body">
                                Bahasa semula jadi komuniti pekak Malaysia yang mempunyai struktur tatabahasa visual, budaya, dan ekspresi mimik muka tersendiri.
                            </p>
                        </div>
                        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-3">
                            <div class="text-xs font-black text-amber-700 uppercase mb-1">✋ KTBM (Kod Tangan Bahasa Melayu)</div>
                            <p class="text-xs font-semibold text-gray-700 font-body">
                                Dicipta oleh pendidik pada tahun 1980–1986 sebagai alat bantu mengajar tatabahasa dan imbuhan Bahasa Melayu secara bertulis di sekolah.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Senarai Persatuan & Organisasi Sokongan -->
                <div class="bg-white border-2 border-gray-200 rounded-3xl p-4 shadow-2xs">
                    <div class="flex items-center gap-2.5 mb-3">
                        <span class="w-9 h-9 rounded-xl bg-rose-100 text-duoRed flex items-center justify-center text-lg">🤝</span>
                        <h2 class="text-base font-black text-gray-800">Organisasi Komuniti Pekak Malaysia</h2>
                    </div>
                    <div class="space-y-2.5 text-xs font-body">
                        <div class="p-3 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="font-black text-gray-800 font-sans">1. Malaysia Federation of the Deaf (MFD)</div>
                            <p class="text-gray-600 mt-0.5">Badan induk kebangsaan yang memperjuangkan hak, pendidikan, dan pembangunan BIM sejak 1998.</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="font-black text-gray-800 font-sans">2. RC Deaf Missions Malaysia</div>
                            <p class="text-gray-600 mt-0.5">Pertubuhan sosial yang aktif menganjurkan kelas BIM untuk orang awam serta pemerkasaan kerjaya komuniti pekak.</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="font-black text-gray-800 font-sans">3. Malaysia Deaf Sports Association (MSDeaf)</div>
                            <p class="text-gray-600 mt-0.5">Menaungi atlet pekak negara ke kejohanan Sukan SEA Pekak dan Deaflympics.</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="font-black text-gray-800 font-sans">4. Selangor Hearing Impaired Community Association</div>
                            <p class="text-gray-600 mt-0.5">Persatuan komuniti setempat yang menyokong kebajikan dan aktiviti sosial warga pekak di Selangor.</p>
                        </div>
                    </div>
                </div>

                <!-- Tip Etika Berkomunikasi -->
                <div class="bg-sky-50 border-2 border-sky-200 rounded-3xl p-4">
                    <h3 class="text-sm font-black text-duoBlueDark mb-2">💡 Etika Asas Berkomunikasi dengan Komuniti Pekak</h3>
                    <ul class="text-xs font-semibold text-gray-700 space-y-1.5 font-body list-disc pl-4">
                        <li>Sentuh bahu secara lembut atau lambaikan tangan dalam pandangan mata untuk menarik perhatian.</li>
                        <li>Kekalkan hubungan mata (<em>eye contact</em>) dan gunakan ekspresi mimik muka yang jelas.</li>
                        <li>Jangan bercakap terlalu laju atau menutup mulut semasa berkomunikasi.</li>
                    </ul>
                </div>
            </section>

            <!-- TAB 3: PROFIL & PENCAPAIAN (PROFILE) -->
            <section id="view-profile" class="hidden px-4 pt-4 pb-8">
                <!-- Kad Avatar Pengguna -->
                <div class="bg-gradient-to-br from-sky-400 to-duoBlue rounded-3xl p-5 text-white mb-6 shadow-md relative overflow-hidden">
                    <div class="flex items-center gap-4 relative z-10">
                        <div class="w-20 h-20 rounded-full bg-white/20 border-4 border-white flex items-center justify-center text-4xl shadow-inner">
                            🤟
                        </div>
                        <div>
                            <h2 class="text-xl font-black">Pelajar BIM Malaysia</h2>
                            <p id="profile-level-title" class="text-xs font-bold bg-white/25 inline-block px-2.5 py-0.5 rounded-full mt-1">
                                Tahap 1: Sahabat Baru
                            </p>
                            <p class="text-xs text-sky-100 mt-1.5 font-body">Komited merapatkan jurang komunikasi komuniti pekak.</p>
                        </div>
                    </div>
                </div>

                <!-- Grid Statistik -->
                <h3 class="text-base font-black text-gray-800 mb-3">Statistik Pembelajaran</h3>
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <div class="bg-white border-2 border-gray-200 rounded-2xl p-3.5 flex items-center gap-3">
                        <span class="text-2xl">🔥</span>
                        <div>
                            <div id="prof-streak" class="text-lg font-black text-gray-800">1 Hari</div>
                            <div class="text-xs font-bold text-gray-400">Streak Aktif</div>
                        </div>
                    </div>
                    <div class="bg-white border-2 border-gray-200 rounded-2xl p-3.5 flex items-center gap-3">
                        <span class="text-2xl">💎</span>
                        <div>
                            <div id="prof-xp" class="text-lg font-black text-gray-800">0 XP</div>
                            <div class="text-xs font-bold text-gray-400">Jumlah Permata</div>
                        </div>
                    </div>
                    <div class="bg-white border-2 border-gray-200 rounded-2xl p-3.5 flex items-center gap-3">
                        <span class="text-2xl">👐</span>
                        <div>
                            <div id="prof-signs" class="text-lg font-black text-gray-800">0 / 37</div>
                            <div class="text-xs font-bold text-gray-400">Modul Dikuasai</div>
                        </div>
                    </div>
                    <div class="bg-white border-2 border-gray-200 rounded-2xl p-3.5 flex items-center gap-3">
                        <span class="text-2xl">🏆</span>
                        <div>
                            <div id="prof-lessons" class="text-lg font-black text-gray-800">0 / 5 Unit</div>
                            <div class="text-xs font-bold text-gray-400">Unit Tamat</div>
                        </div>
                    </div>
                </div>

                <!-- Lencana Pencapaian -->
                <h3 class="text-base font-black text-gray-800 mb-3">Lencana Pencapaian</h3>
                <div id="badges-container" class="space-y-3 mb-6">
                    <!-- Dijana melalui JS -->
                </div>

                <!-- Butang Pulihkan Nyawa / Reset Kemajuan -->
                <div class="space-y-3 pt-2 border-t-2 border-gray-100">
                    <button onclick="refillHearts()" class="w-full btn-3d btn-blue py-3.5 rounded-2xl font-extrabold text-sm flex items-center justify-center gap-2">
                        <span>❤️</span> Isi Semula 5 Nyawa (Percuma)
                    </button>
                    <button onclick="promptResetProgress()" class="w-full py-3 rounded-2xl font-bold text-xs text-gray-400 hover:text-duoRed transition">
                        Set Semula Kemajuan Pembelajaran
                    </button>
                </div>
            </section>
        </main>

        <!-- 6. NAVIGASI BAWAH (ANDROID BOTTOM NAVIGATION BAR) -->
        <nav class="fixed bottom-0 w-full max-w-[480px] bg-white border-t-2 border-gray-200 px-3 py-2 flex justify-around items-center z-30">
            <button onclick="switchTab('learn')" id="nav-learn" class="nav-tab flex flex-col items-center gap-1 text-duoGreen transition">
                <div class="w-11 h-8 rounded-xl bg-emerald-100 flex items-center justify-center text-lg">🏠</div>
                <span class="text-[10px] font-black tracking-wide">BELAJAR</span>
            </button>
            <button onclick="switchTab('dictionary')" id="nav-dictionary" class="nav-tab flex flex-col items-center gap-1 text-gray-400 transition">
                <div class="w-11 h-8 rounded-xl bg-transparent flex items-center justify-center text-lg">📖</div>
                <span class="text-[10px] font-extrabold tracking-wide">KAMUS</span>
            </button>
            <button onclick="switchTab('info')" id="nav-info" class="nav-tab flex flex-col items-center gap-1 text-gray-400 transition">
                <div class="w-11 h-8 rounded-xl bg-transparent flex items-center justify-center text-lg">🤟</div>
                <span class="text-[10px] font-extrabold tracking-wide">INFO BIM</span>
            </button>
            <button onclick="switchTab('profile')" id="nav-profile" class="nav-tab flex flex-col items-center gap-1 text-gray-400 transition">
                <div class="w-11 h-8 rounded-xl bg-transparent flex items-center justify-center text-lg">🏅</div>
                <span class="text-[10px] font-extrabold tracking-wide">PROFIL</span>
            </button>
        </nav>

        <!-- ===================================================================== -->
        <!-- SKRIN MOD PELAJARAN INTERAKTIF & KUIZ (FULLSCREEN OVERLAY MODAL)      -->
        <!-- ===================================================================== -->
        <div id="lesson-modal" class="fixed inset-0 z-50 bg-white max-w-[480px] mx-auto hidden flex-col">
            <!-- Bar Kemajuan Pelajaran -->
            <div class="px-4 pt-4 pb-2 flex items-center gap-3">
                <button onclick="confirmExitLesson()" class="w-9 h-9 rounded-full hover:bg-gray-100 flex items-center justify-center text-gray-400 font-black text-xl">
                    ✕
                </button>
                <!-- Progress Bar -->
                <div class="flex-1 h-4 bg-gray-200 rounded-full overflow-hidden p-0.5">
                    <div id="lesson-progress-bar" class="h-full bg-duoGreen rounded-full transition-all duration-300" style="width: 10%"></div>
                </div>
                <!-- Nyawa Semasa -->
                <div class="flex items-center gap-1">
                    <span class="text-lg">❤️</span>
                    <span id="lesson-hearts" class="font-black text-duoRed text-base">5</span>
                </div>
            </div>

            <!-- Kandungan Langkah Pelajaran (Flashcard / Kuiz) -->
            <div id="lesson-content-area" class="flex-1 overflow-y-auto px-5 py-3 flex flex-col justify-between">
                <!-- Dijana secara dinamik oleh enjin pelajaran -->
            </div>

            <!-- Bahagian Butang Semak / Teruskan Bawah -->
            <div id="lesson-footer" class="p-4 border-t-2 border-gray-100 bg-white">
                <button id="btn-lesson-action" onclick="handleLessonAction()" class="w-full btn-3d btn-green py-4 rounded-2xl font-black text-base tracking-wide uppercase">
                    FAHAM & TERUSKAN
                </button>
            </div>

            <!-- Drawer Maklum Balas Segera (Bottom Sheet) -->
            <div id="feedback-drawer" class="feedback-drawer fixed bottom-0 left-0 right-0 max-w-[480px] mx-auto p-5 rounded-t-3xl shadow-2xl transform translate-y-full z-50">
                <div class="flex items-start gap-3 mb-4">
                    <div id="feedback-icon" class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-2xl flex-shrink-0 shadow-sm">
                        🎉
                    </div>
                    <div>
                        <h4 id="feedback-title" class="text-xl font-black">Hebat! Tepat sekali!</h4>
                        <p id="feedback-subtitle" class="text-sm font-bold opacity-90 mt-0.5 font-body">Teruskan usaha murni anda!</p>
                    </div>
                </div>
                <button id="btn-feedback-next" onclick="nextLessonStep()" class="w-full btn-3d py-3.5 rounded-2xl font-black text-base uppercase tracking-wide">
                    TERUSKAN
                </button>
            </div>
        </div>

        <!-- Pemeriksa Isyarat AI Berasaskan Kamera (pemprosesan pada peranti) -->
        <div id="ai-checker-modal" class="fixed inset-0 z-[70] bg-white max-w-[480px] mx-auto hidden flex-col">
            <!-- Kekalkan bar kemajuan pelajaran yang sama seperti skrin soalan -->
            <div class="px-4 pt-4 pb-2 flex items-center gap-3 bg-white">
                <button onclick="closeAIChecker()" class="w-9 h-9 rounded-full hover:bg-gray-100 flex items-center justify-center text-gray-400 font-black text-xl">
                    ✕
                </button>
                <div class="flex-1 h-4 bg-gray-200 rounded-full overflow-hidden p-0.5">
                    <div id="ai-progress-bar" class="h-full bg-duoGreen rounded-full transition-all duration-300" style="width:10%"></div>
                </div>
                <div class="flex items-center gap-1">
                    <span class="text-lg">❤️</span>
                    <span id="ai-lesson-hearts" class="font-black text-duoRed text-base">5</span>
                </div>
            </div>
            <div class="px-5 pt-2 pb-1">
                <div class="text-[10px] font-black uppercase tracking-widest text-duoBlue">Pemeriksa Isyarat AI</div>
                <h3 class="text-lg font-black text-gray-800">Tunjukkan huruf <span id="ai-target-letter" class="text-duoGreen">A</span> kepada kamera</h3>
            </div>
            <div class="relative mx-4 mt-2 rounded-3xl overflow-hidden bg-slate-100 aspect-square border-2 border-sky-200 shadow-sm">
                <video id="ai-camera-video" class="absolute inset-0 w-full h-full object-cover -scale-x-100" autoplay muted playsinline></video>
                <canvas id="ai-camera-canvas" class="absolute inset-0 w-full h-full -scale-x-100"></canvas>
                <div id="ai-camera-loading" class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-sky-50 to-emerald-50 text-gray-700 text-center p-6">
                    <div><div class="text-4xl mb-3 animate-pulse">🤖</div><p class="text-sm font-bold">Memuatkan model pengesanan tangan…</p></div>
                </div>
            </div>
            <div class="p-4 space-y-3">
                <div id="ai-check-result" class="bg-white border-2 border-gray-200 rounded-2xl p-4 text-center text-gray-800 shadow-sm">
                    <div id="ai-check-icon" class="text-3xl mb-1">🖐️</div>
                    <div id="ai-check-title" class="font-black">Letakkan satu tangan dalam bingkai</div>
                    <div id="ai-check-detail" class="text-xs font-semibold text-gray-500 mt-1">Pastikan tangan jelas dan mendapat cahaya yang cukup.</div>
                </div>
                <div class="h-2.5 bg-gray-200 rounded-full overflow-hidden">
                    <div id="ai-confidence-bar" class="h-full bg-duoGreen rounded-full transition-all" style="width:0%"></div>
                </div>
                <p class="text-[10px] text-center text-gray-400 font-semibold">Video diproses terus pada peranti dan tidak dimuat naik.</p>
            </div>
        </div>

        <!-- ===================================================================== -->
        <!-- MODAL KAMUS TERPERINCI & PENGESAHAN (CUSTOM DIALOG PENGGANTI ALERT)   -->
        <!-- ===================================================================== -->
        <div id="custom-dialog" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-xs max-w-[480px] mx-auto hidden items-center justify-center p-5">
            <div id="custom-dialog-box" class="bg-white rounded-3xl p-6 w-full max-w-sm shadow-2xl transform transition-all">
                <!-- Kandungan dinamik -->
            </div>
        </div>

    </div>

    <!-- ========================================================================= -->
    <!-- LOGIK APLIKASI & DATA BAHASA ISYARAT MALAYSIA (BIM)                      -->
    <!-- ========================================================================= -->
    <script>
        // ==========================================
        // 1. PANGKALAN DATA PERKATAAN & ISYARAT BIM
        // Sumber: "Introducing Sign Language and the Deaf: For Beginner" (UiTM Press)
        // ==========================================
        const BIM_SIGNS = {
            // ==========================================
            // UNIT 2: UCAPAN & SAPAAN ASAS (SPEECH)
            // ==========================================
            'hai_hello': {
                id: 'hai_hello',
                word: 'Hai / Hello',
                en: 'Hi / Hello',
                category: 'Sapaan',
                unit: 2,
                svgType: 'salute_wave',
                animClass: 'anim-wave',
                steps: 'Angkat tangan kanan ke sisi dahi seperti tabik hormat ringan, kemudian gerakkan sedikit ke luar dengan tapak tangan terbuka.',
                expression: '👋 Senyuman ceria dan kontak mata mesra.',
                sentence: ['Hai / Hello', 'Apa khabar?']
            },
            'apa_khabar': {
                id: 'apa_khabar',
                word: 'Apa khabar?',
                en: 'How are you?',
                category: 'Sapaan',
                unit: 2,
                svgType: 'wave_open',
                animClass: 'anim-wave',
                steps: 'Rapati kedua-dua belakang jari di hadapan dada, kemudian pusingkan kedua-dua tapak tangan menghadap ke hadapan sambil mengangguk.',
                expression: '😊 Naikkan kening sedikit menandakan soalan mesra.',
                sentence: ['Apa khabar?', 'Awak / Anda']
            },
            'khabar_baik': {
                id: 'khabar_baik',
                word: 'Khabar baik',
                en: 'Fine',
                category: 'Sapaan',
                unit: 2,
                svgType: 'thumbs_up_chest',
                animClass: 'anim-forward',
                steps: 'Sentuh dada dengan hujung jari tangan terbuka (Baik), diikuti isyarat ibu jari tegak ke atas (Thumbs up).',
                expression: '😄 Senyum yakin dan anggukkan kepala.',
                sentence: ['Saya', 'Khabar baik']
            },
            'terima_kasih': {
                id: 'terima_kasih',
                word: 'Terima kasih',
                en: 'Thank you',
                category: 'Sapaan',
                unit: 2,
                svgType: 'chin_forward',
                animClass: 'anim-forward',
                steps: 'Sentuh dagu dengan hujung jari tangan kanan yang rapat, kemudian gerakkan tangan ke hadapan ke arah penerima.',
                expression: '🥰 Senyuman ikhlas tanda penghargaan.',
                sentence: ['Terima kasih', 'Tuan']
            },
            'sama_sama': {
                id: 'sama_sama',
                word: 'Sama-sama',
                en: "You're welcome",
                category: 'Sapaan',
                unit: 2,
                svgType: 'open_sweep',
                animClass: 'anim-forward',
                steps: 'Gerakkan tapak tangan terbuka dari bahagian dada ke arah hadapan secara lembut sebagai balasan ucapan terima kasih.',
                expression: '🙂 Anggukan mesra sambil tersenyum.',
                sentence: ['Sama-sama', 'Khabar baik']
            },
            'maaf': {
                id: 'maaf',
                word: 'Maaf',
                en: 'Sorry',
                category: 'Sapaan',
                unit: 2,
                svgType: 'fist_chest',
                animClass: 'anim-chest',
                steps: 'Genggam tangan kanan (bentuk huruf A) dan gosokkan secara membulat di tengah dada.',
                expression: '🥺 Riak wajah bersalah dan lembut, kening sedikit berkerut.',
                sentence: ['Saya', 'Maaf']
            },
            'tahniah': {
                id: 'tahniah',
                word: 'Tahniah',
                en: 'Congrats',
                category: 'Sapaan',
                unit: 2,
                svgType: 'clasp_shake',
                animClass: 'anim-wave',
                steps: 'Genggam kedua-dua tangan bersama-sama di hadapan dada dan goyangkan sedikit seperti bersalaman meraikan kejayaan.',
                expression: '🎉 Wajah teruja, mata bersinar dan senyuman lebar!',
                sentence: ['Tahniah', 'Awak / Anda']
            },
            'tolong_lah': {
                id: 'tolong_lah',
                word: 'Tolong (lah)',
                en: 'Please',
                category: 'Sapaan',
                unit: 2,
                svgType: 'rub_chest_flat',
                animClass: 'anim-chest',
                steps: 'Letakkan tapak tangan kanan terbuka rata di atas dada dan gosokkan secara membulat dengan lembut.',
                expression: '🙏 Kening terangkat sedikit dengan mimik wajah memohon sopan.',
                sentence: ['Tolong (lah)', 'Saya']
            },
            'selamat': {
                id: 'selamat',
                word: 'Selamat',
                en: 'Well / Good',
                category: 'Sapaan',
                unit: 2,
                svgType: 'safe_cross',
                animClass: 'anim-updown',
                steps: 'Silangkan kedua-dua penumbuk di hadapan dada, kemudian buka sedikit ke sisi dengan yakin.',
                expression: '😌 Wajah tenang dan meyakinkan.',
                sentence: ['Selamat', 'Saya']
            },
            'selamat_pagi': {
                id: 'selamat_pagi',
                word: 'Selamat pagi',
                en: 'Good morning',
                category: 'Sapaan',
                unit: 2,
                svgType: 'sun_rise',
                animClass: 'anim-updown',
                steps: 'Isyarat "Selamat" diikuti tapak tangan kanan naik perlahan di atas lengan kiri seperti matahari terbit.',
                expression: '☀️ Wajah segar dan ceria menyambut waktu pagi.',
                sentence: ['Selamat pagi', 'Puan']
            },
            'selamat_tengah_hari': {
                id: 'selamat_tengah_hari',
                word: 'Selamat tengah hari',
                en: 'Good afternoon',
                category: 'Sapaan',
                unit: 2,
                svgType: 'sun_noon',
                animClass: 'anim-chest',
                steps: 'Isyarat "Selamat" diikuti lengan kanan tegak menegak di atas lengan kiri mendatar (menandakan matahari tegak di langit).',
                expression: '🌤️ Senyuman mesra pada waktu tengah hari.',
                sentence: ['Selamat tengah hari', 'Tuan']
            },
            'selamat_petang': {
                id: 'selamat_petang',
                word: 'Selamat petang',
                en: 'Good evening',
                category: 'Sapaan',
                unit: 2,
                svgType: 'sun_set',
                animClass: 'anim-updown',
                steps: 'Isyarat "Selamat" diikuti pergelangan tangan kanan dilenturkan ke bawah di atas belakang tangan kiri (matahari terbenam).',
                expression: '🌇 Ekspresi lembut dan ramah.',
                sentence: ['Selamat petang', 'Apa khabar?']
            },
            'selamat_malam': {
                id: 'selamat_malam',
                word: 'Selamat malam',
                en: 'Good night',
                category: 'Sapaan',
                unit: 2,
                svgType: 'night_cover',
                animClass: 'anim-updown',
                steps: 'Isyarat "Selamat" diikuti tapak tangan kanan melengkung turun menutup bahagian atas tangan kiri (hari gelap).',
                expression: '🌙 Senyuman tenang sebelum berehat.',
                sentence: ['Selamat malam', 'Terima kasih']
            },

            // ==========================================
            // UNIT 3: KATA GANTI NAMA (PRONOUNS)
            // ==========================================
            'saya': {
                id: 'saya',
                word: 'Saya',
                en: 'I, Me',
                category: 'GantiNama',
                unit: 3,
                svgType: 'point_self',
                animClass: 'anim-chest',
                steps: 'Halakan jari telunjuk tangan kanan menyentuh bahagian tengah dada anda sendiri.',
                expression: '🙂 Ekspresi neutral dan jelas merujuk diri sendiri.',
                sentence: ['Saya', 'Khabar baik']
            },
            'awak_anda': {
                id: 'awak_anda',
                word: 'Awak / Anda',
                en: 'You',
                category: 'GantiNama',
                unit: 3,
                svgType: 'point_forward',
                animClass: 'anim-forward',
                steps: 'Halakan jari telunjuk tangan kanan lurus ke hadapan ke arah orang yang sedang diajak berbual.',
                expression: '👀 Pandangan mata tepat kepada lawan bicara.',
                sentence: ['Awak / Anda', 'Siapa?']
            },
            'dia': {
                id: 'dia',
                word: 'Dia',
                en: 'He, She',
                category: 'GantiNama',
                unit: 3,
                svgType: 'point_side',
                animClass: 'anim-forward',
                steps: 'Halakan jari telunjuk ke arah sisi (kiri atau kanan) merujuk kepada pihak ketiga yang diperkatakan.',
                expression: '👉 Pandangan sekilas ke arah sisi.',
                sentence: ['Dia', 'Khabar baik']
            },
            'kami': {
                id: 'kami',
                word: 'Kami',
                en: 'We',
                category: 'GantiNama',
                unit: 3,
                svgType: 'arc_we',
                animClass: 'anim-wave',
                steps: 'Sentuh bahu kanan dengan jari telunjuk, kemudian gerakkan membentuk lengkungan ke bahu kiri (merangkumi kumpulan kita).',
                expression: '😊 Wajah inklusif melibatkan diri dan rakan.',
                sentence: ['Kami', 'Selamat']
            },
            'mereka': {
                id: 'mereka',
                word: 'Mereka',
                en: 'They',
                category: 'GantiNama',
                unit: 3,
                svgType: 'sweep_they',
                animClass: 'anim-wave',
                steps: 'Halakan jari telunjuk ke hadapan dan gerakkan secara melintang dari kiri ke kanan merujuk sekumpulan orang lain.',
                expression: '👥 Ekspresi menerangkan sekumpulan individu.',
                sentence: ['Mereka', 'Di mana?']
            },
            'tuan': {
                id: 'tuan',
                word: 'Tuan',
                en: 'Sir',
                category: 'GantiNama',
                unit: 3,
                svgType: 'thumb_forehead',
                animClass: 'anim-chest',
                steps: 'Buka kelima-lima jari tangan kanan, sentuhkan hujung ibu jari pada bahagian tepi dahi sebagai tanda hormat kepada lelaki.',
                expression: '👨 Riak wajah hormat dan sopan.',
                sentence: ['Selamat pagi', 'Tuan']
            },
            'puan': {
                id: 'puan',
                word: 'Puan',
                en: 'Madam',
                category: 'GantiNama',
                unit: 3,
                svgType: 'thumb_chin',
                animClass: 'anim-chest',
                steps: 'Buka kelima-lima jari tangan kanan, sentuhkan hujung ibu jari pada bahagian dagu sebagai tanda hormat kepada wanita.',
                expression: '👩 Riak wajah hormat dan senyuman sopan.',
                sentence: ['Terima kasih', 'Puan']
            },
            'kamu': {
                id: 'kamu',
                word: 'Kamu',
                en: 'Your / You',
                category: 'GantiNama',
                unit: 3,
                svgType: 'palm_forward',
                animClass: 'anim-forward',
                steps: 'Tunjukkan tapak tangan terbuka menghadap ke arah penerima (menunjukkan kepunyaan atau merujuk kamu).',
                expression: '🙂 Kontak mata langsung dengan penerima.',
                sentence: ['Apa?', 'Kamu']
            },

            // ==========================================
            // UNIT 4: KATA TANYA (QUESTIONS)
            // ==========================================
            'apa': {
                id: 'apa',
                word: 'Apa?',
                en: 'What?',
                category: 'KataTanya',
                unit: 4,
                svgType: 'wave_open',
                animClass: 'anim-wave',
                steps: 'Buka kedua-dua tapak tangan menghadap ke atas di hadapan badan dan goyangkan sedikit ke kiri dan kanan.',
                expression: '🤔 Kerutkan kening sedikit dan condongkan kepala ke hadapan.',
                sentence: ['Apa?', 'Itu']
            },
            'siapa': {
                id: 'siapa',
                word: 'Siapa?',
                en: 'Who?',
                category: 'KataTanya',
                unit: 4,
                svgType: 'chin_finger',
                animClass: 'anim-forward',
                steps: 'Letakkan ibu jari di bawah dagu dan bengkok-bengkokkan jari telunjuk ke hadapan beberapa kali.',
                expression: '🧐 Kening berkerut tanda ingin tahu identiti seseorang.',
                sentence: ['Siapa?', 'Dia']
            },
            'mana_yang_mana': {
                id: 'mana_yang_mana',
                word: 'Mana? / Yang mana?',
                en: 'Which?',
                category: 'KataTanya',
                unit: 4,
                svgType: 'alternate_thumbs',
                animClass: 'anim-updown',
                steps: 'Angkat kedua-dua ibu jari (tangan kiri dan kanan) dan gerakkan naik turun secara berselang-seli seperti membuat pilihan.',
                expression: '🤔 Kening berkerut sambil membandingkan dua pilihan.',
                sentence: ['Mana? / Yang mana?', 'Biru']
            },
            'kenapa': {
                id: 'kenapa',
                word: 'Kenapa?',
                en: 'Why?',
                category: 'KataTanya',
                unit: 4,
                svgType: 'forehead_y',
                animClass: 'anim-forward',
                steps: 'Sentuh dahi dengan hujung jari, kemudian tarik ke hadapan sambil membentuk huruf "Y" (ibu jari dan kelingking terbuka).',
                expression: '🤨 Kening berkerut menyoal sebab atau punca.',
                sentence: ['Kenapa?', 'Maaf']
            },
            'bila': {
                id: 'bila',
                word: 'Bila?',
                en: 'When?',
                category: 'KataTanya',
                unit: 4,
                svgType: 'circle_finger',
                animClass: 'anim-chest',
                steps: 'Tegakkan jari telunjuk kiri, kemudian pusingkan jari telunjuk kanan mengelilinginya sebelum menyentuh hujungnya.',
                expression: '⏰ Kening terangkat/berkerut menyoal masa atau waktu.',
                sentence: ['Bila?', 'Awak / Anda']
            },
            'di_mana': {
                id: 'di_mana',
                word: 'Di mana?',
                en: 'Where?',
                category: 'KataTanya',
                unit: 4,
                svgType: 'wag_index',
                animClass: 'anim-wave',
                steps: 'Tegakkan jari telunjuk tangan kanan ke atas dan goyangkan ke kiri dan ke kanan dengan pantas.',
                expression: '📍 Ekspresi mencari lokasi dengan kening berkerut.',
                sentence: ['Di mana?', 'Mereka']
            },
            'berapa': {
                id: 'berapa',
                word: 'Berapa?',
                en: 'How many?',
                category: 'KataTanya',
                unit: 4,
                svgType: 'flick_fingers',
                animClass: 'anim-updown',
                steps: 'Kuncupkan jari tangan kanan menghadap ke atas, kemudian buka kelima-lima jari ke atas secara serentak.',
                expression: '🔢 Kening berkerut menyoal jumlah atau kuantiti.',
                sentence: ['Berapa?', 'Sembilan (9)']
            },
            'bagaimana': {
                id: 'bagaimana',
                word: 'Bagaimana?',
                en: 'How?',
                category: 'KataTanya',
                unit: 4,
                svgType: 'roll_hands',
                animClass: 'anim-forward',
                steps: 'Rapati kedua-dua belakang jari melengkung di hadapan dada, kemudian pusingkan kedua-dua tapak tangan menghadap ke atas.',
                expression: '🤷‍♂️ Kening berkerut dan bahu terangkat sedikit menyoal cara.',
                sentence: ['Bagaimana?', 'Saya']
            },

            // ==========================================
            // UNIT 5: WARNA (COLOURS)
            // ==========================================
            'merah': {
                id: 'merah',
                word: 'Merah',
                en: 'Red',
                category: 'Warna',
                unit: 5,
                colorHex: '#EF4444',
                svgType: 'lip_finger',
                animClass: 'anim-updown',
                steps: 'Sentuh bibir bawah dengan hujung jari telunjuk kanan, kemudian tarik ke bawah sambil membengkokkan jari sedikit.',
                expression: '🔴 Ekspresi neutral sambil menunjuk warna merah bibir.',
                sentence: ['Saya', 'Merah']
            },
            'hitam': {
                id: 'hitam',
                word: 'Hitam',
                en: 'Black',
                category: 'Warna',
                unit: 5,
                colorHex: '#1F2937',
                svgType: 'brow_swipe',
                animClass: 'anim-forward',
                steps: 'Leretkan jari telunjuk kanan secara mendatar merentasi bahagian dahi (di atas kening) dari kiri ke kanan.',
                expression: '⚫ Ekspresi jelas dan tenang.',
                sentence: ['Hitam', 'Putih']
            },
            'oren': {
                id: 'oren',
                word: 'Oren',
                en: 'Orange',
                category: 'Warna',
                unit: 5,
                colorHex: '#F97316',
                svgType: 'squeeze_chin',
                animClass: 'anim-chest',
                steps: 'Bentuk huruf "C" atau genggaman lembut di hadapan dagu dan picit-picitkan seperti memerah buah oren.',
                expression: '🟠 Ekspresi segar.',
                sentence: ['Oren', 'Kuning']
            },
            'ungu': {
                id: 'ungu',
                word: 'Ungu',
                en: 'Purple',
                category: 'Warna',
                unit: 5,
                colorHex: '#A855F7',
                svgType: 'shake_p',
                animClass: 'anim-wave',
                steps: 'Bentuk isyarat huruf "P" (jari telunjuk ke hadapan, jari tengah ke bawah) dan goyangkan sedikit di sisi.',
                expression: '🟣 Ekspresi neutral.',
                sentence: ['Ungu', 'Biru']
            },
            'hijau': {
                id: 'hijau',
                word: 'Hijau',
                en: 'Green',
                category: 'Warna',
                unit: 5,
                colorHex: '#22C55E',
                svgType: 'shake_g',
                animClass: 'anim-wave',
                steps: 'Bentuk isyarat huruf "G" (jari telunjuk dan ibu jari selari mendatar) dan goyangkan sedikit ke kiri dan kanan.',
                expression: '🟢 Ekspresi segar dan semula jadi.',
                sentence: ['Hijau', 'Kuning']
            },
            'biru': {
                id: 'biru',
                word: 'Biru',
                en: 'Blue',
                category: 'Warna',
                unit: 5,
                colorHex: '#3B82F6',
                svgType: 'shake_b',
                animClass: 'anim-wave',
                steps: 'Bentuk isyarat huruf "B" (tapak tangan rata ke hadapan, ibu jari dilipat ke tapak) dan goyangkan sedikit.',
                expression: '🔵 Ekspresi tenang.',
                sentence: ['Biru', 'Putih']
            },
            'kuning': {
                id: 'kuning',
                word: 'Kuning',
                en: 'Yellow',
                category: 'Warna',
                unit: 5,
                colorHex: '#EAB308',
                svgType: 'shake_y',
                animClass: 'anim-wave',
                steps: 'Bentuk isyarat huruf "Y" (ibu jari dan jari kelingking terbuka) dan goyangkan pergelangan tangan.',
                expression: '🟡 Ekspresi ceria.',
                sentence: ['Kuning', 'Merah']
            },
            'putih': {
                id: 'putih',
                word: 'Putih',
                en: 'White',
                category: 'Warna',
                unit: 5,
                colorHex: '#F8FAFC',
                svgType: 'pull_chest',
                animClass: 'anim-forward',
                steps: 'Letakkan kelima-lima hujung jari terbuka pada dada, kemudian tarik ke hadapan sambil menguncupkan hujung jari.',
                expression: '⚪ Ekspresi bersih dan tenang.',
                sentence: ['Putih', 'Hitam']
            },

            // ==========================================
            // UNIT 1 (TAHAP 1): ABJAD (A-Z) & NOMBOR (1-10)
            // ==========================================
            'abjad_a_z': {
                id: 'abjad_a_z',
                word: 'Abjad BIM (A – Z)',
                en: 'BIM Alphabets A to Z',
                category: 'NomborAbjad',
                unit: 1,
                svgType: 'alpha_az',
                animClass: 'anim-chest',
                steps: 'Ejaan jari satu tangan mengikut standard rasmi MFD merangkumi kesemua 26 huruf Rumi (A hingga Z). Ketik mana-mana huruf A–Z di bawah untuk melihat ilustrasi jari dan panduan langkah demi langkah.',
                expression: '🔤 Kekalkan posisi tangan di hadapan bahu kanan dengan latar jelas supaya mudah dibaca.',
                sentence: ['Saya', 'Abjad BIM (A – Z)']
            },
            'nombor_1_10': {
                id: 'nombor_1_10',
                word: 'Nombor 1 – 10',
                en: 'Numbers 1 to 10',
                category: 'NomborAbjad',
                unit: 1,
                svgType: 'num_1_10',
                animClass: 'anim-updown',
                steps: '1–5: Tapak tangan menghadap ke hadapan (1: telunjuk, 2: telunjuk & tengah, 3: ibu jari, telunjuk & tengah, 4: empat jari tegak, 5: lima jari terbuka). 6–10: Ibu jari menyentuh kelingking (6), jari manis (7), jari tengah (8), jari telunjuk (9), dan ibu jari tegak digoyangkan (10).',
                expression: '🔟 Ketik mana-mana nombor 1–10 di bawah untuk melihat ilustrasi jari dan panduan terperinci.',
                sentence: ['Berapa?', 'Nombor 1 – 10']
            }
        };

        // Panduan Terperinci Nombor 1-10 Mengikut Rujukan BIM
        const NUMBER_GUIDE = {
            '1': 'Tapak tangan menghadap ke hadapan; tegakkan jari telunjuk lurus ke atas, jari-jari lain digenggam.',
            '2': 'Tapak tangan menghadap ke hadapan; tegakkan jari telunjuk dan jari tengah membentuk huruf "V".',
            '3': 'Tapak tangan menghadap ke hadapan; buka ibu jari, jari telunjuk, dan jari tengah tegak, jari manis & kelingking dilipat.',
            '4': 'Tapak tangan menghadap ke hadapan; tegakkan empat jari (telunjuk hingga kelingking), ibu jari dilipat ke tapak tangan.',
            '5': 'Tapak tangan menghadap ke hadapan; buka kelima-lima jari luas ke atas.',
            '6': 'Tapak tangan menghadap ke hadapan; sentuhkan hujung ibu jari dengan hujung jari kelingking, tiga jari lain tegak.',
            '7': 'Tapak tangan menghadap ke hadapan; sentuhkan hujung ibu jari dengan hujung jari manis, tiga jari lain tegak.',
            '8': 'Tapak tangan menghadap ke hadapan; sentuhkan hujung ibu jari dengan hujung jari tengah, tiga jari lain tegak.',
            '9': 'Tapak tangan menghadap ke hadapan; sentuhkan hujung ibu jari dengan hujung jari telunjuk, tiga jari lain tegak.',
            '10': 'Genggam penumbuk dengan ibu jari tegak ke atas, kemudian goyangkan pergelangan tangan sedikit ke kiri dan kanan.'
        };

        // Panduan Terperinci Ejaan Jari A-Z Mengikut Rujukan Rasmi MFD
        const FINGERSPELL_GUIDE = {
            'A': 'Tapak tangan menghadap ke hadapan; empat jari digenggam rapat ke tapak tangan, manakala ibu jari tegak rapat di sisi jari telunjuk.',
            'B': 'Tapak tangan menghadap ke hadapan; keempat-empat jari diluruskan rapat ke atas dan ibu jari dilipat melintang ke dalam tapak tangan.',
            'C': 'Tangan dipusingkan sedikit ke sisi dengan semua jari dan ibu jari dilengkungkan membentuk huruf "C".',
            'D': 'Jari telunjuk tegak ke atas; hujung jari tengah, manis, dan kelinking menyentuh hujung ibu jari membentuk bulatan.',
            'E': 'Keempat-empat jari dibengkokkan ke bawah menyentuh ibu jari yang dilipat melintang ke tapak tangan.',
            'F': 'Hujung jari telunjuk dan ibu jari bertemu membentuk bulatan; tiga jari lain (tengah, manis, kelinking) tegak rapat ke atas.',
            'G': 'Jari telunjuk dan ibu jari menunjuk mendatar selari ke sisi, manakala tiga jari lain digenggam.',
            'H': 'Jari telunjuk dan jari tengah dirapatkan menunjuk mendatar ke sisi dengan belakang tangan menghadap ke hadapan.',
            'I': 'Jari kelinking tegak ke atas, manakala jari lain digenggam dan ditahan oleh ibu jari di hadapan.',
            'J': 'Bermula dari bentuk huruf "I", gerakkan jari kelinking melengkung ke bawah dan ke sisi melukis huruf "J".',
            'K': 'Jari telunjuk tegak ke atas dan jari tengah condong ke hadapan membentuk "V", ibu jari menyentuh pangkal jari tengah.',
            'L': 'Jari telunjuk tegak ke atas dan ibu jari lurus mendatar ke sisi membentuk sudut tepat huruf "L", jari lain digenggam.',
            'M': 'Tiga jari (telunjuk, tengah, manis) dilipat ke hadapan menutupi ibu jari yang diselitkan di bawah jari manis.',
            'N': 'Dua jari (telunjuk dan tengah) dilipat ke hadapan menutupi ibu jari yang diselitkan di bawah jari tengah.',
            'O': 'Semua hujung jari melengkung bertemu hujung ibu jari membentuk bulatan penuh huruf "O".',
            'P': 'Bentuk tangan seperti huruf "K", tetapi pergelangan tangan dihalakan menunjuk ke bawah (jari tengah ke bawah, telunjuk ke hadapan).',
            'Q': 'Bentuk tangan seperti huruf "G", tetapi dihalakan menunjuk ke bawah dengan ibu jari dan jari telunjuk selari ke bawah.',
            'R': 'Jari tengah disilangkan di belakang jari telunjuk ke atas, manakala jari lain digenggam.',
            'S': 'Penumbuk digenggam rapat dengan ibu jari melintang di hadapan jari-jari yang digenggam.',
            'T': 'Penumbuk digenggam dengan ibu jari diselitkan keluar di antara jari telunjuk dan jari tengah.',
            'U': 'Jari telunjuk dan jari tengah dirapatkan tegak ke atas, manakala jari lain digenggam.',
            'V': 'Jari telunjuk dan jari tengah dibuka tegak membentuk huruf "V", manakala jari lain digenggam.',
            'W': 'Tiga jari (telunjuk, tengah, manis) dibuka tegak membentuk huruf "W", dengan ibu jari menahan jari kelinking.',
            'X': 'Jari telunjuk dibengkokkan seperti cangkuk, manakala tiga jari lain digenggam dan ibu jari menahan di sisi.',
            'Y': 'Ibu jari dan jari kelinking dibuka luas ke sisi, manakala tiga jari tengah dilipat ke tapak tangan.',
            'Z': 'Jari telunjuk diluruskan untuk melukis pergerakan zig-zag berbentuk huruf "Z" di udara.'
        };

        // ==========================================
        // 2. STRUKTUR 5 UNIT PEMBELAJARAN (ABJAD NAIK KE TAHAP 1)
        // ==========================================
        const UNITS = [
            {
                id: 1,
                title: 'Unit 1: Abjad BIM & Nombor Asas',
                desc: 'Asas ejaan jari A–Z dan Nombor 1–10 mengikut standard MFD',
                color: 'bg-duoGreen',
                borderColor: 'border-duoGreenDark',
                shadowColor: '#46A302',
                lessons: ['abjad_a_z', 'nombor_1_10']
            },
            {
                id: 2,
                title: 'Unit 2: Ucapan & Sapaan Asas',
                desc: '13 ungkapan sapaan harian dalam Bahasa Isyarat Malaysia',
                color: 'bg-duoBlue',
                borderColor: 'border-duoBlueDark',
                shadowColor: '#1899D6',
                lessons: ['hai_hello', 'apa_khabar', 'khabar_baik', 'terima_kasih', 'sama_sama', 'maaf', 'tahniah', 'tolong_lah', 'selamat', 'selamat_pagi', 'selamat_tengah_hari', 'selamat_petang', 'selamat_malam']
            },
            {
                id: 3,
                title: 'Unit 3: Kata Ganti Nama',
                desc: 'Rujukan diri, panggilan hormat Tuan/Puan, dan orang lain',
                color: 'bg-duoPurple',
                borderColor: 'border-duoPurpleDark',
                shadowColor: '#A560E8',
                lessons: ['saya', 'awak_anda', 'dia', 'kami', 'mereka', 'tuan', 'puan', 'kamu']
            },
            {
                id: 4,
                title: 'Unit 4: Kata Tanya',
                desc: '8 kata soal utama untuk bertanyakan maklumat',
                color: 'bg-duoYellow',
                borderColor: 'border-duoYellowDark',
                shadowColor: '#E5B400',
                lessons: ['apa', 'siapa', 'mana_yang_mana', 'kenapa', 'bila', 'di_mana', 'berapa', 'bagaimana']
            },
            {
                id: 5,
                title: 'Unit 5: Warna',
                desc: '8 warna asas daripada buku teks BIM UiTM Press',
                color: 'bg-duoRed',
                borderColor: 'border-duoRedDark',
                shadowColor: '#EA2B2B',
                lessons: ['merah', 'hitam', 'oren', 'ungu', 'hijau', 'biru', 'kuning', 'putih']
            }
        ];

        // ==========================================
        // 3. PENJANA ILUSTRASI ISYARAT TANGAN SVG
        // ==========================================
        function getSignSVG(svgType, animClass = '', colorAccent = null) {
            const skinFill = "#FFDBAC";
            const skinStroke = "#D49B6A";
            const arrowColor = "#1CB0F6";
            const bgTint = colorAccent ? colorAccent : "#F8FAFC";
            const bgOpacity = colorAccent ? "0.18" : "1";

            let handGraphic = '';

            switch (svgType) {
                case 'salute_wave': // Hai / Hello
                case 'wave_open': // Apa khabar / Apa
                    handGraphic = `
                        <g class="${animClass}">
                            <rect x="38" y="45" width="26" height="28" rx="10" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2.5"/>
                            <rect x="30" y="50" width="8" height="16" rx="4" transform="rotate(-25 30 50)" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="39" y="25" width="6" height="24" rx="3" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="47" y="22" width="6" height="26" rx="3" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="55" y="25" width="6" height="24" rx="3" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="62" y="32" width="5" height="20" rx="2.5" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                        </g>
                        <path d="M22 25 Q30 15 40 20" fill="none" stroke="${arrowColor}" stroke-width="3" stroke-linecap="round" stroke-dasharray="4 3"/>
                        <path d="M78 25 Q70 15 60 20" fill="none" stroke="${arrowColor}" stroke-width="3" stroke-linecap="round" stroke-dasharray="4 3"/>
                    `;
                    break;

                case 'thumbs_up_chest': // Khabar baik
                    handGraphic = `
                        <g class="${animClass}">
                            <rect x="38" y="42" width="26" height="26" rx="10" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2.5"/>
                            <rect x="44" y="20" width="8" height="24" rx="4" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2.5"/>
                            <rect x="40" y="44" width="22" height="6" rx="3" fill="${skinFill}" stroke="${skinStroke}" stroke-width="1.8"/>
                            <rect x="40" y="51" width="22" height="6" rx="3" fill="${skinFill}" stroke="${skinStroke}" stroke-width="1.8"/>
                            <rect x="40" y="58" width="22" height="6" rx="3" fill="${skinFill}" stroke="${skinStroke}" stroke-width="1.8"/>
                        </g>
                        <path d="M70 48 L84 48 M84 48 L78 43 M84 48 L78 53" fill="none" stroke="${arrowColor}" stroke-width="3" stroke-linecap="round"/>
                    `;
                    break;

                case 'chin_forward': // Terima kasih
                case 'open_sweep': // Sama-sama
                    handGraphic = `
                        <path d="M25 25 Q40 42 58 25" fill="none" stroke="#CBD5E1" stroke-width="4" stroke-linecap="round"/>
                        <g class="${animClass}">
                            <rect x="38" y="42" width="24" height="26" rx="8" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2.5"/>
                            <rect x="40" y="26" width="20" height="20" rx="6" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <line x1="45" y1="26" x2="45" y2="42" stroke="${skinStroke}" stroke-width="1.5"/>
                            <line x1="50" y1="26" x2="50" y2="42" stroke="${skinStroke}" stroke-width="1.5"/>
                            <line x1="55" y1="26" x2="55" y2="42" stroke="${skinStroke}" stroke-width="1.5"/>
                        </g>
                        <path d="M66 42 L82 54 M82 54 L74 55 M82 54 L80 46" fill="none" stroke="${arrowColor}" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    `;
                    break;

                case 'fist_chest': // Maaf
                case 'rub_chest_flat': // Tolong (lah)
                    handGraphic = `
                        <circle cx="50" cy="48" r="24" fill="none" stroke="${arrowColor}" stroke-width="2.5" stroke-dasharray="5 4"/>
                        <g class="${animClass}">
                            <rect x="36" y="36" width="28" height="26" rx="10" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2.5"/>
                            <rect x="38" y="38" width="6" height="12" rx="3" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="44" y="37" width="6" height="13" rx="3" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="50" y="37" width="6" height="13" rx="3" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="56" y="38" width="6" height="12" rx="3" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                        </g>
                    `;
                    break;

                case 'clasp_shake': // Tahniah
                case 'safe_cross': // Selamat
                    handGraphic = `
                        <g class="${animClass}">
                            <rect x="30" y="38" width="26" height="22" rx="9" transform="rotate(-15 43 49)" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2.5"/>
                            <rect x="44" y="38" width="26" height="22" rx="9" transform="rotate(15 57 49)" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2.5"/>
                        </g>
                        <path d="M24 30 L32 36 M76 30 L68 36" fill="none" stroke="${arrowColor}" stroke-width="3" stroke-linecap="round"/>
                    `;
                    break;

                case 'sun_rise': // Selamat pagi
                case 'sun_noon': // Selamat tengah hari
                case 'sun_set': // Selamat petang
                case 'night_cover': // Selamat malam
                    const sunY = svgType === 'sun_rise' ? 34 : (svgType === 'sun_noon' ? 22 : 46);
                    handGraphic = `
                        <rect x="20" y="64" width="60" height="10" rx="5" fill="#CBD5E1"/>
                        <g class="${animClass}">
                            <circle cx="50" cy="${sunY}" r="13" fill="#FFC800" opacity="0.45"/>
                            <rect x="38" y="${sunY}" width="24" height="22" rx="8" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2.5"/>
                        </g>
                        <path d="M74 52 L74 26" fill="none" stroke="${arrowColor}" stroke-width="3" stroke-linecap="round" stroke-dasharray="4 3"/>
                    `;
                    break;

                case 'point_self': // Saya
                case 'point_forward': // Awak / Anda
                case 'point_side': // Dia
                case 'arc_we': // Kami
                case 'sweep_they': // Mereka
                case 'wag_index': // Di mana?
                    handGraphic = `
                        <g class="${animClass}">
                            <rect x="38" y="46" width="24" height="26" rx="9" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2.5"/>
                            <rect x="40" y="20" width="7" height="28" rx="3.5" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="48" y="40" width="6" height="12" rx="3" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="54" y="41" width="6" height="11" rx="3" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="32" y="44" width="8" height="14" rx="4" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                        </g>
                        <path d="M26 24 Q50 12 74 24" fill="none" stroke="${arrowColor}" stroke-width="3" stroke-linecap="round" stroke-dasharray="4 3"/>
                    `;
                    break;

                case 'thumb_chin': // Puan
                case 'thumb_forehead': // Tuan
                    const isSir = svgType === 'thumb_forehead';
                    handGraphic = `
                        <path d="M25 ${isSir ? '24' : '68'} Q50 ${isSir ? '16' : '76'} 75 ${isSir ? '24' : '68'}" fill="none" stroke="#CBD5E1" stroke-width="4" stroke-linecap="round"/>
                        <g class="${animClass}">
                            <rect x="42" y="38" width="24" height="24" rx="8" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2.5"/>
                            <rect x="32" y="${isSir ? '26' : '48'}" width="14" height="7" rx="3.5" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="44" y="20" width="5" height="20" rx="2.5" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="50" y="18" width="5" height="22" rx="2.5" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="56" y="20" width="5" height="20" rx="2.5" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="62" y="24" width="4.5" height="18" rx="2.2" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                        </g>
                    `;
                    break;

                case 'num_1_10':
                    return renderNumberHandSVG('1-10');

                case 'alpha_az':
                    return renderAlphabetHandSVG('A');

                default: // Kata Tanya & Warna (isyarat tangan dengan bulatan tumpuan)
                    handGraphic = `
                        <g class="${animClass}">
                            <rect x="38" y="44" width="24" height="26" rx="9" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2.5"/>
                            <rect x="40" y="20" width="6.5" height="26" rx="3.2" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="48" y="24" width="6.5" height="22" rx="3.2" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                            <rect x="31" y="44" width="12" height="7" rx="3.5" fill="${skinFill}" stroke="${skinStroke}" stroke-width="2"/>
                        </g>
                        ${colorAccent ? `<circle cx="76" cy="24" r="10" fill="${colorAccent}" stroke="#CBD5E1" stroke-width="2"/>` : `<circle cx="44" cy="15" r="5" fill="${arrowColor}" opacity="0.5"/>`}
                    `;
                    break;
            }

            return `
                <svg viewBox="0 0 100 90" class="w-full h-full">
                    <rect x="5" y="5" width="90" height="80" rx="20" fill="${bgTint}" fill-opacity="${bgOpacity}"/>
                    ${handGraphic}
                </svg>
            `;
        }

        // ==========================================
        // 3B. PENJANA ILUSTRASI VEKTOR ABJAD MFD (A-Z)
        // Latar putih bersih & gaya ilustrasi seiras gambar rujukan A.webp
        // ==========================================
        function renderAlphabetHandSVG(letter) {
            const ch = (letter || 'A').toUpperCase();

            // Gunakan imej BIM sebenar yang dimuat naik untuk huruf A.
            if (ch === 'A') {
                return `
                    <img src="assets/abjad/A.webp"
                         alt="Isyarat tangan Bahasa Isyarat Malaysia untuk huruf A"
                         class="w-full h-full object-contain bg-white"
                         loading="lazy">
                `;
            }

            // Gunakan ilustrasi yang telah diseragamkan dengan gaya huruf A.
            if (ch === 'B') {
                return `
                    <img src="assets/abjad/B.png"
                         alt="Isyarat tangan Bahasa Isyarat Malaysia untuk huruf B"
                         class="w-full h-full object-contain bg-white"
                         loading="lazy">
                `;
            }

            if (ch === 'C') {
                return `
                    <img src="assets/abjad/C.png"
                         alt="Isyarat tangan Bahasa Isyarat Malaysia untuk huruf C"
                         class="w-full h-full object-contain bg-white"
                         loading="lazy">
                `;
            }

            if (['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'].includes(ch)) {
                return `
                    <img src="assets/abjad/${ch}.png"
                         alt="Isyarat tangan Bahasa Isyarat Malaysia untuk huruf ${ch}"
                         class="w-full h-full object-contain bg-white"
                         loading="lazy">
                `;
            }

            const skin = "#FAD5BC";
            const skinDark = "#E8B08E";
            const nailFill = "#E6A994";
            const line = "#1E1410";
            const uid = `mfd-clean-${ch}-${Math.floor(Math.random() * 10000)}`;

            // Komponen asas pergelangan & tapak tangan menghadap hadapan (seiras gaya A.webp)
            const wristBase = `
                <path d="M29 100 L31 76 Q50 80 68 76 L70 100 Z" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                <path d="M58 100 L59 77 Q64 76 68 75 L70 100 Z" fill="${skinDark}" opacity="0.7"/>
                <rect x="28" y="45" width="44" height="34" rx="15" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                <path d="M36 69 C46 66 56 61 65 56" fill="none" stroke="#3B241A" stroke-width="1.2" stroke-linecap="round"/>
                <path d="M34 78 C43 80 54 79 62 76" fill="none" stroke="#3B241A" stroke-width="1.1" stroke-linecap="round"/>
            `;

            // 4 jari digenggam rapat dengan kuku & lipatan buku jari
            const curledFourFingers = `
                <rect x="28" y="41" width="11" height="17" rx="5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                <path d="M30 55 Q33.5 58 37 55 Z" fill="${nailFill}" stroke="${line}" stroke-width="1"/>
                <rect x="39" y="39" width="11" height="19" rx="5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                <path d="M41 55 Q44.5 58 48 55 Z" fill="${nailFill}" stroke="${line}" stroke-width="1"/>
                <rect x="50" y="39" width="11" height="19" rx="5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                <path d="M52 55 Q55.5 58 59 55 Z" fill="${nailFill}" stroke="${line}" stroke-width="1"/>
                <rect x="61" y="41" width="11" height="17" rx="5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                <path d="M63 55 Q66.5 58 70 55 Z" fill="${nailFill}" stroke="${line}" stroke-width="1"/>
            `;

            let handShape = '';

            switch (ch) {
                case 'A': // Ilustrasi tepat seiras gambar rujukan A.webp
                    return `
                        <svg viewBox="0 0 100 100" class="w-full h-full">
                            <rect x="0" y="0" width="100" height="100" rx="20" fill="#FFFFFF"/>
                            <!-- Pergelangan tangan & tapak tangan -->
                            <path d="M27 100 L28 79 C24 68 23 57 25 48 C27 42 33 41 36 45 C39 40 45 39 48 43 C52 38 58 37 62 41 C65 37 70 37 73 41 L76 34 C81 27 88 26 89 31 C90 36 85 45 83 54 C82 63 80 71 72 78 C66 83 62 86 62 100 Z" 
                                  fill="#FAD5BC" stroke="#1E1410" stroke-width="1.9" stroke-linejoin="round"/>
                            
                            <!-- Bayang lembut sisi pergelangan & bawah tapak -->
                            <path d="M56 100 C56 87 60 82 69 75 C76 69 79 61 81 51 C82 43 87 34 88 30 C86 30 82 35 79 44 C77 52 75 61 68 67 C61 72 52 77 51 100 Z" 
                                  fill="#E8B08E" opacity="0.75"/>
                            <path d="M29 100 L30 81 C35 83 45 84 53 82 L52 87 C44 88 35 87 30 85 Z" fill="#E8B08E" opacity="0.6"/>

                            <!-- Jari kelinking (paling kiri) -->
                            <path d="M25 48 C24 55 25 60 30 61 C34 61 36 58 36 53 L36 45" fill="#FAD5BC" stroke="#1E1410" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M28 59 C29 61 33 61 34 59" fill="#E6A994" stroke="#1E1410" stroke-width="1.1"/>
                            <path d="M28 49 Q31 48 33 49" fill="none" stroke="#8C5843" stroke-width="1.1" stroke-linecap="round"/>

                            <!-- Jari manis -->
                            <path d="M36 45 L36 56 C36 61 39 64 43 64 C47 64 49 60 49 55 L48 43" fill="#FAD5BC" stroke="#1E1410" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M39 61 C40 64 45 64 46 61 Z" fill="#E6A994" stroke="#1E1410" stroke-width="1.1"/>
                            <path d="M39 48 Q42.5 47 45 48" fill="none" stroke="#8C5843" stroke-width="1.1" stroke-linecap="round"/>

                            <!-- Jari tengah -->
                            <path d="M48 43 L49 56 C49 61 52 63 56 63 C60 63 62 59 62 54 L62 41" fill="#FAD5BC" stroke="#1E1410" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M52 60 C53 63 58 63 59 60 Z" fill="#E6A994" stroke="#1E1410" stroke-width="1.1"/>
                            <path d="M52 46 Q55.5 45 58 46" fill="none" stroke="#8C5843" stroke-width="1.1" stroke-linecap="round"/>

                            <!-- Jari telunjuk -->
                            <path d="M62 41 L62 53 C62 58 65 61 69 60 C73 59 75 55 74 49 L73 41" fill="#FAD5BC" stroke="#1E1410" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M65 57 C66 60 71 59 72 56 Z" fill="#E6A994" stroke="#1E1410" stroke-width="1.1"/>
                            <path d="M65 45 Q68 44 70 45" fill="none" stroke="#8C5843" stroke-width="1.1" stroke-linecap="round"/>

                            <!-- Ibu jari tegak di sisi kanan & kuku sisi -->
                            <path d="M73 41 C72 48 73 54 76 58" fill="none" stroke="#1E1410" stroke-width="1.7" stroke-linecap="round"/>
                            <path d="M88 30 C85 32 83 36 83 39 C85 40 87 38 88 34 Z" fill="#E6A994" stroke="#1E1410" stroke-width="1.1"/>
                            <path d="M77 45 Q80 46 82 45 M77 47 Q80 48 82 47" fill="none" stroke="#8C5843" stroke-width="1" stroke-linecap="round"/>

                            <!-- Garisan lipatan tapak tangan & pergelangan -->
                            <path d="M24 58 L29 60 M36 72 C45 69 55 64 64 59 M40 76 C48 72 56 67 62 63" fill="none" stroke="#3B241A" stroke-width="1.2" stroke-linecap="round"/>
                            <path d="M32 79 C41 81 51 80 58 77 M38 84 C44 85 50 84 54 83 M38 91 L49 91" fill="none" stroke="#3B241A" stroke-width="1.1" stroke-linecap="round"/>
                        </svg>
                    `;

                case 'B': // Empat jari rapat lurus ke atas, ibu jari dilipat melintang ke tapak
                    handShape = `
                        ${wristBase}
                        <rect x="34" y="17" width="8" height="33" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="42" y="13" width="8.5" height="37" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="50.5" y="15" width="8.5" height="35" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="59" y="20" width="8" height="30" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M66 56 Q52 48 41 53 Q39 58 45 60 L65 64 Z" fill="${skin}" stroke="${line}" stroke-width="2.2" stroke-linejoin="round"/>
                    `;
                    break;

                case 'C': // Tangan sisi melengkung membentuk huruf C
                    handShape = `
                        <path d="M32 96 L36 72 Q26 52 38 30 Q54 18 72 28 Q75 33 69 36 Q54 29 44 40 Q38 52 46 64 Q58 68 72 62 Q77 65 73 71 Q56 79 44 74 L43 96 Z" fill="${skin}" stroke="${line}" stroke-width="2.3" stroke-linejoin="round"/>
                        <path d="M46 25 Q60 21 71 27" fill="none" stroke="${line}" stroke-width="1.6" stroke-linecap="round"/>
                    `;
                    break;

                case 'D': // Telunjuk tegak, jari tengah/manis/kelinking sentuh ibu jari membentuk bulatan
                    handShape = `
                        ${wristBase}
                        <rect x="56" y="13" width="9" height="37" rx="4.5" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <ellipse cx="44" cy="46" rx="11" ry="9" fill="none" stroke="${line}" stroke-width="2.2"/>
                        <rect x="34" y="38" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="41" y="36" width="8.5" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M64 58 Q51 48 42 52 Q40 57 46 59 L63 64 Z" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                    `;
                    break;

                case 'E': // Empat jari dibengkokkan ke bawah menyentuh ibu jari melintang
                    handShape = `
                        ${wristBase}
                        <rect x="34" y="33" width="8" height="17" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="42" y="31" width="8.5" height="18" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="50.5" y="31" width="8.5" height="18" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="59" y="33" width="8" height="17" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M66 60 Q54 51 44 54 Q42 59 48 61 L65 66 Z" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                    `;
                    break;

                case 'F': // Hujung telunjuk & ibu jari bulatan, 3 jari lain tegak
                    handShape = `
                        ${wristBase}
                        <rect x="34" y="18" width="8" height="32" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="42" y="14" width="8.5" height="36" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="50.5" y="16" width="8.5" height="34" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M60 36 Q71 38 69 49 Q62 54 57 47" fill="none" stroke="${line}" stroke-width="2.2"/>
                        <path d="M66 56 Q61 44 56 47 Q54 51 60 56 Z" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                    `;
                    break;

                case 'G': // Telunjuk & ibu jari menunjuk mendatar selari ke sisi
                    handShape = `
                        <path d="M26 96 L28 66 Q24 44 40 36 L78 36 Q83 40 78 44 L54 45 L54 52 L76 54 Q81 58 76 62 L48 64 L44 96 Z" fill="${skin}" stroke="${line}" stroke-width="2.2" stroke-linejoin="round"/>
                        <rect x="34" y="45" width="18" height="7" rx="3.5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                        <rect x="34" y="52" width="16" height="7" rx="3.5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                    `;
                    break;

                case 'H': // Telunjuk & tengah dirapatkan menunjuk mendatar ke sisi
                    handShape = `
                        <path d="M24 96 L26 64 Q24 40 42 35 L84 36 Q88 39 84 43 L52 43 L86 44 Q90 48 85 51 L50 51 L46 68 L42 96 Z" fill="${skin}" stroke="${line}" stroke-width="2.2" stroke-linejoin="round"/>
                        <rect x="34" y="51" width="17" height="7" rx="3.5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                        <rect x="34" y="58" width="15" height="7" rx="3.5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                    `;
                    break;

                case 'I': // Jari kelinking tegak ke atas
                    handShape = `
                        ${wristBase}
                        <rect x="33" y="17" width="8" height="34" rx="4" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="41.5" y="38" width="8.5" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="50" y="37" width="8.5" height="16" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="58.5" y="39" width="8.5" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M65 56 Q52 47 42 51 Q40 56 46 58 L64 63 Z" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                    `;
                    break;

                case 'J': // Bentuk I dengan jejak anak panah melengkung J
                    handShape = `
                        <g class="anim-wave">
                            ${wristBase}
                            <rect x="33" y="17" width="8" height="34" rx="4" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                            <rect x="41.5" y="38" width="8.5" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                            <rect x="50" y="37" width="8.5" height="16" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                            <rect x="58.5" y="39" width="8.5" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                            <path d="M65 56 Q52 47 42 51 Q40 56 46 58 L64 63 Z" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        </g>
                        <path d="M22 22 L22 64 Q22 80 42 80 L54 74" fill="none" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round"/>
                        <path d="M22 22 L22 64 Q22 80 42 80 L54 74" fill="none" stroke="#0F172A" stroke-width="3" stroke-dasharray="1 6" stroke-linecap="round"/>
                        <polygon points="58,71 49,70 52,79" fill="#0F172A"/>
                    `;
                    break;

                case 'K': // Telunjuk tegak & jari tengah condong V, ibu jari di pangkal
                    handShape = `
                        ${wristBase}
                        <rect x="42" y="14" width="8.5" height="36" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="52" y="18" width="8.5" height="34" rx="4.2" transform="rotate(24 54 45)" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="33" y="42" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="40" y="42" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M62 56 L51 34 Q47 31 45 36 L54 58 Z" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                    `;
                    break;

                case 'L': // Telunjuk tegak & ibu jari mendatar membentuk L
                    handShape = `
                        ${wristBase}
                        <rect x="33" y="41" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="41" y="40" width="8" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="49" y="41" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="57" y="15" width="9" height="36" rx="4.5" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <path d="M64 54 L86 58 Q90 62 85 66 L62 65 Z" fill="${skin}" stroke="${line}" stroke-width="2.2" stroke-linejoin="round"/>
                    `;
                    break;

                case 'M': // 3 jari (telunjuk, tengah, manis) dilipat menutup ibu jari
                    handShape = `
                        ${wristBase}
                        <rect x="34" y="42" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M63 58 L38 40 Q34 38 35 43 L56 64 Z" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="42" y="36" width="8.5" height="22" rx="4" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="50.5" y="36" width="8.5" height="22" rx="4" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="59" y="38" width="8.5" height="21" rx="4" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                    `;
                    break;

                case 'N': // 2 jari (telunjuk, tengah) dilipat menutup ibu jari
                    handShape = `
                        ${wristBase}
                        <rect x="34" y="42" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="42" y="41" width="8" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M63 58 L44 38 Q40 36 41 42 L56 64 Z" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="50" y="35" width="8.5" height="23" rx="4" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="58.5" y="37" width="8.5" height="22" rx="4" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                    `;
                    break;

                case 'O': // Semua hujung jari bertemu ibu jari membentuk bulatan O
                    handShape = `
                        <path d="M34 100 L36 74 Q26 52 38 32 Q55 20 71 36 Q78 52 68 68 Q54 78 44 72 L44 100 Z" fill="${skin}" stroke="${line}" stroke-width="2" stroke-linejoin="round"/>
                        <ellipse cx="56" cy="50" rx="10" ry="12" fill="#FFFFFF" stroke="${line}" stroke-width="2"/>
                    `;
                    break;

                case 'P': // Bentuk K dihalakan menunjuk ke bawah
                    handShape = `
                        <path d="M12 34 L34 26 Q50 22 60 36 L76 66 Q75 72 69 70 L56 50 L44 74 Q38 76 37 69 L45 48 L20 50 Z" fill="${skin}" stroke="${line}" stroke-width="2.2" stroke-linejoin="round"/>
                        <rect x="32" y="40" width="12" height="7" rx="3.5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                    `;
                    break;

                case 'Q': // Bentuk G dihalakan menunjuk ke bawah
                    handShape = `
                        <path d="M12 32 L36 25 Q56 24 62 42 L62 74 Q58 79 54 74 L53 50 L44 50 L44 74 Q39 79 35 74 L35 48 L18 48 Z" fill="${skin}" stroke="${line}" stroke-width="2.2" stroke-linejoin="round"/>
                        <rect x="44" y="36" width="13" height="7" rx="3.5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                    `;
                    break;

                case 'R': // Jari tengah disilangkan di belakang jari telunjuk ke atas
                    handShape = `
                        ${wristBase}
                        <rect x="46" y="14" width="8.5" height="36" rx="4.2" transform="rotate(-12 50 40)" fill="${skinDark}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="52" y="14" width="8.5" height="36" rx="4.2" transform="rotate(8 55 40)" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="34" y="42" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="41" y="41" width="8" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M64 56 Q52 48 43 52 Q41 57 47 59 L63 63 Z" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                    `;
                    break;

                case 'S': // Penumbuk rapat dengan ibu jari melintang di hadapan jari
                    handShape = `
                        ${wristBase}
                        ${curledFourFingers}
                        <path d="M66 56 Q50 44 38 49 Q36 55 43 57 L64 63 Z" fill="${skin}" stroke="${line}" stroke-width="2.3" stroke-linejoin="round"/>
                    `;
                    break;

                case 'T': // Ibu jari diselitkan keluar di antara telunjuk & jari tengah
                    handShape = `
                        ${wristBase}
                        <rect x="33" y="41" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="41.5" y="40" width="8.5" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="50" y="39" width="8.5" height="16" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M64 58 L57 33 Q61 29 66 34 L67 56 Z" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="59" y="40" width="8.5" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                    `;
                    break;

                case 'U': // Telunjuk & jari tengah rapat tegak ke atas
                    handShape = `
                        ${wristBase}
                        <rect x="48" y="14" width="8.5" height="36" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="56.5" y="15" width="8.5" height="35" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="34" y="42" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="41" y="41" width="8" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M64 56 Q52 48 43 52 Q41 57 47 59 L63 63 Z" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                    `;
                    break;

                case 'V': // Telunjuk & jari tengah dibuka membentuk V
                    handShape = `
                        ${wristBase}
                        <rect x="44" y="15" width="8.5" height="36" rx="4.2" transform="rotate(-14 48 45)" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="56" y="15" width="8.5" height="36" rx="4.2" transform="rotate(14 58 45)" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="34" y="43" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="41" y="42" width="8" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M64 56 Q52 48 43 52 Q41 57 47 59 L63 63 Z" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                    `;
                    break;

                case 'W': // Tiga jari (telunjuk, tengah, manis) dibuka tegak membentuk W
                    handShape = `
                        ${wristBase}
                        <rect x="38" y="17" width="8" height="34" rx="4" transform="rotate(-16 42 45)" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="47" y="14" width="8.5" height="36" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="57" y="17" width="8" height="34" rx="4" transform="rotate(16 60 45)" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="33" y="43" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M64 56 Q50 48 39 51 Q37 56 43 58 L63 63 Z" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                    `;
                    break;

                case 'X': // Telunjuk dibengkokkan seperti cangkuk
                    handShape = `
                        ${wristBase}
                        <path d="M58 48 L58 26 Q58 20 65 20 L74 23 Q77 27 72 29 L65 28 L65 48 Z" fill="${skin}" stroke="${line}" stroke-width="2.2" stroke-linejoin="round"/>
                        <rect x="34" y="42" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="42" y="41" width="8" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="50" y="41" width="8" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M66 56 Q54 48 45 52 Q43 57 49 59 L65 63 Z" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                    `;
                    break;

                case 'Y': // Ibu jari & jari kelinking dibuka luas ke sisi
                    handShape = `
                        ${wristBase}
                        <rect x="31" y="20" width="8" height="32" rx="4" transform="rotate(-18 35 45)" fill="${skin}" stroke="${line}" stroke-width="2.2"/>
                        <rect x="40" y="41" width="8" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="48" y="40" width="8" height="16" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="56" y="41" width="8" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M64 52 L82 38 Q87 40 84 46 L65 62 Z" fill="${skin}" stroke="${line}" stroke-width="2.2" stroke-linejoin="round"/>
                    `;
                    break;

                case 'Z': // Telunjuk melukis zig-zag Z di udara
                default:
                    handShape = `
                        <g class="anim-forward">
                            ${wristBase}
                            ${curledFourFingers}
                            <path d="M58 46 L74 22 Q79 20 80 26 L65 52 Z" fill="${skin}" stroke="${line}" stroke-width="2" stroke-linejoin="round"/>
                        </g>
                        <path d="M26 22 L70 22 L30 62 L74 62" fill="none" stroke="#E2E8F0" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M26 22 L70 22 L30 62 L74 62" fill="none" stroke="#1E1410" stroke-width="3" stroke-dasharray="1 6" stroke-linecap="round" stroke-linejoin="round"/>
                        <polygon points="79,62 70,57 70,67" fill="#1E1410"/>
                    `;
                    break;
            }

            return `
                <svg viewBox="0 0 100 100" class="w-full h-full">
                    <rect x="0" y="0" width="100" height="100" rx="20" fill="#FFFFFF"/>
                    ${handShape}
                </svg>
            `;
        }

        // ==========================================
        // 3C. PENJANA ILUSTRASI VEKTOR NOMBOR BIM (1-10)
        // ==========================================
        function renderNumberHandSVG(numStr) {
            const n = String(numStr);
            const skin = "#FAD5BC";
            const skinDark = "#E8B08E";
            const line = "#1E1410";

            const wristBase = `
                <path d="M30 100 L32 76 Q50 80 68 76 L70 100 Z" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                <path d="M58 100 L59 77 Q64 76 68 75 L70 100 Z" fill="${skinDark}" opacity="0.7"/>
                <rect x="29" y="45" width="42" height="34" rx="15" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
            `;

            if (n === '1-10') {
                return `
                    <svg viewBox="0 0 100 100" class="w-full h-full">
                        <rect x="0" y="0" width="100" height="100" rx="20" fill="#FFFFFF"/>
                        ${wristBase}
                        <rect x="33" y="21" width="7.5" height="28" rx="3.7" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="41.5" y="16" width="8" height="33" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="50.5" y="16" width="8" height="33" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="59.5" y="20" width="7.5" height="29" rx="3.7" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <path d="M68 50 L85 40 Q89 43 85 49 L68 62 Z" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="28" y="61" width="44" height="18" rx="9" fill="#58CC02"/>
                        <text x="50" y="74" text-anchor="middle" font-size="13" font-weight="900" fill="#FFFFFF">1 – 10</text>
                    </svg>
                `;
            }

            let fingers = '';
            switch (n) {
                case '1':
                    fingers = `
                        <rect x="57" y="14" width="9" height="36" rx="4.5" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="33" y="41" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                        <rect x="41" y="40" width="8" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                        <rect x="49" y="41" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                        <path d="M65 56 Q52 48 43 52 Q41 57 47 59 L64 63 Z" fill="${skin}" stroke="${line}" stroke-width="2"/>
                    `;
                    break;
                case '2':
                    fingers = `
                        <rect x="45" y="15" width="8.5" height="36" rx="4.2" transform="rotate(-12 49 45)" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="56" y="15" width="8.5" height="36" rx="4.2" transform="rotate(12 58 45)" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="33" y="42" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                        <rect x="41" y="41" width="8" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                        <path d="M65 56 Q52 48 43 52 Q41 57 47 59 L64 63 Z" fill="${skin}" stroke="${line}" stroke-width="2"/>
                    `;
                    break;
                case '3':
                    fingers = `
                        <rect x="46" y="15" width="8.5" height="36" rx="4.2" transform="rotate(-10 50 45)" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="57" y="15" width="8.5" height="36" rx="4.2" transform="rotate(10 59 45)" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <path d="M66 51 L84 40 Q88 43 84 49 L67 62 Z" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        <rect x="33" y="42" width="8" height="14" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                        <rect x="41" y="41" width="8" height="15" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                    `;
                    break;
                case '4':
                    fingers = `
                        <rect x="33" y="20" width="8" height="30" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="42" y="14" width="8.5" height="36" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="51" y="14" width="8.5" height="36" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="60" y="19" width="8" height="31" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <path d="M67 56 Q53 48 42 53 Q40 58 46 60 L66 64 Z" fill="${skin}" stroke="${line}" stroke-width="2"/>
                    `;
                    break;
                case '5':
                    fingers = `
                        <rect x="31" y="21" width="7.5" height="29" rx="3.7" transform="rotate(-10 35 45)" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="41" y="15" width="8" height="35" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="50.5" y="14" width="8" height="36" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="60" y="19" width="7.5" height="31" rx="3.7" transform="rotate(8 63 45)" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <path d="M68 51 L86 41 Q90 44 86 50 L68 62 Z" fill="${skin}" stroke="${line}" stroke-width="2"/>
                    `;
                    break;
                case '6':
                    fingers = `
                        <rect x="42" y="15" width="8.5" height="35" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="51" y="14" width="8.5" height="36" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="60" y="18" width="8" height="32" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <path d="M32 37 Q44 50 56 52" fill="none" stroke="${line}" stroke-width="2.2" stroke-linecap="round"/>
                        <circle cx="45" cy="49" r="5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                    `;
                    break;
                case '7':
                    fingers = `
                        <rect x="33" y="21" width="8" height="29" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="51" y="14" width="8.5" height="36" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="60" y="18" width="8" height="32" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <circle cx="49" cy="48" r="5.5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                        <path d="M67 56 L52 48" stroke="${line}" stroke-width="2.2" stroke-linecap="round"/>
                    `;
                    break;
                case '8':
                    fingers = `
                        <rect x="33" y="21" width="8" height="29" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="42" y="15" width="8.5" height="35" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="60" y="18" width="8" height="32" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <circle cx="56" cy="48" r="5.5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                        <path d="M68 56 L58 48" stroke="${line}" stroke-width="2.2" stroke-linecap="round"/>
                    `;
                    break;
                case '9':
                    fingers = `
                        <rect x="33" y="21" width="8" height="29" rx="4" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="42" y="15" width="8.5" height="35" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <rect x="51" y="14" width="8.5" height="36" rx="4.2" fill="${skin}" stroke="${line}" stroke-width="1.9"/>
                        <circle cx="64" cy="46" r="5.5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                    `;
                    break;
                case '10':
                default:
                    fingers = `
                        <g class="anim-wave">
                            <rect x="31" y="42" width="9" height="15" rx="4.5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                            <rect x="40" y="41" width="9" height="16" rx="4.5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                            <rect x="49" y="41" width="9" height="16" rx="4.5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                            <rect x="58" y="42" width="9" height="15" rx="4.5" fill="${skin}" stroke="${line}" stroke-width="1.8"/>
                            <rect x="63" y="20" width="9.5" height="28" rx="4.7" fill="${skin}" stroke="${line}" stroke-width="2"/>
                        </g>
                        <path d="M52 24 Q68 14 82 24" fill="none" stroke="#1CB0F6" stroke-width="2.5" stroke-linecap="round" stroke-dasharray="3 3"/>
                    `;
                    break;
            }

            return `
                <svg viewBox="0 0 100 100" class="w-full h-full">
                    <rect x="0" y="0" width="100" height="100" rx="20" fill="#FFFFFF"/>
                    ${wristBase}
                    ${fingers}
                </svg>
            `;
        }

        // ==========================================
        // 4. ENJIN KESAN BUNYI SINTETIK (WEB AUDIO API)
        // ==========================================
        let audioCtx = null;

        function initAudio() {
            if (!audioCtx) {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                if (AudioContext) audioCtx = new AudioContext();
            }
        }

        function playSound(type) {
            if (!appState.soundEnabled) return;
            try {
                initAudio();
                if (audioCtx.state === 'suspended') audioCtx.resume();

                const now = audioCtx.currentTime;
                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                osc.connect(gain);
                gain.connect(audioCtx.destination);

                if (type === 'correct') {
                    // Bunyi 'ding' ceria dua nada naik
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(587.33, now); // D5
                    osc.frequency.setValueAtTime(880, now + 0.1); // A5
                    gain.gain.setValueAtTime(0.25, now);
                    gain.gain.exponentialRampToValueAtTime(0.01, now + 0.35);
                    osc.start(now);
                    osc.stop(now + 0.35);
                } else if (type === 'wrong') {
                    // Bunyi lembut rendah
                    osc.type = 'triangle';
                    osc.frequency.setValueAtTime(220, now);
                    osc.frequency.linearRampToValueAtTime(175, now + 0.25);
                    gain.gain.setValueAtTime(0.2, now);
                    gain.gain.exponentialRampToValueAtTime(0.01, now + 0.28);
                    osc.start(now);
                    osc.stop(now + 0.28);
                } else if (type === 'tap') {
                    // Bunyi klik ringan
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(420, now);
                    gain.gain.setValueAtTime(0.08, now);
                    gain.gain.exponentialRampToValueAtTime(0.001, now + 0.06);
                    osc.start(now);
                    osc.stop(now + 0.06);
                } else if (type === 'fanfare') {
                    // Melodi kemenangan tamat pelajaran
                    const notes = [523.25, 659.25, 783.99, 1046.50]; // C5, E5, G5, C6
                    notes.forEach((freq, idx) => {
                        const o = audioCtx.createOscillator();
                        const g = audioCtx.createGain();
                        o.type = 'triangle';
                        o.connect(g);
                        g.connect(audioCtx.destination);
                        o.frequency.setValueAtTime(freq, now + idx * 0.11);
                        g.gain.setValueAtTime(0.2, now + idx * 0.11);
                        g.gain.exponentialRampToValueAtTime(0.01, now + idx * 0.11 + 0.3);
                        o.start(now + idx * 0.11);
                        o.stop(now + idx * 0.11 + 0.3);
                    });
                }
            } catch (e) {
                console.warn('Audio tidak disokong:', e);
            }
        }

        // ==========================================
        // 5. PENGURUSAN STATE & LOCALSTORAGE
        // ==========================================
        const DEFAULT_STATE = {
            xp: 0,
            streak: 1,
            hearts: 5,
            completedLessons: [], // array id perkataan cth ['apa_khabar', 'terima_kasih']
            soundEnabled: true,
            lastActiveDate: new Date().toDateString()
        };

        let appState = loadState();

        function loadState() {
            try {
                const saved = localStorage.getItem('signlah_bim_state_v1');
                if (saved) {
                    const parsed = JSON.parse(saved);
                    return { ...DEFAULT_STATE, ...parsed };
                }
            } catch (e) {
                console.error('Gagal memuatkan data:', e);
            }
            return { ...DEFAULT_STATE };
        }

        function saveState() {
            try {
                localStorage.setItem('signlah_bim_state_v1', JSON.stringify(appState));
                updateStatsUI();
            } catch (e) {
                console.error('Gagal menyimpan data:', e);
            }
        }

        function toggleSound() {
            appState.soundEnabled = !appState.soundEnabled;
            saveState();
            if (appState.soundEnabled) playSound('tap');
        }

        function updateStatsUI() {
            document.getElementById('stat-streak').innerText = appState.streak;
            document.getElementById('stat-xp').innerText = appState.xp;
            document.getElementById('stat-hearts').innerText = appState.hearts;
            document.getElementById('sound-icon').innerText = appState.soundEnabled ? '🔊' : '🔇';

            // Kemaskini paparan profil jika dibuka
            const totalModules = Object.keys(BIM_SIGNS).length;
            document.getElementById('prof-streak').innerText = `${appState.streak} Hari`;
            document.getElementById('prof-xp').innerText = `${appState.xp} XP`;
            document.getElementById('prof-signs').innerText = `${appState.completedLessons.length} / ${totalModules}`;
            
            const completedUnits = UNITS.filter(u => u.lessons.every(l => appState.completedLessons.includes(l))).length;
            document.getElementById('prof-lessons').innerText = `${completedUnits} / ${UNITS.length} Unit`;

            // Tahap pengguna
            const count = appState.completedLessons.length;
            let levelTitle = 'Tahap 1: Sahabat Baru BIM';
            if (count >= 30) levelTitle = 'Tahap 4: Duta Bahasa Isyarat Malaysia';
            else if (count >= 18) levelTitle = 'Tahap 3: Komunikator Prihatin';
            else if (count >= 8) levelTitle = 'Tahap 2: Rakan Komuniti Pekak';
            document.getElementById('profile-level-title').innerText = levelTitle;

            renderBadges();
        }

        // ==========================================
        // 6. PAPARAN LALUAN PEMBELAJARAN (WINDING PATH)
        // ==========================================
        function renderLearningPath() {
            const container = document.getElementById('learning-path-container');
            container.innerHTML = '';

            const allLessonKeys = UNITS.flatMap(u => u.lessons);
            let nextLessonKey = allLessonKeys.find(k => !appState.completedLessons.includes(k)) || allLessonKeys[allLessonKeys.length - 1];

            // Ucapan dinamik maskot
            const mascotSpeech = document.getElementById('mascot-speech');
            if (appState.completedLessons.length === 0) {
                mascotSpeech.innerText = '"Hai! Jom mulakan Unit 1: Abjad BIM (A–Z) & Nombor Asas untuk menguasai ejaan jari!"';
            } else if (appState.completedLessons.length >= allLessonKeys.length) {
                mascotSpeech.innerText = '"Syabas! Anda telah melengkapkan kesemua 5 Unit Asas BIM! Ulang kaji bila-bila masa."';
            } else {
                const nextSign = BIM_SIGNS[nextLessonKey];
                mascotSpeech.innerText = `"Teruskan! Seterusnya jom pelajari isyarat '${nextSign.word}' (${nextSign.en})."`;
            }

            UNITS.forEach((unit) => {
                const unitDiv = document.createElement('div');
                unitDiv.className = 'mb-6';

                // Header Unit
                unitDiv.innerHTML = `
                    <div class="${unit.color} text-white rounded-3xl p-4 mb-6 shadow-md border-b-4 ${unit.borderColor}">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-black">${unit.title}</h2>
                                <p class="text-xs font-semibold opacity-95 font-body">${unit.desc}</p>
                            </div>
                            <span class="text-2xl bg-white/20 w-10 h-10 rounded-2xl flex items-center justify-center">🤟</span>
                        </div>
                    </div>
                `;

                // Laluan Nod Berliku (Winding Path)
                const pathNodesDiv = document.createElement('div');
                pathNodesDiv.className = 'flex flex-col items-center gap-5 relative py-2';

                // Offset mendatar untuk bentuk laluan berliku (Zig-Zag lembut)
                const offsets = ['translate-x-0', '-translate-x-10', '-translate-x-14', '-translate-x-6', 'translate-x-8'];

                unit.lessons.forEach((lessonKey, idx) => {
                    const sign = BIM_SIGNS[lessonKey];
                    const isCompleted = appState.completedLessons.includes(lessonKey);
                    const isCurrent = lessonKey === nextLessonKey && !isCompleted;
                    const isUnlocked = isCompleted || isCurrent || idx === 0 && unit.id === 1;

                    const offsetClass = offsets[idx % offsets.length];
                    
                    let btnStyle = 'bg-gray-200 text-gray-400 border-b-4 border-gray-300';
                    let icon = '🔒';
                    let pulseClass = '';

                    if (isCompleted) {
                        btnStyle = `${unit.color} text-white border-b-4 ${unit.borderColor}`;
                        icon = '⭐';
                    } else if (isCurrent) {
                        btnStyle = `bg-duoGreen text-white border-b-4 border-duoGreenDark`;
                        icon = '🤟';
                        pulseClass = 'pulse-node';
                    }

                    const nodeWrapper = document.createElement('div');
                    nodeWrapper.className = `flex flex-col items-center transform ${offsetClass} transition-all`;

                    nodeWrapper.innerHTML = `
                        <button onclick="startLesson('${lessonKey}', ${isUnlocked})" 
                            class="relative w-20 h-20 rounded-full ${btnStyle} ${pulseClass} flex items-center justify-center text-3xl shadow-lg active:translate-y-1 transition-transform">
                            ${icon}
                            ${isCurrent ? `<span class="absolute -top-7 bg-white text-duoGreen border-2 border-duoGreen text-[11px] font-black px-2.5 py-0.5 rounded-xl shadow-sm whitespace-nowrap animate-bounce">MULA!</span>` : ''}
                        </button>
                        <span class="mt-2 text-xs font-extrabold ${isUnlocked ? 'text-gray-700' : 'text-gray-400'} bg-white/95 px-2.5 py-0.5 rounded-full shadow-2xs text-center">
                            ${sign.word}
                        </span>
                        <span class="text-[10px] font-bold text-gray-400">${sign.en}</span>
                    `;
                    pathNodesDiv.appendChild(nodeWrapper);
                });

                unitDiv.appendChild(pathNodesDiv);
                container.appendChild(unitDiv);
            });
        }

        // ==========================================
        // 7. ENJIN PELAJARAN INTERAKTIF & KUIZ
        // ==========================================
        let currentSession = null;

        function startLesson(signKey, isUnlocked) {
            playSound('tap');
            if (!isUnlocked) {
                showDialog({
                    emoji: '🔒',
                    title: 'Pelajaran Terkunci',
                    message: 'Selesaikan pelajaran sebelumnya dahulu untuk membuka isyarat ini!',
                    confirmText: 'FAHAM',
                    confirmClass: 'btn-blue'
                });
                return;
            }

            if (appState.hearts <= 0) {
                showDialog({
                    emoji: '💔',
                    title: 'Nyawa Habis!',
                    message: 'Anda perlukan sekurang-kurangnya 1 nyawa untuk memulakan pelajaran. Isi semula nyawa anda sekarang secara percuma!',
                    confirmText: 'ISI SEMULA NYAWA ❤️',
                    confirmClass: 'btn-red',
                    onConfirm: () => {
                        refillHearts();
                        startLesson(signKey, true);
                    }
                });
                return;
            }

            const targetSign = BIM_SIGNS[signKey];
            const otherKeys = Object.keys(BIM_SIGNS).filter(k => k !== signKey);
            // Ambil 3 pilihan pengganggu secara rawak
            const distractors = otherKeys.sort(() => 0.5 - Math.random()).slice(0, 3);

            // Bina 4 Langkah Pembelajaran:
            // Langkah 1: Kad Pembelajaran (Flashcard + Animasi + Mimik Muka)
            // Langkah 2: Kuiz Padanan Gambar Isyarat -> Perkataan
            // Langkah 3: Kuiz Betul / Salah berdasarkan penerangan
            // Langkah 4: Bina Ayat BIM Asas (Tap-to-build blocks)
            let steps = [
                {
                    type: 'flashcard',
                    sign: targetSign
                },
                {
                    type: 'quiz_match',
                    sign: targetSign,
                    options: [signKey, ...distractors].sort(() => 0.5 - Math.random())
                },
                {
                    type: 'quiz_tf',
                    sign: targetSign,
                    isTrueStatement: Math.random() > 0.4,
                    fakeSign: BIM_SIGNS[distractors[0]]
                },
                {
                    type: 'quiz_sentence',
                    sign: targetSign,
                    targetWords: targetSign.sentence,
                    wordBank: [...targetSign.sentence, 'Saya', 'Awak', 'Esok'].filter((v, i, a) => a.indexOf(v) === i).sort(() => 0.5 - Math.random())
                }
            ];

            // Modul Abjad: 26 latihan AI + 26 soalan pilihan jawapan.
            // Kesemua 52 soalan diacak dan huruf yang sama tidak boleh berturutan.
            if (signKey === 'abjad_a_z') {
                const allLetters = Object.keys(FINGERSPELL_GUIDE);
                const totalAlphabetQuestions = allLetters.length * 2;

                let alphabetQuestions = allLetters.flatMap(letter => {
                    const wrongAnswers = allLetters
                        .filter(candidate => candidate !== letter)
                        .sort(() => 0.5 - Math.random())
                        .slice(0, 3);

                    return [
                        { type: 'alphabet_ai', sign: targetSign, letter },
                        {
                            type: 'alphabet_quiz',
                            sign: targetSign,
                            letter,
                            options: [letter, ...wrongAnswers].sort(() => 0.5 - Math.random())
                        }
                    ];
                });

                // Ulang kocok sehingga tiada dua soalan huruf sama bersebelahan.
                for (let attempt = 0; attempt < 100; attempt++) {
                    const shuffled = [...alphabetQuestions].sort(() => 0.5 - Math.random());
                    const hasAdjacentDuplicate = shuffled.some((question, index) =>
                        index > 0 && question.letter === shuffled[index - 1].letter
                    );
                    if (!hasAdjacentDuplicate) {
                        alphabetQuestions = shuffled;
                        break;
                    }
                }

                // Jaminan susunan sekiranya kocokan rawak masih menghasilkan pasangan sama.
                if (alphabetQuestions.some((question, index) => index > 0 && question.letter === alphabetQuestions[index - 1].letter)) {
                    const letterOrder = [...allLetters].sort(() => 0.5 - Math.random());
                    const byKey = new Map(alphabetQuestions.map(question => [`${question.type}-${question.letter}`, question]));
                    alphabetQuestions = letterOrder.flatMap((letter, index) => [
                        byKey.get(`alphabet_ai-${letter}`),
                        byKey.get(`alphabet_quiz-${letterOrder[(index + 2) % letterOrder.length]}`)
                    ]);
                }

                alphabetQuestions = alphabetQuestions.map((question, index) => ({
                    ...question,
                    questionNumber: index + 1,
                    totalQuestions: totalAlphabetQuestions
                }));

                steps = [
                    { type: 'flashcard', sign: targetSign },
                    ...alphabetQuestions
                ];
            }

            currentSession = {
                signKey,
                steps,
                currentIndex: 0,
                selectedAnswer: null,
                builtSentence: [],
                isAnswered: false
            };

            const modal = document.getElementById('lesson-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            renderLessonStep();
        }

        function renderLessonStep() {
            const step = currentSession.steps[currentSession.currentIndex];
            const progress = ((currentSession.currentIndex) / currentSession.steps.length) * 100;
            document.getElementById('lesson-progress-bar').style.width = `${Math.max(12, progress)}%`;
            document.getElementById('lesson-hearts').innerText = appState.hearts;

            // Sembunyikan drawer maklum balas
            const drawer = document.getElementById('feedback-drawer');
            drawer.classList.remove('translate-y-0');
            drawer.classList.add('translate-y-full');

            const contentArea = document.getElementById('lesson-content-area');
            const actionBtn = document.getElementById('btn-lesson-action');
            actionBtn.classList.remove('hidden');
            currentSession.selectedAnswer = null;
            currentSession.builtSentence = [];
            currentSession.isAnswered = false;

            if (step.type === 'flashcard') {
                actionBtn.innerText = 'SAYA FAHAM, MULA KUIZ!';
                actionBtn.className = 'w-full btn-3d btn-green py-4 rounded-2xl font-black text-base tracking-wide uppercase';
                actionBtn.disabled = false;

                const isAlphabetModule = step.sign.id === 'abjad_a_z';
                const isNumberModule = step.sign.id === 'nombor_1_10';
                const interactiveGridHTML = isAlphabetModule ? `
                    <div class="bg-sky-50 border-2 border-sky-200 rounded-2xl p-3 mb-3">
                        <div class="text-xs font-black text-duoBlueDark uppercase mb-2">🔤 Ketik Huruf A – Z (Rujukan Rasmi MFD):</div>
                        <div class="grid grid-cols-4 gap-2 max-h-56 overflow-y-auto pr-1">
                            ${Object.keys(FINGERSPELL_GUIDE).map(ch => `
                                <button type="button" onclick="showFingerspellTip('${ch}')" class="bg-white border border-sky-200 rounded-xl p-1.5 text-center shadow-2xs active:scale-95 transition">
                                    <div class="w-11 h-11 mx-auto rounded-lg overflow-hidden">${renderAlphabetHandSVG(ch)}</div>
                                    <div class="text-xs font-black text-gray-800 mt-0.5">${ch}</div>
                                </button>
                            `).join('')}
                        </div>
                    </div>
                ` : (isNumberModule ? `
                    <div class="bg-emerald-50 border-2 border-emerald-200 rounded-2xl p-3 mb-3">
                        <div class="text-xs font-black text-duoGreenDark uppercase mb-2">🔢 Ketik Nombor 1 – 10 (Panduan Jari BIM):</div>
                        <div class="grid grid-cols-5 gap-2">
                            ${Object.keys(NUMBER_GUIDE).map(num => `
                                <button type="button" onclick="showNumberTip('${num}')" class="bg-white border border-emerald-200 rounded-xl p-1.5 text-center shadow-2xs active:scale-95 transition">
                                    <div class="w-11 h-11 mx-auto rounded-lg overflow-hidden">${renderNumberHandSVG(num)}</div>
                                    <div class="text-xs font-black text-gray-800 mt-0.5">${num}</div>
                                </button>
                            `).join('')}
                        </div>
                    </div>
                ` : '');

                contentArea.innerHTML = `
                    <div class="my-auto">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="inline-block bg-sky-100 text-duoBlue text-xs font-black px-3 py-1 rounded-full">
                                ISYARAT BAHARU ✨
                            </span>
                            <span class="inline-block bg-gray-100 text-gray-600 text-xs font-extrabold px-2.5 py-1 rounded-full">
                                BI: ${step.sign.en}
                            </span>
                        </div>
                        <h2 class="text-3xl font-black text-gray-800 mb-3">${step.sign.word}</h2>

                        ${(isAlphabetModule || isNumberModule) ? interactiveGridHTML : `
                        <!-- Kad Ilustrasi Beranimasi -->
                        <div class="bg-white border-2 border-gray-200 rounded-3xl p-4 shadow-sm mb-4">
                            <div class="w-44 h-40 mx-auto mb-2">
                                ${getSignSVG(step.sign.svgType, step.sign.animClass, step.sign.colorHex)}
                            </div>
                            <div class="text-center">
                                <span class="text-[11px] font-extrabold text-duoBlue bg-sky-50 px-2.5 py-1 rounded-full">
                                    🔄 Animasi Gerakan Tangan
                                </span>
                            </div>
                        </div>
                        `}

                        <!-- Panduan Langkah Demi Langkah -->
                        <div class="bg-emerald-50 border-2 border-emerald-200 rounded-2xl p-3.5 mb-3">
                            <div class="text-xs font-black text-duoGreenDark uppercase mb-1">👐 Cara Membuat Isyarat:</div>
                            <p class="text-sm font-bold text-gray-700 leading-relaxed font-body">${step.sign.steps}</p>
                        </div>

                        <!-- Tip Mimik Muka -->
                        <div class="bg-amber-50 border-2 border-amber-200 rounded-2xl p-3.5">
                            <div class="text-xs font-black text-amber-700 uppercase mb-1">🎭 Ekspresi & Mimik Muka:</div>
                            <p class="text-xs font-bold text-gray-700 leading-relaxed font-body">${step.sign.expression}</p>
                        </div>
                    </div>
                `;
            } 
            else if (step.type === 'alphabet_ai') {
                actionBtn.classList.add('hidden');
                contentArea.innerHTML = `
                    <div class="my-auto">
                        <span class="text-xs font-black text-duoBlue uppercase tracking-wider">
                            Soalan ${step.questionNumber} daripada ${step.totalQuestions} • Latihan Kamera AI
                        </span>
                        <h2 class="text-xl font-black text-gray-800 mt-1 mb-2">Tunjukkan isyarat huruf <span class="text-duoBlue">${step.letter}</span> kepada kamera</h2>
                        <p class="text-xs font-semibold text-gray-500 mb-8">Bentuk isyarat berdasarkan ingatan anda. AI akan membawa anda ke soalan jawapan selepas isyarat disahkan.</p>

                        <div class="w-24 h-24 mx-auto mb-8 rounded-3xl bg-gradient-to-br from-sky-100 to-emerald-100 border-2 border-sky-200 flex items-center justify-center text-5xl shadow-sm">
                            📷
                        </div>

                        <button type="button" onclick="openAIChecker('${step.letter}')"
                            class="w-full btn-3d btn-blue py-4 rounded-2xl font-black text-sm flex items-center justify-center gap-2">
                            <span>📷</span> SEMAK ISYARAT SAYA DENGAN AI
                        </button>
                        <button type="button" onclick="nextLessonStep()" class="w-full mt-4 py-2 text-xs font-extrabold text-gray-400 uppercase">
                            Lewati latihan kamera
                        </button>
                    </div>
                `;
            }
            else if (step.type === 'alphabet_quiz') {
                setActionBtnDisabled();
                contentArea.innerHTML = `
                    <div class="my-auto">
                        <span class="text-xs font-black text-duoPurple uppercase tracking-wider">
                            Soalan ${step.questionNumber} daripada ${step.totalQuestions} • Kenali Abjad BIM
                        </span>
                        <h2 class="text-xl font-black text-gray-800 mt-1 mb-4">Apakah huruf yang ditunjukkan oleh isyarat tangan ini?</h2>

                        <div class="w-56 h-56 mx-auto mb-6 border-2 border-sky-200 rounded-3xl overflow-hidden bg-white shadow-xs">
                            ${renderAlphabetHandSVG(step.letter)}
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            ${step.options.map(option => `
                                <button onclick="selectQuizOption('${option}', this)"
                                    class="quiz-opt-btn btn-3d btn-white py-4 rounded-2xl font-black text-xl">
                                    ${option}
                                </button>
                            `).join('')}
                        </div>
                    </div>
                `;
            }
            else if (step.type === 'quiz_match') {
                setActionBtnDisabled();
                contentArea.innerHTML = `
                    <div class="my-auto">
                        <span class="text-xs font-black text-duoPurple uppercase tracking-wider">Soalan 1 • Padanan Visual</span>
                        <h2 class="text-xl font-black text-gray-800 mt-1 mb-4">Apakah maksud isyarat tangan di bawah ini?</h2>

                        <div class="w-44 h-40 mx-auto mb-6 border-2 border-gray-200 rounded-3xl p-2 shadow-xs">
                            ${getSignSVG(step.sign.svgType, step.sign.animClass, step.sign.colorHex)}
                        </div>

                        <div class="grid grid-cols-1 gap-3">
                            ${step.options.map(optKey => {
                                const optSign = BIM_SIGNS[optKey];
                                return `
                                    <button onclick="selectQuizOption('${optKey}', this)" 
                                        class="quiz-opt-btn btn-3d btn-white w-full py-3.5 px-4 rounded-2xl font-extrabold text-base text-left flex items-center justify-between">
                                        <div>
                                            <span>${optSign.word}</span>
                                            <span class="text-xs font-bold text-gray-400 ml-1.5">(${optSign.en})</span>
                                        </div>
                                        <span class="text-gray-300 text-sm">●</span>
                                    </button>
                                `;
                            }).join('')}
                        </div>
                    </div>
                `;
            } 
            else if (step.type === 'quiz_tf') {
                setActionBtnDisabled();
                const displayedDesc = step.isTrueStatement ? step.sign.steps : step.fakeSign.steps;

                contentArea.innerHTML = `
                    <div class="my-auto">
                        <span class="text-xs font-black text-duoBlue uppercase tracking-wider">Soalan 2 • Betul atau Salah</span>
                        <h2 class="text-xl font-black text-gray-800 mt-1 mb-3">Adakah penerangan ini tepat untuk isyarat <span class="text-duoBlue">"${step.sign.word}"</span>?</h2>

                        <div class="w-36 h-32 mx-auto mb-4 border-2 border-gray-200 rounded-3xl p-2">
                            ${getSignSVG(step.sign.svgType, step.sign.animClass, step.sign.colorHex)}
                        </div>

                        <div class="bg-gray-50 border-2 border-gray-200 rounded-2xl p-4 mb-5">
                            <p class="text-sm font-bold text-gray-700 font-body">"${displayedDesc}"</p>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <button onclick="selectQuizOption(true, this)" class="quiz-opt-btn btn-3d btn-white py-4 rounded-2xl font-black text-base flex flex-col items-center gap-1">
                                <span class="text-2xl">✅</span>
                                <span>BETUL</span>
                            </button>
                            <button onclick="selectQuizOption(false, this)" class="quiz-opt-btn btn-3d btn-white py-4 rounded-2xl font-black text-base flex flex-col items-center gap-1">
                                <span class="text-2xl">❌</span>
                                <span>SALAH</span>
                            </button>
                        </div>
                    </div>
                `;
            } 
            else if (step.type === 'quiz_sentence') {
                setActionBtnDisabled();
                contentArea.innerHTML = `
                    <div class="my-auto">
                        <span class="text-xs font-black text-duoGreen uppercase tracking-wider">Soalan 3 • Susun Ungkapan BIM</span>
                        <h2 class="text-xl font-black text-gray-800 mt-1 mb-2">Susun blok perkataan untuk membentuk ungkapan:</h2>
                        
                        <div class="bg-sky-50 border-2 border-sky-200 rounded-2xl p-3 mb-4 flex items-center gap-3">
                            <div class="w-16 h-16 flex-shrink-0">
                                ${getSignSVG(step.sign.svgType, step.sign.animClass, step.sign.colorHex)}
                            </div>
                            <div class="font-black text-lg text-duoBlue">"${step.targetWords.join(' ')}"</div>
                        </div>

                        <!-- Kawasan Jawapan Terbina -->
                        <div id="sentence-dropzone" class="min-h-[64px] bg-gray-50 border-2 border-dashed border-gray-300 rounded-2xl p-3 mb-6 flex flex-wrap gap-2 items-center">
                            <span class="text-xs font-bold text-gray-400">Ketik blok perkataan di bawah...</span>
                        </div>

                        <!-- Bank Perkataan -->
                        <div id="sentence-wordbank" class="flex flex-wrap gap-2.5 justify-center">
                            ${step.wordBank.map((word, idx) => `
                                <button id="wb-btn-${idx}" onclick="toggleSentenceWord('${word}', ${idx})" 
                                    class="btn-3d btn-white px-4 py-2.5 rounded-2xl font-extrabold text-sm">
                                    ${word}
                                </button>
                            `).join('')}
                        </div>
                    </div>
                `;
            }
        }

        function setActionBtnDisabled() {
            const actionBtn = document.getElementById('btn-lesson-action');
            actionBtn.innerText = 'SEMAK JAWAPAN';
            actionBtn.className = 'w-full btn-3d btn-disabled py-4 rounded-2xl font-black text-base tracking-wide uppercase';
            actionBtn.disabled = true;
        }

        function enableCheckButton() {
            const actionBtn = document.getElementById('btn-lesson-action');
            actionBtn.innerText = 'SEMAK JAWAPAN';
            actionBtn.className = 'w-full btn-3d btn-green py-4 rounded-2xl font-black text-base tracking-wide uppercase';
            actionBtn.disabled = false;
        }

        function selectQuizOption(val, btnEl) {
            if (currentSession.isAnswered) return;
            playSound('tap');
            currentSession.selectedAnswer = val;

            document.querySelectorAll('.quiz-opt-btn').forEach(b => b.classList.remove('selected'));
            btnEl.classList.add('selected');
            enableCheckButton();
        }

        function toggleSentenceWord(word, idx) {
            if (currentSession.isAnswered) return;
            playSound('tap');
            const btn = document.getElementById(`wb-btn-${idx}`);
            
            const existingIndex = currentSession.builtSentence.findIndex(item => item.idx === idx);
            if (existingIndex > -1) {
                currentSession.builtSentence.splice(existingIndex, 1);
                btn.classList.remove('opacity-30', 'pointer-events-none');
            } else {
                currentSession.builtSentence.push({ word, idx });
                btn.classList.add('opacity-30', 'pointer-events-none');
            }

            renderBuiltSentence();
        }

        function renderBuiltSentence() {
            const dropzone = document.getElementById('sentence-dropzone');
            if (currentSession.builtSentence.length === 0) {
                dropzone.innerHTML = `<span class="text-xs font-bold text-gray-400">Ketik blok perkataan di bawah...</span>`;
                setActionBtnDisabled();
            } else {
                dropzone.innerHTML = currentSession.builtSentence.map(item => `
                    <button onclick="toggleSentenceWord('${item.word}', ${item.idx})" 
                        class="btn-3d btn-white selected px-3.5 py-2 rounded-xl font-extrabold text-sm">
                        ${item.word}
                    </button>
                `).join('');
                enableCheckButton();
            }
        }

        function handleLessonAction() {
            const step = currentSession.steps[currentSession.currentIndex];

            // Jika kad pembelajaran, terus ke soalan pertama
            if (step.type === 'flashcard') {
                playSound('tap');
                currentSession.currentIndex++;
                renderLessonStep();
                return;
            }

            if (currentSession.isAnswered) return;
            currentSession.isAnswered = true;

            let isCorrect = false;
            let correctionText = '';

            if (step.type === 'alphabet_quiz') {
                isCorrect = currentSession.selectedAnswer === step.letter;
                correctionText = `Jawapan tepat: Huruf ${step.letter}. ${FINGERSPELL_GUIDE[step.letter]}`;
            } else if (step.type === 'quiz_match') {
                isCorrect = currentSession.selectedAnswer === step.sign.id;
                correctionText = `Jawapan tepat: ${step.sign.word}`;
            } else if (step.type === 'quiz_tf') {
                isCorrect = currentSession.selectedAnswer === step.isTrueStatement;
                correctionText = step.isTrueStatement ? 'Pernyataan tersebut adalah BETUL.' : `Salah! Itu penerangan untuk "${step.fakeSign.word}".`;
            } else if (step.type === 'quiz_sentence') {
                const userSentence = currentSession.builtSentence.map(i => i.word).join(' ');
                const targetSentence = step.targetWords.join(' ');
                isCorrect = userSentence === targetSentence;
                correctionText = `Susunan tepat: "${targetSentence}"`;
            }

            showFeedbackDrawer(isCorrect, correctionText);
        }

        function showFeedbackDrawer(isCorrect, correctionText) {
            const drawer = document.getElementById('feedback-drawer');
            const icon = document.getElementById('feedback-icon');
            const title = document.getElementById('feedback-title');
            const subtitle = document.getElementById('feedback-subtitle');
            const nextBtn = document.getElementById('btn-feedback-next');

            if (isCorrect) {
                playSound('correct');
                drawer.className = 'feedback-drawer fixed bottom-0 left-0 right-0 max-w-[480px] mx-auto p-5 rounded-t-3xl shadow-2xl z-50 bg-emerald-100 text-duoGreenDark transform translate-y-0';
                icon.innerText = '🎉';
                title.innerText = 'Hebat! Tepat sekali!';
                subtitle.innerText = 'Anda semakin mahir berkomunikasi dalam BIM!';
                nextBtn.className = 'w-full btn-3d btn-green py-3.5 rounded-2xl font-black text-base uppercase tracking-wide';
            } else {
                playSound('wrong');
                appState.hearts = Math.max(0, appState.hearts - 1);
                saveState();
                document.getElementById('lesson-hearts').innerText = appState.hearts;

                drawer.className = 'feedback-drawer fixed bottom-0 left-0 right-0 max-w-[480px] mx-auto p-5 rounded-t-3xl shadow-2xl z-50 bg-rose-100 text-duoRedDark transform translate-y-0';
                icon.innerText = '💡';
                title.innerText = 'Kurang tepat, cuba lagi!';
                subtitle.innerText = correctionText;
                nextBtn.className = 'w-full btn-3d btn-red py-3.5 rounded-2xl font-black text-base uppercase tracking-wide';
            }
        }

        function nextLessonStep() {
            playSound('tap');
            if (appState.hearts <= 0) {
                closeLessonModal();
                showDialog({
                    emoji: '💔',
                    title: 'Nyawa Anda Telah Habis',
                    message: 'Jangan putus asa! Isi semula nyawa anda dan cuba lagi pelajaran ini.',
                    confirmText: 'ISI SEMULA NYAWA ❤️',
                    confirmClass: 'btn-green',
                    onConfirm: () => refillHearts()
                });
                return;
            }

            currentSession.currentIndex++;
            if (currentSession.currentIndex < currentSession.steps.length) {
                renderLessonStep();
            } else {
                completeLesson();
            }
        }

        function completeLesson() {
            playSound('fanfare');
            document.getElementById('lesson-progress-bar').style.width = '100%';
            const feedbackDrawer = document.getElementById('feedback-drawer');
            feedbackDrawer.classList.remove('translate-y-0');
            feedbackDrawer.classList.add('translate-y-full');

            const isFirstTime = !appState.completedLessons.includes(currentSession.signKey);
            const earnedXP = isFirstTime ? 25 : 10;

            if (isFirstTime) {
                appState.completedLessons.push(currentSession.signKey);
            }
            appState.xp += earnedXP;
            saveState();

            const contentArea = document.getElementById('lesson-content-area');
            const actionBtn = document.getElementById('btn-lesson-action');
            const totalModules = Object.keys(BIM_SIGNS).length;

            contentArea.innerHTML = `
                <div class="my-auto text-center py-6">
                    <div class="text-6xl mb-4 animate-bounce">🏆</div>
                    <h2 class="text-3xl font-black text-duoYellowDark mb-2">Pelajaran Tamat!</h2>
                    <p class="text-sm font-bold text-gray-600 mb-6 font-body">
                        Anda kini boleh menggunakan isyarat <span class="text-duoGreen font-black">"${BIM_SIGNS[currentSession.signKey].word}"</span> (${BIM_SIGNS[currentSession.signKey].en}) bersama komuniti pekak!
                    </p>

                    <div class="grid grid-cols-2 gap-4 max-w-xs mx-auto">
                        <div class="bg-amber-50 border-2 border-duoYellow rounded-2xl p-4">
                            <div class="text-xs font-black text-amber-600 uppercase">GANJARAN XP</div>
                            <div class="text-2xl font-black text-duoYellowDark mt-1">+${earnedXP} 💎</div>
                        </div>
                        <div class="bg-emerald-50 border-2 border-duoGreen rounded-2xl p-4">
                            <div class="text-xs font-black text-duoGreenDark uppercase">KEMAJUAN</div>
                            <div class="text-2xl font-black text-duoGreen mt-1">${appState.completedLessons.length}/${totalModules} 🤟</div>
                        </div>
                    </div>
                </div>
            `;

            actionBtn.innerText = 'KEMBALI KE LALUAN';
            actionBtn.className = 'w-full btn-3d btn-green py-4 rounded-2xl font-black text-base tracking-wide uppercase';
            actionBtn.onclick = () => {
                playSound('tap');
                closeLessonModal();
                // Pulihkan fungsi asal butang
                actionBtn.onclick = handleLessonAction;
                renderLearningPath();
            };
        }

        function confirmExitLesson() {
            playSound('tap');
            showDialog({
                emoji: '🤔',
                title: 'Keluar Pelajaran?',
                message: 'Kemajuan dalam sesi kuiz ini tidak akan disimpan jika anda keluar sekarang.',
                confirmText: 'KELUAR',
                confirmClass: 'btn-red',
                cancelText: 'TERUSKAN BELAJAR',
                onConfirm: () => closeLessonModal()
            });
        }

        function closeLessonModal() {
            const modal = document.getElementById('lesson-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            const feedbackDrawer = document.getElementById('feedback-drawer');
            feedbackDrawer.classList.remove('translate-y-0');
            feedbackDrawer.classList.add('translate-y-full');
        }

        // ==========================================
        // 8. PEMERIKSA ISYARAT AI (MEDIAPIPE HAND LANDMARKER)
        // ==========================================
        let aiHandLandmarker = null;
        let aiCameraStream = null;
        let aiAnimationFrame = null;
        let aiTargetLetter = 'A';
        let aiStableFrames = 0;
        let aiMotionTrail = [];
        let aiLastVideoTime = -1;
        let aiAutoAdvanced = false;
        let aiAdvanceTimer = null;

        async function loadAIHandModel() {
            if (aiHandLandmarker) return aiHandLandmarker;
            const vision = await import('./assets/mediapipe/vision_bundle.mjs');
            const fileset = await vision.FilesetResolver.forVisionTasks('./assets/mediapipe/wasm');
            const commonOptions = {
                runningMode: 'VIDEO', numHands: 1,
                minHandDetectionConfidence: 0.55,
                minHandPresenceConfidence: 0.55,
                minTrackingConfidence: 0.55
            };
            try {
                aiHandLandmarker = await vision.HandLandmarker.createFromOptions(fileset, {
                    ...commonOptions,
                    baseOptions: { modelAssetPath: './assets/mediapipe/hand_landmarker.task', delegate: 'GPU' }
                });
            } catch (gpuError) {
                console.warn('GPU MediaPipe tidak tersedia, menggunakan CPU.', gpuError);
                aiHandLandmarker = await vision.HandLandmarker.createFromOptions(fileset, {
                    ...commonOptions,
                    baseOptions: { modelAssetPath: './assets/mediapipe/hand_landmarker.task', delegate: 'CPU' }
                });
            }
            return aiHandLandmarker;
        }

        async function openAIChecker(letter) {
            aiTargetLetter = (letter || 'A').toUpperCase();
            aiStableFrames = 0;
            aiMotionTrail = [];
            aiLastVideoTime = -1;
            aiAutoAdvanced = false;
            document.getElementById('ai-target-letter').innerText = aiTargetLetter;
            document.getElementById('ai-progress-bar').style.width = document.getElementById('lesson-progress-bar').style.width;
            document.getElementById('ai-lesson-hearts').innerText = appState.hearts;
            document.getElementById('ai-check-icon').innerText = '🖐️';
            document.getElementById('ai-check-title').innerText = 'Letakkan satu tangan dalam bingkai';
            document.getElementById('ai-check-detail').innerText = ['J', 'Z'].includes(aiTargetLetter)
                ? 'Bentuk posisi permulaan, kemudian lakukan gerakan huruf tersebut.'
                : 'Pastikan tapak tangan dan semua jari kelihatan jelas.';
            document.getElementById('ai-confidence-bar').style.width = '0%';
            const modal = document.getElementById('ai-checker-modal');
            const loading = document.getElementById('ai-camera-loading');
            loading.innerHTML = '<div><div class="text-4xl mb-3 animate-pulse">🤖</div><p class="text-sm font-bold">Memuatkan model pengesanan tangan…</p></div>';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            loading.classList.remove('hidden');

            try {
                await loadAIHandModel();
            } catch (modelError) {
                console.error('Model AI:', modelError);
                loading.innerHTML = '<div><div class="text-4xl mb-3">⚠️</div><p class="text-sm font-black text-gray-800">Model AI gagal dimuatkan</p><p class="text-xs text-gray-500 mt-2">Muat semula halaman dengan Ctrl + F5. Semua fail model kini disimpan dalam projek.</p></div>';
                return;
            }

            try {
                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    throw new Error('Camera API unavailable.');
                }
                aiCameraStream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: 'user', width: { ideal: 640 }, height: { ideal: 640 } }, audio: false
                });
                const video = document.getElementById('ai-camera-video');
                video.srcObject = aiCameraStream;
                await video.play();
                loading.classList.add('hidden');
                runAICheckLoop();
            } catch (cameraError) {
                console.error('Kamera:', cameraError);
                const denied = cameraError && cameraError.name === 'NotAllowedError';
                loading.innerHTML = `<div><div class="text-4xl mb-3">📷</div><p class="text-sm font-black text-gray-800">${denied ? 'Akses kamera tidak dibenarkan' : 'Kamera tidak dapat dibuka'}</p><p class="text-xs text-gray-500 mt-2">${denied ? 'Tekan ikon kamera pada bar alamat dan pilih Benarkan, kemudian cuba semula.' : 'Tutup aplikasi lain yang menggunakan kamera dan pastikan halaman dibuka melalui localhost atau HTTPS.'}</p></div>`;
            }
        }

        function closeAIChecker() {
            if (aiAdvanceTimer) clearTimeout(aiAdvanceTimer);
            aiAdvanceTimer = null;
            if (aiAnimationFrame) cancelAnimationFrame(aiAnimationFrame);
            aiAnimationFrame = null;
            if (aiCameraStream) aiCameraStream.getTracks().forEach(track => track.stop());
            aiCameraStream = null;
            document.getElementById('ai-camera-video').srcObject = null;
            const modal = document.getElementById('ai-checker-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function jointAngle(a, b, c) {
            const ab = { x: a.x - b.x, y: a.y - b.y };
            const cb = { x: c.x - b.x, y: c.y - b.y };
            const dot = ab.x * cb.x + ab.y * cb.y;
            const mag = Math.hypot(ab.x, ab.y) * Math.hypot(cb.x, cb.y) || 1;
            return Math.acos(Math.max(-1, Math.min(1, dot / mag))) * 180 / Math.PI;
        }

        function landmarkDistance(a, b) {
            return Math.hypot(a.x - b.x, a.y - b.y, (a.z || 0) - (b.z || 0));
        }

        function getHandFeatures(lm) {
            const joints = [[5,6,8], [9,10,12], [13,14,16], [17,18,20]];
            const fingerAngles = joints.map(([mcp, pip, tip]) => jointAngle(lm[mcp], lm[pip], lm[tip]));
            const extended = joints.map(([mcp, pip, tip], index) =>
                fingerAngles[index] > 145 &&
                landmarkDistance(lm[tip], lm[0]) > landmarkDistance(lm[pip], lm[0]) * 1.05
            );
            const thumbExtended = jointAngle(lm[1], lm[2], lm[4]) > 135 &&
                landmarkDistance(lm[4], lm[5]) > landmarkDistance(lm[3], lm[5]) * 1.08;
            const palmSize = landmarkDistance(lm[0], lm[9]) || 0.1;
            return {
                extended, thumbExtended, fingerAngles,
                indexMiddleGap: landmarkDistance(lm[8], lm[12]) / palmSize,
                middleRingGap: landmarkDistance(lm[12], lm[16]) / palmSize,
                thumbIndexGap: landmarkDistance(lm[4], lm[8]) / palmSize,
                curledIndex: jointAngle(lm[5], lm[6], lm[8]) < 125,
                loopOpening: landmarkDistance(lm[3], lm[6]) / palmSize,
                fingertipsToThumb: [8,12,16,20].map(index => landmarkDistance(lm[index], lm[4]) / palmSize)
            };
        }

        function evaluateBIMLetter(letter, lm) {
            const f = getHandFeatures(lm);
            const patterns = {
                A:[0,0,0,0], B:[1,1,1,1], D:[1,0,0,0], E:[0,0,0,0], F:[0,1,1,1],
                G:[1,0,0,0], H:[1,1,0,0], I:[0,0,0,1], J:[0,0,0,1], K:[1,1,0,0],
                L:[1,0,0,0], M:[0,0,0,0], N:[0,0,0,0], P:[1,1,0,0], Q:[1,0,0,0],
                R:[1,1,0,0], S:[0,0,0,0], T:[0,0,0,0], U:[1,1,0,0], V:[1,1,0,0],
                W:[1,1,1,0], X:[0,0,0,0], Y:[0,0,0,1], Z:[1,0,0,0]
            };
            const expected = patterns[letter] || [0,0,0,0];
            let score = expected.reduce((sum, value, index) => sum + (f.extended[index] === Boolean(value) ? 1 : 0), 0) / 4;

            if (letter === 'C') score = f.thumbIndexGap > 0.45 && f.thumbIndexGap < 1.35 ? 0.9 : 0.35;
            if (letter === 'O') {
                // O mesti membentuk gelung penuh. Sentuhan ibu jari-telunjuk sahaja
                // tidak mencukupi kerana bentuk T juga boleh menghasilkan jarak itu.
                const [indexToThumb, middleToThumb, ringToThumb, pinkyToThumb] = f.fingertipsToThumb;
                const oChecks = [
                    !f.extended.some(Boolean),
                    indexToThumb < 0.34,
                    middleToThumb < 0.58,
                    ringToThumb < 0.78,
                    pinkyToThumb < 0.98,
                    f.fingerAngles.every(angle => angle > 55 && angle < 142),
                    f.loopOpening > 0.42
                ];
                const passed = oChecks.filter(Boolean).length;
                score = passed === oChecks.length ? 0.98 : Math.min(0.72, passed / oChecks.length);
            }
            if (letter === 'X') score = f.curledIndex && !f.extended[1] && !f.extended[2] && !f.extended[3] ? 0.92 : 0.35;
            if (letter === 'U') score *= f.indexMiddleGap < 0.42 ? 1 : 0.55;
            if (letter === 'V') score *= f.indexMiddleGap > 0.42 ? 1 : 0.55;
            if (letter === 'W') score *= f.middleRingGap > 0.25 ? 1 : 0.65;
            if (['G','L','Q','Y'].includes(letter)) score *= f.thumbExtended ? 1 : 0.7;
            if (letter === 'B') score *= !f.thumbExtended ? 1 : 0.75;

            const tip = lm[8];
            aiMotionTrail.push({ x: tip.x, y: tip.y, time: performance.now() });
            aiMotionTrail = aiMotionTrail.filter(p => performance.now() - p.time < 1800);
            if (['J','Z'].includes(letter) && aiMotionTrail.length > 3) {
                const xs = aiMotionTrail.map(p => p.x), ys = aiMotionTrail.map(p => p.y);
                const dx = Math.max(...xs) - Math.min(...xs), dy = Math.max(...ys) - Math.min(...ys);
                const movement = letter === 'J' ? Math.min(1, (dx + dy) / 0.35) : Math.min(1, dx / 0.32) * Math.min(1, dy / 0.18);
                score = score * 0.55 + movement * 0.45;
            }
            return Math.max(0, Math.min(1, score));
        }

        function drawHandLandmarks(ctx, lm, width, height) {
            const links = [[0,1],[1,2],[2,3],[3,4],[0,5],[5,6],[6,7],[7,8],[5,9],[9,10],[10,11],[11,12],[9,13],[13,14],[14,15],[15,16],[13,17],[17,18],[18,19],[19,20],[0,17]];
            ctx.strokeStyle = '#58CC02'; ctx.lineWidth = 4;
            links.forEach(([a,b]) => { ctx.beginPath(); ctx.moveTo(lm[a].x*width,lm[a].y*height); ctx.lineTo(lm[b].x*width,lm[b].y*height); ctx.stroke(); });
            ctx.fillStyle = '#FFC800';
            lm.forEach(p => { ctx.beginPath(); ctx.arc(p.x*width,p.y*height,5,0,Math.PI*2); ctx.fill(); });
        }

        function updateAIResult(score, handFound) {
            const rawPercent = Math.round(score * 100);
            if (aiAutoAdvanced) return;
            if (!handFound) {
                aiStableFrames = 0;
                document.getElementById('ai-confidence-bar').style.width = '0%';
                document.getElementById('ai-check-icon').innerText = '🔍';
                document.getElementById('ai-check-title').innerText = 'Tangan belum dikesan';
                document.getElementById('ai-check-detail').innerText = 'Gerakkan tangan ke tengah bingkai.';
                return;
            }
            if (score >= 0.78) aiStableFrames++; else aiStableFrames = Math.max(0, aiStableFrames - 2);
            if (aiStableFrames >= 10) {
                document.getElementById('ai-confidence-bar').style.width = '100%';
                document.getElementById('ai-check-icon').innerText = '✅';
                document.getElementById('ai-check-title').innerText = `Betul! Ini isyarat ${aiTargetLetter}`;
                document.getElementById('ai-check-detail').innerText = 'Padanan stabil 100%. Soalan seterusnya akan dibuka…';

                if (!aiAutoAdvanced) {
                    aiAutoAdvanced = true;
                    playSound('correct');
                    aiAdvanceTimer = setTimeout(() => {
                        const activeStep = currentSession?.steps?.[currentSession.currentIndex];
                        aiAdvanceTimer = null;
                        closeAIChecker();
                        if (activeStep?.type === 'alphabet_ai' && activeStep.letter === aiTargetLetter) {
                            nextLessonStep();
                        }
                    }, 1200);
                }
            } else {
                const displayPercent = Math.min(99, rawPercent);
                document.getElementById('ai-confidence-bar').style.width = `${displayPercent}%`;
                document.getElementById('ai-check-icon').innerText = score >= 0.58 ? '👌' : '💡';
                document.getElementById('ai-check-title').innerText = score >= 0.58 ? 'Hampir betul—kemaskan posisi' : 'Cuba laraskan bentuk jari';
                document.getElementById('ai-check-detail').innerText = `Padanan semasa ${displayPercent}%. Pastikan semua jari kelihatan.`;
            }
        }

        function runAICheckLoop() {
            const video = document.getElementById('ai-camera-video');
            const canvas = document.getElementById('ai-camera-canvas');
            const ctx = canvas.getContext('2d');
            const detect = () => {
                if (!aiCameraStream || !aiHandLandmarker) return;
                if (video.readyState >= 2 && video.currentTime !== aiLastVideoTime) {
                    aiLastVideoTime = video.currentTime;
                    canvas.width = video.videoWidth; canvas.height = video.videoHeight;
                    ctx.clearRect(0,0,canvas.width,canvas.height);
                    const result = aiHandLandmarker.detectForVideo(video, performance.now());
                    if (result.landmarks && result.landmarks.length) {
                        const lm = result.landmarks[0];
                        drawHandLandmarks(ctx,lm,canvas.width,canvas.height);
                        updateAIResult(evaluateBIMLetter(aiTargetLetter,lm),true);
                    } else updateAIResult(0,false);
                }
                aiAnimationFrame = requestAnimationFrame(detect);
            };
            detect();
        }

        // ==========================================
        // 9. KAMUS PANTAS BIM (DICTIONARY) & EJAAN JARI
        // ==========================================
        let activeDictCategory = 'Semua';

        function setDictFilter(category) {
            playSound('tap');
            activeDictCategory = category;
            const filterMap = {
                'Semua': 'Semua',
                'NomborAbjad': '1. Abjad & Nombor',
                'Sapaan': '2. Ucapan & Sapaan',
                'GantiNama': '3. Kata Ganti Nama',
                'KataTanya': '4. Kata Tanya',
                'Warna': '5. Warna'
            };
            document.querySelectorAll('.dict-filter-btn').forEach(btn => {
                if (btn.innerText === filterMap[category]) {
                    btn.className = 'dict-filter-btn active px-3.5 py-1.5 rounded-xl text-xs font-extrabold bg-duoBlue text-white whitespace-nowrap';
                } else {
                    btn.className = 'dict-filter-btn px-3.5 py-1.5 rounded-xl text-xs font-extrabold bg-gray-100 text-gray-600 whitespace-nowrap';
                }
            });
            renderDictionary();
        }

        function renderFingerspelling() {
            const rawInput = document.getElementById('fingerspell-input').value.toUpperCase().replace(/[^A-Z]/g, '');
            const outputEl = document.getElementById('fingerspell-output');

            if (!rawInput) {
                outputEl.innerHTML = `<span class="text-xs font-bold text-amber-700/70 italic">Huruf A–Z akan dipaparkan di sini mengikut bentuk ejaan jari rasmi MFD...</span>`;
                return;
            }

            outputEl.innerHTML = rawInput.split('').map(char => `
                <div onclick="showFingerspellTip('${char}')" class="flex-shrink-0 w-24 bg-white border-2 border-amber-300 rounded-2xl p-2 text-center shadow-2xs active:scale-95 transition cursor-pointer">
                    <div class="w-16 h-16 mx-auto rounded-xl overflow-hidden shadow-2xs mb-1">
                        ${renderAlphabetHandSVG(char)}
                    </div>
                    <div class="text-sm font-black text-gray-800 leading-none">Huruf ${char}</div>
                    <div class="text-[9px] font-extrabold text-duoBlue mt-0.5 truncate">Ketik Cara Buat</div>
                </div>
            `).join('');
        }

        function showFingerspellTip(char) {
            playSound('tap');
            showDialog({
                customHTML: `
                    <div class="text-center">
                        <span class="inline-block bg-sky-100 text-duoBlue text-[11px] font-black px-3 py-0.5 rounded-full mb-2">Rujukan Rasmi MFD</span>
                        <h3 class="text-2xl font-black text-gray-800 mb-3">Abjad BIM: Huruf "${char}"</h3>
                        <div class="w-44 h-44 mx-auto mb-4 rounded-3xl overflow-hidden shadow-md border-2 border-sky-200">
                            ${renderAlphabetHandSVG(char)}
                        </div>
                        <div class="text-left bg-amber-50 border border-amber-200 rounded-2xl p-3.5 mb-4">
                            <div class="text-[11px] font-black text-amber-700 uppercase">Cara Membentuk Tangan:</div>
                            <p class="text-xs font-bold text-gray-700 mt-1 leading-relaxed font-body">${FINGERSPELL_GUIDE[char] || 'Bentuk posisi jari mengikut abjad BIM.'}</p>
                        </div>
                        <button onclick="closeDialog()" class="w-full btn-3d btn-yellow py-3 rounded-2xl font-black text-sm uppercase">FAHAM & TUTUP</button>
                    </div>
                `
            });
        }

        function showNumberTip(num) {
            playSound('tap');
            showDialog({
                customHTML: `
                    <div class="text-center">
                        <span class="inline-block bg-emerald-100 text-duoGreenDark text-[11px] font-black px-3 py-0.5 rounded-full mb-2">Nombor Asas BIM</span>
                        <h3 class="text-2xl font-black text-gray-800 mb-3">Nombor "${num}"</h3>
                        <div class="w-44 h-44 mx-auto mb-4 rounded-3xl overflow-hidden shadow-md border-2 border-emerald-200">
                            ${renderNumberHandSVG(num)}
                        </div>
                        <div class="text-left bg-emerald-50 border border-emerald-200 rounded-2xl p-3.5 mb-4">
                            <div class="text-[11px] font-black text-duoGreenDark uppercase">Cara Membentuk Jari:</div>
                            <p class="text-xs font-bold text-gray-700 mt-1 leading-relaxed font-body">${NUMBER_GUIDE[num] || 'Bentuk posisi jari mengikut nombor BIM.'}</p>
                        </div>
                        <button onclick="closeDialog()" class="w-full btn-3d btn-green py-3 rounded-2xl font-black text-sm uppercase">FAHAM & TUTUP</button>
                    </div>
                `
            });
        }

        // Mod Latihan Kilat Ejaan Jari (Fingerspelling Quiz A-Z)
        function startFingerspellQuiz(score = 0, round = 1) {
            playSound('tap');
            const totalRounds = 5;
            if (round > totalRounds) {
                playSound('fanfare');
                const bonusXP = score * 5;
                appState.xp += bonusXP;
                saveState();
                showDialog({
                    emoji: '⚡',
                    title: 'Latihan Kilat Tamat!',
                    message: `Anda berjaya meneka ${score} daripada ${totalRounds} huruf ejaan jari BIM dengan tepat dan memperoleh +${bonusXP} XP!`,
                    confirmText: 'MANTAP!',
                    confirmClass: 'btn-green'
                });
                return;
            }

            const letters = Object.keys(FINGERSPELL_GUIDE);
            const targetLetter = letters[Math.floor(Math.random() * letters.length)];
            const distractors = letters.filter(l => l !== targetLetter).sort(() => 0.5 - Math.random()).slice(0, 3);
            const options = [targetLetter, ...distractors].sort(() => 0.5 - Math.random());

            showDialog({
                customHTML: `
                    <div class="text-center">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[11px] font-black text-amber-700 bg-amber-100 px-2.5 py-0.5 rounded-full">⚡ Soalan ${round}/${totalRounds}</span>
                            <span class="text-[11px] font-black text-duoGreen">Skor: ${score}</span>
                        </div>
                        <h3 class="text-lg font-black text-gray-800 mb-3">Huruf apakah yang ditunjukkan oleh isyarat tangan MFD ini?</h3>
                        <div class="w-40 h-40 mx-auto mb-4 rounded-3xl overflow-hidden shadow-md border-2 border-sky-200">
                            ${renderAlphabetHandSVG(targetLetter)}
                        </div>
                        <div class="grid grid-cols-2 gap-2.5 mb-3">
                            ${options.map(opt => `
                                <button onclick="checkFingerspellQuiz('${opt}', '${targetLetter}', ${score}, ${round})" 
                                    class="btn-3d btn-white py-3 rounded-2xl font-black text-xl text-gray-800 hover:border-duoBlue">
                                    ${opt}
                                </button>
                            `).join('')}
                        </div>
                        <button onclick="closeDialog()" class="text-xs font-extrabold text-gray-400 hover:text-gray-600 uppercase pt-1">Tutup Kuiz</button>
                    </div>
                `
            });
        }

        function checkFingerspellQuiz(chosen, target, score, round) {
            const isCorrect = chosen === target;
            if (isCorrect) {
                playSound('correct');
                showDialog({
                    emoji: '🎉',
                    title: `Tepat! Huruf "${target}"`,
                    message: FINGERSPELL_GUIDE[target],
                    confirmText: round < 5 ? 'SOALAN SETERUSNYA ➔' : 'LIHAT KEPUTUSAN 🏆',
                    confirmClass: 'btn-green',
                    onConfirm: () => startFingerspellQuiz(score + 1, round + 1)
                });
            } else {
                playSound('wrong');
                showDialog({
                    emoji: '💡',
                    title: `Kurang Tepat! Itu Huruf "${target}"`,
                    message: FINGERSPELL_GUIDE[target],
                    confirmText: round < 5 ? 'TERUSKAN ➔' : 'LIHAT KEPUTUSAN 🏆',
                    confirmClass: 'btn-blue',
                    onConfirm: () => startFingerspellQuiz(score, round + 1)
                });
            }
        }

        function renderDictionary() {
            const query = document.getElementById('dict-search').value.toLowerCase().trim();
            const listEl = document.getElementById('dictionary-list');
            
            const filtered = Object.values(BIM_SIGNS).filter(sign => {
                const matchCat = activeDictCategory === 'Semua' || sign.category === activeDictCategory;
                const matchText = sign.word.toLowerCase().includes(query) || 
                                  sign.en.toLowerCase().includes(query) || 
                                  sign.steps.toLowerCase().includes(query);
                return matchCat && matchText;
            });

            if (filtered.length === 0) {
                listEl.innerHTML = `
                    <div class="text-center py-10 text-gray-400">
                        <div class="text-4xl mb-2">🔍</div>
                        <p class="text-sm font-bold">Tiada perkataan ditemui untuk "${query}".</p>
                    </div>
                `;
                return;
            }

            listEl.innerHTML = filtered.map(sign => `
                <div onclick="openSignDetail('${sign.id}')" class="bg-white border-2 border-gray-200 hover:border-duoBlue rounded-2xl p-3.5 flex items-center gap-3.5 shadow-2xs active:scale-[0.99] transition cursor-pointer">
                    <div class="w-16 h-16 flex-shrink-0 rounded-xl overflow-hidden border border-gray-100">
                        ${getSignSVG(sign.svgType, '', sign.colorHex)}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-base font-black text-gray-800 truncate">${sign.word}</h3>
                            <span class="text-[10px] font-extrabold bg-sky-50 text-duoBlue px-2 py-0.5 rounded-full">${sign.en}</span>
                        </div>
                        <p class="text-xs text-gray-500 line-clamp-2 mt-1 font-body">${sign.steps}</p>
                    </div>
                    <span class="text-duoBlue font-black text-lg">›</span>
                </div>
            `).join('');
        }

        function openSignDetail(signKey) {
            playSound('tap');
            const sign = BIM_SIGNS[signKey];
            const isAlphabetModule = sign.id === 'abjad_a_z';
            const isNumberModule = sign.id === 'nombor_1_10';

            if (isAlphabetModule) {
                showDialog({
                    customHTML: `
                        <div class="text-center">
                            <span class="inline-block bg-sky-100 text-duoBlue text-[11px] font-black px-3 py-0.5 rounded-full mb-1">BI: ${sign.en}</span>
                            <h3 class="text-xl font-black text-gray-800 mb-1">${sign.word}</h3>
                            <p class="text-[11px] font-bold text-gray-500 mb-3 font-body">Ketik mana-mana huruf A–Z untuk melihat penerangan terperinci MFD:</p>
                            <div class="grid grid-cols-4 gap-2 max-h-64 overflow-y-auto bg-sky-50/70 border border-sky-200 rounded-2xl p-2.5 mb-4">
                                ${Object.keys(FINGERSPELL_GUIDE).map(ch => `
                                    <button type="button" onclick="showFingerspellTip('${ch}')" class="bg-white border border-sky-200 rounded-xl p-1.5 text-center shadow-2xs active:scale-95 transition">
                                        <div class="w-11 h-11 mx-auto rounded-lg overflow-hidden">${renderAlphabetHandSVG(ch)}</div>
                                        <div class="text-xs font-black text-gray-800 mt-0.5">${ch}</div>
                                    </button>
                                `).join('')}
                            </div>
                            <button onclick="closeDialog()" class="w-full btn-3d btn-blue py-3 rounded-2xl font-black text-sm uppercase">TUTUP PANDUAN</button>
                        </div>
                    `
                });
                return;
            }

            if (isNumberModule) {
                showDialog({
                    customHTML: `
                        <div class="text-center">
                            <span class="inline-block bg-emerald-100 text-duoGreenDark text-[11px] font-black px-3 py-0.5 rounded-full mb-1">BI: ${sign.en}</span>
                            <h3 class="text-xl font-black text-gray-800 mb-1">${sign.word}</h3>
                            <p class="text-[11px] font-bold text-gray-500 mb-3 font-body">Ketik mana-mana nombor 1–10 untuk melihat panduan jari secara terperinci:</p>
                            <div class="grid grid-cols-5 gap-2 bg-emerald-50/70 border border-emerald-200 rounded-2xl p-2.5 mb-4">
                                ${Object.keys(NUMBER_GUIDE).map(num => `
                                    <button type="button" onclick="showNumberTip('${num}')" class="bg-white border border-emerald-200 rounded-xl p-1.5 text-center shadow-2xs active:scale-95 transition">
                                        <div class="w-11 h-11 mx-auto rounded-lg overflow-hidden">${renderNumberHandSVG(num)}</div>
                                        <div class="text-xs font-black text-gray-800 mt-0.5">${num}</div>
                                    </button>
                                `).join('')}
                            </div>
                            <button onclick="closeDialog()" class="w-full btn-3d btn-green py-3 rounded-2xl font-black text-sm uppercase">TUTUP PANDUAN</button>
                        </div>
                    `
                });
                return;
            }

            showDialog({
                customHTML: `
                    <div class="text-center">
                        <span class="inline-block bg-sky-100 text-duoBlue text-[11px] font-black px-3 py-0.5 rounded-full mb-2">BI: ${sign.en}</span>
                        <h3 class="text-2xl font-black text-gray-800 mb-3">${sign.word}</h3>
                        <div class="w-44 h-40 mx-auto mb-4 border-2 border-gray-100 rounded-3xl p-2">
                            ${getSignSVG(sign.svgType, sign.animClass, sign.colorHex)}
                        </div>
                        <div class="text-left bg-emerald-50 rounded-2xl p-3 mb-2.5">
                            <div class="text-[11px] font-black text-duoGreenDark uppercase">Langkah Tangan:</div>
                            <p class="text-xs font-bold text-gray-700 mt-0.5 font-body">${sign.steps}</p>
                        </div>
                        <div class="text-left bg-amber-50 rounded-2xl p-3 mb-4">
                            <div class="text-[11px] font-black text-amber-700 uppercase">Mimik Muka:</div>
                            <p class="text-xs font-bold text-gray-700 mt-0.5 font-body">${sign.expression}</p>
                        </div>
                        <button onclick="closeDialog()" class="w-full btn-3d btn-blue py-3 rounded-2xl font-black text-sm uppercase">TUTUP PANDUAN</button>
                    </div>
                `
            });
        }

        // ==========================================
        // 9. LENCANA PENCAPAIAN & FUNGSI PROFIL
        // ==========================================
        function renderBadges() {
            const totalModules = Object.keys(BIM_SIGNS).length;
            const badges = [
                {
                    id: 'bintang_abjad',
                    icon: '🔤',
                    title: 'Juara Abjad & Nombor',
                    desc: 'Lengkapkan Unit 1 (Abjad BIM A–Z & Nombor 1–10)',
                    unlocked: UNITS[0].lessons.every(l => appState.completedLessons.includes(l))
                },
                {
                    id: 'bintang_sapaan',
                    icon: '🌟',
                    title: 'Bintang Ucapan & Sapaan',
                    desc: 'Lengkapkan semua 13 ungkapan sapaan dalam Unit 2',
                    unlocked: UNITS[1].lessons.every(l => appState.completedLessons.includes(l))
                },
                {
                    id: 'pakar_tanya',
                    icon: '❓',
                    title: 'Pakar Kata Ganti & Tanya',
                    desc: 'Lengkapkan Unit 3 (Kata Ganti Nama) & Unit 4 (Kata Tanya)',
                    unlocked: UNITS[2].lessons.every(l => appState.completedLessons.includes(l)) && UNITS[3].lessons.every(l => appState.completedLessons.includes(l))
                },
                {
                    id: 'master_bim',
                    icon: '👑',
                    title: 'Graduan Asas BIM UiTM',
                    desc: `Kuasai kesemua ${totalModules} modul dalam SignLah`,
                    unlocked: appState.completedLessons.length >= totalModules
                }
            ];

            const container = document.getElementById('badges-container');
            container.innerHTML = badges.map(b => `
                <div class="flex items-center gap-3.5 p-3.5 rounded-2xl border-2 ${b.unlocked ? 'bg-amber-50/60 border-duoYellow' : 'bg-gray-50 border-gray-200 opacity-60'}">
                    <div class="w-12 h-12 rounded-2xl ${b.unlocked ? 'bg-duoYellow text-white shadow-xs' : 'bg-gray-200 grayscale'} flex items-center justify-center text-2xl flex-shrink-0">
                        ${b.icon}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <h4 class="text-sm font-black text-gray-800">${b.title}</h4>
                            ${b.unlocked ? '<span class="text-[10px] font-black bg-duoGreen text-white px-2 py-0.5 rounded-full">DIPEROLEH</span>' : ''}
                        </div>
                        <p class="text-xs font-semibold text-gray-500 font-body">${b.desc}</p>
                    </div>
                </div>
            `).join('');
        }

        function refillHearts() {
            playSound('correct');
            appState.hearts = 5;
            saveState();
            showDialog({
                emoji: '❤️',
                title: 'Nyawa Penuh!',
                message: 'Anda kini mempunyai 5 nyawa penuh. Selamat meneruskan pembelajaran BIM!',
                confirmText: 'HEBAT!',
                confirmClass: 'btn-green'
            });
        }

        function promptResetProgress() {
            playSound('tap');
            showDialog({
                emoji: '⚠️',
                title: 'Set Semula Kemajuan?',
                message: 'Semua XP, lencana, dan pelajaran yang telah tamat akan dipadamkan.',
                confirmText: 'YA, SET SEMULA',
                confirmClass: 'btn-red',
                cancelText: 'BATAL',
                onConfirm: () => {
                    appState = { ...DEFAULT_STATE };
                    saveState();
                    renderLearningPath();
                    renderDictionary();
                }
            });
        }

        // ==========================================
        // 10. NAVIGASI TAB & DIALOG TERSUAI (NO ALERT)
        // ==========================================
        function switchTab(tabName) {
            playSound('tap');
            ['learn', 'dictionary', 'info', 'profile'].forEach(t => {
                const section = document.getElementById(`view-${t}`);
                const navBtn = document.getElementById(`nav-${t}`);
                const iconBox = navBtn.querySelector('div');

                if (t === tabName) {
                    section.classList.remove('hidden');
                    navBtn.classList.remove('text-gray-400');
                    navBtn.classList.add('text-duoGreen');
                    iconBox.classList.remove('bg-transparent');
                    iconBox.classList.add('bg-emerald-100');
                } else {
                    section.classList.add('hidden');
                    navBtn.classList.add('text-gray-400');
                    navBtn.classList.remove('text-duoGreen');
                    iconBox.classList.add('bg-transparent');
                    iconBox.classList.remove('bg-emerald-100');
                }
            });

            if (tabName === 'learn') renderLearningPath();
            if (tabName === 'dictionary') {
                renderDictionary();
                renderFingerspelling();
            }
            if (tabName === 'profile') updateStatsUI();
        }

        function showDialog({ emoji, title, message, confirmText = 'OK', confirmClass = 'btn-green', cancelText = null, onConfirm = null, customHTML = null }) {
            const dialog = document.getElementById('custom-dialog');
            const box = document.getElementById('custom-dialog-box');

            if (customHTML) {
                box.innerHTML = customHTML;
            } else {
                box.innerHTML = `
                    <div class="text-center">
                        <div class="text-5xl mb-3">${emoji}</div>
                        <h3 class="text-xl font-black text-gray-800 mb-2">${title}</h3>
                        <p class="text-sm font-semibold text-gray-600 mb-6 font-body">${message}</p>
                        <div class="space-y-2.5">
                            <button id="dlg-confirm" class="w-full btn-3d ${confirmClass} py-3.5 rounded-2xl font-black text-sm uppercase">${confirmText}</button>
                            ${cancelText ? `<button onclick="closeDialog()" class="w-full py-2.5 rounded-2xl font-extrabold text-xs text-gray-400 hover:text-gray-600 uppercase">${cancelText}</button>` : ''}
                        </div>
                    </div>
                `;
                document.getElementById('dlg-confirm').onclick = () => {
                    closeDialog();
                    if (onConfirm) onConfirm();
                };
            }

            dialog.classList.remove('hidden');
            dialog.classList.add('flex');
        }

        function closeDialog() {
            const dialog = document.getElementById('custom-dialog');
            dialog.classList.add('hidden');
            dialog.classList.remove('flex');
        }

        // ==========================================
        // 11. INISIALISASI APLIKASI
        // ==========================================
        window.addEventListener('DOMContentLoaded', () => {
            updateStatsUI();
            renderLearningPath();
            renderDictionary();
            renderFingerspelling();
        });
    </script>
</body>
</html>
