<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strade - 比特幣自動交易機器人</title>
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
            color: #C6FF00;
        }
        .bg-neon-green {
            background-color: #C6FF00;
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
    <nav class="fixed w-full top-0 z-50 bg-opacity-90 backdrop-blur-md" style="background-color: rgba(15, 20, 25, 0.95);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-neon-green rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold">Strade</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#market" class="text-gray-400 hover:text-white transition">Market</a>
                    <a href="#features" class="text-gray-400 hover:text-white transition">Features</a>
                    <a href="#calculator" class="text-gray-400 hover:text-white transition">Backtest</a>
                    <a href="#pricing" class="text-gray-400 hover:text-white transition">Pricing</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-neon-green text-black px-6 py-2 rounded-lg font-semibold hover-neon">Sign Up</a>
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
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="crypto-badge inline-block px-4 py-2 rounded-full text-sm font-semibold neon-green mb-6">
                        🚀 Daily ROI now $ get up to $5,000
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        Trusted and Secure<br/>
                        <span class="neon-green">Bitcoin Trading</span><br/>
                        Robot
                    </h1>
                    <p class="text-gray-400 text-lg mb-8 leading-relaxed">
                        Try Risk-free with our trend-following strategy. AI-powered Bitcoin trading bot with 24/7 automated execution.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <input type="email" placeholder="Email/Phone" class="px-6 py-3 bg-white bg-opacity-5 border border-gray-700 rounded-lg focus:outline-none focus:border-neon-green text-white">
                        <button class="bg-neon-green text-black px-8 py-3 rounded-lg font-semibold hover-neon">Sign Up</button>
                    </div>
                    <div class="flex items-center space-x-6 mt-8 text-sm text-gray-400">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 neon-green" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span>Trust Pilot 4.5 Star</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 neon-green" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span>Blockchain 8.3</span>
                        </div>
                    </div>
                </div>

                <!-- Trading Card -->
                <div class="glass-card rounded-2xl p-6">
                    <div class="flex space-x-2 mb-6">
                        <button class="bg-neon-green text-black px-6 py-2 rounded-lg font-semibold text-sm">Buy</button>
                        <button class="text-gray-400 px-6 py-2 rounded-lg font-semibold text-sm hover:bg-white hover:bg-opacity-5">Sell</button>
                        <button class="text-gray-400 px-6 py-2 rounded-lg font-semibold text-sm hover:bg-white hover:bg-opacity-5">Exchange</button>
                    </div>

                    <h3 class="text-xl font-bold mb-4">Buy Crypto Using USD</h3>

                    <div class="space-y-4">
                        <div class="glass-card rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <select class="bg-transparent text-white font-semibold focus:outline-none">
                                    <option>🟠 BTC</option>
                                    <option>⚪ ETH</option>
                                </select>
                                <span class="text-gray-400">Get</span>
                            </div>
                            <div class="text-right text-2xl font-bold">0.01</div>
                        </div>

                        <div class="glass-card rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <select class="bg-transparent text-white font-semibold focus:outline-none">
                                    <option>🟡 USD</option>
                                </select>
                                <span class="text-gray-400">Pay</span>
                            </div>
                            <div class="text-right text-2xl font-bold">19496.28</div>
                        </div>

                        <div class="glass-card rounded-lg p-3 text-sm">
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-400">Exchange rate</span>
                                <span>1 BTC = 19496.28 USD</span>
                            </div>
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-400">Transaction Fee</span>
                                <span>0.1%</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Price Impact</span>
                                <span class="neon-green">0.67%</span>
                            </div>
                        </div>

                        <button class="w-full bg-neon-green text-black py-4 rounded-lg font-bold hover-neon">
                            Buy Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Market Live Section -->
    <section id="market" class="py-16 px-4 bg-black bg-opacity-30">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <div class="text-sm neon-green font-semibold mb-2">CRYPTO MARKET LIVE</div>
                <h2 class="text-4xl font-bold">Explore prices and charts</h2>
            </div>

            <div class="flex flex-wrap gap-3 mb-8">
                <button class="bg-neon-green text-black px-6 py-2 rounded-lg font-semibold text-sm">View All</button>
                <button class="text-gray-400 px-6 py-2 rounded-lg text-sm hover:bg-white hover:bg-opacity-5">Metaverse</button>
                <button class="text-gray-400 px-6 py-2 rounded-lg text-sm hover:bg-white hover:bg-opacity-5">Top Gainer</button>
                <button class="text-gray-400 px-6 py-2 rounded-lg text-sm hover:bg-white hover:bg-opacity-5">DeFi</button>
            </div>

            <div class="glass-card rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="border-b border-gray-800">
                            <tr>
                                <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">#</th>
                                <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Name</th>
                                <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Last Price</th>
                                <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">24h Change</th>
                                <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Market Cap</th>
                                <th class="text-left py-4 px-6 text-gray-400 font-semibold text-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5">
                                <td class="py-4 px-6">01</td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-orange-500 rounded-full"></div>
                                        <div>
                                            <div class="font-semibold">Bitcoin</div>
                                            <div class="text-sm text-gray-400">BTC</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 font-semibold">$ 26,458 USD</td>
                                <td class="py-4 px-6">
                                    <span class="text-green-500 font-semibold">↗ 7.2%</span>
                                </td>
                                <td class="py-4 px-6">$ 15,782,962.74 USD</td>
                                <td class="py-4 px-6">
                                    <button class="bg-neon-green text-black px-6 py-2 rounded-lg font-semibold text-sm hover-neon">Trade</button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5">
                                <td class="py-4 px-6">02</td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-purple-500 rounded-full"></div>
                                        <div>
                                            <div class="font-semibold">Ethereum</div>
                                            <div class="text-sm text-gray-400">ETH</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 font-semibold">$ 1,841.80 USD</td>
                                <td class="py-4 px-6">
                                    <span class="text-green-500 font-semibold">↗ 3.73%</span>
                                </td>
                                <td class="py-4 px-6">$42,012,808.09</td>
                                <td class="py-4 px-6">
                                    <button class="bg-neon-green text-black px-6 py-2 rounded-lg font-semibold text-sm hover-neon">Trade</button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5">
                                <td class="py-4 px-6">03</td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-teal-500 rounded-full"></div>
                                        <div>
                                            <div class="font-semibold">Tether USD</div>
                                            <div class="text-sm text-gray-400">USDT</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 font-semibold">$ 0.9999328 USD</td>
                                <td class="py-4 px-6">
                                    <span class="text-green-500 font-semibold">↗ 0.12%</span>
                                </td>
                                <td class="py-4 px-6">$ 15,782,962.74 USD</td>
                                <td class="py-4 px-6">
                                    <button class="bg-neon-green text-black px-6 py-2 rounded-lg font-semibold text-sm hover-neon">Trading</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center py-6">
                    <button class="text-neon-green font-semibold hover:underline">View More Chart & details →</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <div class="text-sm neon-green font-semibold mb-2">WE ARE AT YOUR SERVICE</div>
                <h2 class="text-4xl font-bold">Trusted with our feature</h2>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <div class="glass-card rounded-2xl p-8 text-center hover:border-neon-green transition">
                    <div class="w-16 h-16 bg-neon-green bg-opacity-10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 neon-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Secure Fund</h3>
                    <p class="text-gray-400">Your safety is our priority. We use bank-level security to protect your investments.</p>
                </div>

                <div class="glass-card rounded-2xl p-8 text-center hover:border-neon-green transition">
                    <div class="w-16 h-16 bg-neon-green bg-opacity-10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 neon-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">24/7 Support</h3>
                    <p class="text-gray-400">We are always ready and willing to help you with any inquires you may have.</p>
                </div>

                <div class="glass-card rounded-2xl p-8 text-center hover:border-neon-green transition">
                    <div class="w-16 h-16 bg-neon-green bg-opacity-10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 neon-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Best Commission</h3>
                    <p class="text-gray-400">With Zero fees for your first trades & low commission, you'll keep more of your profit.</p>
                </div>

                <div class="glass-card rounded-2xl p-8 text-center hover:border-neon-green transition">
                    <div class="w-16 h-16 bg-neon-green bg-opacity-10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 neon-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Best Chart</h3>
                    <p class="text-gray-400">The easiest tools for your charting needs with details for precision.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Get Started -->
    <section class="py-20 px-4 bg-black bg-opacity-30">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-4">
                <div class="text-sm neon-green font-semibold mb-2">How to Get Started</div>
                <h2 class="text-4xl font-bold mb-4">Buy Crypto in Minutes</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">
                    Simple and easy way to start your investment in top cryptocurrencies like Bitcoin, Ethereum, Tether & more.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mt-16">
                <div class="text-center relative">
                    <div class="relative inline-block">
                        <div class="w-20 h-20 bg-neon-green bg-opacity-10 rounded-2xl flex items-center justify-center mx-auto mb-6 border-2 border-neon-green">
                            <svg class="w-10 h-10 neon-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="absolute -top-2 -left-2 w-12 h-12 bg-neon-green rounded-lg flex items-center justify-center text-black font-bold text-xl">1</div>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Ready</h3>
                    <p class="text-gray-400">Create your free Cryptomart account in no seconds.</p>
                </div>

                <div class="text-center relative">
                    <div class="relative inline-block">
                        <div class="w-20 h-20 bg-neon-green bg-opacity-10 rounded-2xl flex items-center justify-center mx-auto mb-6 border-2 border-neon-green">
                            <svg class="w-10 h-10 neon-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div class="absolute -top-2 -left-2 w-12 h-12 bg-neon-green rounded-lg flex items-center justify-center text-black font-bold text-xl">2</div>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Set</h3>
                    <p class="text-gray-400">Make a deposit to your Cryptomart account.</p>
                </div>

                <div class="text-center relative">
                    <div class="relative inline-block">
                        <div class="w-20 h-20 bg-neon-green bg-opacity-10 rounded-2xl flex items-center justify-center mx-auto mb-6 border-2 border-neon-green">
                            <svg class="w-10 h-10 neon-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="absolute -top-2 -left-2 w-12 h-12 bg-neon-green rounded-lg flex items-center justify-center text-black font-bold text-xl">3</div>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Let's Build Portfolio</h3>
                    <p class="text-gray-400">Buy & Sell and convert Crypto and keep track them.</p>
                </div>
            </div>

            <div class="text-center mt-12">
                <button class="bg-neon-green text-black px-8 py-4 rounded-lg font-bold hover-neon">Get Started</button>
            </div>
        </div>
    </section>

    <!-- Backtest Calculator -->
    <section id="calculator" class="py-20 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <div class="text-sm neon-green font-semibold mb-2">STRATEGY BACKTEST</div>
                <h2 class="text-4xl font-bold mb-4">Trend-Following Backtest</h2>
                <p class="text-gray-400">Enter parameters to see historical performance of our Bitcoin trend-following strategy</p>
            </div>

            <div class="gradient-border rounded-2xl p-8">
                <form id="backtestForm" action="{{ route('backtest.calculate') }}" method="POST">
                    @csrf
                    
                    <!-- Compound Interest Toggle -->
                    <div class="mb-8 pb-6 border-b border-gray-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold mb-1">Interest Calculation Method</h3>
                                <p class="text-sm text-gray-400">Choose between simple or compound interest calculation</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-semibold" id="simpleLabel">Simple</span>
                                <div class="toggle-switch" id="compoundToggle" onclick="toggleCompound()">
                                    <div class="toggle-slider"></div>
                                </div>
                                <span class="text-sm font-semibold neon-green" id="compoundLabel" style="opacity: 0.5;">Compound</span>
                                <input type="hidden" name="is_compound" id="isCompound" value="0">
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-400 font-semibold mb-3 text-sm">Start Date</label>
                            <div class="relative">
                                <input type="text" id="startDate" name="start_date" required readonly class="w-full px-4 py-4 bg-white bg-opacity-5 border border-gray-700 rounded-lg focus:outline-none focus:border-neon-green text-white cursor-pointer" placeholder="Select start date">
                                <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-400 font-semibold mb-3 text-sm">End Date</label>
                            <div class="relative">
                                <input type="text" id="endDate" name="end_date" required readonly class="w-full px-4 py-4 bg-white bg-opacity-5 border border-gray-700 rounded-lg focus:outline-none focus:border-neon-green text-white cursor-pointer" placeholder="Select end date">
                                <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-gray-400 font-semibold mb-3 text-sm">Initial Amount (USD)</label>
                            <input type="number" name="initial_amount" required min="100" step="0.01" placeholder="10000" class="w-full px-4 py-4 bg-white bg-opacity-5 border border-gray-700 rounded-lg focus:outline-none focus:border-neon-green text-white">
                        </div>
                        <div>
                            <label class="block text-gray-400 font-semibold mb-3 text-sm">Fee Rate (%)</label>
                            <input type="number" name="fee_rate" required min="0" max="1" step="0.01" placeholder="0.1" class="w-full px-4 py-4 bg-white bg-opacity-5 border border-gray-700 rounded-lg focus:outline-none focus:border-neon-green text-white">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-neon-green text-black py-4 rounded-lg font-bold text-lg hover-neon">
                        Calculate Backtest
                    </button>
                </form>

                <!-- Results Section -->
                @if(isset($results))
                <div class="mt-10 pt-10 border-t border-gray-800">
                    <h3 class="text-2xl font-bold mb-8 neon-green">Backtest Results</h3>
                    
                    <div class="grid md:grid-cols-3 gap-6 mb-8">
                        <div class="glass-card p-6 rounded-xl">
                            <div class="text-gray-400 text-sm mb-2">Total Return</div>
                            <div class="text-4xl font-bold neon-green">{{ number_format($results['total_return'], 2) }}%</div>
                        </div>
                        <div class="glass-card p-6 rounded-xl">
                            <div class="text-gray-400 text-sm mb-2">Total Trades</div>
                            <div class="text-4xl font-bold">{{ $results['trade_count'] }}</div>
                        </div>
                        <div class="glass-card p-6 rounded-xl">
                            <div class="text-gray-400 text-sm mb-2">Win Rate</div>
                            <div class="text-4xl font-bold text-green-500">{{ number_format($results['win_rate'], 2) }}%</div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div class="glass-card p-6 rounded-xl">
                            <div class="text-gray-400 text-sm mb-2">Initial Capital</div>
                            <div class="text-3xl font-bold">${{ number_format($results['initial_amount'], 2) }}</div>
                        </div>
                        <div class="glass-card p-6 rounded-xl">
                            <div class="text-gray-400 text-sm mb-2">Final Capital</div>
                            <div class="text-3xl font-bold">${{ number_format($results['final_amount'], 2) }}</div>
                        </div>
                    </div>

                    <div class="crypto-badge p-4 rounded-lg">
                        <p class="text-sm text-gray-300">
                            <strong class="neon-green">Risk Warning:</strong> Past performance does not guarantee future results. Cryptocurrency trading carries high risk. Please invest carefully.
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Supported Coins -->
    <section class="py-20 px-4 bg-black bg-opacity-30">
        <div class="max-w-7xl mx-auto text-center">
            <div class="text-sm neon-green font-semibold mb-2">WE HAVE LOT'S OF COIN FOR YOU TO BUY, SELL & TRADE</div>
            <h2 class="text-4xl font-bold mb-12">More Than 150+ Coins</h2>

            <div class="flex flex-wrap justify-center gap-8 items-center">
                <div class="flex items-center space-x-3 glass-card px-6 py-3 rounded-full">
                    <div class="w-8 h-8 bg-orange-500 rounded-full"></div>
                    <span class="font-semibold">Bitcoin</span>
                </div>
                <div class="flex items-center space-x-3 glass-card px-6 py-3 rounded-full">
                    <div class="w-8 h-8 bg-purple-500 rounded-full"></div>
                    <span class="font-semibold">Ethereum</span>
                </div>
                <div class="flex items-center space-x-3 glass-card px-6 py-3 rounded-full">
                    <div class="w-8 h-8 bg-yellow-500 rounded-full"></div>
                    <span class="font-semibold">Binance</span>
                </div>
                <div class="flex items-center space-x-3 glass-card px-6 py-3 rounded-full">
                    <div class="w-8 h-8 bg-blue-500 rounded-full"></div>
                    <span class="font-semibold">1inch</span>
                </div>
                <div class="flex items-center space-x-3 glass-card px-6 py-3 rounded-full">
                    <div class="w-8 h-8 bg-teal-500 rounded-full"></div>
                    <span class="font-semibold">Tether</span>
                </div>
            </div>

            <div class="flex flex-wrap justify-center gap-8 items-center mt-6">
                <div class="flex items-center space-x-3 glass-card px-6 py-3 rounded-full">
                    <div class="w-8 h-8 bg-green-500 rounded-full"></div>
                    <span class="font-semibold">Flow</span>
                </div>
                <div class="flex items-center space-x-3 glass-card px-6 py-3 rounded-full">
                    <div class="w-8 h-8 bg-gray-500 rounded-full"></div>
                    <span class="font-semibold">XRP</span>
                </div>
                <div class="flex items-center space-x-3 glass-card px-6 py-3 rounded-full">
                    <div class="w-8 h-8 bg-pink-500 rounded-full"></div>
                    <span class="font-semibold">Uniswap</span>
                </div>
                <div class="flex items-center space-x-3 glass-card px-6 py-3 rounded-full">
                    <div class="w-8 h-8 bg-indigo-500 rounded-full"></div>
                    <span class="font-semibold">Egoras</span>
                </div>
                <div class="flex items-center space-x-3 glass-card px-6 py-3 rounded-full">
                    <div class="w-8 h-8 bg-lime-500 rounded-full"></div>
                    <span class="font-semibold">Nuls</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section id="pricing" class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Choose Your Plan</h2>
                <p class="text-gray-400 text-lg">Flexible pricing to suit your trading needs</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-card rounded-2xl p-8 hover:border-neon-green transition">
                    <h3 class="text-2xl font-bold mb-2">Starter</h3>
                    <div class="text-5xl font-bold mb-6">$29<span class="text-lg text-gray-400">/mo</span></div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-300">Trend-Following Strategy</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-300">Basic Risk Management</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-300">Daily Reports</span>
                        </li>
                    </ul>
                    <button class="w-full border-2 border-neon-green neon-green py-3 rounded-lg font-bold hover:bg-neon-green hover:text-black transition">
                        Get Started
                    </button>
                </div>

                <div class="glass-card rounded-2xl p-8 border-2 border-neon-green relative transform md:scale-105">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-neon-green text-black px-6 py-1 rounded-full text-sm font-bold">
                        POPULAR
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Pro</h3>
                    <div class="text-5xl font-bold mb-6">$99<span class="text-lg text-gray-400">/mo</span></div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-300">All Starter Features</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-300">Advanced Risk Management</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-300">Real-time Notifications</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-300">Priority Support</span>
                        </li>
                    </ul>
                    <button class="w-full bg-neon-green text-black py-3 rounded-lg font-bold hover-neon">
                        Get Started
                    </button>
                </div>

                <div class="glass-card rounded-2xl p-8 hover:border-neon-green transition">
                    <h3 class="text-2xl font-bold mb-2">Enterprise</h3>
                    <div class="text-5xl font-bold mb-6">Custom</div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-300">All Pro Features</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-300">Custom Strategies</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-300">Dedicated Account Manager</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 neon-green mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-300">API Integration Support</span>
                        </li>
                    </ul>
                    <button class="w-full border-2 border-neon-green neon-green py-3 rounded-lg font-bold hover:bg-neon-green hover:text-black transition">
                        Contact Us
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
            <h2 class="text-5xl font-bold mb-6">Ready to Start<br/>Automated Trading?</h2>
            <p class="text-xl text-gray-400 mb-8">Sign up now and enjoy 14 days free trial</p>
            <button class="bg-neon-green text-black px-10 py-4 rounded-lg font-bold text-lg hover-neon">
                Start Free Trial
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-800 py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-5 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-neon-green rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">Strade</span>
                    </div>
                    <p class="text-gray-400 text-sm">We always prioritize user comfort and are very happy to assist your business.</p>
                </div>

                <div>
                    <h4 class="font-bold mb-4">About</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">About us</a></li>
                        <li><a href="#" class="hover:text-white transition">Features</a></li>
                        <li><a href="#" class="hover:text-white transition">News & Blog</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition">Support Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Partner</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Our Partner</a></li>
                        <li><a href="#" class="hover:text-white transition">Become Partner</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Get Update</h4>
                    <p class="text-sm text-gray-400 mb-4">We are growing fast, subscribe to stay update</p>
                    <div class="flex">
                        <input type="email" placeholder="Enter Email" class="flex-1 px-4 py-2 bg-white bg-opacity-5 border border-gray-700 rounded-l-lg focus:outline-none text-white text-sm">
                        <button class="bg-neon-green text-black px-4 py-2 rounded-r-lg font-semibold hover-neon text-sm">Subscribe</button>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <div class="mb-4 md:mb-0">
                    <p>&copy; 2024 Strade Services Inc. All rights reserved.</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-white transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="hover:text-white transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                    </a>
                    <a href="#" class="hover:text-white transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/></svg>
                    </a>
                </div>
            </div>
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
        function calculateBacktest(event) {
            event.preventDefault();
            
            const startDate = new Date(document.getElementById('startDate').value);
            const endDate = new Date(document.getElementById('endDate').value);
            const initialAmount = parseFloat(document.getElementById('initialAmount').value);
            const feeRate = parseFloat(document.getElementById('feeRate').value) / 100;
            const isCompound = document.getElementById('isCompound').value === '1';
            
            // Filter trades within date range
            const filteredTrades = backtestData.filter(trade => {
                const entryDate = new Date(trade.entry_at);
                const exitDate = new Date(trade.exit_at);
                return entryDate >= startDate && exitDate <= endDate && trade.status === 'closed';
            });
            
            if (filteredTrades.length === 0) {
                alert('No trades found in the selected date range.');
                return;
            }
            
            // Calculate results
            let currentCapital = initialAmount;
            let winCount = 0;
            let totalPnl = 0;
            let maxCapital = initialAmount;
            let minCapital = initialAmount;
            let maxDrawdown = 0;
            
            filteredTrades.forEach(trade => {
                const pnlPct = parseFloat(trade.pnl_pct);
                
                if (isCompound) {
                    // Compound: use all current capital
                    const tradeAmount = currentCapital;
                    const grossPnl = tradeAmount * (pnlPct / 100);
                    const fee = Math.abs(grossPnl) * feeRate;
                    const netPnl = grossPnl - fee;
                    currentCapital += netPnl;
                    totalPnl += netPnl;
                } else {
                    // Simple: always use initial amount
                    const tradeAmount = initialAmount;
                    const grossPnl = tradeAmount * (pnlPct / 100);
                    const fee = Math.abs(grossPnl) * feeRate;
                    const netPnl = grossPnl - fee;
                    currentCapital += netPnl;
                    totalPnl += netPnl;
                }
                
                if (pnlPct > 0) winCount++;
                
                // Track max capital and drawdown
                if (currentCapital > maxCapital) {
                    maxCapital = currentCapital;
                }
                if (currentCapital < minCapital) {
                    minCapital = currentCapital;
                }
                const currentDrawdown = ((maxCapital - currentCapital) / maxCapital) * 100;
                if (currentDrawdown > maxDrawdown) {
                    maxDrawdown = currentDrawdown;
                }
            });
            
            const finalCapital = currentCapital;
            const totalReturn = ((finalCapital - initialAmount) / initialAmount) * 100;
            const winRate = (winCount / filteredTrades.length) * 100;
            const avgProfit = totalPnl / filteredTrades.length;
            
            // Display results
            document.getElementById('totalReturn').textContent = totalReturn.toFixed(2) + '%';
            document.getElementById('tradeCount').textContent = filteredTrades.length;
            document.getElementById('winRate').textContent = winRate.toFixed(2) + '%';
            document.getElementById('initialCapital').textContent = '
</body>
</html> + initialAmount.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            document.getElementById('finalCapital').textContent = '
</body>
</html> + finalCapital.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            document.getElementById('avgProfit').textContent = '
</body>
</html> + avgProfit.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            document.getElementById('maxDrawdown').textContent = maxDrawdown.toFixed(2) + '%';
            
            // Show results section
            document.getElementById('resultsSection').classList.remove('hidden');
            
            // Smooth scroll to results
            document.getElementById('resultsSection').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
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
                defaultDate: defaultEndDate,
                minDate: actualStartDate,
                maxDate: DATA_END_DATE,
                dateFormat: "Y-m-d",
                theme: "dark"
            });
        });
        
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>
