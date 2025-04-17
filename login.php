<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <!-- jQuery y jQuery UI -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

  <!-- Particles.js -->
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color:rgb(134, 131, 131);
      margin: 0;
      padding: 0;
      overflow: hidden;
    }

    #particles-js {
      position: fixed;
      width: 100%;
      height: 100%;
      z-index: -1;
      top: 0;
      left: 0;
    }

    #loginBox {
      width: 300px;
      margin: 120px auto;
      padding: 25px;
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 10px;
      box-shadow: 0px 5px 15px rgba(0,0,0,0.3);
      position: relative;
      z-index: 1;
    }

    input, button {
      margin: 10px 0;
      padding: 10px;
      width: 90%;
    }

    h2 {
      margin-bottom: 20px;
    }

    #error {
      color: red;
      font-weight: bold;
      margin-top: 10px;
      display: none;
    }
  </style>
</head>
<body>

  <div id="particles-js"></div>

  <!-- Caja de login -->
  <div id="loginBox" class="ui-widget-content">
    <h2 class="ui-widget-header">Iniciar sesión</h2>

    <form id="loginForm">
      <input type="email" name="email" placeholder="Correo" required><br>
      <input type="password" name="password" placeholder="Contraseña" required><br>
      <button type="submit">Ingresar</button>
    </form>

    <div id="error"></div>
  </div>

  <!-- Script de login -->
  <script>
    $(document).ready(function () {
      $("#loginForm").on("submit", function (e) {
        e.preventDefault();

        $.post("validar_login.php", $(this).serialize(), function (response) {
          if (response.trim() === "ok") {
            window.location.href = "index.php";
          } else {
            $("#error").text("Credenciales inválidas").fadeIn().effect("shake");
          }
        });
      });
    });
  </script>

  <script>
    particlesJS("particles-js", {
      "particles": {
        "number": { "value": 80, "density": { "enable": true, "value_area": 800 } },
        "color": { "value": "#faa634" },
        "shape": { 
          "type": "triangle",
          "stroke": { "width": 0, "color": "#000000" },
          "polygon": { "nb_sides": 5 }
        },
        "opacity": {
          "value": 0.5,
          "random": false,
          "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false }
        },
        "size": {
          "value": 6,
          "random": true,
          "anim": { "enable": false, "speed": 40, "size_min": 0.1, "sync": false }
        },
        "line_linked": {
          "enable": true,
          "distance": 150,
          "color": "#faa634",
          "opacity": 0.4,
          "width": 1
        },
        "move": {
          "enable": true,
          "speed": 6,
          "direction": "none",
          "random": false,
          "straight": false,
          "out_mode": "out",
          "bounce": false,
          "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 }
        }
      },
      "interactivity": {
        "detect_on": "canvas",
        "events": {
          "onhover": { "enable": false, "mode": "repulse" },
          "onclick": { "enable": true, "mode": "push" },
          "resize": true
        },
        "modes": {
          "grab": { "distance": 400, "line_linked": { "opacity": 1 } },
          "bubble": {
            "distance": 400,
            "size": 40,
            "duration": 2,
            "opacity": 8,
            "speed": 3
          },
          "repulse": { "distance": 200, "duration": 0.4 },
          "push": { "particles_nb": 4 },
          "remove": { "particles_nb": 2 }
        }
      },
      "retina_detect": true
    });
  </script>

</body>
</html>
