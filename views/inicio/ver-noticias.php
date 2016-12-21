<?php
/* @var $this yii\web\View */
use yii\widgets\DetailView;
use yii\widgets\ListView;

?>
<h1><strong>Noticias</strong></h1>
<?php
//foreach ($noticias as $noticia)
//    echo DetailView::widget([
//        'model' => $noticia,
//        'attributes' => [
//            'titulo',                                           // title attribute (in plain text)
//            'contenido',                                // description attribute formatted as HTML
//            'fecha_inicio',
//            'autor_id'
//        ],
//    ]);
//?>

<?php echo ListView::widget([

    'dataProvider' => $dataProvider,


    'itemOptions' => ['class' => 'item'],

    'itemView' => function ($model, $key, $index, $widget) {
        $img = \app\models\Imagenes::findOne(['publicacion_id' => $model->id]);
        if ($img == null) {
            $img = "";
        } else {
            $img = $img->url;
        }
        return $this->render('/publicacion/viewNoticias', ['model' => $model, 'img' => $img]) . "<br><br>";
    },

]); ?>


