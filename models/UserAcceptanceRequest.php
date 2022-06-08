<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_acceptance_request".
 *
 * @property int $id
 * @property string $date
 * @property int $is_original
 * @property int $user_id
 * @property float $atestat_mean
 * @property int $acceptance_class_id
 *
 * @property AcceptanceClass $acceptanceClass
 * @property User $user
 */
class UserAcceptanceRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_acceptance_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['is_original', 'user_id', 'atestat_mean', 'acceptance_class_id'], 'required'],
            [['is_original', 'user_id', 'acceptance_class_id'], 'integer'],
            [['atestat_mean'], 'number'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['acceptance_class_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcceptanceClass::className(), 'targetAttribute' => ['acceptance_class_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'is_original' => 'Is Original',
            'user_id' => 'User ID',
            'atestat_mean' => 'Atestat Mean',
            'acceptance_class_id' => 'Acceptance Class ID',
        ];
    }

    /**
     * Gets query for [[AcceptanceClass]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAcceptanceClass()
    {
        return $this->hasOne(AcceptanceClass::className(), ['id' => 'acceptance_class_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
