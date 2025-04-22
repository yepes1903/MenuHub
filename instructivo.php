<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Instructivo para Comprar en Línea vía WhatsApp</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        :root {
            --primary-color: #6b35ff;
            --secondary-color: #4d059e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            overflow: hidden;
            perspective: 1000px;
            background: linear-gradient(135deg, #ffedbc, #ff6b35);
        }

        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1098e7, #699dfc);
            overflow: hidden;
            z-index: -1;
        }

        .background-animation::before,
        .background-animation::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.5;
        }

        .background-animation::before {
            background: radial-gradient(circle at 20% 70%, rgba(255,255,255,0.3) 0%, transparent 50%);
            animation: moveGradient 15s ease infinite;
        }

        .background-animation::after {
            background: radial-gradient(circle at 80% 30%, rgba(255,255,255,0.2) 0%, transparent 60%);
            animation: moveGradient 20s ease-in-out infinite alternate;
        }

        @keyframes moveGradient {
            0% {
                transform: scale(1) rotate(0deg);
            }
            50% {
                transform: scale(1.2) rotate(180deg);
            }
            100% {
                transform: scale(1) rotate(360deg);
            }
        }

        .container {
            width: 100%;
            max-width: 700px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 25px 45px rgba(0,0,0,0.1);
            padding: 40px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            transform: rotateX(10deg);
            transition: all 0.3s ease;
            color: #333;
        }

        .container:hover {
            transform: rotateX(0);
            box-shadow: 0 30px 50px rgba(0,0,0,0.15);
        }

        h1 {
            color: var(--primary-color);
            font-size: 32px;
            margin-bottom: 20px;
            text-align: center;
        }

        p.intro {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
            text-align: center;
        }

        ol.steps {
            list-style: decimal inside;
            font-size: 18px;
            color: #444;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        ol.steps li {
            margin-bottom: 15px;
        }

        .btn-contact {
            display: block;
            width: 220px;
            margin: 0 auto;
            padding: 15px 0;
            border-radius: 30px;
            color: #fff;
            border: none;
            background-color: var(--primary-color);
            font-size: 18px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: 0.5s;
        }

        .btn-contact:hover {
            background-color: #fff;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
                margin: 0 10px;
            }

            h1 {
                font-size: 26px;
            }

            p.intro, ol.steps {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="background-animation"></div>
    <div class="container">
        <h1>Cómo Comprar en Línea vía WhatsApp</h1>
        <p class="intro">
            Sigue estos sencillos pasos para realizar tu compra en línea de manera rápida y segura a través de WhatsApp.
        </p>
        <ol class="steps">
            <li>Abre la aplicación de WhatsApp en tu teléfono o computadora.</li>
            <li>Agrega nuestro número de contacto: <strong>+123 456 7890</strong> a tu lista de contactos.</li>
            <li>Envía un mensaje con el nombre del producto que deseas comprar.</li>
            <li>Recibirás una respuesta con la confirmación de disponibilidad y el precio.</li>
            <li>Confirma tu pedido enviando tus datos de envío y forma de pago.</li>
            <li>Recibe la confirmación final y el tiempo estimado de entrega.</li>
            <li>Realiza el pago según las instrucciones proporcionadas.</li>
            <li>Espera la entrega de tu producto en la dirección indicada.</li>
        </ol>
        <a href="https://wa.me/1234567890" target="_blank" class="btn-contact">Contactar por WhatsApp</a>
        <a href="index.php" target="_blank" class="btn-contact">Volver</a>
    </div>
</body>
</html>
