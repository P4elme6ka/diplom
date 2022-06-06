<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document_set".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property AcceptanceClass[] $acceptanceClasses
 * @property DocumentSetToPreset[] $documentSetToPresets
 */
class DocumentSet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document_set';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[AcceptanceClasses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAcceptanceClasses()
    {
        return $this->hasMany(AcceptanceClass::className(), ['document_set_id' => 'id']);
    }

    /**
     * Gets query for [[DocumentSetToPresets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentSetToPresets()
    {
        return $this->hasMany(DocumentSetToPreset::className(), ['document_set_id' => 'id']);
    }
}
