<?php

namespace App\Models\Merchant;

use App\Traits\BelongsToMerchant;
use Illuminate\Database\Eloquent\Model;

class MerchantKYC extends Model
{
    use BelongsToMerchant;

    protected $connection = 'dpaisa';

    protected $table = 'user_k_y_c_s';

    const STATUS_VERIFIED = 1;

    const ACCEPT_ACCEPTED = 1;
    const ACCEPT_REJECTED = 0;
    const ACCEPT_UNVERIFIED = null;

    const MALE = 'm';
    const FEMALE = 'f';
    const OTHER = 'o';

    const DOCUMENT_CITIZENSHIP = 'c';
    const DOCUMENT_PASSPORT = 'p';
    const DOCUMENT_LICENSE = 'l';

    public function documentationType()
    {
        if ($this->document_type == self::DOCUMENT_CITIZENSHIP) {
            return 'Citizenship';
        } elseif ($this->document_type == self::DOCUMENT_LICENSE) {
            return 'License';
        } elseif ($this->document_type == self::DOCUMENT_PASSPORT) {
            return 'Passport';
        }
    }
}
