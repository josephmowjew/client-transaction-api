# Client Transaction API

A Laravel-based RESTful API for managing clients and their transactions. This API provides endpoints for creating, reading, updating, and deleting clients, as well as managing their financial transactions.

## Features

- CRUD operations for clients
- Transaction management for each client
- Automatic transaction total calculation
- Input validation
- RESTful API design
- SQLite database for easy setup

## Requirements

- PHP >= 8.1
- Composer
- SQLite3

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd client-transaction-api
```

2. Install dependencies:
```bash
composer install
```

3. Create environment file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Configure the SQLite database:
```bash
touch database/database.sqlite
```

6. Update .env file with SQLite configuration:
```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

7. Run migrations and seed the database:
```bash
php artisan migrate:fresh --seed
```

8. Start the development server:
```bash
php artisan serve
```

## API Documentation

### Clients

#### List all clients
```
GET /api/clients
```
Response:
```json
{
    "data": [
        {
            "id": 1,
            "name": "John",
            "surname": "Doe",
            "email": "john@example.com",
            "phone": "+1234567890",
            "income": 75000.00,
            "created_at": "2024-03-17T19:31:07.000000Z",
            "updated_at": "2024-03-17T19:31:07.000000Z"
        }
    ]
}
```

#### Get single client
```
GET /api/clients/{id}
```
Response:
```json
{
    "data": {
        "id": 1,
        "name": "John",
        "surname": "Doe",
        "email": "john@example.com",
        "phone": "+1234567890",
        "income": 75000.00,
        "created_at": "2024-03-17T19:31:07.000000Z",
        "updated_at": "2024-03-17T19:31:07.000000Z"
    }
}
```

#### Create client
```
POST /api/clients
```
Request body:
```json
{
    "name": "John",
    "surname": "Doe",
    "email": "john@example.com",
    "phone": "+1234567890",
    "income": 75000.00
}
```

#### Update client
```
PUT /api/clients/{id}
```
Request body:
```json
{
    "name": "John",
    "surname": "Doe",
    "email": "john@example.com",
    "phone": "+1234567890",
    "income": 75000.00
}
```

#### Delete client
```
DELETE /api/clients/{id}
```

### Transactions

#### List client transactions
```
GET /api/clients/{client_id}/transactions
```
Response:
```json
{
    "data": [
        {
            "id": 1,
            "client_id": 1,
            "amount": 1000.00,
            "type": "credit",
            "description": "Salary deposit",
            "created_at": "2024-03-17T19:31:07.000000Z",
            "updated_at": "2024-03-17T19:31:07.000000Z"
        }
    ]
}
```

#### Create transaction
```
POST /api/clients/{client_id}/transactions
```
Request body:
```json
{
    "amount": 1000.00,
    "type": "credit",
    "description": "Salary deposit"
}
```

#### Get transaction total
```
GET /api/clients/{client_id}/transactions/total
```
Response:
```json
{
    "total": 1000.00
}
```

## Validation Rules

### Client Validation
- name: required, string, max:255
- surname: required, string, max:255
- email: required, email, unique:clients
- phone: nullable, string, max:20
- income: required, numeric, min:0

### Transaction Validation
- amount: required, numeric, min:0
- type: required, in:credit,debit
- description: required, string, max:255

## Error Handling

The API returns appropriate HTTP status codes and error messages:

- 200: Successful operation
- 201: Resource created
- 204: No content (successful deletion)
- 400: Bad request
- 404: Resource not found
- 422: Validation error
- 500: Server error

## Testing

You can test the API using tools like Postman or cURL. Example cURL commands:

```bash
# List all clients
curl -X GET -H "Accept: application/json" http://127.0.0.1:8000/api/clients

# Create a new client
curl -X POST -H "Content-Type: application/json" -H "Accept: application/json" \
-d '{"name":"John","surname":"Doe","email":"john@example.com","phone":"+1234567890","income":75000.00}' \
http://127.0.0.1:8000/api/clients

# Create a transaction
curl -X POST -H "Content-Type: application/json" -H "Accept: application/json" \
-d '{"amount":1000.00,"type":"credit","description":"Salary deposit"}' \
http://127.0.0.1:8000/api/clients/1/transactions
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
