<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fileuploadfolder extends Model
{
    use HasFactory;

    protected $fillable = ['eventversion_id', 'filecontenttype_id', 'folder_id', 'instrumentation_id', 'name',
        'parent_id'];
}
