<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    /**
     * Get all files by relationship

     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }

    /**
     * Find file by name

     * @param string $fileName
     * @return File|Model|\Illuminate\Database\Eloquent\Relations\HasMany|\LaravelIdea\Helper\App\Models\_IH_File_QB
     */
    public function findFile(string $fileName)
    {
        return $this->files()->where('name', $fileName)->firstOrFail();
    }
}
