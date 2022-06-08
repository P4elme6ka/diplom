<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "acceptance_class".
 *
 * @property int $class_id
 * @property int $acceptance_id
 * @property int|null $document_set_id
 * @property string $name
 * @property string $description
 */
class AcceptanceCreateForm extends Model
{

    public $acceptance_class_id;
    public $user_id;
    public $atestat_mean;

    public $req_attach;
    public $accept_attach;
    public $atetat_attach;


    public function rules()
    {
        return [
            [['acceptance_class_id', 'user_id', 'atestat_mean'], 'required'],
        ];
    }

    public function save(){
        $user_req = new UserAcceptanceRequest();

        $user_req->user_id = $this->user_id;
        $user_req->atestat_mean = $this->atestat_mean;
        $user_req->acceptance_class_id = $this->acceptance_class_id;
        $user_req->is_original = 0;

        // TODO: upload three attachments
        $res = $user_req->save();

//        VarDumper::dump($user_req); die;

        return $res;
    }
}
