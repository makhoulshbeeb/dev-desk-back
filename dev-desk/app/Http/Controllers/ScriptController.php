<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Script;
use App\Models\User;
class ScriptController extends Controller
{

    public function getAllScripts()
    {
        $scripts = Script::all();
        return response()->json($scripts, 200);
    }

    public function getScript(Request $req)
    {
        $script = Script::find($req->id);
        if (!$script) {
            return response()->json(['error' => 'Script not found'], 404);
        }
        return response()->json($script, 200);
    }

    public function createScript(Request $req)
    {
        $username = $req->input('username');
        $validatedUser = User::where('username', $username)->first();

        if (!$validatedUser) {
            return response()->json(['error' => 'Username not found'], 404);
        }

        $script = Script::create([
            'username' => $req->username,
            'content' => $req->content,
            'language' => $req->language,
        ]);
        
        return response()->json($script, 201);
    }

    public function updateScript(Request $req)
    {
        $script = Script::find($req->id);
        if (!$script) {
            return response()->json(['error' => 'Script not found'], 404);
        }
        $script->content = $req->content;
        $script->language = $req->language;
        $script->save();

        return response()->json($script, 200);
    }
    public function deleteScript(Request $req)
    {
        $script = Script::find($req->id);
        if (!$script) {
            return response()->json(['error' => 'Script not found'], 404);
        }
        $script->delete();
        return response()->json(['message' => 'Script deleted successfully'], 200);
    }
}
