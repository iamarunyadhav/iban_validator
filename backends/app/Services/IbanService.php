<?php

namespace App\Services;
use Illuminate\Support\Facades\DB as FacadesDB;

class IbanService
{
    public function validateIban($iban)
    {
        if (!$this->isValidFormat($iban) || !$this->isValidChecksum($iban) || $this->countrySpecificChecks($iban)) {
            return ['valid' => false, 'message' => 'IBAN is invalid'];
        }
        return ['valid' => true, 'message' => 'IBAN is valid'];
    }

    private function isValidFormat($iban)
    {
        return preg_match('/^[A-Z]{2}\d{2}[A-Z0-9]{1,30}$/', $iban);
    }

    private function isValidChecksum($iban)
    {
        $movedChar = substr($iban, 4) . substr($iban, 0, 4);
        $converted = "";
        foreach (str_split($movedChar) as $char) {
            $converted .= ctype_alpha($char) ? ord($char) - ord('A') + 10 : $char;
        }
        return bcmod($converted, 97) == 1;
    }

    private function countrySpecificChecks($iban)
    {
        // Load country lengths from a config or another service
        $countryLengths = config('iban.country_lengths');

        $countryCode = substr($iban, 0, 2);
        $length = strlen($iban);
        if (isset($countryLengths[$countryCode]) && $countryLengths[$countryCode] != $length) {
            return "{$countryCode} IBAN must be {$countryLengths[$countryCode]} characters long";
        }
        return null;
    }
    
    public function getIbanUserList()
    {
    $ibansWithUsers = FacadesDB::table('ibans')
    ->join('users', 'ibans.user_id', '=', 'users.id')
    ->select('ibans.*', 'users.name', 'users.email')
    ->paginate(10);
    return $ibansWithUsers;
    }
    
}
