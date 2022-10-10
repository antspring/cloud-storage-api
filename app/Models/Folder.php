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

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function findFile(string $fileName)
    {
        return $this->files()->where('name', $fileName)->firstOrFail();
    }
}
