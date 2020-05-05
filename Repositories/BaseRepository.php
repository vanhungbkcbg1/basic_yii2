<?php

namespace app\Repositories;

use app\Repositories\Interfaces\IRepository;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

abstract class BaseRepository implements IRepository
{

    /**
     * @var \yii\db\ActiveRecord $model
     */
    protected $model;
    /**
     * @var ActiveQuery $query
     */
    protected $query;

    public function __construct()
    {
        $model = $this->getModel();
        $this->query = call_user_func(array($model, "find"));
    }

    protected abstract function getModel();

    public function find($id)
    {
        return $this->query->where(["id" => $id])->one();
    }

    public function insert($data)
    {
        $model = $this->getModel();
        /**
         * @var ActiveRecord $record
         */
        $record = new $model();
        $record->setAttributes($data, false);
        $result = $record->save();
        if (!$result) {
            return $record;
        }
        return true;
    }

    public function update($id, $data)
    {
        $record = $this->find($id);
        if (!$record) {
            return false;
        }

        $record->setAttributes($data, false);
        return $record->save();
    }

    public function delete($id)
    {
        $record = $this->find($id);
        if ($record) {
            return false;
        }
        return $record->delete();
    }
}