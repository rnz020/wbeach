<?php

namespace App\Repositories;

abstract class Repository {
    
    /**
     * @return \App\Entities\Entity
     */
    abstract public function getModel();
    
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery()
    {
        return $this->getModel()->newQuery();
    }
    
    public function findOrFail($id)
    {
        return $this->newQuery()->findOrFail($id);
    }
   
    public function create(array $attributes)
    { 
        return $this->getModel()->create($attributes);
    }
   
    public function update($id, array $attributes)
    {  
        $entity = $this->findOrFail($id);
        
            return $entity->update($attributes);
    }
   
    public function delete($entity)
    { 
        if(is_int($entity)){
            return $this->findOrFail($entity)->delete();
        }
            
        return $entity->delete();
    }
}