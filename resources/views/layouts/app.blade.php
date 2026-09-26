<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aurora') · Task Manager</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Sora:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #0b0d14;
            --panel: rgba(255, 255, 255, 0.055);
            --panel-border: rgba(255, 255, 255, 0.09);
            --text: #eef0f7;
            --text-dim: #9098b0;
            --accent-a: #7c5cff;
            --accent-b: #38e5c4;
            --accent-c: #ff5c8a;
            --pending: #ffb454;
            --completed: #38e5c4;
            --danger: #ff5c7a;
            --radius: 18px;
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            min-height: 100%;
            background: var(--bg);
            color: var(--text);
            font-family: 'Sora', system-ui, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, .brand, .stat-num, button, .btn {
            font-family: 'Space Grotesk', 'Sora', sans-serif;
        }

        /* Aurora background blobs */
        .aurora-bg {
            position: fixed;
            inset: 0;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }
        .aurora-bg span {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.35;
        }
        .aurora-bg span:nth-child(1) {
            width: 480px; height: 480px;
            background: var(--accent-a);
            top: -160px; left: -120px;
            animation: float1 16s ease-in-out infinite;
        }
        .aurora-bg span:nth-child(2) {
            width: 420px; height: 420px;
            background: var(--accent-b);
            bottom: -140px; right: -100px;
            animation: float2 20s ease-in-out infinite;
        }
        .aurora-bg span:nth-child(3) {
            width: 300px; height: 300px;
            background: var(--accent-c);
            top: 40%; left: 60%;
            animation: float1 24s ease-in-out infinite reverse;
        }
        @keyframes float1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(60px, 40px) scale(1.15); }
        }
        @keyframes float2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-50px, -30px) scale(1.1); }
        }

        .shell {
            position: relative;
            z-index: 1;
            max-width: 980px;
            margin: 0 auto;
            padding: 40px 20px 80px;
        }

        header.top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        .brand .dot {
            width: 34px; height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent-a), var(--accent-b));
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
            box-shadow: 0 6px 20px -6px rgba(124, 92, 255, 0.6);
        }

        nav a {
            color: var(--text-dim);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 10px 18px;
            border-radius: 999px;
            border: 1px solid transparent;
            transition: all .15s ease;
        }
        nav a:hover { color: var(--text); border-color: var(--panel-border); background: var(--panel); }

        .panel {
            background: var(--panel);
            border: 1px solid var(--panel-border);
            border-radius: var(--radius);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 20px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: transform .15s ease, box-shadow .15s ease, opacity .15s ease;
        }
        .btn:active { transform: scale(0.97); }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-a), #9b7bff);
            color: white;
            box-shadow: 0 8px 24px -8px rgba(124, 92, 255, 0.7);
        }
        .btn-primary:hover { box-shadow: 0 10px 28px -6px rgba(124, 92, 255, 0.85); }

        .btn-ghost {
            background: var(--panel);
            color: var(--text);
            border: 1px solid var(--panel-border);
        }
        .btn-ghost:hover { background: rgba(255,255,255,0.09); }

        .btn-danger {
            background: rgba(255, 92, 122, 0.12);
            color: var(--danger);
            border: 1px solid rgba(255, 92, 122, 0.3);
        }
        .btn-danger:hover { background: rgba(255, 92, 122, 0.22); }

        .btn-sm { padding: 7px 14px; font-size: 13px; }

        .flash {
            padding: 14px 18px;
            border-radius: 12px;
            background: rgba(56, 229, 196, 0.1);
            border: 1px solid rgba(56, 229, 196, 0.35);
            color: var(--completed);
            font-size: 14px;
            margin-bottom: 24px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dim);
            margin-bottom: 8px;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        input[type=text], input[type=date], textarea, select {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--panel-border);
            color: var(--text);
            padding: 12px 14px;
            border-radius: 12px;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: border-color .15s ease, background .15s ease;
        }
        input:focus, textarea:focus, select:focus {
            border-color: var(--accent-a);
            background: rgba(255,255,255,0.06);
        }
        textarea { resize: vertical; min-height: 100px; }

        .error-text { color: var(--danger); font-size: 13px; margin-top: 6px; }

        ::placeholder { color: #5b6178; }
    </style>
</head>
<body>
    <div class="aurora-bg"><span></span><span></span><span></span></div>

    <div class="shell">
        <header class="top">
            <div class="brand">
                <span class="dot">✦</span>
                Aurora <span style="color: var(--text-dim); font-weight: 400;">Tasks</span>
            </div>
            <nav>
                <a href="{{ route('tasks.index') }}">Board</a>
                <a href="{{ route('tasks.create') }}">+ New Task</a>
            </nav>
        </header>

        @if (session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
