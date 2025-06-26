<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Str;
use App\Models\MobilePrefix;
use Illuminate\Contracts\Validation\ValidationRule;

class MobilePrefixRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $no_hp = $this->sanitizeNoWhatsapp($value);
        $no_hp_prefix = Str::substr($no_hp, 0, 4);
        $provider_check = MobilePrefix::where('prefix', '=', $no_hp_prefix)->get();

        if ($provider_check->count() == 0) {
            $fail('Prefix Provider '.$no_hp_prefix.' tidak ditemukan, silahkan cek kembali');
        }
    }

    protected function sanitizeNoWhatsapp($no_whatsapp)
    {
        $no_whatsapp = preg_replace('/[^0-9]/', '', $no_whatsapp);

        if (Str::startsWith($no_whatsapp, '+62')) {
            $no_whatsapp = '0'.Str::substr($no_whatsapp, 3);
        }

        if (Str::startsWith($no_whatsapp, '62')) {
            $no_whatsapp = '0'.Str::substr($no_whatsapp, 2);
        }

        if (Str::startsWith($no_whatsapp, '08+62')) {
            $no_whatsapp = '0'.Str::substr($no_whatsapp, 5);
        }

        if (Str::startsWith($no_whatsapp, '0862')) {
            $no_whatsapp = '0'.Str::substr($no_whatsapp, 4);
        }

        return $no_whatsapp;
    }
}
