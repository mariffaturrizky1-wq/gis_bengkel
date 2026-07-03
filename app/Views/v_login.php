<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login | GIS Bengkel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --orange: #ff6b00;
      --orange2: #e84800;
      --dark: #111113;
      --dark2: #1c1c1e;
      --dark3: #252527;
      --card: rgba(255,255,255,.06);
      --stroke: rgba(255,255,255,.10);
      --text: rgba(255,255,255,.92);
      --muted: rgba(255,255,255,.60);
      --radius: 20px;
      --radius2: 14px;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; }
    body {
      min-height: 100vh;
      font-family: ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif;
      color: var(--text);
      background: #0f0a00;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px 16px;
      overflow-x: hidden;
      overflow-y: auto;
      position: relative;
    }

    /* ===== CANVAS BACKGROUND ===== */
    #bgCanvas {
      position: fixed;
      inset: 0;
      z-index: 0;
    }

    /* ===== SPARKS LAYER ===== */
    #sparksCanvas {
      position: fixed;
      inset: 0;
      z-index: 1;
      pointer-events: none;
    }

    /* ===== FLOATING GEARS ===== */
    .floaters {
      position: fixed;
      inset: 0;
      z-index: 2;
      pointer-events: none;
      overflow: hidden;
    }
    .floater {
      position: absolute;
      opacity: 0;
      animation: floatGear linear infinite;
    }
    @keyframes floatGear {
      0%   { opacity: 0; transform: translateY(110vh) rotate(0deg); }
      5%   { opacity: .18; }
      95%  { opacity: .10; }
      100% { opacity: 0; transform: translateY(-20vh) rotate(360deg); }
    }

    /* ===== WRAP ===== */
    .wrap {
      position: relative;
      z-index: 10;
      width: min(980px, 95vw);
      display: grid;
      grid-template-columns: 1.15fr 1fr;
      gap: 0;
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: 0 40px 120px rgba(0,0,0,.80);
      border: 1px solid rgba(255,107,0,.20);
    }

    /* ===== LEFT PANEL ===== */
    .left {
      background: linear-gradient(145deg, #c23400 0%, #e84800 40%, #ff6b00 100%);
      padding: 36px 32px 32px;
      position: relative;
      overflow: hidden;
    }
    .left::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        radial-gradient(circle at 80% 10%, rgba(255,255,255,.12) 0%, transparent 45%),
        radial-gradient(circle at 20% 90%, rgba(0,0,0,.25) 0%, transparent 45%);
    }
    .left-pattern {
      position: absolute;
      inset: 0;
      opacity: .07;
      background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 5l2 4h4l-3 3 1 4-4-2-4 2 1-4-3-3h4z' fill='white'/%3E%3C/svg%3E");
    }
    .left > * { position: relative; z-index: 1; }

    .brand {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 26px;
    }
    .brand-icon {
      width: 52px; height: 52px;
      border-radius: 16px;
      background: rgba(0,0,0,.28);
      display: grid;
      place-items: center;
      font-size: 24px;
      flex-shrink: 0;
      border: 1px solid rgba(255,255,255,.18);
      box-shadow: 0 8px 24px rgba(0,0,0,.30);
    }
    .brand-name { font-size: 19px; font-weight: 900; letter-spacing: .3px; }
    .brand-sub  { font-size: 12px; opacity: .78; margin-top: 3px; }

    .left h2 {
      font-size: 28px;
      font-weight: 900;
      line-height: 1.18;
      margin-bottom: 13px;
    }
    .left h2 em { font-style: normal; color: #ffe0bf; }
    .left p {
      font-size: 13.5px;
      opacity: .85;
      line-height: 1.75;
      margin-bottom: 24px;
      max-width: 40ch;
    }

    .stats {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
      margin-bottom: 22px;
    }
    .stat {
      background: rgba(0,0,0,.22);
      border: 1px solid rgba(255,255,255,.14);
      border-radius: 14px;
      padding: 12px 14px;
    }
    .stat .sv { font-size: 15px; font-weight: 900; margin-top: 4px; }
    .stat .sk { font-size: 11px; opacity: .72; }

    .chips { display: flex; flex-wrap: wrap; gap: 8px; }
    .chip {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 7px 12px;
      border-radius: 999px;
      font-size: 12px;
      background: rgba(0,0,0,.24);
      border: 1px solid rgba(255,255,255,.16);
    }
    .chip i { font-size: 11px; opacity: .90; }

    /* ===== RIGHT PANEL ===== */
    .right {
      background: var(--dark2);
      padding: 36px 30px 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .topbar {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 26px;
    }
    .topbar h3   { font-size: 20px; font-weight: 900; color: #fff; }
    .topbar p    { font-size: 12.5px; color: var(--muted); margin-top: 5px; }
    .status-pill {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 6px 13px;
      border-radius: 999px;
      font-size: 11.5px;
      font-weight: 500;
      background: var(--dark3);
      border: 1px solid rgba(255,255,255,.12);
      color: #aaa;
      white-space: nowrap;
    }
    .dot {
      width: 7px; height: 7px;
      border-radius: 50%;
      background: #4ade80;
      box-shadow: 0 0 7px #4ade80;
      flex-shrink: 0;
    }

    /* ===== FORM ===== */
    .field { margin-bottom: 16px; }
    .field label {
      display: flex;
      align-items: center;
      gap: 7px;
      font-size: 12px;
      color: var(--muted);
      margin-bottom: 8px;
    }
    .field label i { color: var(--orange); font-size: 11px; }

    .inp-wrap { position: relative; }
    .inp-wrap input {
      width: 100%;
      height: 50px;
      border-radius: var(--radius2);
      border: 1px solid rgba(255,255,255,.12);
      background: rgba(255,255,255,.05);
      color: #fff;
      padding: 0 50px 0 15px;
      font-size: 14px;
      outline: none;
      font-family: inherit;
      transition: border-color .2s, box-shadow .2s, background .2s;
    }
    .inp-wrap input:focus {
      border-color: var(--orange);
      box-shadow: 0 0 0 3px rgba(255,107,0,.15);
      background: rgba(255,107,0,.05);
    }
    .inp-wrap input::placeholder { color: rgba(255,255,255,.28); }

    .inp-btn {
      position: absolute;
      right: 0; top: 0;
      width: 50px; height: 50px;
      display: grid;
      place-items: center;
      cursor: pointer;
      color: rgba(255,255,255,.40);
      border-radius: 0 var(--radius2) var(--radius2) 0;
      transition: color .2s;
      font-size: 14px;
    }
    .inp-btn:hover { color: var(--orange); }

    .rowline {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 12px;
      margin-bottom: 18px;
    }
    .remember {
      display: flex;
      align-items: center;
      gap: 8px;
      color: var(--muted);
      cursor: pointer;
      user-select: none;
    }
    .remember input { accent-color: var(--orange); }
    .forgot { color: var(--orange); text-decoration: none; font-size: 12px; }
    .forgot:hover { text-decoration: underline; }

    /* strength bar */
    .strength-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 8px;
      font-size: 11px;
      color: var(--muted);
    }
    .strength-bar {
      flex: 1;
      height: 4px;
      border-radius: 999px;
      background: rgba(255,255,255,.08);
      overflow: hidden;
    }
    .strength-fill {
      height: 100%;
      width: 0%;
      border-radius: 999px;
      transition: width .25s ease, background .25s;
    }

    /* buttons */
    .btn-primary {
      width: 100%; height: 52px;
      border: none;
      border-radius: 16px;
      font-size: 15px;
      font-weight: 800;
      letter-spacing: .5px;
      color: #fff;
      background: linear-gradient(90deg, #ff6b00, #e84800);
      cursor: pointer;
      font-family: inherit;
      transition: transform .18s, box-shadow .18s;
      box-shadow: 0 12px 40px rgba(255,107,0,.35);
      margin-bottom: 12px;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 18px 55px rgba(255,107,0,.50);
    }
    .btn-primary:active { transform: translateY(0); }
    .btn-primary i { margin-right: 8px; }

    .btn-sec {
      width: 100%; height: 46px;
      border: 1px solid rgba(255,255,255,.12);
      border-radius: 14px;
      font-size: 13px;
      font-weight: 600;
      color: var(--muted);
      background: var(--dark3);
      cursor: pointer;
      font-family: inherit;
      transition: border-color .2s, color .2s;
    }
    .btn-sec:hover { border-color: rgba(255,107,0,.40); color: #fff; }
    .btn-sec i { margin-right: 7px; color: var(--orange); }

    .divider {
      display: flex;
      align-items: center;
      gap: 12px;
      margin: 14px 0;
      color: rgba(255,255,255,.20);
      font-size: 11px;
    }
    .divider::before, .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: rgba(255,255,255,.10);
    }

    .footer-note {
      margin-top: 16px;
      font-size: 11px;
      color: rgba(255,255,255,.32);
      display: flex;
      align-items: center;
      gap: 6px;
      justify-content: center;
    }
    .footer-note i { color: var(--orange); }

    /* ===== TOAST ===== */
    .toasts {
      position: fixed;
      top: 16px; right: 16px;
      z-index: 9999;
      display: flex;
      flex-direction: column;
      gap: 10px;
      width: min(340px, calc(100vw - 32px));
      pointer-events: none;
    }
    .toast {
      pointer-events: auto;
      background: #1c1c1e;
      border: 1px solid rgba(255,255,255,.14);
      border-radius: 16px;
      padding: 12px 14px;
      display: flex;
      align-items: flex-start;
      gap: 10px;
      box-shadow: 0 16px 50px rgba(0,0,0,.50);
      animation: tIn .3s ease forwards;
    }
    @keyframes tIn {
      from { opacity: 0; transform: translateX(20px); }
      to   { opacity: 1; transform: translateX(0); }
    }
    .t-ic {
      width: 34px; height: 34px;
      border-radius: 11px;
      display: grid; place-items: center;
      flex-shrink: 0; font-size: 15px;
    }
    .t-err .t-ic  { background: #2d1010; color: #f87171; }
    .t-ok  .t-ic  { background: #0d2d1a; color: #4ade80; }
    .t-info .t-ic { background: #1a1a00; color: #fbbf24; }
    .t-ttl { font-size: 13px; font-weight: 700; color: #eee; }
    .t-msg { font-size: 11.5px; color: #888; margin-top: 3px; line-height: 1.45; }

    /* ===== LOADING ===== */
    .loading {
      position: fixed; inset: 0;
      z-index: 99999;
      background: rgba(5,3,0,.70);
      display: none;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(8px);
      flex-direction: column;
      gap: 18px;
    }
    .loading.show { display: flex; }
    .spinner {
      width: 64px; height: 64px;
      border-radius: 50%;
      border: 5px solid rgba(255,107,0,.20);
      border-top: 5px solid var(--orange);
      animation: spin 0.9s linear infinite;
    }
    .loading p { font-size: 14px; color: var(--muted); }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* ===== SHAKE ===== */
    .shake { animation: shake .4s ease; }
    @keyframes shake {
      0%,100% { transform: translateX(0); }
      20%      { transform: translateX(-9px); }
      40%      { transform: translateX(9px); }
      60%      { transform: translateX(-6px); }
      80%      { transform: translateX(6px); }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 760px) {
      .wrap { grid-template-columns: 1fr; }
      .left { padding: 28px 24px; }
      .left h2 { font-size: 22px; }
      .stats { grid-template-columns: 1fr 1fr; }
      .right { padding: 28px 22px 24px; }
    }
  </style>
</head>
<body>

<!-- Background canvas -->
<canvas id="bgCanvas"></canvas>

<!-- Sparks / welding particles canvas -->
<canvas id="sparksCanvas"></canvas>

<!-- Floating gears layer -->
<div class="floaters" id="floaters"></div>

<!-- Toast container -->
<div class="toasts" id="toasts"></div>

<!-- Loading overlay -->
<div class="loading" id="loading">
  <div class="spinner"></div>
  <p><i class="fas fa-wrench fa-spin"></i> &nbsp; Memeriksa akun...</p>
</div>

<!-- MAIN CARD -->
<div class="wrap" id="mainCard">

  <!-- LEFT: PROMO -->
  <section class="left">
    <div class="left-pattern"></div>

    <div class="brand">
      <div class="brand-icon"><i class="fas fa-tools"></i></div>
      <div>
        <div class="brand-name">GIS Bengkel</div>
        <div class="brand-sub">Sistem Informasi Bengkel Online</div>
      </div>
    </div>

    <h2>Kelola bengkel dengan <em>lebih cepat</em> & <em>lebih cerdas</em></h2>
    <p>
      Portal terpusat untuk manajemen servis kendaraan, data mekanik,
      peta lokasi bengkel, dan laporan real-time berbasis GIS.
    </p>

    <div class="stats">
      <div class="stat">
        <div class="sk">Servis Status</div>
        <div class="sv"><i class="fas fa-bolt" style="color:#ffe0bf"></i> Real-time</div>
      </div>
      <div class="stat">
        <div class="sk">Akses</div>
        <div class="sv"><i class="fas fa-user-shield" style="color:#ffe0bf"></i> Multi-level</div>
      </div>
      <div class="stat">
        <div class="sk">Peta GIS</div>
        <div class="sv"><i class="fas fa-map-marked-alt" style="color:#ffe0bf"></i> Interaktif</div>
      </div>
      <div class="stat">
        <div class="sk">Laporan</div>
        <div class="sv"><i class="fas fa-chart-bar" style="color:#ffe0bf"></i> Otomatis</div>
      </div>
    </div>

    <div class="chips">
      <div class="chip"><i class="fas fa-wrench"></i> Manajemen servis</div>
      <div class="chip"><i class="fas fa-car"></i> Data kendaraan</div>
      <div class="chip"><i class="fas fa-user-cog"></i> Mekanik</div>
      <div class="chip"><i class="fas fa-map-pin"></i> Lokasi bengkel</div>
      <div class="chip"><i class="fas fa-history"></i> Riwayat servis</div>
      <div class="chip"><i class="fas fa-lock"></i> Session aman</div>
    </div>
  </section>

  <!-- RIGHT: LOGIN -->
  <section class="right" id="loginCard">
    <div class="topbar">
      <div>
        <h3><i class="fas fa-sign-in-alt" style="color:var(--orange);margin-right:8px"></i>Masuk</h3>
        <p>Login ke portal GIS Bengkel Anda</p>
      </div>
      <div class="status-pill">
        <span class="dot"></span> Sistem aktif
      </div>
    </div>

    <!-- PHP flashdata placeholder -->
    <?php
      $pesan  = session()->getFlashdata('pesan');
      $error  = session()->getFlashdata('error');
      $errors = session()->getFlashdata('errors');
    ?>

    <form action="<?= base_url('auth/cek_login_user') ?>" method="post" onsubmit="handleSubmit(event)">
      <?= csrf_field() ?>

      <!-- EMAIL -->
      <div class="field">
        <label><i class="fas fa-envelope"></i> Email</label>
        <div class="inp-wrap">
          <input id="email" type="email" name="email"
                 placeholder="contoh: admin@bengkel.com"
                 autocomplete="username" required>
          <div class="inp-btn"><i class="fas fa-at"></i></div>
        </div>
      </div>

      <!-- PASSWORD -->
      <div class="field">
        <label><i class="fas fa-lock"></i> Password</label>
        <div class="inp-wrap">
          <input id="password" type="password" name="password"
                 placeholder="••••••••"
                 autocomplete="current-password" required
                 oninput="updateStrength(this.value)">
          <div class="inp-btn" onclick="togglePw()" id="eyeBtn" title="Tampilkan/Sembunyikan">
            <i class="fas fa-eye" id="eyeIco"></i>
          </div>
        </div>
        <div class="strength-row">
          <span id="strLabel" style="min-width:74px"><i class="fas fa-signal"></i> Strength</span>
          <div class="strength-bar"><div class="strength-fill" id="strBar"></div></div>
        </div>
      </div>

      <!-- REMEMBER & FORGOT -->
      <div class="rowline">
        <label class="remember">
          <input type="checkbox" id="rememberMe">
          Ingat email saya
        </label>
        <a class="forgot" href="<?= base_url('auth/forgot') ?>">Lupa password?</a>
      </div>

      <!-- SUBMIT -->
      <button type="submit" class="btn-primary" id="btnLogin">
        <i class="fas fa-key"></i> MASUK SEKARANG
      </button>
    </form>

    <a href="<?= base_url('home') ?>" class="btn-sec" style="display: flex; align-items: center; justify-content: center; height: 52px; text-decoration: none; margin-bottom: 12px; font-weight: 800;">
      <i class="fas fa-arrow-left"></i> BATAL / KEMBALI
    </a>

    <div class="divider">atau</div>
    <button class="btn-sec" onclick="contactAdmin()">
      <i class="fas fa-headset"></i> Hubungi Administrator
    </button>

    <div class="footer-note">
      <i class="fas fa-shield-alt"></i> Koneksi aman &bull; GIS Bengkel &copy; 2025
    </div>

    <!-- hidden server messages -->
    <div id="serverMsg"
         data-pesan="<?= esc($pesan ?? '') ?>"
         data-error="<?= esc($error ?? '') ?>"
         data-errors="<?= esc(is_array($errors) ? implode(' | ', $errors) : ($errors ?? '')) ?>">
    </div>
  </section>
</div>

<!-- ====================================================
     JAVASCRIPT — ALL INLINE
===================================================== -->
<script>
// ─── 1. BACKGROUND CANVAS (dark industrial + grid) ─────────────────────────
(function() {
  const c  = document.getElementById('bgCanvas');
  const cx = c.getContext('2d');
  let W, H;

  function resize() {
    W = c.width  = window.innerWidth;
    H = c.height = window.innerHeight;
  }
  resize();
  window.addEventListener('resize', resize);

  // grid lines
  function drawGrid(t) {
    cx.clearRect(0, 0, W, H);

    // base gradient
    const grad = cx.createLinearGradient(0, 0, W, H);
    grad.addColorStop(0,   '#0f0a00');
    grad.addColorStop(0.4, '#1a0e00');
    grad.addColorStop(1,   '#0a0500');
    cx.fillStyle = grad;
    cx.fillRect(0, 0, W, H);

    // orange glow top-right
    const g2 = cx.createRadialGradient(W*.85, H*.10, 0, W*.85, H*.10, W*.55);
    g2.addColorStop(0,   'rgba(255,107,0,.18)');
    g2.addColorStop(0.5, 'rgba(200,60,0,.06)');
    g2.addColorStop(1,   'transparent');
    cx.fillStyle = g2;
    cx.fillRect(0, 0, W, H);

    // bottom-left glow
    const g3 = cx.createRadialGradient(W*.10, H*.90, 0, W*.10, H*.90, W*.45);
    g3.addColorStop(0,   'rgba(180,50,0,.14)');
    g3.addColorStop(1,   'transparent');
    cx.fillStyle = g3;
    cx.fillRect(0, 0, W, H);

    // animated grid
    const spacing = 60;
    const offsetX = (t * 8) % spacing;
    const offsetY = (t * 4) % spacing;
    cx.strokeStyle = 'rgba(255,107,0,.06)';
    cx.lineWidth = 0.8;
    cx.beginPath();
    for (let x = -spacing + offsetX; x < W + spacing; x += spacing) {
      cx.moveTo(x, 0); cx.lineTo(x, H);
    }
    for (let y = -spacing + offsetY; y < H + spacing; y += spacing) {
      cx.moveTo(0, y); cx.lineTo(W, y);
    }
    cx.stroke();
  }

  let t = 0;
  function loop() { t += 0.016; drawGrid(t); requestAnimationFrame(loop); }
  loop();
})();


// ─── 2. SPARKS / WELDING PARTICLES ─────────────────────────────────────────
(function() {
  const c  = document.getElementById('sparksCanvas');
  const cx = c.getContext('2d');
  let W, H;

  function resize() {
    W = c.width  = window.innerWidth;
    H = c.height = window.innerHeight;
  }
  resize();
  window.addEventListener('resize', resize);

  const sparks = [];
  const COLORS = ['#ff6b00','#ff9900','#ffcc00','#fff0a0','#ff4400'];

  function spawnSpark() {
    const x = Math.random() * W;
    const y = Math.random() * H;
    sparks.push({
      x, y,
      vx: (Math.random() - .5) * 4,
      vy: -(Math.random() * 3 + 1),
      life: 1,
      decay: Math.random() * .02 + .01,
      size: Math.random() * 2.5 + .5,
      color: COLORS[Math.floor(Math.random() * COLORS.length)],
      trail: []
    });
  }

  function tick() {
    cx.clearRect(0, 0, W, H);

    if (Math.random() < .18) spawnSpark();

    for (let i = sparks.length - 1; i >= 0; i--) {
      const s = sparks[i];
      s.trail.push({ x: s.x, y: s.y });
      if (s.trail.length > 8) s.trail.shift();

      s.x  += s.vx;
      s.y  += s.vy;
      s.vy += .07; // gravity
      s.vx *= .98;
      s.life -= s.decay;

      if (s.life <= 0) { sparks.splice(i, 1); continue; }

      // draw trail
      if (s.trail.length > 1) {
        cx.beginPath();
        cx.moveTo(s.trail[0].x, s.trail[0].y);
        for (let j = 1; j < s.trail.length; j++) {
          cx.lineTo(s.trail[j].x, s.trail[j].y);
        }
        cx.strokeStyle = s.color.replace(')', `,${s.life * .35})`).replace('rgb', 'rgba').replace('##','#');
        // simpler approach:
        cx.globalAlpha = s.life * .25;
        cx.strokeStyle = s.color;
        cx.lineWidth = s.size * .5;
        cx.stroke();
      }

      // draw core
      cx.globalAlpha = s.life * .90;
      cx.fillStyle = s.color;
      cx.beginPath();
      cx.arc(s.x, s.y, s.size * s.life, 0, Math.PI * 2);
      cx.fill();

      cx.globalAlpha = 1;
    }

    requestAnimationFrame(tick);
  }
  tick();
})();


// ─── 3. FLOATING GEARS ──────────────────────────────────────────────────────
(function() {
  const container = document.getElementById('floaters');
  const ICONS = ['fa-cog','fa-wrench','fa-tools','fa-car','fa-gas-pump','fa-oil-can'];
  const COLORS = ['#ff6b00','#ff9900','#ffcc00','#e84800'];

  for (let i = 0; i < 14; i++) {
    const el = document.createElement('div');
    el.className = 'floater';
    const ico = document.createElement('i');
    ico.className = `fas ${ICONS[Math.floor(Math.random() * ICONS.length)]}`;
    const size = Math.random() * 22 + 12;
    ico.style.cssText = `font-size:${size}px;color:${COLORS[Math.floor(Math.random()*COLORS.length)]};opacity:.55`;
    el.appendChild(ico);

    const left = Math.random() * 95;
    const dur  = Math.random() * 18 + 14;
    const delay= Math.random() * -20;
    el.style.cssText = `left:${left}%;animation-duration:${dur}s;animation-delay:${delay}s`;
    container.appendChild(el);
  }
})();


// ─── 4. PASSWORD TOGGLE ──────────────────────────────────────────────────────
function togglePw() {
  const inp = document.getElementById('password');
  const ico = document.getElementById('eyeIco');
  if (inp.type === 'password') {
    inp.type = 'text';
    ico.className = 'fas fa-eye-slash';
  } else {
    inp.type = 'password';
    ico.className = 'fas fa-eye';
  }
}


// ─── 5. PASSWORD STRENGTH ────────────────────────────────────────────────────
function updateStrength(v) {
  let score = 0;
  if (v.length >= 6)  score++;
  if (v.length >= 10) score++;
  if (/[A-Z]/.test(v)) score++;
  if (/[0-9]/.test(v)) score++;
  if (/[^a-zA-Z0-9]/.test(v)) score++;

  const bar   = document.getElementById('strBar');
  const label = document.getElementById('strLabel');
  const pct   = Math.min((score / 5) * 100, 100);
  bar.style.width = pct + '%';

  if (score <= 1)      { bar.style.background = '#ef4444'; label.innerHTML = '<i class="fas fa-signal"></i> Lemah'; }
  else if (score <= 3) { bar.style.background = '#f59e0b'; label.innerHTML = '<i class="fas fa-signal"></i> Sedang'; }
  else                 { bar.style.background = '#22c55e'; label.innerHTML = '<i class="fas fa-signal"></i> Kuat'; }
}


// ─── 6. REMEMBER EMAIL ───────────────────────────────────────────────────────
(function() {
  const saved = localStorage.getItem('bengkel_email');
  if (saved) {
    document.getElementById('email').value = saved;
    document.getElementById('rememberMe').checked = true;
  }
})();


// ─── 7. TOAST ────────────────────────────────────────────────────────────────
function showToast(type, title, msg) {
  const box = document.getElementById('toasts');
  const el  = document.createElement('div');
  el.className = `toast t-${type}`;
  const icons = { ok:'fa-check-circle', err:'fa-exclamation-triangle', info:'fa-info-circle' };
  el.innerHTML = `
    <div class="t-ic"><i class="fas ${icons[type] || 'fa-info-circle'}"></i></div>
    <div>
      <div class="t-ttl">${title}</div>
      <div class="t-msg">${msg}</div>
    </div>`;
  box.appendChild(el);
  setTimeout(() => el.remove(), 5000);
}


// ─── 8. FORM SUBMIT ──────────────────────────────────────────────────────────
function handleSubmit(e) {
  const email = document.getElementById('email').value.trim();
  const pass  = document.getElementById('password').value;
  const rem   = document.getElementById('rememberMe').checked;

  if (!email || !pass) {
    e.preventDefault();
    document.getElementById('loginCard').classList.add('shake');
    setTimeout(() => document.getElementById('loginCard').classList.remove('shake'), 500);
    showToast('err', 'Field kosong', 'Mohon isi email dan password Anda.');
    return;
  }

  if (rem) localStorage.setItem('bengkel_email', email);
  else     localStorage.removeItem('bengkel_email');

  document.getElementById('loading').classList.add('show');
}

function showLoading() {
  document.getElementById('loading').classList.add('show');
}

function contactAdmin() {
  showToast('info', 'Hubungi Administrator', 'Silakan hubungi admin sistem bengkel Anda untuk akses atau reset akun.');
}


// ─── 9. SERVER FLASH MESSAGES (CI4) ─────────────────────────────────────────
(function() {
  const el     = document.getElementById('serverMsg');
  if (!el) return;
  const pesan  = el.dataset.pesan;
  const error  = el.dataset.error;
  const errors = el.dataset.errors;

  if (pesan)  showToast('ok',   'Sukses', pesan);
  if (error)  { showToast('err', 'Login Gagal', error); document.getElementById('loginCard').classList.add('shake'); setTimeout(() => document.getElementById('loginCard').classList.remove('shake'), 500); }
  if (errors) showToast('err', 'Validasi', errors);
})();
</script>

</body>
</html>
