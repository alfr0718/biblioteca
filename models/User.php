<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\base\Security;


/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $Username
 * @property string $Password
 * @property string $Auth_key
 * @property int $Status
 * @property string $Created_at
 * @property string $Updated_at
 * @property string|null $Temporalpassword
 * @property string|null $Tempralpasswordtime
 *
 * @property Authassignmentrole[] $authassignmentroles
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    private $_user = false;
    public $currentPassword;
    public $newPassword;
    public $confirmPassword;
    public $temporalpassword;
    public $tempralpasswordtime;
    public $_roleNames = [];


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Username', 'Password', 'Auth_key', 'Created_at'], 'required'],
            [['Status'], 'integer'],
            [['Created_at', 'Updated_at', 'Tempralpasswordtime'], 'safe'],
            [['Username'], 'string', 'max' => 15],
            [['Password', 'Temporalpassword'], 'string', 'max' => 255],
            [['Auth_key'], 'string', 'max' => 32],
            [['Username', 'Auth_key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Username' => 'Usuario',
            'Password' => 'Contraseña',
            'Auth_key' => 'Clave de Autentificación',
            'Status' => 'Estado',
            'Created_at' => 'Creado',
            'Updated_at' => 'Actualizado',
            'Temporalpassword' => 'Temporalpassword',
            'Tempralpasswordtime' => 'Tempralpasswordtime',
        ];
    }
    

    /**
     * Gets query for [[Authassignmentroles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthassignmentroles()
    {
        return $this->hasMany(Authassignmentrole::class, ['idusername' => 'id']);
    }

    public function getDatospersonalesed(){
        return $this->hasOne(Datospersonalesed::class, ['Ci' => 'Username']);
    }

    /**
     * Valida la contraseña actual.
     */
    public function validateCurrentPassword($attribute, $params)
    {
        $user = self::findByUsername($this->Username);
        if (!$this->hasErrors()) {
            $user = self::findIdentity($this->id);
            if (!$user || !$user->validatePassword($this->currentPassword, $user->Password)) {
                $this->addError($attribute, 'Contraseña actual incorrecta, comuníquese con el administrador.');
            }
        }
    }

    /**
     * Cambia la contraseña del usuario.
     */
    public function changePassword()
    {
        if ($this->validate()) {
            $user = self::findIdentity($this->id);
            $user->setPassword($this->newPassword);
            return $user->save(false);
        }
        return false;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'Status' => 1]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['Auth_key' => $token, 'Status' => 1]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['Username' => $username, 'Status' => 1]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->Auth_key;
    }


 

    public function validateAuthKey($authkey)
    {
        return $this->Auth_key === $authkey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->Password);
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->Username);
        }

        return $this->_user;
    }


    public function login()
    {
        if ($this->validate()) {
            $this->getRoleNames();
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /** 
     * Gets query for [[Authassignmentroles]].
     * return String[]
     */
    public function getRoleNames()
    {

        return Yii::$app->cache->getOrSet('userRoleNames_' . $this->id, function () {
            $roleNames = [];
    
            $authAssignmentRoles = $this->getAuthAssignmentRoles()
                ->orderBy(['role_id' => SORT_DESC])
                ->all();
    
            foreach ($authAssignmentRoles as $rolesrelacion) {
                $role = $rolesrelacion->getRole()->one();
                $roleNames[] = $role->Name_role;
            }
            

            return $roleNames;
        });
    }



}