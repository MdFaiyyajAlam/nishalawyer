<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Advocate = 'advocate';
    case Client = 'client';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Administrator',
            self::Advocate => 'Advocate',
            self::Client => 'Client',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Admin => 'bg-purple-100 text-purple-800',
            self::Advocate => 'bg-blue-100 text-blue-800',
            self::Client => 'bg-emerald-100 text-emerald-800',
        };
    }
}