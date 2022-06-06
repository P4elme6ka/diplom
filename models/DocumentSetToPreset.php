<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document_set_to_preset".
 *
 * @property int $document_preset_id
 * @property int $document_set_id
 *
 * @property DocumentPreset $documentPreset
 * @property DocumentSet $documentSet
 */
class DocumentSetToPreset extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document_set_to_preset';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document_preset_id', 'document_set_id'], 'required'],
            [['document_preset_id', 'document_set_id'], 'integer'],
            [['document_preset_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentPreset::className(), 'targetAttribute' => ['document_preset_id' => 'id']],
            [['document_set_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentSet::className(), 'targetAttribute' => ['document_set_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'document_preset_id' => 'Document Preset ID',
            'document_set_id' => 'Document Set ID',
        ];
    }

    /**
     * Gets query for [[DocumentPreset]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentPreset()
    {
        return $this->hasOne(DocumentPreset::className(), ['id' => 'document_preset_id']);
    }

    /**
     * Gets query for [[DocumentSet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentSet()
    {
        return $this->hasOne(DocumentSet::className(), ['id' => 'document_set_id']);
    }
}
