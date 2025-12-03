<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{config('app.name')}} 提供專業的加密貨幣自動交易機器人服務。24/7 執行趨勢追蹤策略，內建風險控管與停損機制，支援 Bitget 交易所。立即免費開始，讓獲利自動化。">
    <meta name="keywords" content="加密貨幣交易, 自動交易機器人, 量化交易, 趨勢追蹤策略, Bitcoin, BTC, Bitget, 加密貨幣投資, 自動化交易, {{config('app.name')}}">
    <meta name="author" content="{{config('app.name')}} Services Inc.">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{config('app.url')}}">
    <meta property="og:title" content="{{config('app.name')}} - 加密貨幣自動交易機器人 | 24/7 趨勢追蹤策略">
    <meta property="og:description" content="專業量化交易策略，24/7 自動執行。趨勢追蹤、風險控管、歷史績效回測。支援 Bitget 交易所，免費開始使用。">
    <meta property="og:image:alt" content="{{config('app.name')}} 加密貨幣自動交易機器人">
    <meta property="og:site_name" content="{{config('app.name')}}">
    <meta property="og:locale" content="zh_TW">
    <meta name="twitter:url" content="{{config('app.url')}}">
    <meta name="twitter:title" content="Strade - 加密貨幣自動交易機器人">
    <meta name="twitter:description" content="24/7 自動執行趨勢追蹤策略，風險控管，讓獲利自動化。支援 Bitget，免費開始。">
    <meta name="twitter:site" content="@Strade">
    <meta name="twitter:creator" content="@Strade">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="canonical" href="{{config('app.url')}}">
    <link rel="alternate" hreflang="zh-TW" href="{{config('app.url')}}">
    <link rel="alternate" hreflang="x-default" href="{{config('app.url')}}">
    <title>{{config('app.name')}} - 加密貨幣自動交易機器人</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

        .crypto-badge {
            background: rgba(198, 255, 0, 0.1);
            border: 1px solid rgba(198, 255, 0, 0.2);
        }

        .gradient-border {
            position: relative;
            background: linear-gradient(135deg, rgba(198, 255, 0, 0.1), rgba(198, 255, 0, 0.05));
            border: 1px solid rgba(198, 255, 0, 0.2);
        }

        /* Custom Toggle Switch */
        .toggle-switch {
            position: relative;
            width: 52px;
            height: 28px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toggle-switch.active {
            background: #C6FF00;
        }

        .toggle-slider {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .toggle-switch.active .toggle-slider {
            transform: translateX(24px);
            background: #0F1419;
        }

        /* Flatpickr Dark Theme Customization */
        .flatpickr-calendar {
            background: rgba(15, 20, 25, 0.98) !important;
            border: 1px solid rgba(198, 255, 0, 0.2) !important;
            box-shadow: 0 0 20px rgba(198, 255, 0, 0.1) !important;
        }

        .flatpickr-months {
            background: transparent !important;
        }

        .flatpickr-month {
            color: #C6FF00 !important;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months {
            background: rgba(255, 255, 255, 0.05) !important;
            color: white !important;
        }

        .flatpickr-day {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .flatpickr-day:hover {
            background: rgba(198, 255, 0, 0.2) !important;
            color: white !important;
        }

        .flatpickr-day.selected {
            background: #C6FF00 !important;
            color: #0F1419 !important;
            font-weight: bold;
        }

        .flatpickr-day.today {
            border-color: #C6FF00 !important;
        }

        .flatpickr-weekday {
            color: #C6FF00 !important;
        }

        .numInputWrapper:hover,
        .flatpickr-monthDropdown-months:hover {
            background: rgba(198, 255, 0, 0.1) !important;
        }
    </style>
</head>

<body class="text-white">
    <!-- Navigation -->
    <nav class="fixed w-full top-0 z-50 bg-opacity-90 backdrop-blur-md"
        style="background-color: rgba(15, 20, 25, 0.95);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-neon-green rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-black"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M4 17 L9 11 L13 14 L18 8 L20 9" />
                            <circle cx="4" cy="17" r="1.1" fill="currentColor" />
                            <circle cx="9" cy="11" r="1.1" fill="currentColor" />
                            <circle cx="13" cy="14" r="1.1" fill="currentColor" />
                            <circle cx="18" cy="8" r="1.1" fill="currentColor" />
                            <circle cx="20" cy="9" r="1.1" fill="currentColor" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight">{{ config('app.name') }}</span>
                </div>

                <div class="hidden md:flex space-x-8">
                    <a href="#features" class="text-gray-400 hover:text-white transition">功能特色</a>
                    <a href="#market" class="text-gray-400 hover:text-white transition">近期績效</a>
                    <a href="#calculator" class="text-gray-400 hover:text-white transition">回測試算</a>
                    <a href="#pricing" class="text-gray-400 hover:text-white transition">價格方案</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('filament.account.pages.dashboard') }}"
                        class="bg-neon-green text-black px-6 py-2 rounded-lg font-semibold hover-neon">登入</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 left-10 w-72 h-72 bg-neon-green rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500 rounded-full filter blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="grid gap-12 items-center">
                <div class="mx-auto text-center">
                    <h1 class="mt-14 text-5xl md:text-6xl font-bold mb-6">
                        跟隨策略交易<br />讓獲利<span class="neon-green md:leading-[1.1]">自動化</span><br />
                    </h1>
                    <p class="text-gray-400 text-lg mb-8 leading-relaxed">
                        策略交易機器人 24/7 不間斷執行策略
                    </p>
                    <div class="flex flex-col justify-center sm:flex-row gap-4">
                        <a href="#calculator"
                            class="bg-neon-green text-black px-8 py-3 rounded-lg font-semibold hover-neon">回測試算</a>
                        <a href="{{ route('filament.account.pages.dashboard') }}"
                            class="px-6 py-3 bg-white bg-opacity-5 border border-gray-700 rounded-lg focus:outline-none focus:border-neon-green text-white">免費開始</a>
                    </div>
                    <div class="flex items-center space-x-6 mt-8 mb-4 text-sm text-gray-400">
                        <div class="flex mx-auto items-center space-x-2">
                            <svg class="w-5 h-5 neon-green" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>支援交易所：Bitget</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 px-4 bg-black bg-opacity-30">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <div class="text-sm neon-green font-semibold mb-2">專業量化交易策略，讓你更有效率地掌握加密貨幣市場</div>
                <h2 class="text-4xl font-bold">為什麼選擇 {{config('app.name')}}？</h2>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <div class="glass-card rounded-2xl p-8 text-center hover:border-neon-green transition">
                    <div
                        class="w-16 h-16 bg-neon-green bg-opacity-10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">趨勢追蹤策略</h3>
                    <p class="text-gray-400">偵測市場趨勢，在上漲初期自動進場，盡可能掌握主要漲幅。</p>
                </div>

                <div class="glass-card rounded-2xl p-8 text-center hover:border-neon-green transition">
                    <div
                        class="w-16 h-16 bg-neon-green bg-opacity-10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">24/7 自動化交易</h3>
                    <p class="text-gray-400">無需盯盤，系統全天候監控市場，依照策略即時執行交易。
                    </p>
                </div>

                <div class="glass-card rounded-2xl p-8 text-center hover:border-neon-green transition">
                    <div
                        class="w-16 h-16 bg-neon-green bg-opacity-10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">風險控管</h3>
                    <p class="text-gray-400">內建停損機制，嚴格控管每筆交易風險，優先保護你的資金安全。</p>
                </div>

                <div class="glass-card rounded-2xl p-8 text-center hover:border-neon-green transition">
                    <div
                        class="w-16 h-16 bg-neon-green bg-opacity-10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">歷史績效回測</h3>
                    <p class="text-gray-400">策略經過長期歷史資料驗證，即使在熊市中，表現仍有機會優於大盤。</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Market Live Section -->
    <section id="market" class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <div class="text-sm neon-green font-semibold mb-2">BTC 追漲趨勢策略</div>
                <h2 class="text-4xl font-bold">近期策略績效</h2>
            </div>

            <div class="glass-card rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="border-b border-gray-800">
                            <tr>
                                <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">開倉時間</th>
                                <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">開倉價格</th>
                                <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">關倉時間</th>
                                <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">關倉價格</th>
                                <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">損益</th>
                            </tr>
                        </thead>
                        <?php foreach ($trades as $trade): ?>
                            <tbody>
                                <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5">
                                    <td class="py-4 px-6"><?= $trade['entry_at']->format('Y-m-d') ?></td>
                                    <td class="py-4 px-6 font-semibold">
                                        <?= number_format($trade['entry_price'], 2, '.', ',') ?>
                                    </td>
                                    <td class="py-4 px-6"><?= $trade['exit_at']->format('Y-m-d') ?></td>
                                    <td class="py-4 px-6 font-semibold">
                                        <?= number_format($trade['exit_price'], 2, '.', ',') ?>
                                    </td>
                                    <td class="py-4 px-6">
                                        <?php if ($trade['pnl_pct'] > 0): ?>
                                            <span
                                                class="text-green-500 font-semibold"><?= number_format($trade['pnl_pct'], '2', '.') ?>%</span>
                                        <?php else: ?>
                                            <span
                                                class="text-red-500 font-semibold"><?= number_format($trade['pnl_pct'], '2', '.') ?>%</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section id="calculator" class="py-16 px-4 bg-black bg-opacity-30">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <div class="text-sm neon-green font-semibold mb-2">BTC 追漲趨勢策略</div>
                <h2 class="text-4xl font-bold mb-4">回測試算工具</h2>
                <p class="text-gray-400">輸入參數即可查看任意區間的歷史績效。</p>
            </div>

            <div class="gradient-border rounded-2xl p-8">
                <div id="backtestForm">
                    <!-- Compound Interest Toggle -->
                    <div class="mb-8 pb-2 md:pb-6 border-b border-gray-700">
                        <div
                            class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                            <div>
                                <h3 class="text-lg font-bold mb-1">報酬計算方式</h3>
                                <p class="text-sm text-gray-400">
                                    選擇每次固定投入金額，或採用獲利再投入的複利模式。
                                </p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-semibold" id="simpleLabel">單利</span>
                                <div class="toggle-switch" id="compoundToggle" onclick="toggleCompound()">
                                    <div class="toggle-slider"></div>
                                </div>
                                <span class="text-sm font-semibold neon-green" id="compoundLabel" style="opacity: 0.5;">
                                    複利
                                </span>
                                <input type="hidden" name="is_compound" id="isCompound" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-400 font-semibold mb-3 text-sm">起始時間</label>
                            <div class="relative">
                                <input type="text" id="startDate" name="start_date" required readonly
                                    class="w-full px-4 py-4 bg-white bg-opacity-5 border border-gray-700 rounded-lg focus:outline-none focus:border-neon-green text-white cursor-pointer"
                                    placeholder="選擇起始日期">
                                <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-400 font-semibold mb-3 text-sm">結束時間</label>
                            <div class="relative">
                                <input type="text" id="endDate" name="end_date" required readonly
                                    class="w-full px-4 py-4 bg-white bg-opacity-5 border border-gray-700 rounded-lg focus:outline-none focus:border-neon-green text-white cursor-pointer"
                                    placeholder="選擇結束日期">
                                <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6 mb-8">
                        <div>
                            <label class="block text-gray-400 font-semibold mb-3 text-sm">初始投入金額（USDT）</label>
                            <input type="number" name="initial_amount" id="initialAmount" required min="100" step="1"
                                value="10000"
                                class="w-full px-4 py-4 bg-white bg-opacity-5 border border-gray-700 rounded-lg focus:outline-none focus:border-neon-green text-white">
                        </div>
                        <div>
                            <label class="block text-gray-400 font-semibold mb-3 text-sm">手續費率 (%)</label>
                            <input type="number" name="fee_rate" id="feeRate" required min="0" max="1" step="0.01"
                                value="0.04"
                                class="w-full px-4 py-4 bg-white bg-opacity-5 border border-gray-700 rounded-lg focus:outline-none focus:border-neon-green text-white">
                        </div>
                        <div>
                            <label class="block text-gray-400 font-semibold mb-3 text-sm">槓桿倍數設定</label>
                            <input type="number" name="leverage" id="leverage" required min="1" max="100" step="1"
                                value="1"
                                class="w-full px-4 py-4 bg-white bg-opacity-5 border border-gray-700 rounded-lg focus:outline-none focus:border-neon-green text-white">
                        </div>
                    </div>

                    <button onClick="calculateBacktest()"
                        class="w-full bg-neon-green text-black py-4 rounded-lg font-bold text-lg hover-neon">
                        回測試算結果
                    </button>
                </div>

                <!-- Results Section -->
                <div class="mt-10 pt-10 border-t border-gray-800 hidden" id="resultsSection">
                    <h3 class="text-2xl font-bold mb-8 neon-green">回測結果</h3>

                    <div class="grid md:grid-cols-4 gap-6 mb-8">
                        <div class="glass-card p-6 rounded-xl">
                            <div class="text-gray-400 text-sm mb-2">交易次數</div>
                            <div class="text-4xl font-bold" id="tradeCount">0</div>
                        </div>
                        <div class="glass-card p-6 rounded-xl">
                            <div class="text-gray-400 text-sm mb-2">勝率</div>
                            <div class="text-4xl font-bold" id="winRate">-%</div>
                        </div>
                        <div class="glass-card p-6 rounded-xl">
                            <div class="text-gray-400 text-sm mb-2">最大回撤幅度</div>
                            <div class="text-4xl font-bold" id="maxDrawdown">-%</div>
                        </div>
                        <div class="glass-card p-6 rounded-xl">
                            <div class="text-gray-400 text-sm mb-2">總報酬率</div>
                            <div class="text-4xl font-bold" id="totalReturn">-%</div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div class="glass-card p-6 rounded-xl">
                            <div class="text-gray-400 text-sm mb-2">初始資金</div>
                            <div class="text-3xl font-bold" id="initialCapital">0</div>
                        </div>
                        <div class="glass-card p-6 rounded-xl">
                            <div class="text-gray-400 text-sm mb-2">最終資金</div>
                            <div class="text-3xl font-bold neon-green" id="finalCapital">0</div>
                        </div>
                    </div>

                    <div class="crypto-badge p-4 rounded-lg">
                        <p class="text-sm text-gray-300">
                            <strong class="neon-green">風險提醒：</strong>過去績效不代表未來表現，加密貨幣交易風險極高，請審慎評估自身風險承受度後再進行交易。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Pricing -->
    <section id="pricing" class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">方案與價格</h2>
                <p class="text-gray-400 text-lg">依照你的使用情境選擇最適合的方案。</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-card rounded-2xl p-8 hover:border-neon-green transition">
                    <h3 class="text-2xl font-bold mb-2">入門方案</h3>
                    <div class="text-5xl font-bold mb-6">$0<span class="text-lg text-gray-400">/月</span></div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-300">可啟用 1 組交易機器人</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-300">最多支援 1 倍槓桿</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-300">單筆下單金額上限 500USDT</span>
                        </li>
                    </ul>
                    <a href="{{ route('filament.account.pages.dashboard') }}">
                        <button
                            class="w-full border-2 border-neon-green neon-green py-3 rounded-lg font-bold hover:bg-neon-green hover:text-black transition">
                            立即開始
                        </button>
                    </a>
                </div>

                <div class="glass-card rounded-2xl p-8 border-2 border-neon-green relative transform md:scale-105">
                    <div
                        class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-neon-green text-black px-6 py-1 rounded-full text-sm font-bold">
                        推薦
                    </div>
                    <h3 class="text-2xl font-bold mb-2">專業方案</h3>
                    <div class="text-5xl font-bold mb-6">$99<span class="text-lg text-gray-400">/月</span></div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-300">可啟用 10 組交易機器人</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-300">單筆下單金額無上限</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-300">支援複利模式</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-300">支援自訂槓桿倍數</span>
                        </li>
                    </ul>
                    <a href="{{ route('filament.account.pages.dashboard') }}">
                        <button class="w-full bg-neon-green text-black py-3 rounded-lg font-bold hover-neon">
                            立即開始
                        </button>
                    </a>
                </div>

                <div class="glass-card rounded-2xl p-8 hover:border-neon-green transition">
                    <h3 class="text-2xl font-bold mb-2">進階方案</h3>
                    <div class="text-5xl font-bold mb-6">客製化</div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-300">含專業方案所有功能</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-300">客製化策略開發</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-gray-300">專屬技術與客服支援</span>
                        </li>
                    </ul>
                    <button
                        class="w-full border-2 border-neon-green neon-green py-3 rounded-lg font-bold hover:bg-neon-green hover:text-black transition">
                        聯絡我們
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 left-0 w-96 h-96 bg-neon-green rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500 rounded-full filter blur-3xl"></div>
        </div>
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <h2 class="text-5xl font-bold mb-6">準備好啟動你的自動化交易流程了嗎？</h2>
            <p class="text-xl text-gray-400 mb-8">立即使用 {{config('app.name')}} 自動化交易。</p>
            <a href="{{ route('filament.account.pages.dashboard') }}" class="bg-neon-green text-black px-10 py-4 rounded-lg font-bold text-lg hover-neon">
                立即開始
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-800 py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="pt-4 text-center text-sm text-gray-400">
                <p>&copy; <?= date('Y', time()) ?> {{config('app.name')}} Services Inc. All rights reserved.</p>
            </div>
    </footer>

    <script>
        // Backtest data from backend (will be injected by Laravel)
        let backtestData = @json($backtestData ?? []);

        // Data range
        const DATA_START_DATE = new Date('2022-01-12');
        const DATA_END_DATE = new Date();

        // Compound Interest Toggle
        function toggleCompound() {
            const toggle = document.getElementById('compoundToggle');
            const isCompoundInput = document.getElementById('isCompound');
            const simpleLabel = document.getElementById('simpleLabel');
            const compoundLabel = document.getElementById('compoundLabel');

            toggle.classList.toggle('active');

            if (toggle.classList.contains('active')) {
                isCompoundInput.value = '1';
                simpleLabel.style.opacity = '0.5';
                compoundLabel.style.opacity = '1';
            } else {
                isCompoundInput.value = '0';
                simpleLabel.style.opacity = '1';
                compoundLabel.style.opacity = '0.5';
            }
        }

        // Calculate Backtest Results
        function calculateBacktest() {
            const startDate = new Date(document.getElementById('startDate').value);
            const endDate = new Date(document.getElementById('endDate').value);
            const initialAmount = parseFloat(document.getElementById('initialAmount').value);

            // 單邊手續費（百分比）
            const feeInput = parseFloat(document.getElementById('feeRate').value);
            const feeRate = feeInput / 100; // 0.04 → 0.0004

            // 槓桿
            const leverage = parseFloat(document.getElementById('leverage').value) || 1;

            const isCompound = document.getElementById('isCompound').value === '1';

            // 篩交易（用 exit_at）
            const filteredTrades = backtestData.filter(trade => {
                const exitDate = new Date(trade.exit_at);
                return exitDate >= startDate && exitDate <= endDate;
            });

            if (filteredTrades.length === 0) {
                alert('選定區間內沒有交易');
                return;
            }

            let currentCapital = initialAmount;
            let winCount = 0;
            let totalPnl = 0;
            let maxCapital = initialAmount;
            let maxDrawdown = 0;

            // 單邊 → 一進一出
            const totalFeeRate = feeRate * 2;

            filteredTrades.forEach(trade => {
                const pnlPct = parseFloat(trade.pnl_pct); // ex: 1.23 = 1.23%

                const grossPct = pnlPct / 100; // 1.23% → 0.0123

                // = 淨報酬率（未套槓桿）
                let netPct = grossPct - totalFeeRate;

                // ▶ 套槓桿後（報酬率 × 槓桿）
                netPct = netPct * leverage;

                // 單利/複利的交易資金
                const tradeAmount = isCompound ? currentCapital : initialAmount;

                // ▶ 槓桿後實際淨損益
                const netPnl = tradeAmount * netPct;

                currentCapital += netPnl;
                totalPnl += netPnl;

                if (netPct > 0) winCount++;

                // 最大回撤
                if (currentCapital > maxCapital) {
                    maxCapital = currentCapital;
                }
                const currentDrawdown = (maxCapital - currentCapital) / maxCapital * 100;
                if (currentDrawdown > maxDrawdown) {
                    maxDrawdown = currentDrawdown;
                }
            });

            const finalCapital = currentCapital;
            const totalReturn = (finalCapital - initialAmount) / initialAmount * 100;
            const winRate = winCount / filteredTrades.length * 100;

            // 顯示結果
            const totalReturnEl = document.getElementById('totalReturn');
            totalReturnEl.textContent = totalReturn.toFixed(2) + '%';
            totalReturnEl.classList.remove('text-green-500', 'text-red-500');
            totalReturnEl.classList.add(totalReturn > 0 ? 'text-green-500' : 'text-red-500');

            document.getElementById('tradeCount').textContent = filteredTrades.length;
            document.getElementById('winRate').textContent = winRate.toFixed(2) + '%';
            document.getElementById('initialCapital').textContent = '$' +
                initialAmount.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            document.getElementById('finalCapital').textContent = '$' +
                finalCapital.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            document.getElementById('maxDrawdown').textContent = maxDrawdown.toFixed(2) + '%';

            document.getElementById('resultsSection').classList.remove('hidden');
            document.getElementById('resultsSection').scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        }


        // Initialize Flatpickr for date pickers
        document.addEventListener('DOMContentLoaded', function() {
            const defaultEndDate = new Date();
            const defaultStartDate = new Date(defaultEndDate);
            defaultStartDate.setDate(defaultStartDate.getDate() - 30);

            // Ensure default dates are within data range
            const actualStartDate = defaultStartDate < DATA_START_DATE ? DATA_START_DATE : defaultStartDate;

            flatpickr("#startDate", {
                defaultDate: actualStartDate,
                minDate: DATA_START_DATE,
                maxDate: DATA_END_DATE,
                dateFormat: "Y-m-d",
                theme: "dark",
                onChange: function(selectedDates, dateStr) {
                    // Update end date minDate when start date changes
                    const endDatePicker = document.getElementById('endDate')._flatpickr;
                    if (endDatePicker) {
                        endDatePicker.set('minDate', dateStr);
                    }
                }
            });

            flatpickr("#endDate", {
                defaultDate: DATA_END_DATE,
                minDate: actualStartDate,
                maxDate: DATA_END_DATE,
                dateFormat: "Y-m-d",
                theme: "dark"
            });
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>