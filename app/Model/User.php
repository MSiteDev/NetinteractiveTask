<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Model
 *
 * @property int $id
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $pesel
 * @property Carbon $created_at
 *
 * @property Collection|Language[] $languages
 */
class User extends Model
{
    public const UPDATED_AT = null;

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }
}
