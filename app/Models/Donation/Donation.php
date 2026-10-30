<?php

namespace App\Models\Donation;

use App\Models\Donation\FundraiserEvent;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Donation extends Model
{
    use HasUuids;

    public function donator(): BelongsTo
    {
        return $this->belongsTo(Donator::class);
    }

    public function fundraiserEvent(): BelongsTo
    {
        return $this->belongsTo(FundraiserEvent::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(DonationPayment::class);
    }
}
