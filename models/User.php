<?php

namespace app\models;

use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property int $role_id
 * @property string $email
 * @property string $public_status
 * @property int|null $phone
 * @property int|null $age
 * @property string|null $city
 * @property int $status_id
 * @property int|null $acceptance_id
 * @property string $access_token
 * @property string $password
 * @property string fio
 *
 * @property Acceptance $acceptance
 * @property Role $role
 * @property Status $status
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
    public function rules()
    {
        return [
            [['role_id', 'email', 'public_status', 'status_id', 'acceptance_id'], 'required'],
            [['role_id', 'phone', 'age', 'status_id', 'acceptance_id'], 'integer'],
            [['public_status'], 'string'],
            [['email', 'city'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['acceptance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Acceptance::class, 'targetAttribute' => ['acceptance_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'role_id' => 'Role ID',
            'email' => 'Email',
            'public_status' => 'Public Status',
            'phone' => 'Phone',
            'age' => 'Age',
            'city' => 'City',
            'status_id' => 'Status ID',
            'acceptance_id' => 'Acceptance ID',
        ];
    }

    /**
     * Gets query for [[Acceptance]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAcceptance()
    {
        return $this->hasOne(Acceptance::class, ['id' => 'acceptance_id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    public static function findIdentity($id)
    {
        return User::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return User::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->access_token;
    }

    public function validateAuthKey($authKey)
    {
        return $this->access_token == $authKey;
    }

    public static function findByUsername($username){
        return User::findOne(['email' => $username]);
    }

    public function setPassword($pass){
        $this->password = yii::$app->security->generatePasswordHash($pass);
    }

    public function validatePassword($pass){
        return yii::$app->security->validatePassword($pass, $this->password);
    }

    public function createAuthKey(){
        $this->access_token = yii::$app->security->generateRandomString(64);
    }
}
