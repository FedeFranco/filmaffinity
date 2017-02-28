<?php
namespace app\models;

use app\models\Pelicula;
use app\models\Genero;
use app\models\Rol;
use app\models\Participante;
use app\models\Participacion;
use yii\base\Model;
use Yii;

class Upload extends Model
{
    public function subir($titulo,$descr,$file,$msg)
    {

        $peli = new Pelicula;
        $part = new Participacion;

        $peli->titulo = $titulo;
        $peli->descricion = $descr;
        //var_dump($peli->id_genero); die();
        $peli->save();



        foreach ($file as $files) {
            $files->saveAs('uploads/' . $files->baseName . '.' . $files->extension);
            
        }

        //var_dump($peli); die();
        $part->id_participante = Participante::find()->select('id')->where(['nombre_participante' => 'Jakov']);
        $part->id_rol = Rol::find()->select('id')->where(['nombre_rol' => 'Actor']);
        $part->id_pelicula = Pelicula::find()->select('id')->where(['titulo' => $titulo]);
        $part->id_genero = Genero::find()->select('id')->where(['nombre_genero' => 'Drama']);
        $part->save(false);

        return true;
    }
}
