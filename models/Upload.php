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
    public function subir($titulo,$descr,$file,$generos)
    {

        $peli = new Pelicula;
        $peli->titulo = $titulo;
        $peli->descricion = $descr;
        //var_dump($peli->id_genero); die();
        $peli->save();



        foreach ($file as $files) {
            $files->saveAs('uploads/' . $files->baseName . '.' . $files->extension);

        }

        foreach ($generos as $genero) {
            $part = new Participacion;
            //var_dump($generos); die();
            $part->id_participante = Participante::find()->select('id')->where(['nombre_participante' => 'Jakov']);
            $part->id_rol = Rol::find()->select('id')->where(['nombre_rol' => 'Actor']);
            $part->id_pelicula = Pelicula::find()->select('id')->where(['titulo' => $titulo]);
            $part->id_genero = Genero::find()->select('id')->where(['nombre_genero' => $genero]);
            $part->save(false);
        }


        return true;
    }
}
