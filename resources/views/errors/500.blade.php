<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - 伺服器錯誤 | {{config('app.name')}}</title>
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

        .neon-purple {
            color: #A78BFA;
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
            background: #8B5CF6;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 400px;
            height: 400px;
            background: #EC4899;
            bottom: 10%;
            right: 10%;
            animation-delay: 7s;
        }

        .shape-3 {
            width: 250px;
            height: 250px;
            background: #6366F1;
            top: 50%;
            right: 20%;
            animation-delay: 14s;
        }

        /* 500 Number Animation */
        .error-number {
            font-size: 12rem;
            font-weight: 800;
            background: linear-gradient(135deg, #8B5CF6 0%, #EC4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 80px rgba(139, 92, 246, 0.3);
            animation: glitchPulse 4s infinite ease-in-out;
        }

        @keyframes glitchPulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            25% {
                opacity: 0.8;
                transform: scale(1.02) translateX(-2px);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            75% {
                opacity: 0.8;
                transform: scale(1.02) translateX(2px);
            }
        }

        /* Server Icon Animation */
        .server-icon {
            animation: serverBlink 3s infinite;
        }

        @keyframes serverBlink {
            0%, 90%, 100% {
                opacity: 1;
            }
            45%, 55% {
                opacity: 0.3;
            }
        }

        /* Circuit Lines */
        .circuit-line {
            stroke-dasharray: 1000;
            stroke-dashoffset: 1000;
            animation: drawLine 3s ease-in-out infinite;
        }

        @keyframes drawLine {
            0% {
                stroke-dashoffset: 1000;
            }
            50% {
                stroke-dashoffset: 0;
            }
            100% {
                stroke-dashoffset: -1000;
            }
        }

        /* Status Indicator */
        .status-dot {
            animation: statusPulse 2s infinite;
        }

        @keyframes statusPulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.5;
                transform: scale(1.2);
            }
        }

        /* Loading Bar */
        .loading-bar {
            width: 0%;
            animation: loading 3s ease-in-out infinite;
        }

        @keyframes loading {
            0% {
                width: 0%;
            }
            50% {
                width: 70%;
            }
            100% {
                width: 100%;
            }
        }

        /* Code Rain Effect */
        .code-rain {
            opacity: 0.1;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            color: #8B5CF6;
            animation: rain 15s linear infinite;
        }

        @keyframes rain {
            0% {
                transform: translateY(-100%);
            }
            100% {
                transform: translateY(100vh);
            }
        }

        @media (max-width: 768px) {
            .error-number {
                font-size: 8rem;
            }
        }
    </style>
</head>

