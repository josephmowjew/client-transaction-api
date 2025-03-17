<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(TransactionRequest $request, Client $client)
    {
        $transaction = $client->transactions()->create($request->validated());
        return new TransactionResource($transaction);
    }

    public function index(Client $client)
    {
        return TransactionResource::collection($client->transactions);
    }

    public function total(Client $client)
    {
        $total = $client->transactions()
            ->selectRaw('SUM(CASE WHEN type = "credit" THEN amount ELSE -amount END) as total')
            ->value('total');
        
        return response()->json(['total' => $total ?? 0]);
    }
}
