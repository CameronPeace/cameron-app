<?php

namespace App\Models\Donation;

use App\Models\Donation\Donation;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonationPayment extends Model
{
    use HasUuids;

    public function donation(): BelongsTo
    {
        return $this->belongsTo(Donation::class);
    }
}
