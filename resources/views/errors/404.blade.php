<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - 找不到頁面 | {{config('app.name')}}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #0F1419;
        }

        .neon-green {
            color: #E3FF7A;
        }

        .bg-neon-green {
            background-color: #E3FF7A;
        }

        .hover-neon {
            transition: all 0.3s ease;
        }

        .hover-neon:hover {
            box-shadow: 0 0 20px rgba(198, 255, 0, 0.5);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }

        /* Animated Background */
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            animation: float 20s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(50px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-50px, 50px) scale(0.9);
            }
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: #E3FF7A;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 400px;
            height: 400px;
            background: #3B82F6;
            bottom: 10%;
            right: 10%;
            animation-delay: 7s;
        }

        .shape-3 {
            width: 250px;
            height: 250px;
            background: #8B5CF6;
            top: 50%;
            right: 20%;
            animation-delay: 14s;
        }

        /* 404 Number Animation */
        .error-number {
            font-size: 12rem;
            font-weight: 800;
            background: linear-gradient(135deg, #E3FF7A 0%, #C6FF00 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 80px rgba(227, 255, 122, 0.3);
            animation: pulse 3s infinite ease-in-out;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.8;
                transform: scale(1.05);
            }
        }

        /* Glitch Effect */
        .glitch {
            position: relative;
        }

        .glitch::before,
        .glitch::after {
            content: '404';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #E3FF7A 0%, #C6FF00 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glitch::before {
            animation: glitch-1 2.5s infinite;
            clip-path: polygon(0 0, 100% 0, 100% 45%, 0 45%);
        }

        .glitch::after {
            animation: glitch-2 2.5s infinite;
            clip-path: polygon(0 55%, 100% 55%, 100% 100%, 0 100%);
        }

        @keyframes glitch-1 {
            0%, 100% {
                transform: translate(0);
            }
            33% {
                transform: translate(-2px, 2px);
            }
            66% {
                transform: translate(2px, -2px);
            }
        }

        @keyframes glitch-2 {
            0%, 100% {
                transform: translate(0);
            }
            33% {
                transform: translate(2px, -2px);
            }
            66% {
                transform: translate(-2px, 2px);
            }
        }

        /* Crypto Icon Animation */
        .crypto-icon {
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .error-number {
                font-size: 8rem;
            }
        }
    </style>
</head>

<body class="text-white ">
    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 bg-opacity-90 backdrop-blur-md"
        style="background-color: rgba(15, 20, 25, 0.95);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-neon-green rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold">{{config('app.name')}}</span>
                </a>
                <div class="flex items-center space-x-4">
                    <a href="/"
                        class="bg-neon-green text-black px-6 py-2 rounded-lg font-semibold hover-neon">返回首頁</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Animated Background -->
    <div class="fixed inset-0 opacity-20 pointer-events-none">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
    </div>

    <!-- 404 Content -->
    <section class="min-h-screen flex items-center justify-center px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Crypto Icon -->
            <div class="mb-8 flex justify-center">
                <div class="crypto-icon w-24 h-24 bg-neon-green bg-opacity-10 rounded-full flex items-center justify-center border-2 border-neon-green">
                    <svg class="w-12 h-12 neon-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>

            <!-- 404 Number with Glitch Effect -->
            <h1 class="error-number glitch mb-6">404</h1>

            <!-- Error Message -->
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                糟糕!找不到這個頁面
            </h2>
            <p class="text-gray-400 text-lg mb-8 max-w-2xl mx-auto">
                您訪問的頁面似乎已經消失在區塊鏈的某個節點中了。<br class="hidden md:block">
                讓我們幫您找回正確的路徑。
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                <a href="/"
                    class="bg-neon-green text-black px-8 py-3 rounded-lg font-semibold hover-neon inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    返回首頁
                </a>
                <button onclick="history.back()"
                    class="px-8 py-3 bg-white bg-opacity-5 border border-gray-700 rounded-lg hover:border-neon-green transition text-white inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    返回上一頁
                </button>
            </div>

            <!-- Quick Links -->
            <div class="glass-card rounded-2xl p-8 max-w-2xl mx-auto">
                <h3 class="text-xl font-bold mb-6 neon-green">快速連結</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="/#features" class="p-4 bg-white bg-opacity-5 rounded-lg hover:bg-opacity-10 transition text-center">
                        <svg class="w-8 h-8 neon-green mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <div class="text-sm font-semibold">功能特色</div>
                    </a>
                    <a href="/#market" class="p-4 bg-white bg-opacity-5 rounded-lg hover:bg-opacity-10 transition text-center">
                        <svg class="w-8 h-8 neon-green mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <div class="text-sm font-semibold">近期績效</div>
                    </a>
                    <a href="/#calculator" class="p-4 bg-white bg-opacity-5 rounded-lg hover:bg-opacity-10 transition text-center">
                        <svg class="w-8 h-8 neon-green mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <div class="text-sm font-semibold">回測試算</div>
                    </a>
                    <a href="/#pricing" class="p-4 bg-white bg-opacity-5 rounded-lg hover:bg-opacity-10 transition text-center">
                        <svg class="w-8 h-8 neon-green mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm font-semibold">價格方案</div>
                    </a>
                </div>
            </div>

            <!-- Error Code -->
            <p class="text-gray-600 text-sm mt-8">
                錯誤代碼: <span class="neon-green font-mono">HTTP 404 - NOT FOUND</span>
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-800 py-8 px-4 relative z-10">
        <div class="max-w-7xl mx-auto text-center text-sm text-gray-400">
            <p>&copy; <?= date('Y', time()) ?> {{config('app.name')}} Services Inc. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="/#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                // Allow the link to navigate to home page with hash
            });
        });

        // Add keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' || e.key === 'Backspace') {
                window.history.back();
            }
            if (e.key === 'h' || e.key === 'H') {
                window.location.href = '/';
            }
        });
    </script>
</body>

</html>
