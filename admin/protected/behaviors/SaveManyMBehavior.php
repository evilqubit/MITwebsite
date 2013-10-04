<?php

/**
 * Save Many Behavior for Models
 * used for saving multiple entries for many_many relations
 * Usage:<br>
  'saveMany'=>array(
  'class'=>'application.behaviors.SaveManyMBehavior',
  )
 * @author AB
 * @version 3-20120508
 */
class SaveManyMBehavior extends CActiveRecordBehavior{

    /**
     * Saves many entries for many_many relations
     * @param string $relation many_many relation name
     * @param array $values Ids of foreign key to be added 
     */
    public function saveMany($relation, $values){
        $owner = $this->getOwner();
        $ownerId = $owner->{$owner->tableSchema->primaryKey};
        $connection = Yii::app()->db;
        $relations = $owner->relations();
        $relationArray = $relations[$relation];
        $pattern = '/^(.+)\((.+)\s*,\s*(.+)\)$/'; //match tableName(thisField, foreignField)
        if(preg_match($pattern, $relationArray[2], $pocks)){
            $info['table'] = $pocks[1];
            $info['thisField'] = $pocks[2];
            $info['foreignField'] = $pocks[3];
        }
        foreach($owner->$relation as $foreign){
            $foreignPK = $foreign->tableSchema->primaryKey;
            $foreignPKValue = $foreign->$foreignPK;
            if(!in_array($foreignPKValue, $values)){ //If not selected, delete the record
                $sql = "DELETE FROM {$info['table']} WHERE {$info['thisField']} = :ownerId AND {$info['foreignField']} = :foreignId";
                $command = $connection->createCommand($sql);
                $command->bindParam(":ownerId", $ownerId);
                $command->bindParam(":foreignId", $foreignPKValue);
                $command->execute();
            }
            else{ //No need to add it again
                $valueKey = array_keys($values, $foreignPKValue);
                unset($values[$valueKey[0]]);
            }
        }
        foreach($values as $value){
            $sql = "INSERT INTO {$relationArray[2]} VALUES (:ownerId, :foreignId)";
            $command = $connection->createCommand($sql);
            $command->bindParam(":ownerId", $ownerId);
            $command->bindParam(":foreignId", $value);
            $command->execute();
        }
    }

}