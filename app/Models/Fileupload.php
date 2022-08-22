<?php

namespace App\Models;

use App\Models\Filecontenttype;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fileupload extends Model
{
    use HasFactory;

    protected $fillable = ['approved', 'approved_by', 'filecontenttype_id', 'folder_id',
        'registrant_id', 'server_id', 'uploaded_by'];

    public function getFilecontenttypeDescrAttribute()
    {
        return Filecontenttype::find($this->filecontenttype_id)->descr;
    }
}
