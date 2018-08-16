<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Hash extends Model
{
    use Searchable;

    public $table = 'search_hash';

    public $timestamps = false;

    public function fileList()
    {
        return $this->hasOne('App\HashList','info_hash','info_hash');
    }
    
    /**
     * 定义索引里面的type
     * @return string
     */
    public function searchableAs()
    {
        return 'post';
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'id' => $this->id,
            'length' => $this->length,
            'requests' => $this->requests
        ];
    }

}
