<?php
use app\models\User;
/**
 *
 */
class UploadFormCest
{
    /**
     * [_before description]
     * @param  FunctionalTester $I [description]
     * @return [type]              [description]
     */

   public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('upload/uploads');
    }

    public function openUploadPage(\FunctionalTester $I)
    {
        $I->see('Subir archivos', 'h2');

    }

    public function EnviarVacioForm(\FunctionalTester $I)
    {
        $I->submitForm('#w0', []);
        //$I->expectTo('see validations errors');
        $I->see('Contact', 'h1');
        $I->see('No has seleccionado ningún archivo');
        $I->see('Título cannot be blank.');
        $I->see('Genero cannot be blank.');
        $I->see('Descripción cannot be blank.');
    }

}
