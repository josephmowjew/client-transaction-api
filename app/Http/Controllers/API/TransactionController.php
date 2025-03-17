<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TransactionController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/clients/{client_id}/transactions",
     *     summary="Create a new transaction for a client",
     *     tags={"Transactions"},
     *     @OA\Parameter(
     *         name="client_id",
     *         in="path",
     *         required=true,
     *         description="Client ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(schema="TransactionRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Transaction created successfully",
     *         @OA\JsonContent(schema="Transaction")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Client not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(TransactionRequest $request, Client $client)
    {
        $transaction = $client->transactions()->create($request->validated());
        return new TransactionResource($transaction);
    }

    /**
     * @OA\Get(
     *     path="/api/clients/{client_id}/transactions",
     *     summary="List all transactions for a client",
     *     tags={"Transactions"},
     *     @OA\Parameter(
     *         name="client_id",
     *         in="path",
     *         required=true,
     *         description="Client ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of transactions",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(schema="Transaction")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Client not found"
     *     )
     * )
     */
    public function index(Client $client)
    {
        return TransactionResource::collection($client->transactions);
    }

    /**
     * @OA\Get(
     *     path="/api/clients/{client_id}/transactions/total",
     *     summary="Get total balance for a client",
     *     tags={"Transactions"},
     *     @OA\Parameter(
     *         name="client_id",
     *         in="path",
     *         required=true,
     *         description="Client ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Total balance",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="total",
     *                 type="number",
     *                 format="float"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Client not found"
     *     )
     * )
     */
    public function total(Client $client)
    {
        $total = $client->transactions()
            ->selectRaw('SUM(CASE WHEN type = "credit" THEN amount ELSE -amount END) as total')
            ->value('total');
        
        return response()->json(['total' => $total ?? 0]);
    }
}
