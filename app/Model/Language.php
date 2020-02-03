<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 * @package App\Model
 *
 * @property int $id
 * @property string $name
 *
 * @property-read Collection|User[] $users
 * @property-read int|null $users_count
 */
class Language extends Model
{
    public $timestamps = false;

    // Relationships...

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
