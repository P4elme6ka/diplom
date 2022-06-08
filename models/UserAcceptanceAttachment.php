<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_acceptance_attachment".
 *
 * @property int $user_request_id
 * @property int $file_id
 */
class UserAcceptanceAttachment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_acceptance_attachment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_request_id', 'file_id'], 'required'],
            [['user_request_id', 'file_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_request_id' => 'User Request ID',
            'file_id' => 'File ID',
        ];
    }
}
