<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $img_receipt
 * @property bool $legal_1
 * @property bool $legal_3
 * @property bool $legal_4
 * @property bool $is_main_prize
 * @property bool $is_week_prize
 * @property int $whence_id
 * @property string $token
 * @property string $email
 * @property int $id
 */
class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'firstname', 'lastname', 'birthday', 'email', 'phone', 'shop', 'product_code', 'img_receipt',
        'legal_1', 'legal_2', 'legal_3', 'legal_4', 'legal_5', 'legal_6',
        'is_main_prize', 'competition_title', 'competition_audio',
        'is_week_prize', 'timer', 'response', 'correct',
        'whence_id', 'token'];

    /**
     * @param $value
     * @return void
     */
    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    /**
     * @param $value
     * @return string
     */
    public function getBirthdayAttribute($value): string
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    }

    public function setLegal1Attribute($value)
    {
        $this->attributes['legal_1'] = $value === 'on';
    }

    public function setLegal2Attribute($value)
    {
        $this->attributes['legal_2'] = $value === 'on';
    }

    public function setLegal3Attribute($value)
    {
        $this->attributes['legal_3'] = $value === 'on';
    }

    public function setLegal4Attribute($value)
    {
        $this->attributes['legal_4'] = $value === 'on';
    }

    public function setLegal5Attribute($value)
    {
        $this->attributes['legal_5'] = $value === 'on';
    }

    public function setLegal6Attribute($value)
    {
        $this->attributes['legal_6'] = $value === 'on';
    }

    /**
     * @return BelongsTo
     */
    public function whence(): BelongsTo
    {
        return $this->belongsTo(Whence::class);
    }
}
