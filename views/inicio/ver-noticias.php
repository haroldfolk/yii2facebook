<?php
/* @var $this yii\web\View */
use yii\widgets\DetailView;

?>
<h1>inicio/ver-noticias</h1>
<?php
foreach ($noticias as $noticia)
    echo DetailView::widget([
        'model' => $noticia,
        'attributes' => [
            'titulo',                                           // title attribute (in plain text)
            'contenido',                                // description attribute formatted as HTML
            'fecha_inicio',
            'autor_id'
        ],
    ]);
