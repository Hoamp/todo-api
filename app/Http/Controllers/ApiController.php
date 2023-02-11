<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getDataApi()
    {
        $todo = Todo::with(["getPerson"])->get();

        return response()->json($todo);
    }

    public function postDataApi(Request $request)
    {
        $text = $request->text;
        $todo = new Todo();
        $todo->text = $text;
        $todo->save();

        if ($todo) {
            $data = [
                "message" => "Berhasil tambah data",
                "data" => $todo
            ];

            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => "something went wrong",
                'data' => []
            ], 400);
        }
    }

    public function updateDataApi(Request $request, $id)
    {
        $text = $request->text;
        $todo = Todo::find($id);
        $todo->text = $text;
        $todo->save();

        if ($todo) {
            $data = [
                "message" => "Berhasil update data",
                "data" => $todo
            ];

            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => "something went wrong",
                'data' => []
            ], 400);
        }
    }

    public function deleteDataApi(Request $request, $id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return response()->json(["message" => "Delete data success"], 200);
    }
}
