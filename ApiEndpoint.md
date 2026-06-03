Authentication Endpoints
Login
Method: POST
URL: http://localhost:8000/api/login
Register
Method: POST
URL: http://localhost:8000/api/register
Logout
Method: POST
URL: http://localhost:8000/api/logout
Headers:
Authorization: Bearer <your_token>

Frontend Public Endpoints
Slider List
Method: GET
URL: http://localhost:8000/api/front/sider/list
Category List
Method: GET
URL: http://localhost:8000/api/front/category/list
Products by Category
Method: GET
URL: http://localhost:8000/api/front/product_by/{category_id}
Product Details
Method: GET
URL: http://localhost:8000/api/front/product/{id}/detail

User-Specific Endpoints (Requires Auth)
List All Users
Method: GET
URL: http://localhost:8000/api/list
Headers:
Authorization: Bearer <your_token>
User Products
Method: GET
URL: http://localhost:8000/api/user/products
Headers:
Authorization: Bearer <your_token>
Product Details
Method: GET
URL: http://localhost:8000/api/user/products/{id}
Headers:
Authorization: Bearer <your_token>
Place an Order
Method: POST
URL: http://localhost:8000/api/user/orders
Headers:
Authorization: Bearer <your_token>
Body:
json
Copy code
{
"products": [
{
"product_id": 1,
"qty": 2
},
{
"product_id": 2,
"qty": 1
}
]
}
View Orders
Method: GET
URL: http://localhost:8000/api/user/orders
Headers:
Authorization: Bearer <your_token>
Order Details
Method: GET
URL: http://localhost:8000/api/user/orders/{order_id}
Headers:
Authorization: Bearer <your_token>

Admin Endpoints (Requires Admin Role)

Roles Management
List All Roles

Method: GET
URL: http://localhost:8000/api/admin/roles
Headers:
Authorization: Bearer <admin_token>
Create a Role

Method: POST
URL: http://localhost:8000/api/admin/roles
Headers:
Authorization: Bearer <admin_token>
Body:
json
Copy code
{
"name": "Manager"
}
View Single Role

Method: GET
URL: http://localhost:8000/api/admin/roles/{id}
Headers:
Authorization: Bearer <admin_token>
Update a Role

Method: PUT
URL: http://localhost:8000/api/admin/roles/{id}
Headers:
Authorization: Bearer <admin_token>
Body:
json
Copy code
{
"name": "Updated Role Name"
}
Delete a Role

Method: DELETE
URL: http://localhost:8000/api/admin/roles/{id}
Headers:
Authorization: Bearer <admin_token>
Users Management
List All Users

Method: GET
URL: http://localhost:8000/api/admin/users
Headers:
Authorization: Bearer <admin_token>
Create a User

Method: POST
URL: http://localhost:8000/api/admin/users
Headers:
Authorization: Bearer <admin_token>
Body:
json
Copy code
{
"name": "John Doe",
"username": "johndoe",
"email": "johndoe@example.com",
"password": "securepassword",
"phone": "1234567890",
"address": "123 Main Street",
"role_id": 1
}
View Single User

Method: GET
URL: http://localhost:8000/api/admin/users/{id}
Headers:
Authorization: Bearer <admin_token>
Update a User

Method: PUT
URL: http://localhost:8000/api/admin/users/{id}
Headers:
Authorization: Bearer <admin_token>
Body:
json
Copy code
{
"name": "John Updated",
"email": "johnupdated@example.com",
"phone": "9876543210",
"address": "456 Updated Street"
}
Delete a User

Method: DELETE
URL: http://localhost:8000/api/admin/users/{id}
Headers:
Authorization: Bearer <admin_token>
Categories Management
List All Categories

Method: GET
URL: http://localhost:8000/api/admin/categories
Headers:
Authorization: Bearer <admin_token>
Create a Category

Method: POST
URL: http://localhost:8000/api/admin/categories
Headers:
Authorization: Bearer <admin_token>
Body:
json
Copy code
{
"name": "Electronics",
"description": "Category for electronic devices",
"category_image": "image_url_here"
}
View Single Category

Method: GET
URL: http://localhost:8000/api/admin/categories/{id}
Headers:
Authorization: Bearer <admin_token>
Update a Category

Method: PUT
URL: http://localhost:8000/api/admin/categories/{id}
Headers:
Authorization: Bearer <admin_token>
Body:
json
Copy code
{
"name": "Updated Category Name",
"description": "Updated category description",
"category_image": "new_image_url_here"
}
Delete a Category

Method: DELETE
URL: http://localhost:8000/api/admin/categories/{id}
Headers:
Authorization: Bearer <admin_token>
Products Management
List All Products

Method: GET
URL: http://localhost:8000/api/admin/products
Headers:
Authorization: Bearer <admin_token>
Create a Product

Method: POST
URL: http://localhost:8000/api/admin/products
Headers:
Authorization: Bearer <admin_token>
Body:
json
Copy code
{
"category_id": 1,
"product_name": "Smartphone",
"product_description": "Latest smartphone with great features",
"qty": 100,
"price": 699.99,
"star": 4.5,
"time_value": 7,
"product_image": "product_image_url_here"
}
View Single Product

Method: GET
URL: http://localhost:8000/api/admin/products/{id}
Headers:
Authorization: Bearer <admin_token>
Update a Product

Method: PUT
URL: http://localhost:8000/api/admin/products/{id}
Headers:
Authorization: Bearer <admin_token>
Body:
json
Copy code
{
"product_name": "Updated Product Name",
"qty": 50,
"price": 799.99
}
Delete a Product

Method: DELETE
URL: http://localhost:8000/api/admin/products/{id}
Headers:
Authorization: Bearer <admin_token>
Order Management
List All Orders

Method: GET
URL: http://localhost:8000/api/admin/order
Headers:
Authorization: Bearer <admin_token>
View Single Order

Method: GET
URL: http://localhost:8000/api/admin/order/{id}
Headers:
Authorization: Bearer <admin_token>
Delete an Order

Method: DELETE
URL: http://localhost:8000/api/admin/order/{id}
Headers:
Authorization: Bearer <admin_token>
