<?php
session_start(); // Mulai sesi
?>

<!DOCTYPE html>
<html>
<head>
  <title>Portal AI</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #000000;
      color: white;
      text-align: center;
      font-family: sans-serif;
      height: 100vh; /* Full viewport height */
      display: flex;
      flex-direction: column;
      justify-content: center; /* Center content vertically */
      align-items: center; /* Center content horizontally */
    }
    footer {
      position: absolute;
      bottom: 20px; /* Position footer at the bottom */
      width: 100%;
      font-size: 24px;
      color: cyan;
      text-shadow: 0 0 10px cyan;
    }
    .ring {
      width: 150px;
      height: 150px;
      background: transparent;
      border: 3px solid #3c3c3c;
      border-radius: 50%;
      text-align: center;
      line-height: 150px;
      font-size: 20px;
      color: cyan;
      letter-spacing: 5px;
      text-transform: uppercase;
      text-shadow: 0 0 26px cyan;
      box-shadow: 0 0 26px rgba(26, 26, 26, 26);
      position: relative; /* Relative positioning for the rotating ring */
    }
    .ring:before {
      content: '';
      position: absolute;
      top: -3px;
      left: -3px;
      width: 100%;
      height: 100%;
      border: 3px solid transparent;
      border-top: 3px solid cyan;
      border-right: 3px solid cyan;
      border-radius: 50%;
      animation: animateCircle 2s linear infinite;
    }
    @keyframes animateCircle {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .btn-contain {
      margin-top: 20px; /* Margin to position below the ring */
      z-index: 1; /* Ensure button appears above the ring */
    }
    .btn-outline-contain {
      max-width: 270px;
      margin: 0 auto;
    }
    .btn-outline {
      font-family: sans-serif;
      font-weight: bold;
      text-align: center;
      color: rgba(255, 235, 59, 0.5);
      text-transform: uppercase;
      text-decoration: none;
      outline: none;
      cursor: pointer;
      position: relative;
      border: 1px solid rgba(255, 235, 59, 0.5);
      padding: 20px;
      display: block;
      transition: .5s ease-in-out;
    }
    .line-1, .line-2, .line-3, .line-4 {
      content: "";
      display: block;
      position: absolute;
      background-color: #fff59d;
    }
    .line-1 { width: 2px; left: 0; bottom: 0; }
    .line-2 { height: 2px; left: 0; top: 0; }
    .line-3 { width: 2px; right: 0; top: 0; }
    .line-4 { height: 2px; right: 0; top: 57px; }
    @keyframes outline1 {
      0% { height: 100%; bottom: 0; }
      54% { height: 0; bottom: 100%; }
      55% { height: 0; bottom: 0; }
      100% { height: 100%; bottom: 0; }
    }
    @keyframes outline2 {
      0% { width: 0; left: 0; }
      50% { width: 100%; left: 0; }
      100% { width: 0; left: 100%; }
    }
    @keyframes outline3 {
      0% { height: 100%; top: 0; }
      54% { height: 0; top: 100%; }
      55% { height: 0; top: 0; }
      100% { height: 100%; top: 0; }
    }
    @keyframes outline4 {
      0% { width: 0; right: 0; }
      55% { width: 100%; right: 0; }
      100% { width: 0; right: 100%; }
    }
  </style>
</head>
<body>
  <audio id="audio" src=""></audio>
  <div class="ring">HENZX</div>
  <div class="btn-contain">
    <div class='btn-outline-contain'>
      <a class='btn-outline' href='daftar.php' id='animate-button' onclick="playAudio()">
        <span class="btn-outline-inner">MASUK</span>
        <span class='line-1'></span>
        <span class='line-2'></span>
        <span class='line-3'></span>
        <span class='line-4'></span>
      </a>
    </div>
  </div>
  <footer>Portal AI</footer>
  <script>
    function playAudio() {
      var audio = document.getElementById('audio');
      audio.play();
    }
    document.getElementById('animate-button').addEventListener('click', function(event) {
      event.preventDefault(); // Prevent the default link behavior
      const link = this.getAttribute('href'); // Get the link URL
      setTimeout(() => {
        window.location.href = link; // Redirect after 500 milliseconds
      }, 500);
    });
  </script>
</body>
</html>