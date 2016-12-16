<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->registerJs(
    '$("document").ready(function(){ 
        setInterval(function(){
            $.pjax.reload({container:"#losmensajes"});}  //Reload GridView
        ,10000);
    });'
);
?>
<?php ?>

<div class="row">
    <div class="col-md-4 bordered  ">
        <div class="panel panel-default">
            <div class="panel-body">

                <?php
                foreach ($amigos as $usuario) {
                    echo Html::a($usuario->nombres, ['/mensaje/enviar-inbox', 'idU' => $usuario->id], ['class' => '']) . "<br>";
                }
                ?>

            </div>
        </div>
    </div>
    <div class="col-md-8 bordered">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php
                Pjax::begin(['id' => 'losmensajes']);
                if ($mensajes != null) {
                    foreach ($mensajes as $mensaje) {
                        $elSMS = "";
                        if ($mensaje->usuario_id == $idYo) {
                            $elSMS = "<blockquote class='blockquote-reverse'>";
                        } else {
                            $elSMS = "<blockquote>";
                        }
                        $elSMS = $elSMS . $mensaje->contenido . "</blockquote>";
                        echo $elSMS . "<br>";
                    }
                }

                Pjax::end();
                ?>

            </div>
        </div>

        </blockquote >
    </div>
</div>

<?php ?>


















