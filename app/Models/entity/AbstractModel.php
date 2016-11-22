<?php

namespace App\Models\entity;

use App\Support\Arrays;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model implements \JsonSerializable
{
    public function sync($relationship, $idcolumn, $column, array $values)
    {
        $new_values = array_filter($values);
        $old_values = $this->$relationship->lists($column, $idcolumn)->toArray();
        
        // Delete removed values, if any
        if ($deleted = Arrays::keysDeleted($new_values, $old_values)) {
            $this->$relationship()->whereIn($idcolumn, $deleted)->delete();
        }

        // Create new values, if any
        if ($created = Arrays::keysCreated($new_values, $old_values)) {
            foreach ($created as $id) {
                $new[] = $this->$relationship()->getModel()->newInstance([
                    $column => $new_values[$id],
                ]);
            }
            
            $this->$relationship()->saveMany($new);
        }

        // // Update changed values, if any
        // if ($updated = Arrays::keysUpdated($new_values, $old_values)) {
        //     foreach ($updated as $id) {
        //         $this->$relationship()->where($idcolumn, $id)->update([
        //             $column => $new_values[$id],
        //         ]);
        //     }
        // }
    }

    // Original sync One to Many
    // 
    // public function sync($relationship, $column, array $values)
    // {
    //     $new_values = array_filter($values);
    //     $old_values = $this->$relationship->lists($column, 'id');

    //     // Delete removed values, if any
    //     if ($deleted = Arrays::keysDeleted($new_values, $old_values)) {
    //         $this->$relationship()->whereIn('id', $deleted)->delete();
    //     }

    //     // Create new values, if any
    //     if ($created = Arrays::keysCreated($new_values, $old_values)) {
    //         foreach ($created as $id) {
    //             $new[] = $this->$relationship()->getModel()->newInstance([
    //                 $column => $new_values[$id],
    //             ]);
    //         }

    //         $this->$relationship()->saveMany($new);
    //     }

    //     // Update changed values, if any
    //     if ($updated = Arrays::keysUpdated($new_values, $old_values)) {
    //         foreach ($updated as $id) {
    //             $this->$relationship()->find($id)->update([
    //                 $column => $new_values[$id],
    //             ]);
    //         }
    //     }
    // }
    // 
    
    // Original sync One to Many + idcolumn
    // 
    // public function sync($relationship, $idcolumn, $column, array $values)
    // {
    //     $new_values = array_filter($values);
    //     $old_values = $this->$relationship->lists($column, $idcolumn);

    //     // Delete removed values, if any
    //     if ($deleted = Arrays::keysDeleted($new_values, $old_values)) {
    //         $this->$relationship()->whereIn($idcolumn, $deleted)->delete();
    //     }

    //     // Create new values, if any
    //     if ($created = Arrays::keysCreated($new_values, $old_values)) {
    //         foreach ($created as $id) {
    //             $new[] = $this->$relationship()->getModel()->newInstance($new_values[$id]);
    //         }
            
    //         $this->$relationship()->saveMany($new);
    //     }

    //     // Update changed values, if any
    //     if ($updated = Arrays::keysUpdated($new_values, $old_values)) {
    //         foreach ($updated as $id) {
    //             $this->$relationship()->where($idcolumn, $id)->update($new_values[$id]);
    //         }
    //     }
    // }
}

