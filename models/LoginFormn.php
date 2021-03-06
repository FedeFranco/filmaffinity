<?php
namespace app\models;
use Yii;
use app\helpers\Mensaje;
use yii\base\Model;
use app\models\Usuario;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    /**
     * La instancia del usuario correspondiente, o false si no existe o todavía
     * no se ha buscado.
     * @var boolean|Usuario
     */
    private $_user = false;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Nombre',
            'password' => 'Contraseña',
            'rememberMe' => 'Recuérdame',
        ];
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validarPassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }
    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $usuario = $this->getUser();
            if (!$usuario->activado) {
                Mensaje::fracaso('Usuario aún no validado.');
                return false;
            }
            return Yii::$app->user->login($usuario, $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
    /**
     * Finds user by [[username]]
     *
     * @return Usuario|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuario::buscarPorNombre($this->username);
        }
        return $this->_user;
    }
}
