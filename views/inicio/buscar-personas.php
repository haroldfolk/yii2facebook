<?php
/* @var $this yii\web\View */
use app\models\Usuarios;
use yii\grid\GridView;
use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;

?>
    <form action="buscar-personas">
        <input type="text" name="param">
        <br><br>
        <input type="submit" value="Buscar Personas">
    </form>
<?php


echo GridView::widget([
    'dataProvider' => $dataProvider,
]);
