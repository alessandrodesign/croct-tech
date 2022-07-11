<?php

use NorteDev\Produtor;
use Ramsey\Uuid\Uuid;

require __DIR__ . '/vendor/autoload.php';
$mensagem = new Produtor();
if ($_SERVER['REQUEST_METHOD'] === 'POST'):
    header('Content-Type: application/json; charset=utf-8');
    $ip = filter_has_var(INPUT_POST, 'ip') ? filter_input(INPUT_POST, 'ip', FILTER_VALIDATE_IP) : false;
    if ($ip) {
        $uuid = Uuid::uuid4();
        $message = [
            'clientID' => $uuid->toString(),
            'timestamp' => time(),
            'ip' => $ip,
        ];
        $mensagem->producer(null, TOPICS[0], $message);
    } else {
        throw new Exception("IP é requerido");
    }
else: ?>
    <!doctype html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>CROCT TECH</title>
        <style>
            .success {
                display: inline-block;
                margin-bottom: 10px;
                padding: 5px 10px;
                color: #060;
                background-color: #DFD;
            }

            .error {
                display: inline-block;
                margin-bottom: 10px;
                padding: 5px 10px;
                color: #CA0002;
                background-color: #FDD;
            }
        </style>
    </head>
    <body onload="findMyIp()">
    <h1>Informe seu IP</h1>
    <span id="notify"></span>
    <form method="post" id="formulario">
        <label>IP:
            <input type="text" name="ip" id="ip"/>
        </label>
        <button type="submit" id="btnSubmit">Enviar</button>
    </form>
    <script>
        const ipAPI = '//api.ipify.org?format=json',
            input = document.getElementById('ip'),
            notify = document.getElementById('notify'),
            btnSubmit = document.getElementById('btnSubmit');

        function findMyIp() {
            fetch(ipAPI)
                .then(response => response.json())
                .then(data => input.value = data.ip);
        }

        document.getElementById('formulario').addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            btnSubmit.setAttribute('disabled', true);
            input.setAttribute('disabled', true);
            btnSubmit.innerText = 'Enviando...';

            fetch(e.target.action, {method: 'POST', body: formData})
                .then(response => response.json())
                .then(data => {
                    if (data.data) {
                        btnSubmit.removeAttribute('disabled');
                        input.removeAttribute('disabled');
                        input.value = "";
                        btnSubmit.innerText = 'Enviar';
                        notify.classList.add('success');
                        notify.innerText = "Enviado com sucesso";
                        setTimeout(() => {
                            notify.innerText = "";
                            notify.classList.remove('success');
                        }, 2500);
                    }
                })
                .catch(error => console.log(error))
        });
    </script>
    </body>
    </html>
<?php endif;