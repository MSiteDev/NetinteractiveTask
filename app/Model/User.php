<?php

namespace App\Model;

use App\Support\Pesel;
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

    /** @var Pesel */
    private $peselObject;

    public function getFullName() : string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function getPeselObject()
    {
        if(!$this->peselObject)
            $this->peselObject = new Pesel($this->pesel);
        return $this->peselObject;
    }

    // Modifiers...

    public function setFirstNameAttribute($value) : void
    {
        $this->attributes["first_name"] = ucfirst($value);
    }

    public function setLastNameAttribute($value) : void
    {
        $this->attributes["last_name"] = ucfirst($value);
    }

    public function setPeselAttribute($value) : void
    {
        $this->attributes["pesel"] = $value;
        if($this->isDirty("pesel"))
            $this->peselObject = null;
    }

    // Relationships...

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }
}
