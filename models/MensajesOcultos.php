<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mensajes_ocultos".
 *
 * @property integer $id
 * @property integer $id_mensaje
 * @property integer $id_usuario
 *
 * @property Mensajes $idMensaje
 * @property Usuarios $idUsuario
 */
class MensajesOcultos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mensajes_ocultos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mensaje', 'id_usuario'], 'required'],
            [['id_mensaje', 'id_usuario'], 'integer'],
            [['id_mensaje'], 'exist', 'skipOnError' => true, 'targetClass' => Mensajes::className(), 'targetAttribute' => ['id_mensaje' => 'id']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_mensaje' => 'Id Mensaje',
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMensaje()
    {
        return $this->hasOne(Mensajes::className(), ['id' => 'id_mensaje']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'id_usuario']);
    }
}
