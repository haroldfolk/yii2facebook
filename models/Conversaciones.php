<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "conversaciones".
 *
 * @property integer $id
 *
 * @property Grupos[] $grupos
 * @property Mensajes[] $mensajes
 */
class Conversaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conversaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupos::className(), ['conversacion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensajes()
    {
        return $this->hasMany(Mensajes::className(), ['conversacion_id' => 'id']);
    }
}
