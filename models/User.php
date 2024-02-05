<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property int $status
 * @property string $tipo
 * @property string $created_at
 * @property string $updated_at
 * @property Datospersonales $Datospersonales
 * 
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

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
            [['username', 'password', 'Auth_key', 'Created_at'], 'required'],
            [['Status'], 'integer'],
            [['Tipo'], 'string', 'max' => 64],
            [['Created_at', 'Updated_at'], 'safe'],
            [['username'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 255],
            [['Auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuario',
            'password' => 'Contraseña',
            'Auth_key' => 'Auth Key',
            'Status' => 'Estado',
            'Tipo' => 'Tipo de Usuario',
            'Created_at' => 'Creación',
            'Updated_at' => 'Actualización',
        ];
    }

    /**
     * Gets query for [[Personaldata]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatospersonales()
    {
        return $this->hasOne(Datospersonales::class, ['Ci' => 'username']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'Status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Implementa la búsqueda por token aquí, si es necesario.
        return null;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'Status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->Auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->Auth_key === $authKey;
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function validateCurrentPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->validatePassword($this->$attribute)) {
                $this->addError($attribute, 'La contraseña actual es incorrecta.');
            }
        }
    }

    /**
     * Gets query for [[Prestamos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaccion()
    {
        return $this->hasMany(Transaccion::class, ['user_id' => 'id']);
    }
    
}
