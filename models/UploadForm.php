<?php
namespace app\models;

use yii\base\Model;

class UploadForm extends Model {

    public $file;
    public $titulo;
    public $descricion;
    public $genero;
    
    public function rules()
    {
        return [
            ['file', 'file',
               'skipOnEmpty' => false,
               'uploadRequired' => 'No has seleccionado ningún archivo', //Error
               'maxSize' => 1024*1024*1, //1 MB
               'tooBig' => 'El tamaño máximo permitido es 1MB', //Error
               'minSize' => 10, //10 Bytes
               'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
               'extensions' => 'png',
               'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
               'maxFiles' => 4,
               'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
             ],[['titulo','descricion','genero'],'required']
        ];
    }

 public function attributeLabels()
 {
  return [
   'file' => 'Seleccionar archivos:',
   'titulo' => 'Título',
   'descricion' => 'Descripción',
  ];
 }
}
