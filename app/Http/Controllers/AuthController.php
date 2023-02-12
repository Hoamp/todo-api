<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    public function registration(Request $request)
    {
        $request->validate(['username' => 'required|unique:people', 'password' => 'required']);

        $person = $request->all();

        $person['created_at'] = Carbon::now();
        $person['todo_id'] = 1;
        $person['updated_at'] = Carbon::now();

        $resultSavePerson = Person::registration($person);

        DB::beginTransaction();

        try {
            $response = ['message' => 'berhasil', 'status' => true, 'data' => $resultSavePerson];

            $statusCode = 200;

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            $response = ['message' => 'gagal', 'status' => false];

            if (env('APP_ENV') == 'local') {
                $response['technical'] = $e->getMessage() . " " . $e->getFile() . " " . $e->getLine();
            }
        }

        return response()->json($response, $statusCode);
    }
}
