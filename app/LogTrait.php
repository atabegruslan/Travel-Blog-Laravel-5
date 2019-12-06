<?php

namespace App;

use App\Events\CrudLogEvent;

trait LogTrait
{
    /**
     * Insert the given attributes and set the ID on the model.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $attributes
     * @return void
     */
    protected function insertAndSetId(\Illuminate\Database\Eloquent\Builder $query, $attributes)
    {
        $keyName              = $this->getKeyName();
        $id                   = $query->insertGetId($attributes, $keyName);
        $attributes[$keyName] = $id;
        $table                = $this->getTable();
        $model                = static::class;

        event(new CrudLogEvent($model, $table, 'create', $keyName, $id, $attributes));

        $this->setAttribute($keyName, $id);
    } 

    /**
     * Perform a model update operation.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return bool
     */
    protected function performUpdate(\Illuminate\Database\Eloquent\Builder $query)
    {
        $keyName     = $this->getKeyName();
        $afterStates = $this->getAttributes();
        $id          = $afterStates[$keyName];
        $table       = $this->getTable();
        $model       = static::class;
        $result      = parent::performUpdate($query);

        if ($result)
        {
$myfile = fopen("C:/Users/Victor/Desktop/filename" . date("YFd_H-i-s") . rand(1, 99999) . ".txt", "w");
fwrite($myfile, "test");
fclose($myfile);

            event(new CrudLogEvent($model, $table, 'update', $keyName, $id, $afterStates));
        }

        return $result;
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete()
    {
        $keyName = $this->getKeyName();
        $state   = $this->getAttributes();
        $id      = $state[$keyName];
        $table   = $this->getTable();
        $model   = static::class;
        $result  = parent::delete();

        if ($result)
        {
            event(new CrudLogEvent($model, $table, 'delete', $keyName, $id, $state));
        }

        return $result;
    }
}
