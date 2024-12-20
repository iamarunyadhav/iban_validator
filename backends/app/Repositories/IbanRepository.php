<?php

namespace App\Repositories;

use App\Models\Iban;

class IbanRepository
{
    public function saveIban($ibanRequest)
    {
        return Iban::create([
            'iban' => $ibanRequest['iban'],
            'user_id' => $ibanRequest['id']
        ]);
    }
}
