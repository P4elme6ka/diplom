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
            [['req_attach'], 'file', 'skipOnEmpty' => false],
            [['accept_attach'], 'file', 'skipOnEmpty' => false],
            [['atetat_attach'], 'file', 'skipOnEmpty' => false],
        ];
    }

    public function save(){
        $this->validate();

        $user_req = new UserAcceptanceRequest();

        $user_req->user_id = $this->user_id;
        $user_req->atestat_mean = $this->atestat_mean;
        $user_req->acceptance_class_id = $this->acceptance_class_id;
        $user_req->is_original = 0;

        $res = $user_req->save();
        if (!$res) { VarDumper::dump($res); die; }

        $path = 'uploads/' . Yii::$app->security->generateRandomString() . '.' . $this->req_attach->extension;
        $this->req_attach->saveAs($path);
        $req_fl = new File();
        $req_fl->path = $path;
        $req_fl->name = $this->req_attach->baseName . '.' . $this->req_attach->extension;
        $res = $req_fl->save();
        if (!$res) { VarDumper::dump($req_fl->getErrors()); die; }
        $req_att = new UserAcceptanceAttachment();
        $req_att->file_id = $req_fl->getPrimaryKey();
        $req_att->user_request_id = $user_req->getPrimaryKey();
        $res = $req_att->save();
        if (!$res) { VarDumper::dump($req_att->getErrors()); die; }

        $path = 'uploads/' . Yii::$app->security->generateRandomString() . '.' . $this->accept_attach->extension;
        $this->accept_attach->saveAs($path);
        $accept_fl = new File();
        $accept_fl->path = $path;
        $accept_fl->name = $this->accept_attach->baseName . '.' . $this->accept_attach->extension;
        $res = $accept_fl->save();
        if (!$res) { VarDumper::dump($accept_fl->getErrors()); die; }
        $accept_att = new UserAcceptanceAttachment();
        $accept_att->file_id = $accept_fl->getPrimaryKey();
        $accept_att->user_request_id = $user_req->getPrimaryKey();
        $res = $accept_att->save();
        if (!$res) { VarDumper::dump($accept_att->getErrors()); die; }

        $path = 'uploads/' . Yii::$app->security->generateRandomString() . '.' . $this->atetat_attach->extension;
        $this->atetat_attach->saveAs($path);
        $attestat_fl = new File();
        $attestat_fl->path = $path;
        $attestat_fl->name = $this->atetat_attach->baseName . '.' . $this->atetat_attach->extension;
        $res = $attestat_fl->save();
        if (!$res) { VarDumper::dump($attestat_fl->getErrors()); die; }
        $attestat_att = new UserAcceptanceAttachment();
        $attestat_att->file_id = $attestat_fl->getPrimaryKey();
        $attestat_att->user_request_id = $user_req->getPrimaryKey();
        $res = $attestat_att->save();
        if (!$res) { VarDumper::dump($accept_att->getErrors()); die; }

        return $res;
    }
}
