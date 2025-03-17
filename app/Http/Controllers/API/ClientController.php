<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Client Transaction API",
 *     description="API for managing clients and their transactions",
 *     @OA\Contact(
 *         email="admin@example.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 */
class ClientController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/clients",
     *     summary="List all clients",
     *     tags={"Clients"},
     *     @OA\Response(
     *         response=200,
     *         description="List of clients",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(schema="Client")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return ClientResource::collection(Client::all());
    }

    /**
     * @OA\Post(
     *     path="/api/clients",
     *     summary="Create a new client",
     *     tags={"Clients"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(schema="ClientRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Client created successfully",
     *         @OA\JsonContent(schema="Client")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(ClientRequest $request)
    {
        $client = Client::create($request->validated());
        return new ClientResource($client);
    }

    /**
     * @OA\Get(
     *     path="/api/clients/{id}",
     *     summary="Get client details",
     *     tags={"Clients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Client ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Client details",
     *         @OA\JsonContent(schema="Client")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Client not found"
     *     )
     * )
     */
    public function show(Client $client)
    {
        $client->load('transactions');
        return new ClientResource($client);
    }

    /**
     * @OA\Put(
     *     path="/api/clients/{id}",
     *     summary="Update client details",
     *     tags={"Clients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Client ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(schema="ClientRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Client updated successfully",
     *         @OA\JsonContent(schema="Client")
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
    public function update(ClientRequest $request, Client $client)
    {
        $validatedData = $request->validated();
        $client->update($validatedData);
        return new ClientResource($client);
    }

    /**
     * @OA\Delete(
     *     path="/api/clients/{id}",
     *     summary="Delete a client",
     *     tags={"Clients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Client ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Client deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Client not found"
     *     )
     * )
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->noContent();
    }
}
