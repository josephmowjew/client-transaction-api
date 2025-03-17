<?php

/**
 * @OA\Schema(
 *     schema="Client",
 *     required={"id", "name", "surname", "email", "income"},
 *     @OA\Property(property="id", type="integer", format="int64", example=1),
 *     @OA\Property(property="name", type="string", maxLength=255, example="John"),
 *     @OA\Property(property="surname", type="string", maxLength=255, example="Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
 *     @OA\Property(property="phone", type="string", nullable=true, example="+1234567890"),
 *     @OA\Property(property="income", type="number", format="float", example=5000.00),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2023-01-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-01-01T12:00:00Z")
 * )
 */

/**
 * @OA\Schema(
 *     schema="ClientRequest",
 *     required={"name", "surname", "email", "income"},
 *     @OA\Property(property="name", type="string", maxLength=255, example="John"),
 *     @OA\Property(property="surname", type="string", maxLength=255, example="Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
 *     @OA\Property(property="phone", type="string", nullable=true, example="+1234567890"),
 *     @OA\Property(property="income", type="number", format="float", minimum=0, example=5000.00)
 * )
 */

/**
 * @OA\Schema(
 *     schema="Transaction",
 *     required={"id", "client_id", "amount", "type", "description"},
 *     @OA\Property(property="id", type="integer", format="int64", example=1),
 *     @OA\Property(property="client_id", type="integer", format="int64", example=1),
 *     @OA\Property(property="amount", type="number", format="float", example=150.75),
 *     @OA\Property(property="type", type="string", enum={"credit", "debit"}, example="credit"),
 *     @OA\Property(property="description", type="string", example="Monthly salary payment"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2023-01-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-01-01T12:00:00Z")
 * )
 */

/**
 * @OA\Schema(
 *     schema="TransactionRequest",
 *     required={"amount", "type", "description"},
 *     @OA\Property(property="amount", type="number", format="float", minimum=0, example=150.75),
 *     @OA\Property(property="type", type="string", enum={"credit", "debit"}, example="credit"),
 *     @OA\Property(property="description", type="string", maxLength=255, example="Monthly salary payment")
 * )
 */