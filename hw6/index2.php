<?php
session_start();
$m = new Memcached();
$m->addServer('192.168.1.73', 11211);
$m->set('server', 'server 1');

$_SESSION['user1'] = 'user1';

var_dump($m->get('server'));
var_dump($m->get('server2'));

class Info {
   public $name;
   public $desc;
}



$object = new Info;
$object->name = $_GET['name'];
$object->desc = $_GET['desc'];
$name = $object->name;
$desc = $object->desc;


$Redis = new Redis();
$Redis->connect('127.0.0.1', 6379);
$Redis->set('name',$object->name);
$Redis->set('desc',$object->desc);
$rName = $Redis->get('name');
$rDesc = $Redis->get('desc');



echo <<<HTML
        <head>
            <meta charset="UTF-8">
            <title>Модальное окно server1</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
        <H1>Server1!</H1>
        <div class="modal-overlay" id="modal-overlay"></div>
        
        <div class="modal" id="modal" aria-hidden="true" aria-labelledby="modalTitle" aria-describedby="modalDescription" role="dialog">
          <button class="close-button" id="close-button" title="Закрыть модальное окно">Закрыть</button>
          <div class="modal-guts" role="document">
            <h1>$rName</h1>
            <p>$rDesc</p>
            
            
          </div>
        </div>
        
        <form action="index.php" method = "get" class = "buttons">        
            <a href="index.php?name=Товар 1&desc=Описание товара 1" id="open-button" class="open-button">Товар 1</a>
            <a href="index.php?name=Товар 2&desc=Описание товара 2" id="open-button" class="open-button">Товар 2</a>
            <a href="index.php?name=Товар 3&desc=Описание товара 3" id="open-button" class="open-button">Товар 3</a>
        </formm>
        
            <script>
                var modal = document.querySelector("#modal"),
                    modalOverlay = document.querySelector("#modal-overlay"),
                    closeButton = document.querySelector("#close-button"),
                    openButton = document.querySelectorAll(".open-button");
        
            closeButton.addEventListener("click", function() {
              modal.classList.toggle("closed");
              modalOverlay.classList.toggle("closed");
            });
        
            for( i = 0; i < openButton.length; i++){
                openButton[i].addEventListener("click", function() {
                    modal.classList.toggle("closed");
                    modalOverlay.classList.toggle("closed");
                    });
             };            
            </script>
        </body>
HTML;
echo '<pre><b><h1> . Данные из _SESSION: . <br>';
print_r($_SESSION);
echo '</pre></b></h1>';
?>