<?php

namespace App\Enums;

enum CaseStatus: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Dismissed = 'dismissed';
    case Settled = 'settled';
    case Closed = 'closed';
    case Won = 'won';
    case Lost = 'lost';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Active => 'Active',
            self::Dismissed => 'Dismissed',
            self::Settled => 'Settled',
            self::Closed => 'Closed',
            self::Won => 'Won',
            self::Lost => 'Lost',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Pending => 'bg-yellow-100 text-yellow-800',
            self::Active => 'bg-green-100 text-green-800',
            self::Dismissed => 'bg-red-100 text-red-800',
            self::Settled => 'bg-blue-100 text-blue-800',
            self::Closed => 'bg-gray-100 text-gray-800',
            self::Won => 'bg-emerald-100 text-emerald-800',
            self::Lost => 'bg-rose-100 text-rose-800',
        };
    }
}