<?php

namespace app\controllers;

use app\models\Amigos;
use app\models\Usuarios;
use Yii;
use yii\data\ActiveDataProvider;

class ContactosController extends \yii\web\Controller
{
    public function actionAceptarSolicitud($idSol)
    {
        $idLOG = Yii::$app->user->id;
        $laSOlicitud = Amigos::findOne(['id' => $idSol]);
        if ($idLOG == $laSOlicitud->receptor_id) {
            $laSOlicitud->esta_aceptado = true;
            $laSOlicitud->save();
        }
//        return $this->render('aceptar-solicitud');
    }

//    public function actionAddApodo($idUsuario,$apodo)
//    {
//        return $this->render('add-apodo');
//    }

    public function actionBuscarContacto($param)
    {
        $listaDeAmigos = new Amigos();
        $listaDeAmigos = $listaDeAmigos->listaIDSAmigos(Yii::$app->user->id);

        $activeQuery = Usuarios::find($listaDeAmigos);

        $dataProvider = new ActiveDataProvider([
            'query' => $activeQuery,
        ]);
        $activeQuery->filterWhere(['like', 'nombres', $param]);
        $activeQuery->filterWhere(['like', 'apellidos', $param]);

        return $this->render('buscar-contacto', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEnviarSolicitud($idUsuario)
    {
        $idLOG = Yii::$app->user->id;
        $relacion = new Amigos();
        if (!$relacion->sonAmigos($idLOG, $idUsuario) && $relacion->solicitudPendiente($idLOG, $idUsuario)) {
            return;//ya existe la solicitud pendiente
        }
        $relacion->emisor_id = $idLOG;
        $relacion->receptor_id = $idUsuario;
        $relacion->esta_aceptado = false;
        $relacion->save;
        return $this->redirect(['/perfil/ver', 'id' => $idUsuario]);
    }

    public function actionListarContactos()
    {
        return $this->render('listar-contactos');
    }

    public function actionRechazarSolicitud($idSol)
    {
        $idLOG = Yii::$app->user->id;
        $laSOlicitud = Amigos::findOne(['id' => $idSol]);
        if ($idLOG == $laSOlicitud->receptor_id) {
            $laSOlicitud->delete();
        }
        return $this->goBack();
    }

}