<body class="text-white">
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

    <!-- Code Rain Background -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="code-rain absolute" style="left: 10%; animation-delay: 0s;">01010011<br>01010100<br>01010010</div>
        <div class="code-rain absolute" style="left: 30%; animation-delay: 2s;">01000001<br>01000100<br>01000101</div>
        <div class="code-rain absolute" style="left: 50%; animation-delay: 4s;">01000101<br>01010010<br>01010010</div>
        <div class="code-rain absolute" style="left: 70%; animation-delay: 6s;">01001111<br>01010010<br>00110101</div>
        <div class="code-rain absolute" style="left: 90%; animation-delay: 8s;">00110000<br>00110000<br>00001010</div>
    </div>

    <!-- 500 Content -->
    <section class="min-h-screen flex items-center justify-center px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Server Icon with Circuit -->
            <div class="mb-8 flex justify-center relative">
                <svg class="absolute w-64 h-64 opacity-10" viewBox="0 0 200 200">
                    <path class="circuit-line" d="M 10 100 L 50 100 L 60 90 L 70 110 L 80 100 L 120 100" 
                          stroke="#8B5CF6" stroke-width="2" fill="none"/>
                    <path class="circuit-line" d="M 100 10 L 100 50 L 110 60 L 90 70 L 100 80 L 100 120" 
                          stroke="#EC4899" stroke-width="2" fill="none" style="animation-delay: 1s;"/>
                    <path class="circuit-line" d="M 190 100 L 150 100 L 140 90 L 130 110 L 120 100 L 80 100" 
                          stroke="#6366F1" stroke-width="2" fill="none" style="animation-delay: 2s;"/>
                </svg>
                
                <div class="server-icon w-32 h-32 bg-purple-500 bg-opacity-10 rounded-2xl flex items-center justify-center border-2 border-purple-500 relative z-10">
                    <svg class="w-16 h-16 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                    </svg>
                </div>

                <!-- Status Indicators -->
                <div class="absolute -top-2 -right-2 flex space-x-1">
                    <div class="status-dot w-3 h-3 bg-red-500 rounded-full"></div>
                    <div class="status-dot w-3 h-3 bg-yellow-500 rounded-full" style="animation-delay: 0.3s;"></div>
                    <div class="status-dot w-3 h-3 bg-red-500 rounded-full" style="animation-delay: 0.6s;"></div>
                </div>
            </div>

            <!-- 500 Number -->
            <h1 class="error-number mb-6">500</h1>

            <!-- Error Message -->
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                伺服器發生<span class="neon-purple">內部錯誤</span>
            </h2>
            <p class="text-gray-400 text-lg mb-8 max-w-2xl mx-auto">
                我們的伺服器目前遇到了一些技術問題。<br class="hidden md:block">
                工程團隊已經收到通知，正在全力修復中。請稍後再試。
            </p>

            <!-- Loading Bar -->
            <div class="max-w-md mx-auto mb-12">
                <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                    <span>系統診斷中</span>
                    <span class="font-mono">...</span>
                </div>
                <div class="w-full h-2 bg-gray-800 rounded-full overflow-hidden">
                    <div class="loading-bar h-full bg-gradient-to-r from-purple-500 via-pink-500 to-indigo-500"></div>
                </div>
            </div>

            <!-- Status Cards -->
            <div class="grid md:grid-cols-3 gap-4 mb-8 max-w-3xl mx-auto">
                <div class="glass-card p-6 rounded-xl border-purple-500 border-opacity-20">
                    <div class="w-12 h-12 bg-purple-500 bg-opacity-10 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold mb-2">資料庫連線</h3>
                    <div class="flex items-center justify-center space-x-2">
                        <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                        <p class="text-xs text-gray-500">檢查中</p>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-xl border-pink-500 border-opacity-20">
                    <div class="w-12 h-12 bg-pink-500 bg-opacity-10 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold mb-2">API 服務</h3>
                    <div class="flex items-center justify-center space-x-2">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></div>
                        <p class="text-xs text-gray-500">重啟中</p>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-xl border-indigo-500 border-opacity-20">
                    <div class="w-12 h-12 bg-indigo-500 bg-opacity-10 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold mb-2">快取系統</h3>
                    <div class="flex items-center justify-center space-x-2">
                        <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                        <p class="text-xs text-gray-500">異常</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                <button onclick="location.reload()"
                    class="bg-neon-green text-black px-8 py-3 rounded-lg font-semibold hover-neon inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    重新整理
                </button>
                <a href="/"
                    class="px-8 py-3 bg-white bg-opacity-5 border border-gray-700 rounded-lg hover:border-neon-green transition text-white inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    返回首頁
                </a>
            </div>

            <!-- Technical Details -->
            <div class="glass-card rounded-2xl p-8 max-w-2xl mx-auto border-purple-500 border-opacity-20">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <h3 class="text-lg font-bold mb-2 neon-purple">可能的原因</h3>
                        <ul class="text-gray-400 text-sm space-y-2 leading-relaxed">
                            <li class="flex items-start">
                                <span class="text-purple-500 mr-2">•</span>
                                <span>伺服器負載過高，正在處理大量請求</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-purple-500 mr-2">•</span>
                                <span>資料庫連線暫時中斷</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-purple-500 mr-2">•</span>
                                <span>系統正在進行維護更新</span>
                            </li>
                        </ul>
                        <div class="mt-6 p-4 bg-purple-500 bg-opacity-5 border border-purple-500 border-opacity-20 rounded-lg">
                            <p class="text-xs text-gray-400">
                                <span class="font-semibold neon-purple">預計修復時間:</span>
                                我們的工程團隊正在處理，通常在 5-15 分鐘內恢復正常。
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="mt-8 text-sm text-gray-500">
                如果問題持續發生,請聯繫
                <a href="mailto:support@strade.com" class="neon-green hover:underline">技術支援團隊</a>
            </div>

            <!-- Error Code -->
            <p class="text-gray-600 text-sm mt-6 font-mono">
                錯誤代碼: <span class="neon-purple">HTTP 500 - INTERNAL SERVER ERROR</span>
            </p>
            <p class="text-gray-700 text-xs mt-2 font-mono">
                Request ID: <?php echo bin2hex(random_bytes(8)); ?>
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
        // Auto refresh countdown (optional)
        let countdown = 30;
        const updateCountdown = setInterval(() => {
            countdown--;
            if (countdown <= 0) {
                clearInterval(updateCountdown);
                // Uncomment to enable auto-refresh
                // location.reload();
            }
        }, 1000);

        // Add keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'r' || e.key === 'R') {
                location.reload();
            }
            if (e.key === 'h' || e.key === 'H') {
                window.location.href = '/';
            }
            if (e.key === 'Escape') {
                window.location.href = '/';
            }
        });

        // Simulate status updates (for demo purposes)
        const statusDots = document.querySelectorAll('.status-dot');
        setInterval(() => {
            statusDots.forEach((dot, index) => {
                setTimeout(() => {
                    const colors = ['bg-red-500', 'bg-yellow-500', 'bg-green-500'];
                    const currentColor = colors[Math.floor(Math.random() * colors.length)];
                    dot.className = `status-dot w-3 h-3 ${currentColor} rounded-full`;
                }, index * 200);
            });
        }, 3000);
    </script>
</body>

</html>
