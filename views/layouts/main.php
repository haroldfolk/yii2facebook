<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [

            [
                'label' => 'Inicio',
                'items' => [
                    ['label' => Html::encode(' Ver Noticias'), 'url' => ['/inicio/ver-noticias']],
                    ['label' => Html::encode(' Buscar Personas'), 'url' => ['/inicio/buscar-personas']],
                ],
            ],
            [
                'label' => 'Perfil',
                'items' => [
                    ['label' => Html::encode(' Ver Perfil'), 'url' => ['/perfil/ver-perfil', 'id' => Yii::$app->user->id]],
                    ['label' => Html::encode(' Editar Perfil'), 'url' => ['/perfil/editar-perfil']],
                ],
            ],
            [
                'label' => 'Contactos',
                'items' => [
                    ['label' => Html::encode(' Buscar en Contactos'), 'url' => ['/contactos/buscar-contacto']],
                    ['label' => Html::encode('Ver solicitudes'), 'url' => ['/contactos/listar-solicitudes']],
                    ['label' => Html::encode(' Ver Contactos'), 'url' => ['/contactos/listar-contactos']],
                ],
            ],

            [
                'label' => 'Mensajes', 'url' => ['/mensaje/enviar-inbox']
            ],
            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/usuario/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/usuario/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
