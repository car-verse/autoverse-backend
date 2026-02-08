<?php

namespace App\Enums;


enum CarStatusEnum: int
{
    case DRAFT = 1;
    case PENDING_APPROVAL = 2;
    case ACTIVE = 3;
    case SOLD = 4;
    case EXPIRED = 5;
    case REJECTED = 6;

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::PENDING_APPROVAL => 'Pending Approval',
            self::ACTIVE => 'Active',
            self::SOLD => 'Sold',
            self::EXPIRED => 'Expired',
            self::REJECTED => 'Rejected',
        };
    }

    public function color(): string | array | null
    {
        return match ($this) {
            self::DRAFT => 'gray',
            self::PENDING_APPROVAL => 'warning',
            self::ACTIVE => 'success',
            self::SOLD => 'danger',
            self::EXPIRED => 'gray',
            self::REJECTED => 'danger',
        };
    }
}
