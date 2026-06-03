# Laravel API Endpoints Testing Guide in Postman

## Authentication Endpoints

1. Register User

POST: http://localhost:8000/api/register
Body (raw JSON):
{
"name": "Test User",
"username": "testuser",
"email": "test@example.com",
"password": "password123",
"address": "123 Test Street"
}

2. Login User

POST: http://localhost:8000/api/login
Body (raw JSON):
{
"email": "test@example.com",
"password": "password123"
}

## Public Endpoints

3. Get Sliders

   GET: http://localhost:8000/api/front/sider/list

4. Get Categories

   GET: http://localhost:8000/api/front/category/list

5. Get Products by Category

   GET: http://localhost:8000/api/front/product_by/{category_id}

6. Get Product Detail

   GET: http://localhost:8000/api/front/product/{id}/detail

## Protected Customer Endpoints

Add Authorization header with Bearer token received from login

7. Logout

POST: http://localhost:8000/api/logout
Headers:
Authorization: Bearer {token}

8. Create Order

POST: http://localhost:8000/api/user/orders
Headers:
Authorization: Bearer {token}
Body (raw JSON):
{
"product_id": 1,
"qty": 2
}

9. Get Orders

GET: http://localhost:8000/api/user/orders
Headers:
Authorization: Bearer {token}

## Protected Admin Endpoints

Requires admin role and Bearer token

10. Create Product

POST: http://localhost:8000/api/admin/products
Headers:
Authorization: Bearer {token}
Body (form-data):
product_name: Test Product
product_description: Test Description
qty: 10
price: 99.99
star: 4.5
time_value: 30
product_image: [file]
category_id: 1

11. Update Product

PUT: http://localhost:8000/api/admin/products/{id}
Headers:
Authorization: Bearer {token}
Body (form-data):
\_method: PUT
product_name: Updated Product
[other fields as needed]

12. Delete Product

DELETE: http://localhost:8000/api/admin/products/{id}
Headers:
Authorization: Bearer {token}

## Role Management Endpoints

// Get all roles
GET: http://localhost:8000/api/admin/roles
Headers:
Authorization: Bearer {token}

// Create new role
POST: http://localhost:8000/api/admin/roles
Headers:
Authorization: Bearer {token}
Body (raw JSON):
{
"name": "editor",
"description": "Editor role description"
}

// Get specific role
GET: http://localhost:8000/api/admin/roles/{id}
Headers:
Authorization: Bearer {token}

// Update role
PUT: http://localhost:8000/api/admin/roles/{id}
Headers:
Authorization: Bearer {token}
Body (raw JSON):
{
"name": "updated-editor",
"description": "Updated description"
}

// Delete role
DELETE: http://localhost:8000/api/admin/roles/{id}
Headers:
Authorization: Bearer {token}

## User Management Endpoints

// Get all users
GET: http://localhost:8000/api/admin/users
Headers:
Authorization: Bearer {token}

// Create new user
POST: http://localhost:8000/api/admin/users
Headers:
Authorization: Bearer {token}
Body (raw JSON):
{
"name": "John Doe",
"username": "johndoe",
"email": "john@example.com",
"password": "password123",
"address": "123 Street",
"role_id": 1
}

// Get specific user
GET: http://localhost:8000/api/admin/users/{id}
Headers:
Authorization: Bearer {token}

// Update user
PUT: http://localhost:8000/api/admin/users/{id}
Headers:
Authorization: Bearer {token}
Body (raw JSON):
{
"name": "John Updated",
"email": "john.updated@example.com",
"address": "456 Street"
}

// Delete user
DELETE: http://localhost:8000/api/admin/users/{id}
Headers:
Authorization: Bearer {token}

## Category Management Endpoints

// Get all categories
GET: http://localhost:8000/api/admin/categories
Headers:
Authorization: Bearer {token}

// Create new category
POST: http://localhost:8000/api/admin/categories
Headers:
Authorization: Bearer {token}
Body (form-data):
name: Category Name
category_image: [file]

// Get specific category
GET: http://localhost:8000/api/admin/categories/{id}
Headers:
Authorization: Bearer {token}

// Update category
PUT: http://localhost:8000/api/admin/categories/{id}
Headers:
Authorization: Bearer {token}
Body (form-data):
\_method: PUT
name: Updated Category Name
category_image: [file]

// Delete category
DELETE: http://localhost:8000/api/admin/categories/{id}
Headers:
Authorization: Bearer {token}

Note: All endpoints require admin authentication. Make sure to include the Bearer token received after login in the Authorization header.
# ecommerce-assignment
# ecommerce-assignment
