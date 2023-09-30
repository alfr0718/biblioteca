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
 * @property string $tipo_usuario
 * @property string $authkey
 * @property string $personaldata_correo
 *
 * @property Personaldata $personaldataCorreo
 * @property Prestamo[] $prestamos
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
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
    const TIPO_PERSONA_EXTERNA = 'EXTERNO';
    const TIPO_ESTUDIANTE = 'ESTUDIANTE';
    const TIPO_DOCENTE = 'DOCENTE';

    public function rules()
    {
        return [
            [['username', 'password', 'tipo_usuario', 'authkey', 'personaldata_correo'], 'required'],
            [['username'], 'string', 'max' => 12],
            [['password'], 'string', 'max' => 255],
            [['tipo_usuario'], 'string', 'max' => 45],
            [['tipo_usuario'], 'in', 'range' => [self::TIPO_PERSONA_EXTERNA, self::TIPO_ESTUDIANTE, self::TIPO_DOCENTE]],
            [['authkey'], 'string', 'max' => 32],
            [['personaldata_correo'], 'string', 'max' => 300],
            [['personaldata_correo'], 'exist', 'skipOnError' => true, 'targetClass' => Personaldata::class, 'targetAttribute' => ['personaldata_correo' => 'correo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'tipo_usuario' => 'Tipo Usuario',
            'authkey' => 'Authkey',
            'personaldata_correo' => 'Personaldata Correo',
        ];
    }

    // Implementación de funciones de Identity

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; // No se usa en este ejemplo
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authkey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authkey === $authKey;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        // Implementa la lógica para validar la contraseña aquí
        // Puedes usar Yii::$app->security->validatePassword
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Gets query for [[PersonaldataCorreo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaldataCorreo()
    {
        return $this->hasOne(Personaldata::class, ['correo' => 'personaldata_correo']);
    }

    /**
     * Gets query for [[Prestamos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamo::class, ['user_id' => 'id']);
    }
}
