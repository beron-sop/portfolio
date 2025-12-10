<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Welcome</title>

  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: "Inter", sans-serif;
      background: #0F172A;
      color: #F4F4F4;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      opacity: 0;
      transition: opacity 1s ease;
      cursor: default;
    }
    body.fade-in { opacity: 1; }

    h1, h2 {
      font-family: "Sora", sans-serif;
      color: #22D3EE;
    }

    .welcome-card {
      width: 360px;
      padding: 45px;
      text-align: center;
      border-radius: 18px;
      background: rgba(255,255,255,0.05);
      backdrop-filter: blur(14px);
      border: 1px solid rgba(255,255,255,0.1);
      box-shadow: 0 10px 30px rgba(0,0,0,0.4);
      animation: floatUp .8s ease forwards;
    }

    @keyframes floatUp {
      from { opacity: 0; transform: translateY(25px); }
      to { opacity: 1; transform: translateY(0); }
    }

    p { opacity: .8; margin-bottom: 25px; }

    .btn {
      display: block;
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 10px;
      font-weight: 700;
      cursor: pointer;
      text-align:center;
      text-decoration:none;
      transition: 0.3s ease;
      font-family: "Inter", sans-serif;
    }

    .btn-login {
      background: #22D3EE;
      color:#0F172A;
      box-shadow: 0 0 15px rgba(34,211,238,0.4);
    }
    .btn-login:hover {
      box-shadow: 0 0 25px rgba(34,211,238,0.7);
    }

    .btn-register {
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.2);
      color:#F4F4F4;
    }
    .btn-register:hover {
      border-color: #22D3EE;
      color: #22D3EE;
      text-shadow: 0 0 10px #22D3EE;
    }

    .footer {
      position: fixed;
      bottom: 10px;
      width: 100%;
      color: #64748B;
      font-size: 14px;
      text-align: center;
      line-height: 1.4;
    }

    .cursor-glow {
      position: fixed;
      width: 200px;
      height: 200px;
      pointer-events: none;
      border-radius: 50%;
      background: radial-gradient(circle,
        rgba(34, 211, 238, 0.30) 0%,
        rgba(168, 85, 247, 0.25) 35%,
        rgba(236, 72, 153, 0.20) 60%,
        rgba(236, 72, 153, 0.00) 80%
      );
      filter: blur(40px);
      transform: translate(-50%, -50%);
      z-index: 9999;
      transition: left 0.07s linear, top 0.07s linear;
    }
  </style>
</head>

<body class="fade-in">

  <div class="welcome-card">
    <h1>Welcome to Sophie’s Website</h1>
    <p>Maayong Adlaw!</p>

    <a href="login.php" class="btn btn-login">Login</a>
    <a href="register.php" class="btn btn-register">Register</a>
    <a href="guest.php" class="btn">Just visiting? Login as Guest</a>

  </div>

  <div class="footer">

    <div>© 2025</div>
    <div>My Website. All rights reserved.</div>
  </div>

  <div class="cursor-glow"></div>

  <script>
    const glow = document.querySelector('.cursor-glow');

    document.addEventListener('mousemove', (e) => {
      glow.style.left = `${e.clientX}px`;
      glow.style.top = `${e.clientY}px`;
    });
  </script>

</body>
</html>
