<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicaciones".
 *
 * @property integer $id
 * @property string $titulo
 * @property string $contenido
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property integer $autor_id
 *
 * @property Comentarios[] $comentarios
 * @property Imagenes[] $imagenes
 * @property Likes[] $likes
 * @property Usuarios[] $usuarios
 */
class Publicaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publicaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'contenido', 'autor_id'], 'required'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['autor_id'], 'integer'],
            [['titulo', 'contenido'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'contenido' => 'Contenido',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'autor_id' => 'Autor ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['publicacion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagenes()
    {
        return $this->hasMany(Imagenes::className(), ['publicacion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likes::className(), ['publicacion_id' => 'id']);
    }

    public function getPublicaciones($id)
    {

        $laAmistad = Publicaciones::find()->where(['autor_id' => $id])->all();
        $data = array();
        foreach ($laAmistad as $amigo) {
            $data[] = $amigo->id;
        }

        return $data;

    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['id' => 'usuario_id'])->viaTable('likes', ['publicacion_id' => 'id']);
    }
}
