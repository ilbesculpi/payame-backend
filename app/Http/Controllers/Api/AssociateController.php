<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Associate;

class AssociateController
{

    /**
     * Retrieve a list of User Associates.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if( !$user ) {
            return response()
                ->json([
                    'code' => 'Unauthorized',
                    'message' => 'User not authenticated.',
                ], 401);
        }

        $associates = Associate::where('user_id', $user->id)
            ->get();
        return [
            'associates' => $associates
        ];
    }

    /**
     * Create a new Associate.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $request->merge([
            'user_id' => $user->id
        ]);
        $associate = Associate::create(
            $request->only([
                'full_name',
                'email',
                'telephone',
                'notes',
                'user_id',
            ])
        );
        return response()
            ->json([
                'associate' => $associate
            ], 201);
    }
}
