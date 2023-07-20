<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TaskFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function title($keyword)
    {
        return $this->where('title', 'LIKE', "%$keyword%");
    }

    public function tags($names)
    {
        return $this->withAnyTags($names);
    }
}
