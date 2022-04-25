<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Bid
 *
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Bid newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bid newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bid query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $subject
 * @property string $message
 * @property int $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereUserId($value)
 * @property string|null $file
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereFile($value)
 */
class Bid extends Model
{
    use HasFactory;

    protected $fillable = ['id','subject', 'message', 'file', 'user_id', 'status',];

    public const APPROVED = 1;
    public const WAITING = 0;

    /**
     * @param string $subject
     * @param string $message
     * @param string $file
     * @return self
     */
    public static function new(string $subject, string $message, string $file): self
    {
        return Bid::create([
            'subject' => $subject,
            'message' => $message,
            'file'    => $file,
            'status'  => self::WAITING,
            'user_id' => Auth::id(),
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isApproved(): bool
    {
        return $this->status === self::APPROVED;
    }

    public function approve(): void
    {
        if ($this->isApproved()) {
            throw new \RuntimeException('Bid already approved');
        }
        $this->update(['status' => self::APPROVED]);
    }
}
