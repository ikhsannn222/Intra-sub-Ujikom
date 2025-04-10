<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
       $user = Auth::user();

       if (!$user) {
        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
       }

       return response()->json([
        'message' => 'Get Profile Success',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'nrp' => $user->nrp,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]
       ]);
    }
}
