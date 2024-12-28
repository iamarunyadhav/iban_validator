<?php

namespace App\Repositories;

use App\Http\Resources\Iban as ResourcesIban;
use App\Http\Resources\IbanCollection;
use Illuminate\Support\Facades\DB;


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

    public function getIbanUserList()
    {
    $ibansWithUsers = DB::table('ibans')
    ->join('users', 'ibans.user_id', '=', 'users.id')
    ->select('ibans.*', 'users.name', 'users.email')
    ->paginate(10);

    return $ibansWithUsers;
    // $ibansWithUsers = Iban::with('user')->paginate(10);
    // return new ResourcesIban($ibansWithUsers);
    }
}
