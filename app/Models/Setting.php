<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name', 'value', 'context', 'autoload', 'public'];

    // Polymorphic relationship (for future use if needed)
    public function settingable()
    {
        return $this->morphTo();
    }

    // Scope to retrieve public settings
    public function scopePublicSettings($query)
    {
        return $query->where('public', 1);
    }

    // Scope to retrieve autoload settings
    public function scopeAutoloadSettings($query)
    {
        return $query->where('autoload', 1);
    }
}
