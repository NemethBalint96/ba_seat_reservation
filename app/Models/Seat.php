<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    public const STATUS_AVAILABLE = 'szabad';
    public const STATUS_RESERVED = 'foglalt';
    public const STATUS_SOLD = 'elkelt';

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public static function reserveSeats(array $seatIds): bool
    {
        $availableSeats = Seat::whereIn('id', $seatIds)
            ->where('status', self::STATUS_AVAILABLE)
            ->get();

        if ($availableSeats->count() !== count($seatIds)) {
            return false;
        }

        foreach ($availableSeats as $seat) {
            $seat->reserve();
        }

        return true;
    }

    public static function releseSeats(array $seatIds): void
    {
        foreach ($seatIds as $seatId) {
            $seat = Seat::find($seatId);

            if ($seat) {
                $seat->relese();
            }
        }
    }

    public static function sellSeats(array $seatIds): Collection
    {
        $reservedSeats = Seat::whereIn('id', $seatIds)
            ->where('status', self::STATUS_RESERVED)
            ->get();

        foreach ($reservedSeats as $reservedSeat) {
            $reservedSeat->sell();
        }

        return $reservedSeats;
    }

    private function reserve(): bool
    {
        if ($this->isAvailable()) {
            $this->status = self::STATUS_RESERVED;
            $this->save();

            return true;
        }

        return false;
    }

    private function isAvailable(): bool
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    private function sell(): bool
    {
        if ($this->isReserved()) {
            $this->status = self::STATUS_SOLD;
            $this->save();

            return true;
        }

        return false;
    }

    private function relese(): bool
    {
        if ($this->isReserved()) {
            $this->status = self::STATUS_AVAILABLE;
            $this->save();

            return true;
        }

        return false;
    }

    private function isReserved(): bool
    {
        return $this->status === self::STATUS_RESERVED;
    }
}
