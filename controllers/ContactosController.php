<?php

namespace app\controllers;

use app\models\Amigos;
use app\models\Usuarios;
use Yii;
use yii\data\ActiveDataProvider;

class ContactosController extends \yii\web\Controller
{
    public function actionAceptarSolicitud($id)
    {
        $idLOG = Yii::$app->user->id;
        $laSOlicitud = Amigos::findOne(['emisor_id' => $id, 'receptor_id' => $idLOG]);
        if ($idLOG == $laSOlicitud->receptor_id) {
            $laSOlicitud->esta_aceptado = true;
            $laSOlicitud->save();
        }
        return $this->redirect('listar-solicitudes');
    }

    public function actionRechazarSolicitud($id)
    {
        $idLOG = Yii::$app->user->id;
        $laSOlicitud = Amigos::findOne(['emisor_id' => $id, 'receptor_id' => $idLOG]);
        if ($idLOG == $laSOlicitud->receptor_id) {
            $laSOlicitud->delete();
        }
        return $this->redirect('listar-solicitudes');
    }
//    public function actionAddApodo($idUsuario,$apodo)
//    {
//        return $this->render('add-apodo');
//    }

    public function actionBuscarContacto($param = "")
    {
        $listaDeAmigos = new Amigos();
        $listaDeAmigos = $listaDeAmigos->listaIDSAmigos(Yii::$app->user->id);

        $activeQuery = Usuarios::find()->where(['id' => $listaDeAmigos]);
        $activeQuery->andFilterWhere(['ilike', 'nombres', $param])->orFilterWhere(['ilike', 'apellidos', $param]);
        $dataProvider = new ActiveDataProvider([
            'query' => $activeQuery,
        ]);


        return $this->render('buscar-contacto', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEnviarSolicitud($idUsuario)
    {
        $idLOG = Yii::$app->user->id;
        $relacion = new Amigos();
//        if (!$relacion->sonAmigos($idLOG, $idUsuario) && $relacion->solicitudPendiente($idLOG, $idUsuario)) {
//            return;//ya existe la solicitud pendiente
//        }
        $relacion->emisor_id = $idLOG;
        $relacion->receptor_id = $idUsuario;
        $relacion->esta_aceptado = false;
        $relacion->save;
        return $this->redirect(['/perfil/ver', 'id' => $idUsuario]);
    }

    public function actionListarContactos()
    {
        $idLOG = Yii::$app->user->id;
        $amigos = new Amigos();
        $amigos = $amigos->listaIDsAmigosSinYo($idLOG);
        $activeQuery = Usuarios::find()->where(['id' => $amigos]);

        $dataProvider = new ActiveDataProvider([
            'query' => $activeQuery,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('listar-contactos', ['dataProvider' => $dataProvider]);
    }

    public function actionListarSolicitudes()
    {
        $idLOG = Yii::$app->user->id;

        $solicitudes = Amigos::find()->select('emisor_id')->where(['receptor_id' => $idLOG, 'esta_aceptado' => false]);

        $usuariosDeSolicitudes = Usuarios::find()->where(['id' => $solicitudes]);

        $dataProvider = new ActiveDataProvider([
            'query' => $usuariosDeSolicitudes,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('listar-solicitudes', ['dataProvider' => $dataProvider]);
    }


}
