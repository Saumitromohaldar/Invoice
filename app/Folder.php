<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Folder extends Model
{
    // public function children() {
    //     return $this->hasMany(static::class, 'parent_id');
    //     //return $this->hasMany('App\Folder','parent_id','id') ;
    // }

    public function childrenFolders()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    

    function deleteChildFolders($childrenFolders){
        foreach($childrenFolders as $childFolder){
            Storage::disk('public')->deleteDirectory($childFolder->id);
            $childFolder->deleteChildFolders($childFolder->childrenFolders);
        }

    }


}
