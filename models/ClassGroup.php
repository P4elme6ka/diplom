<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "class_group".
 *
 * @property int $id
 * @property int $name
 *
 * @property AcceptanceClass[] $acceptanceClasses
 */
class ClassGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'integer'],
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
        ];
    }

    /**
     * Gets query for [[AcceptanceClasses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAcceptanceClasses()
    {
        return $this->hasMany(AcceptanceClass::className(), ['class_id' => 'id']);
    }
}
