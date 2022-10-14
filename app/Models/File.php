<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'public_link',
        'folder_id',
        'size'
    ];

    /**
     * Get folder

     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
