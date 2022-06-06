<?php

namespace app\models;

use phpDocumentor\Reflection\Types\This;
use yii\base\Model;

class CreateClassGroup extends Model
{
    public $yearAcceptanceId;
    public $name;
    public $documentStartTime;
    public $documentStopTime;
    public $noDocumentsAcceptance;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['yearAcceptanceId', 'name', 'documentSet', 'noDocumentsAcceptance'], 'required'],
        ];
    }

    public function save(){
        $acc = new AcceptanceClass();
        $class = new ClassGroup();

        $class->name = $this->name;
        if (!$class->save()) {
            return false;
        }
        $acc->acceptance_id = $this->yearAcceptanceId;
        $acc->class_id = $class->getPrimaryKey();
        return $acc->save();
    }
}
