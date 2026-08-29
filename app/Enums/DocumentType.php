<?php

namespace App\Enums;

enum DocumentType: string
{
    case Pleadings = 'pleadings';
    case Evidence = 'evidence';
    case Contracts = 'contracts';
    case Correspondence = 'correspondence';
    case CourtOrders = 'court_orders';
    case LegalNotices = 'legal_notices';
    case General = 'general';
    case Other = 'other';

    public function label(): string
    {
        return match ($this) {
            self::Pleadings => 'Pleadings',
            self::Evidence => 'Evidence',
            self::Contracts => 'Contracts',
            self::Correspondence => 'Correspondence',
            self::CourtOrders => 'Court Orders',
            self::LegalNotices => 'Legal Notices',
            self::General => 'General',
            self::Other => 'Other',
        };
    }
}