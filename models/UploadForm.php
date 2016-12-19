<?php
/**
 * Created by PhpStorm.
 * User: harold
 * Date: 09-10-16
 * Time: 06:41 AM
 */
namespace app\models;

use Yii;
use Faker\Provider\Image;
use yii\base\Model;
use yii\helpers\Json;

use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        $storage = Yii::$app->storage;

        if ($this->validate()) {

            $path = 'fotos/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($path);
            $url = $storage->uploadFile($path, "" . date("Ymd") . time() . "");


            return true;
        } else {
            return true;
        }
    }


}