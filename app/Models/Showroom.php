<?php

namespace App\Models;



use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Showroom extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\ShowroomFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'logo',
        'url',
        'is_approved',
        'city',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_approved' => 'boolean',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'showroom' && $this->is_approved;
    }
}
