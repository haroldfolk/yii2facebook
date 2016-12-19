<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "amigos".
 *
 * @property integer $id
 * @property boolean $esta_aceptado
 * @property string $fecha_creacion
 * @property string $apodo_emisor
 * @property string $apodo_receptor
 * @property integer $emisor_id
 * @property integer $receptor_id
 *
 * @property Usuarios $emisor
 * @property Usuarios $receptor
 */
class Amigos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'amigos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['esta_aceptado', 'emisor_id', 'receptor_id'], 'required'],
            [['esta_aceptado'], 'boolean'],
            [['fecha_creacion'], 'safe'],
            [['emisor_id', 'receptor_id'], 'integer'],
            [['apodo_emisor', 'apodo_receptor'], 'string', 'max' => 255],
            [['emisor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['emisor_id' => 'id']],
            [['receptor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['receptor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'esta_aceptado' => 'Esta Aceptado',
            'fecha_creacion' => 'Fecha Creacion',
            'apodo_emisor' => 'Apodo Emisor',
            'apodo_receptor' => 'Apodo Receptor',
            'emisor_id' => 'Emisor ID',
            'receptor_id' => 'Receptor ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmisor()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'emisor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceptor()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'receptor_id']);
    }

    public function sonAmigos($id1, $id2)
    {
        $laAmistad = Amigos::find()->where(['emisor_id' => $id1, 'receptor_id' => $id2])->one();
        $laAmistadInversa = Amigos::find()->where(['emisor_id' => $id2, 'receptor_id' => $id1])->one();
        if (isset($laAmistad)) {
            return $laAmistad->esta_aceptado;
        } elseif (isset($laAmistadInversa)) {
            return $laAmistadInversa->esta_aceptado;
        }
        return false;
    }

    public function solicitudPendiente($id1, $id2)
    {
        $laAmistad = Amigos::find()->where(['emisor_id' => $id1, 'receptor_id' => $id2])->one();
        $laAmistadInversa = Amigos::find()->where(['emisor_id' => $id2, 'receptor_id' => $id1])->one();
        if (isset($laAmistad)) {
            return !$laAmistad->esta_aceptado;
        } elseif (isset($laAmistadInversa)) {
            return !$laAmistadInversa->esta_aceptado;
        }
        return false;
    }
    public function solicitudPendienteIda($id1, $id2)
    {
        $laAmistad = Amigos::find()->where(['emisor_id' => $id1, 'receptor_id' => $id2])->one();

        if (isset($laAmistad)) {
            return !$laAmistad->esta_aceptado;

        }
        return false;
    }
    public function listaDeAmigos($id)
    {
        $laAmistad = Amigos::find()->where(['emisor_id' => $id, 'esta_aceptado' => true])->orWhere(['receptor_id' => $id, 'esta_aceptado' => true]);
        $data = new ActiveDataProvider([
            'query' => $laAmistad
        ]);

        return $data;
    }

    public function listaIDsAmigos($id)
    {
        $laAmistad = Amigos::find()->where(['emisor_id' => $id, 'esta_aceptado' => true])->orWhere(['receptor_id' => $id, 'esta_aceptado' => true])->all();
        $data = [];
        foreach ($laAmistad as $amigo) {
            $data = array();
            if ($amigo->emisor_id == $id) {
                $data[] = $amigo->receptor_id;
            } else {
                $data[] = $amigo->emisor_id;
            }
        }
        $data[] = $id;
        return $data;
    }

    public function listaIDsAmigos2($id)
    {
        $laAmistad = Amigos::find()->where(['emisor_id' => $id, 'esta_aceptado' => true])->orWhere(['receptor_id' => $id, 'esta_aceptado' => true])->all();
        $data = array();
        foreach ($laAmistad as $amigo) {

            if ($amigo->emisor_id == $id) {
                $data[] = $amigo->receptor_id;
            } else {
                $data[] = $amigo->emisor_id;
            }
        }
        $data[] = $id;
        return $data;
    }
    public function listaIDsAmigosSinYo($id)
    {
        $laAmistad = Amigos::find()->where(['emisor_id' => $id, 'esta_aceptado' => true])->orWhere(['receptor_id' => $id, 'esta_aceptado' => true])->all();
        $data = array();
        foreach ($laAmistad as $amigo) {

            if ($amigo->emisor_id == $id) {
                $data[] = $amigo->receptor_id;
            } else {
                $data[] = $amigo->emisor_id;
            }
        }

        return $data;
    }
}
