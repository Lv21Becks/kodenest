<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Two-Factor Authentication — KodeNest</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Montserrat:wght@600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .mono { font-family: 'JetBrains Mono', monospace; }

        @keyframes scan {
            0% { top: -10%; }
            100% { top: 110%; }
        }
        .scanner-line {
            position: absolute;
            left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #f97316, transparent);
            animation: scan 3s linear infinite;
            pointer-events: none;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
        .cursor-blink { animation: blink 1s step-end infinite; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.6s ease forwards; }
        .fade-up-delay { animation: fadeUp 0.6s 0.15s ease forwards; opacity: 0; }
        .fade-up-delay-2 { animation: fadeUp 0.6s 0.3s ease forwards; opacity: 0; }

        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.4); }
            70% { box-shadow: 0 0 0 12px rgba(249, 115, 22, 0); }
            100% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0); }
        }
        .pulse-orange { animation: pulse-ring 2s ease-out infinite; }

        .otp-input {
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.7em;
            caret-color: #f97316;
        }
        .otp-input::placeholder { letter-spacing: 0.4em; }
    </style>
</head>
<body class="h-full min-h-screen bg-[#0d0d0d] flex items-center justify-center p-4 overflow-hidden">

    {{-- Ambient glow --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-[-20%] left-[10%] w-[600px] h-[600px] rounded-full bg-orange-600/10 blur-[120px]"></div>
        <div class="absolute bottom-[-20%] right-[10%] w-[500px] h-[500px] rounded-full bg-orange-900/15 blur-[100px]"></div>
    </div>

    {{-- Grid overlay --}}
    <div class="fixed inset-0 pointer-events-none opacity-[0.03]"
        style="background-image: linear-gradient(#f97316 1px, transparent 1px), linear-gradient(90deg, #f97316 1px, transparent 1px); background-size: 40px 40px;">
    </div>

    <div class="w-full max-w-md relative z-10">

        {{-- Logo header --}}
        <div class="fade-up text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3">
                <img src="{{ asset('images/KODENEST icon 4.png') }}" alt="KodeNest" class="h-10 w-auto">
                <span class="mono text-white font-bold text-xl tracking-tight">
                    Kode<span class="text-orange-500">Nest</span>
                </span>
            </a>
        </div>

        {{-- Main card --}}
        <div class="fade-up-delay relative border border-white/10 rounded-2xl overflow-hidden bg-[#111111] shadow-2xl shadow-black/60">

            {{-- Scanner animation --}}
            <div class="scanner-line"></div>

            {{-- Top accent bar --}}
            <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-orange-500 to-transparent"></div>

            {{-- Card Header --}}
            <div class="px-8 pt-8 pb-6 border-b border-white/5 flex items-center gap-4">
                <div class="pulse-orange w-12 h-12 rounded-xl bg-orange-500/10 border border-orange-500/30 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-shield-halved text-orange-400 text-xl"></i>
                </div>
                <div>
                    <h1 class="text-white font-black text-lg tracking-tight">Identity Verification</h1>
                    <p class="text-gray-500 text-xs mono mt-0.5">TWO-FACTOR AUTHENTICATION REQUIRED</p>
                </div>
            </div>

            {{-- Body --}}
            <div class="px-8 py-6 space-y-5">

                {{-- Terminal-style info block --}}
                <div class="mono bg-black/40 border border-white/5 rounded-xl p-4 text-xs space-y-1.5">
                    <p class="text-green-400"><span class="text-gray-600">$</span> auth <span class="text-yellow-400">--method</span>=2fa <span class="text-yellow-400">--send</span>=email</p>
                    <p class="text-gray-400">→ Code dispatched to: <span class="text-orange-400">{{ \Illuminate\Support\Str::mask(auth()->user()->email, '*', 3, strpos(auth()->user()->email, '@') - 4) }}</span></p>
                    <p class="text-gray-400">→ Expires in: <span class="text-white">10 minutes</span></p>
                    <p class="text-gray-500 flex items-center gap-1">→ Awaiting input<span class="cursor-blink text-orange-500 font-bold">█</span></p>
                </div>

                {{-- Status message --}}
                @if (session('status'))
                    <div class="flex items-center gap-3 bg-green-500/10 border border-green-500/20 rounded-xl px-4 py-3">
                        <i class="fas fa-check-circle text-green-400 text-sm flex-shrink-0"></i>
                        <p class="text-green-400 text-sm mono">{{ session('status') }}</p>
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('admin.2fa.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="code" class="block mono text-xs text-gray-500 uppercase tracking-widest mb-2">
                            Enter Security Code
                        </label>
                        <input id="code" type="text" name="code"
                            required autofocus autocomplete="one-time-code"
                            maxlength="6" inputmode="numeric" pattern="[0-9]{6}"
                            class="otp-input w-full bg-black/50 border-2 border-white/10 rounded-xl px-5 py-4 text-white text-2xl font-bold text-center tracking-widest focus:border-orange-500 focus:ring-0 focus:outline-none transition-colors placeholder:text-gray-700"
                            placeholder="• • • • • •">
                        @error('code')
                            <div class="mt-2 flex items-center gap-2 text-red-400 text-xs mono bg-red-500/10 border border-red-500/20 rounded-lg px-3 py-2">
                                <i class="fas fa-triangle-exclamation flex-shrink-0"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full py-4 rounded-xl bg-orange-600 hover:bg-orange-500 text-white font-black text-sm tracking-wide transition-all duration-200 hover:shadow-lg hover:shadow-orange-500/20 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <i class="fas fa-unlock-keyhole"></i>
                        AUTHENTICATE ACCESS
                    </button>
                </form>

                {{-- Resend --}}
                <div class="text-center pt-1">
                    <form method="POST" action="{{ route('admin.2fa.resend') }}">
                        @csrf
                        <button type="submit" class="mono text-xs text-gray-600 hover:text-orange-400 transition-colors flex items-center justify-center gap-1.5 mx-auto">
                            <i class="fas fa-rotate-right text-[10px]"></i>
                            Resend code
                        </button>
                    </form>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-8 py-4 border-t border-white/5 bg-black/20 flex items-center justify-between">
                <p class="mono text-xs text-gray-700">KodeNest Security System</p>
                <div class="flex items-center gap-1.5 mono text-xs text-gray-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                    LIVE
                </div>
            </div>
        </div>

        <p class="text-center mono text-xs text-gray-700 mt-6">
            &copy; {{ date('Y') }} KodeNest ICT Academy
        </p>
    </div>

</body>
</html>
