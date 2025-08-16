<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MoBazaar - Intro</title>
  <link rel="icon" type="image/png" href="favlogo.jpeg">
  <style>
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background: linear-gradient(-45deg, #000000, #200000, #400000, #000000);
      background-size: 400% 400%;
      animation: gradientMove 6s ease infinite;
      overflow: hidden;
      font-family: Arial, sans-serif;
      color: white;
    }

    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .bag {
      width: 180px;
      height: 220px;
      border: 3px solid white;
      border-radius: 12px;
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0 0 30px red;
      animation: pop 1.5s ease-out;
      background: rgba(0, 0, 0, 0.3);
    }

    .bag img {
      max-width: 70%;
      max-height: 70%;
      animation: fadeIn 2s ease-in-out;
    }

    .bag::before {
      content: "";
      position: absolute;
      top: -40px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 40px;
      border: 3px solid white;
      border-bottom: none;
      border-radius: 30px 30px 0 0;
    }

    .subtitle {
      margin-top: 20px;
      font-size: 22px;
      font-weight: bold;
      animation: glow 2s infinite alternate, fadeInUp 2s ease forwards;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    @keyframes pop {
      0% { transform: scale(0); opacity: 0; }
      60% { transform: scale(1.2); opacity: 1; }
      100% { transform: scale(1); }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.8); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes glow {
      from {
        color: #ff0000;
        text-shadow: 0 0 5px #ff0000, 0 0 15px #ff3333, 0 0 25px #ff6666;
      }
      to {
        color: #ffffff;
        text-shadow: 0 0 5px #ffffff, 0 0 15px #ff0000, 0 0 25px #ff0000;
      }
    }
  </style>
  <script>
    setTimeout(() => {
      window.location.href = "home.php"; // Redirect after 3s
    }, 4000);
  </script>
</head>
<body>
  <div class="bag">
    <img src="mobazaar-no-bg.png" alt="MoBazaar Logo">
  </div>
  <div class="subtitle">Odisha's Biggest Mart</div>
</body>
</html>
