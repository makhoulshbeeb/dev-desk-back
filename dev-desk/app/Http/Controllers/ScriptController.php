<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Script;
use App\Http\Requests\StoreScriptRequest;
use App\Http\Requests\UpdateScriptRequest;
use Illuminate\Support\Facades\Auth;

class ScriptController extends Controller
{
    public function index()
    {
        $scripts = Script::all();
        return response()->json($scripts, 200);
    }

    public function store(StoreScriptRequest $request)
    {

        $scriptData= Script::create($request->validated());
        return response()->json([
            'message' => 'Script created successfully',
            'script' => $scriptData
        ], 201);
    }

    public function update(UpdateScriptRequest $request, script $script)
    {
        $script->update($request->validated());
        return response()->json([
            'message' => 'Script updated successfully',
            'script' => $script
        ], 200);
    }

    public function destroy(Script $script)
    {
        $script->delete();
        return response()->json(null, 204);
    }

    public function getScriptbyID($id)
    {
        $script = Script::find($id);
        if (!$script) {
            return response()->json(['error' => 'Script not found'], 404);
        }
        return response()->json($script, 200);
    }



    public function getScriptbyUsername($username)
    {
        $scripts = Script::where('username', $username)->get();
        if ($scripts->isEmpty()) {
            return response()->json(['message' => 'No scripts found'], 404);
        }
        return response()->json($scripts, 200);
    }

    public function getScriptbyLike($username)
    {
        $scripts = Script::where('username', 'LIKE', '%' . $username . '%')->get();
        if ($scripts->isEmpty()) {
            return response()->json(['message' => 'No scripts found'], 404);
        }
        return response()->json($scripts, 200);
    }

    public function getScriptbyname(Request $request)
{
    $script = $request->input('name');
    $scripts = Script::where('name', $request->name)->get();
    if ($scripts->isEmpty()) {
        return response()->json(['message' => "No script found for this name"], 404);
    }
    return response()->json($scripts, 200);
}
    

}
