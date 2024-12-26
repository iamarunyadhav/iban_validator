<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Iban as ResourcesIban;
use Illuminate\Http\Request;
use App\Models\Iban;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Services\IbanService;
use App\Repositories\IbanRepository;

class IbanController extends Controller
{

    protected $ibanService;
    protected $ibanRepository;

    public function __construct(IbanService $ibanService, IbanRepository $ibanRepository)
    {
        $this->ibanService = $ibanService;
        $this->ibanRepository = $ibanRepository;
    }

    public function validateIban(Request $request)
    {
       
        $iban = strtoupper(str_replace(' ', '', $request->iban));
        $request->validate(['iban' => 'required|string|unique:ibans,iban']);
       
        $validationResult = $this->ibanService->validateIban($iban);

        if (!$validationResult['valid']) {
            return response()->json(['message' => $validationResult['message']], 422);
        }

        $ibanRequest = [
            "iban" => $iban,
            "id"   => $request->id
        ];


        $ibanRecord = $this->ibanRepository->saveIban($ibanRequest);
        return response()->json(['message' => 'IBAN is valid and saved', 'iban' => $ibanRecord], 201);
    }


    public function ibanUsersList()
    {
        $ibansWithUsers=$this->ibanRepository->getIbanUserList();
        return $ibansWithUsers;
    }
   
}


?>
