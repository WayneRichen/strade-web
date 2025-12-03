<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="拒絕存取。您沒有權限訪問此頁面。升級 {{config('app.name')}} 訂閱方案，解鎖更多專業交易功能，最多支援 10 組交易機器人與自訂槓桿倍數。">
    <meta name="keywords" content="403錯誤, 拒絕存取, 權限不足, {{config('app.name')}}, 訂閱方案, 加密貨幣交易">
    <meta name="robots" content="noindex, follow">
    <meta property="og:type" content="website">
    <meta property="og:title" content="403 - 拒絕存取 | {{config('app.name')}} 加密貨幣自動交易機器人">
    <meta property="og:description" content="此頁面需要更高的權限。升級 {{config('app.name')}} 專業方案，享受無限制交易額度、複利模式與多組機器人並行。">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="403 - 拒絕存取 | {{config('app.name')}}">
    <meta name="twitter:description" content="需要更高權限。查看 {{config('app.name')}} 訂閱方案，解鎖專業交易功能。">
    <title>403 - 拒絕存取 | {{config('app.name')}}</title>
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

        .neon-red {
            color: #FF6B6B;
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

            0%,
            100% {
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
            background: #FF6B6B;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 400px;
            height: 400px;
            background: #FFC107;
            bottom: 10%;
            right: 10%;
            animation-delay: 7s;
        }

        .shape-3 {
            width: 250px;
            height: 250px;
            background: #FF5722;
            top: 50%;
            right: 20%;
            animation-delay: 14s;
        }

        /* 403 Number Animation */
        .error-number {
            font-size: 12rem;
            font-weight: 800;
            background: linear-gradient(135deg, #FF6B6B 0%, #FF5722 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 80px rgba(255, 107, 107, 0.3);
            animation: pulse 3s infinite ease-in-out;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.05);
            }
        }

        /* Lock Icon Animation */
        .lock-icon {
            animation: shake 4s infinite ease-in-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: rotate(0deg);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: rotate(-5deg);
            }

            20%,
            40%,
            60%,
            80% {
                transform: rotate(5deg);
            }
        }

        /* Shield Pulse */
        .shield-pulse {
            animation: shieldPulse 2s infinite;
        }

        @keyframes shieldPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(255, 107, 107, 0.7);
            }

            50% {
                box-shadow: 0 0 0 20px rgba(255, 107, 107, 0);
            }
        }

        /* Warning Stripes */
        .warning-stripes {
            background: repeating-linear-gradient(45deg,
                    rgba(255, 107, 107, 0.1),
                    rgba(255, 107, 107, 0.1) 10px,
                    rgba(255, 193, 7, 0.1) 10px,
                    rgba(255, 193, 7, 0.1) 20px);
            animation: stripeMove 1s linear infinite;
        }

        @keyframes stripeMove {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 28px 0;
            }
        }

        /* Denied Badge Animation */
        .denied-badge {
            animation: deniedPulse 1.5s infinite;
        }

        @keyframes deniedPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.9;
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

    <!-- Warning Stripes -->
    <div class="fixed top-0 left-0 right-0 h-2 warning-stripes z-40"></div>
    <div class="fixed bottom-0 left-0 right-0 h-2 warning-stripes z-40"></div>

    <!-- 403 Content -->
    <section class="min-h-screen flex items-center justify-center mt-20 px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Lock Icon with Shield -->
            <div class="mb-8 flex justify-center relative">
                <div class="shield-pulse w-32 h-32 bg-red-500 bg-opacity-10 rounded-full flex items-center justify-center border-2 border-red-500">
                    <div class="lock-icon">
                        <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>
                <!-- Denied Badge -->
                <div class="denied-badge absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full border-2 border-red-400">
                    拒絕存取
                </div>
            </div>

            <!-- 403 Number -->
            <h1 class="error-number mb-6">403</h1>

            <!-- Error Message -->
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                <span class="neon-red">存取被拒絕</span>
            </h2>
            <p class="text-gray-400 text-lg mb-8 max-w-2xl mx-auto">
                抱歉,您沒有權限存取此頁面。<br class="hidden md:block">
                請確認您已登入正確的帳戶,或聯繫管理員取得存取權限。
            </p>

            <!-- Reason Cards -->
            <div class="grid md:grid-cols-3 gap-4 mb-8 max-w-3xl mx-auto">
                <div class="glass-card p-6 rounded-xl border-red-500 border-opacity-20">
                    <div class="w-12 h-12 bg-red-500 bg-opacity-10 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold mb-2">權限不足</h3>
                    <p class="text-xs text-gray-500">您的帳戶等級無法存取此功能</p>
                </div>

                <div class="glass-card p-6 rounded-xl border-yellow-500 border-opacity-20">
                    <div class="w-12 h-12 bg-yellow-500 bg-opacity-10 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold mb-2">需要登入</h3>
                    <p class="text-xs text-gray-500">此功能需要先登入帳戶</p>
                </div>

                <div class="glass-card p-6 rounded-xl border-orange-500 border-opacity-20">
                    <div class="w-12 h-12 bg-orange-500 bg-opacity-10 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold mb-2">訂閱方案</h3>
                    <p class="text-xs text-gray-500">升級方案以解鎖更多功能</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                <a href="/"
                    class="bg-neon-green text-black px-8 py-3 rounded-lg font-semibold hover-neon inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    返回首頁
                </a>
                <a href="/#pricing"
                    class="px-8 py-3 bg-gradient-to-r from-red-500 to-orange-500 rounded-lg font-semibold hover:from-red-600 hover:to-orange-600 transition text-white inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                    查看方案升級
                </a>
            </div>

            <!-- Security Notice -->
            <div class="glass-card rounded-2xl p-8 max-w-2xl mx-auto border-red-500 border-opacity-20">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <h3 class="text-lg font-bold mb-2 neon-red">安全性提醒</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            此頁面受到安全保護。如果您認為這是錯誤,請聯繫我們的客服團隊。
                            我們重視您的帳戶安全,所有存取嘗試都會被記錄。
                        </p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="text-xs px-3 py-1 bg-red-500 bg-opacity-10 border border-red-500 border-opacity-30 rounded-full">
                                IP 已記錄
                            </span>
                            <span class="text-xs px-3 py-1 bg-yellow-500 bg-opacity-10 border border-yellow-500 border-opacity-30 rounded-full">
                                存取時間已記錄
                            </span>
                            <span class="text-xs px-3 py-1 bg-orange-500 bg-opacity-10 border border-orange-500 border-opacity-30 rounded-full">
                                安全監控中
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="mt-8 text-sm text-gray-500">
                需要協助?
                <a href="mailto:support@strade.com" class="neon-green hover:underline">聯繫客服</a>
            </div>

            <!-- Error Code -->
            <p class="text-gray-600 text-sm mt-6">
                錯誤代碼: <span class="neon-red font-mono">HTTP 403 - FORBIDDEN</span>
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
        // Add keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                window.location.href = '/';
            }
            if (e.key === 'h' || e.key === 'H') {
                window.location.href = '/';
            }
            if (e.key === 'p' || e.key === 'P') {
                window.location.href = '/#pricing';
            }
        });

        // Security animation effect
        const securityBadges = document.querySelectorAll('.denied-badge');
        securityBadges.forEach(badge => {
            setInterval(() => {
                badge.style.opacity = badge.style.opacity === '0.7' ? '1' : '0.7';
            }, 1000);
        });
    </script>
</body>

</html>
