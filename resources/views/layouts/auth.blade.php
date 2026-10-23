<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'DuREN' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .highlight-badge {
            display: inline-block;
            background-color: #F2D98A;
            color: #1F261D;
            padding: 8px 16px;
            border-radius: 8px;
            transform: rotate(2deg);
            box-shadow: 0 3px 8px rgba(92, 74, 18, 0.1);
        }
    </style>
</head>
<body class="bg-white relative antialiased flex flex-col items-center justify-center min-h-screen w-full overflow-x-hidden font-sans py-8">

    <!-- ==================== EMPAT ORNAMEN POJOK (280px x 280px, terpotong 60px, z-0) ==================== -->
    <!-- 1. Pojok Kiri Atas: Blob pastel #E8F3E1, Durian utuh duri runcing (Badan #CFE6C5, duri #B7D7A8) -->
    <div class="fixed -top-[60px] -left-[60px] w-[280px] h-[280px] pointer-events-none z-0">
        <svg class="w-full h-full" fill="none" viewBox="0 0 280 280" xmlns="http://www.w3.org/2000/svg">
            <path d="M35 5C105 -15 190 25 225 90C260 155 240 220 175 240C105 255 25 220 5 165C-20 110 -30 20 35 5Z" fill="#E8F3E1"></path>
            <g transform="translate(50, 50)">
                <path d="M70 24 C 70 8, 86 8, 86 24 Z" fill="#6B7366"></path>
                <ellipse cx="78" cy="95" fill="#CFE6C5" rx="58" ry="70"></ellipse>
                <!-- Outer thorns -->
                <polygon fill="#B7D7A8" points="78,18 73,28 83,28"></polygon>
                <polygon fill="#B7D7A8" points="98,22 92,33 104,31"></polygon>
                <polygon fill="#B7D7A8" points="118,32 110,42 122,43"></polygon>
                <polygon fill="#B7D7A8" points="133,48 123,56 133,61"></polygon>
                <polygon fill="#B7D7A8" points="143,70 131,76 139,84"></polygon>
                <polygon fill="#B7D7A8" points="146,94 133,96 140,106"></polygon>
                <polygon fill="#B7D7A8" points="142,118 130,117 135,127"></polygon>
                <polygon fill="#B7D7A8" points="130,140 119,135 121,146"></polygon>
                <polygon fill="#B7D7A8" points="110,156 102,148 101,160"></polygon>
                <polygon fill="#B7D7A8" points="87,168 81,157 77,170"></polygon>
                <polygon fill="#B7D7A8" points="63,166 66,155 58,164"></polygon>
                <polygon fill="#B7D7A8" points="43,153 50,144 40,149"></polygon>
                <polygon fill="#B7D7A8" points="26,134 36,128 28,122"></polygon>
                <polygon fill="#B7D7A8" points="17,111 29,108 22,99"></polygon>
                <polygon fill="#B7D7A8" points="17,86 29,86 23,77"></polygon>
                <polygon fill="#B7D7A8" points="25,62 36,66 31,55"></polygon>
                <polygon fill="#B7D7A8" points="39,41 48,48 45,37"></polygon>
                <polygon fill="#B7D7A8" points="57,26 63,37 69,29"></polygon>
                <!-- Inner thorns -->
                <polygon fill="#B7D7A8" points="61,54 57,64 67,62"></polygon>
                <polygon fill="#B7D7A8" points="80,48 75,58 85,58"></polygon>
                <polygon fill="#B7D7A8" points="98,56 92,66 103,66"></polygon>
                <polygon fill="#B7D7A8" points="49,78 45,89 56,87"></polygon>
                <polygon fill="#B7D7A8" points="70,76 64,87 75,87"></polygon>
                <polygon fill="#B7D7A8" points="90,74 83,84 95,85"></polygon>
                <polygon fill="#B7D7A8" points="110,78 104,88 115,87"></polygon>
                <polygon fill="#B7D7A8" points="57,105 52,115 62,115"></polygon>
                <polygon fill="#B7D7A8" points="78,102 72,113 83,113"></polygon>
                <polygon fill="#B7D7A8" points="98,103 92,113 103,113"></polygon>
                <polygon fill="#B7D7A8" points="65,130 60,140 70,140"></polygon>
                <polygon fill="#B7D7A8" points="88,128 82,138 93,138"></polygon>
            </g>
        </svg>
    </div>

    <!-- 2. Pojok Kanan Atas: Blob pastel #FAF1CE, Durian utuh duri renggang (Badan #F2D98A, duri #EBD27A) -->
    <div class="fixed -top-[60px] -right-[60px] w-[280px] h-[280px] pointer-events-none z-0">
        <svg class="w-full h-full" fill="none" viewBox="0 0 280 280" xmlns="http://www.w3.org/2000/svg">
            <path d="M245 15C280 80 260 165 210 215C165 265 80 255 30 205C-20 155 -10 80 40 30C90 -20 215 -50 245 15Z" fill="#FAF1CE"></path>
            <g transform="translate(65, 50)">
                <path d="M60 20 C 56 8, 70 6, 70 20 Z" fill="#7A6420"></path>
                <ellipse cx="65" cy="92" fill="#F2D98A" rx="60" ry="70"></ellipse>
                <!-- Sparse thorns -->
                <polygon fill="#EBD27A" points="65,16 56,25 74,25"></polygon>
                <polygon fill="#EBD27A" points="98,26 88,36 104,39"></polygon>
                <polygon fill="#EBD27A" points="123,54 110,60 122,71"></polygon>
                <polygon fill="#EBD27A" points="131,92 117,92 123,105"></polygon>
                <polygon fill="#EBD27A" points="120,126 108,121 113,135"></polygon>
                <polygon fill="#EBD27A" points="93,153 85,142 98,147"></polygon>
                <polygon fill="#EBD27A" points="62,166 54,154 70,154"></polygon>
                <polygon fill="#EBD27A" points="31,149 39,139 27,140"></polygon>
                <polygon fill="#EBD27A" points="10,118 22,112 16,124"></polygon>
                <polygon fill="#EBD27A" points="6,79 19,80 13,69"></polygon>
                <polygon fill="#EBD27A" points="23,43 35,50 26,58"></polygon>
                <!-- Interior sparse thorns -->
                <polygon fill="#EBD27A" points="46,58 36,68 56,68"></polygon>
                <polygon fill="#EBD27A" points="84,62 74,72 94,72"></polygon>
                <polygon fill="#EBD27A" points="65,88 54,100 76,100"></polygon>
                <polygon fill="#EBD27A" points="41,110 31,121 51,121"></polygon>
                <polygon fill="#EBD27A" points="88,111 78,121 98,121"></polygon>
            </g>
        </svg>
    </div>

    <!-- 3. Pojok Kiri Bawah: Blob pastel #FFF3C9, Durian duri bulat tumpul (Badan #FBDDC6, duri #EFC3A3) -->
    <div class="fixed -bottom-[60px] -left-[60px] w-[280px] h-[280px] pointer-events-none z-0">
        <svg class="w-full h-full" fill="none" viewBox="0 0 280 280" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 100C-10 175 40 250 105 265C170 280 245 225 255 160C265 95 200 25 135 15C70 5 40 25 15 100Z" fill="#FFF3C9"></path>
            <g transform="translate(50, 58)">
                <ellipse cx="75" cy="80" fill="#FBDDC6" rx="60" ry="67"></ellipse>
                <rect fill="#7A6420" height="15" rx="5" width="10" x="70" y="8"></rect>
                <circle cx="75" cy="18" fill="#EFC3A3" r="7.5"></circle>
                <circle cx="102" cy="27" fill="#EFC3A3" r="7.5"></circle>
                <circle cx="123" cy="46" fill="#EFC3A3" r="7.5"></circle>
                <circle cx="134" cy="73" fill="#EFC3A3" r="7.5"></circle>
                <circle cx="131" cy="102" fill="#EFC3A3" r="7.5"></circle>
                <circle cx="117" cy="126" fill="#EFC3A3" r="7.5"></circle>
                <circle cx="94" cy="142" fill="#EFC3A3" r="7.5"></circle>
                <circle cx="65" cy="144" fill="#EFC3A3" r="7.5"></circle>
                <circle cx="40" cy="130" fill="#EFC3A3" r="7.5"></circle>
                <circle cx="23" cy="107" fill="#EFC3A3" r="7.5"></circle>
                <circle cx="18" cy="79" fill="#EFC3A3" r="7.5"></circle>
                <circle cx="28" cy="52" fill="#EFC3A3" r="7.5"></circle>
                <circle cx="48" cy="30" fill="#EFC3A3" r="7.5"></circle>
                <circle cx="75" cy="43" fill="#EFC3A3" r="6.5"></circle>
                <circle cx="98" cy="53" fill="#EFC3A3" r="6.5"></circle>
                <circle cx="110" cy="79" fill="#EFC3A3" r="6.5"></circle>
                <circle cx="103" cy="105" fill="#EFC3A3" r="6.5"></circle>
                <circle cx="79" cy="120" fill="#EFC3A3" r="6.5"></circle>
                <circle cx="53" cy="113" fill="#EFC3A3" r="6.5"></circle>
                <circle cx="42" cy="88" fill="#EFC3A3" r="6.5"></circle>
                <circle cx="52" cy="62" fill="#EFC3A3" r="6.5"></circle>
                <circle cx="75" cy="70" fill="#EFC3A3" r="6.5"></circle>
                <circle cx="88" cy="87" fill="#EFC3A3" r="6.5"></circle>
                <circle cx="67" cy="93" fill="#EFC3A3" r="6.5"></circle>
            </g>
        </svg>
    </div>

    <!-- 4. Pojok Kanan Bawah: Blob pastel #E8F3E1, Irisan durian terbelah 3 lobus (Badan #F2D98A, duri #B7D7A8) -->
    <div class="fixed -bottom-[60px] -right-[60px] w-[280px] h-[280px] pointer-events-none z-0">
        <svg class="w-full h-full" fill="none" viewBox="0 0 280 280" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 35C165 -10 240 15 265 85C290 150 265 235 200 260C135 285 70 250 35 185C0 120 35 75 100 35Z" fill="#E8F3E1"></path>
            <g transform="translate(68, 60)">
                <polygon fill="#B7D7A8" points="20,70 9,66 16,79"></polygon>
                <polygon fill="#B7D7A8" points="29,100 15,102 23,113"></polygon>
                <polygon fill="#B7D7A8" points="48,130 35,138 47,146"></polygon>
                <polygon fill="#B7D7A8" points="79,153 71,165 85,166"></polygon>
                <polygon fill="#B7D7A8" points="117,156 115,170 127,166"></polygon>
                <polygon fill="#B7D7A8" points="149,138 156,151 164,141"></polygon>
                <polygon fill="#B7D7A8" points="164,109 176,116 174,102"></polygon>
                <path d="M25 58 Q 17 134 92 160 Q 168 151 168 92 C 151 101 126 109 92 109 C 58 109 37 92 25 58 Z" fill="#B7D7A8"></path>
                <path d="M32 65 Q 25 126 92 151 Q 160 143 161 97 C 134 105 117 101 92 101 C 63 101 44 88 32 65 Z" fill="#F1F5E8"></path>
                <g transform="translate(35, 50)">
                    <ellipse cx="27" cy="37" fill="#F2D98A" rx="22" ry="32" transform="rotate(-18 27 37)"></ellipse>
                    <ellipse cx="22" cy="30" fill="#FAF1CE" rx="12" ry="18" transform="rotate(-18 22 30)"></ellipse>
                    <ellipse cx="32" cy="44" fill="#FFF3C9" rx="6" ry="9" transform="rotate(-18 32 44)"></ellipse>
                    <ellipse cx="32" cy="44" fill="#EEDFA6" rx="3.5" ry="6" transform="rotate(-18 32 44)"></ellipse>
                </g>
                <g transform="translate(79, 55)">
                    <ellipse cx="28" cy="34" fill="#F2D98A" rx="23" ry="30" transform="rotate(22 28 34)"></ellipse>
                    <ellipse cx="31" cy="29" fill="#FAF1CE" rx="12" ry="17" transform="rotate(22 31 29)"></ellipse>
                    <ellipse cx="23" cy="41" fill="#FFF3C9" rx="5" ry="8" transform="rotate(22 23 41)"></ellipse>
                    <ellipse cx="23" cy="41" fill="#EEDFA6" rx="3" ry="5" transform="rotate(22 23 41)"></ellipse>
                </g>
                <g transform="translate(62, 25)">
                    <ellipse cx="17" cy="18" fill="#F2D98A" rx="13" ry="18" transform="rotate(5 17 18)"></ellipse>
                    <ellipse cx="15" cy="15" fill="#FAF1CE" rx="7" ry="10"></ellipse>
                    <ellipse cx="17" cy="22" fill="#EEDFA6" rx="3" ry="5"></ellipse>
                </g>
            </g>
        </svg>
    </div>

    <!-- WRAPPER KONTEN (z-10 di atas ornamen) -->
    <div class="relative z-10 w-full flex flex-col items-center justify-center">
        @yield('content')
    </div>

</body>
</html>
