<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Iban;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class IbanController extends Controller
{
    public function validateIban(Request $request)
    {
        $request->validate(['iban' => 'required|string']);

        $iban = strtoupper(str_replace(' ', '', $request->iban));

        if (!$this->isValidFormat($iban) || !$this->isValidChecksum($iban) || $this->countrySpecificChecks($iban)) {
            return response()->json(['message' => 'IBAN is invalid'], 422);
        }

        // Store the IBAN if it's valid
        $ibanRecord = Iban::create([
            'iban' => $iban,
            'user_id' => 2// Ensure your user is authenticated
        ]);

        return response()->json(['message' => 'IBAN is valid and saved', 'iban' => $ibanRecord], 201);
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
        $countryCode = substr($iban, 0, 2);
        $length = strlen($iban);

        // Assuming we have an array that defines IBAN lengths per country
        $countryLengths = [
            'AL' => 28, 'AD' => 24, 'AT' => 20, 'AZ' => 28, 'BH' => 22,
            'BY' => 28, 'BE' => 16, 'BA' => 20, 'BR' => 29, 'BG' => 22,
            'CR' => 22, 'HR' => 21, 'CY' => 28, 'CZ' => 24, 'DK' => 18,
            'DO' => 28, 'EE' => 20, 'FO' => 18, 'FI' => 18, 'FR' => 27,
            'GE' => 22, 'DE' => 22, 'GI' => 23, 'GR' => 27, 'GL' => 18,
            'GT' => 28, 'HU' => 28, 'IS' => 26, 'IE' => 22, 'IL' => 23,
            'IT' => 27, 'JO' => 30, 'KZ' => 20, 'XK' => 20, 'KW' => 30,
            'LV' => 21, 'LB' => 28, 'LI' => 21, 'LT' => 20, 'LU' => 20,
            'MK' => 19, 'MT' => 31, 'MR' => 27, 'MU' => 30, 'MC' => 27,
            'MD' => 24, 'ME' => 22, 'NL' => 18, 'NO' => 15, 'PK' => 24,
            'PS' => 29, 'PL' => 28, 'PT' => 25, 'QA' => 29, 'RO' => 24,
            'SM' => 27, 'SA' => 24, 'RS' => 22, 'SK' => 24, 'SI' => 19,
            'ES' => 24, 'SE' => 24, 'CH' => 21, 'TL' => 23, 'TN' => 24,
            'TR' => 26, 'UA' => 29, 'AE' => 23, 'GB' => 22, 'VG' => 24
        ];


        if (isset($countryLengths[$countryCode]) && $countryLengths[$countryCode] != $length) {
            return "{$countryCode} IBAN must be {$countryLengths[$countryCode]} characters long";
        }

        return null;  // No error
    }

    // public function ibanUsersList()
    // {
    //     $ibansWithUsers = FacadesDB::table('ibans')
    //         ->join('users', 'ibans.user_id', '=', 'users.id')
    //         ->select('ibans.*', 'users.name', 'users.email') // Specify the columns you need
    //         ->get();
    //     dd($ibansWithUsers);
    // }
}


?>
