# E-Commerce & Food Delivery API Training & Flutter Integration Manual

Welcome to the **E-Commerce & Food Delivery API Developer Manual**. This document is specifically structured to streamline integration with a **Flutter Mobile Application**. It provides the network configuration rules for simulators, emulators, and physical devices, maps out all available backend endpoints, and includes a copy-pasteable production-ready Dart API Client.

---

## 1. Localhost and Emulator Network Guide

A common mistake for Flutter developers is using `localhost` or `127.0.0.1` inside their app code. This fails on mobile environments because the emulator/device runs in its own isolated network workspace instead of the host machine.

Use the table below to configure your Dart API Client base URL:

| Target Device              | Target IP & Port              | Port Details          | Explanation                                                                |
| :------------------------- | :---------------------------- | :-------------------- | :------------------------------------------------------------------------- |
| **Android Emulator**       | `http://10.0.2.2:8000/api`    | Laragon/Artisan Serve | Points to your computer's localhost from the virtual emulator.             |
| **iOS Simulator**          | `http://127.0.0.1:8000/api`   | Laragon/Artisan Serve | share the host machine network stack directly.                             |
| **Physical Device (WiFi)** | `http://192.168.x.x:8000/api` | Current host LAN IP   | Computer and mobile device must reside on the exact same Wi-Fi connection. |

Ensure your local server is running and listening on all interfaces (e.g. `php artisan serve --host=0.0.0.0 --port=8000`).

---

## 2. Role-Based Access Control (RBAC) privileges

Endpoints are protected by `Laravel Sanctum` tokens. Each authenticated user carries an associated `role_id` which determines their API authorization scopes.

| Role Name                 | Role ID | Primary Actions                                                                               | Middleware Protection   |
| :------------------------ | :------ | :-------------------------------------------------------------------------------------------- | :---------------------- |
| **Admin**                 | `1`     | Full dashboard operations: Categories, products, orders, slider banners, user, and role CRUD. | `role:admin`            |
| **Editor**                | `2`     | Content marketing and news blog entries (`POST` and `PUT` media uploads).                     | `role:editor`           |
| **User (Customer)**       | `3`     | Browsing catalogs, starting orders, checking histories, and cancelling transactions.          | `role:user`             |
| **Driver**                | `4`     | View open dispatch order pools, accept deliveries, update driving state, and sign handovers.  | `role:driver,admin`     |
| **Restaurant (Merchant)** | `5`     | Register store outlets, fetch kitchen cooking grids, and transition statuses.                 | `role:restaurant,admin` |

---

## 3. Directory Structure

Below are the primary logical files mapping to these routes:

- Routes Configuration: `routes/api.php`
- User Authentication: `app/Http/Controllers/Auth/AuthController.php`
- Frontend Public Catalog: `app/Http/Controllers/API/FrontController.php`
- Main Customers Orders: `app/Http/Controllers/API/OrderController.php`
- Merchant Flow: `app/Http/Controllers/API/Merchant/RestaurantController.php`
- Driver Logistics: `app/Http/Controllers/API/Delivery/DriverController.php`
- Admin Controllers: Located inside `app/Http/Controllers/API/Admin/`

---

## 4. API Endpoints Catalog

### Group A: Authentication & User Registration

Endpoints in this group do not require authentication for registration and login. Logout requires a valid session token.

#### 1. User Registration

- **Endpoint:** `POST` `/auth/register`

- **Content-Type:** `application/json`

- **JSON Request Payload:**

```json
{
  "name": "Jane Doe",
  "username": "janedoe",
  "email": "jane@example.com",
  "password": "securePass123",
  "confirm_password": "securePass123",
  "phone": "+15550199",
  "role_id": 3
}
```

- **Success Json Response (201 Created):**

```json
{
  "user": {
    "id": 14,
    "name": "Jane Doe",
    "username": "janedoe",
    "email": "jane@example.com",
    "phone": "+15550199",
    "role_id": 3,
    "created_at": "2026-06-11T12:00:00.000000Z"
  },
  "token": "1_token_string_here",
  "message": "Registered successfully"
}
```

#### 2. User Login

- **Endpoint:** `POST` `/auth/login`

- **Content-Type:** `application/json`

- **JSON Request Payload:**

```json
{
  "email": "jane@example.com",
  "password": "securePass123"
}
```

- **Success Json Response (200 OK):**

```json
{
  "status": "success",
  "user": {
    "id": 14,
    "name": "Jane Doe",
    "role_id": 3,
    "email": "jane@example.com"
  },
  "token": "2_token_string_here",
  "message": "Login successfully"
}
```

#### 3. User Logout

- **Endpoint:** `POST` `/auth/logout`

- **Headers:** `Authorization: Bearer <token>`

- **Success Json Response (200 OK):**

```json
{
  "status": "success",
  "message": "Logged out successfully"
}
```

---

### Group B: Public Catalog & Landing Section

Endpoints for home landing interfaces (Sliders, Catalog Collections, and Product Detail screens).

#### 1. List Sliders

- **Endpoint:** `GET` `/front/getSiders`

- **Headers:** `Authorization: Bearer <token>`

- **Success Json Response (200 OK):**

```json
{
  "status": "success",
  "sliders": [
    {
      "id": 1,
      "slider_title": "Summer Promotion",
      "slider_image": "storage/sliders/prom1.jpg"
    }
  ]
}
```

#### 2. List Categories

- **Endpoint:** `GET` `/front/getCategories`

- **Headers:** `Authorization: Bearer <token>`

- **Success Json Response (200 OK):**

```json
{
  "status": "success",
  "categories": [
    {
      "id": 1,
      "name": "Fast Food",
      "description": "Burgers, Pizza & More",
      "category_image": "storage/categories/food.png"
    }
  ]
}
```

#### 3. List Products by Category

- **Endpoint:** `GET` `/front/getProductByCategory/{category_id}`

- **Headers:** `Authorization: Bearer <token>`

- **Success Json Response (200 OK):**

```json
{
  "status": "success",
  "products": [
    {
      "id": 10,
      "category_id": 1,
      "product_name": "Premium Double Burger",
      "price": 8.99,
      "product_image": "storage/products/burger.jpg"
    }
  ]
}
```

#### 4. Product Details

- **Endpoint:** `GET` `/front/getProduct/detailBy/{id}`

- **Headers:** `Authorization: Bearer <token>`

- **Success Json Response (200 OK):**

```json
{
  "status": "success",
  "details": {
    "id": 10,
    "product_name": "Premium Double Burger",
    "product_description": "Grilled patties with special homemade sauce.",
    "price": 8.99,
    "qty": 45,
    "star": 4.8,
    "time_value": 25,
    "product_image": "storage/products/burger.jpg"
  }
}
```

#### 5. Search Products

- **Endpoint:** `GET` `/front/searchProduct?search={query}`

- **Headers:** `Authorization: Bearer <token>`

- **Success Json Response (200 OK):**

```json
{
  "status": "success",
  "products": []
}
```

#### 6. Random Products (General & Details)

- **Endpoints:** `GET` `/front/get_random_product` OR `GET` `/front/get_random_product_detail/{id}`

- **Headers:** `Authorization: Bearer <token>`

- **Success Json Response (200 OK):** Returns curated/random item options for recommendation sliders.

---

### Group C: Customer E-Commerce & Food Delivery Flow

_Restricted To:_ `role:user` (using Bearer Client Token).

#### 1. Submit/Place Order

- **Endpoint:** `POST` `/user/orders`

- **Content-Type:** `application/json`

- **JSON Request Payload:**

```json
{
  "delivery_address": "742 Evergreen Terrace, Springfield",
  "latitude": 37.7749,
  "longitude": -122.4194,
  "payment_method": "cod",
  "notes": "Gate code is #1337",
  "restaurant_id": 1,
  "products": [
    {
      "product_id": 10,
      "qty": 2
    }
  ]
}
```

- **Success Json Response (201 Created):**

```json
{
  "status": "success",
  "message": "Your food order has been placed successfully!",
  "order": {
    "id": 102,
    "user_id": 14,
    "restaurant_id": 1,
    "total_amount": 19.98,
    "delivery_fee": 2.0,
    "status": "pending",
    "payment_method": "cod",
    "payment_status": "pending",
    "delivery_address": "742 Evergreen Terrace, Springfield",
    "created_at": "2026-06-11T12:20:00.000000Z"
  }
}
```

#### 2. Get Order History (Paginated)

- **Endpoint:** `GET` `/user/orders?page={page_number}`

- **Success Json Response (200 OK):**

```json
{
  "status": "success",
  "orders": {
    "current_page": 1,
    "data": [
      {
        "id": 102,
        "total_amount": 19.98,
        "status": "pending",
        "restaurant": { "name": "Burger Joint" },
        "order_details": []
      }
    ],
    "next_page_url": "http://localhost:8000/api/user/orders?page=2"
  }
}
```

#### 3. Cancel My Order

- **Endpoint:** `POST` `/user/orders/{order_id}/cancel`

- **Note:** Cancel is only permitted while status is `'pending'`. Reverts corresponding product stocks automatically.

- **Success Json Response (200 OK):**

```json
{
  "status": "success",
  "message": "Order cancelled successfully.",
  "order": { "id": 102, "status": "cancelled" }
}
```

---

### Group D: On-Demand Meal Merchant Operations

_Restricted To:_ `role:restaurant,admin` (Restaurant Merchant app interfaces).

#### 1. List Merchants Outlets

- **Endpoint:** `GET` `/merchant/restaurants`

- **Success Json Response (200 OK):**

```json
{
  "status": "success",
  "restaurants": [
    {
      "id": 1,
      "name": "Grand Pizza Outlet",
      "cuisine_type": "Italian",
      "address": "123 Main St",
      "products_count": 18
    }
  ]
}
```

#### 2. Store Restaurant Profile

- **Endpoint:** `POST` `/merchant/restaurants`

- **JSON Request Payload:**

```json
{
  "name": "Taco Palace",
  "cuisine_type": "Mexican Food",
  "address": "456 Fiesta Boulevard",
  "phone": "+12345678",
  "image": "https://picsum.photos/200"
}
```

- **Success Json Response (210 Custom Code):**

```json
{
  "status": "success",
  "message": "Restaurant registered successfully!",
  "restaurant": { "id": 2, "name": "Taco Palace" }
}
```

#### 3. Fetch Orders Queue

- **Endpoint:** `GET` `/merchant/orders?status={status}&restaurant_id={id}`

- **Description:** Retrieve orders sorted by timestamp. Filter by workflow values like `pending`, `preparing`, or `ready_for_pickup`.

#### 4. Update Kitchen Workflow Status

- **Endpoint:** `POST` `/merchant/orders/{order_id}/status`

- **JSON Request Payload:**

```json
{
  "status": "preparing"
}
```

- **Success Json Response (200 OK):**

```json
{
  "status": "success",
  "message": "Order updated successfully to 'preparing'!",
  "order": { "id": 102, "status": "preparing" }
}
```

---

### Group E: Driver Delivery & Logistics

_Restricted To:_ `role:driver,admin` (Driver specific application module).

#### 1. Fetch Open Order Pool

- **Endpoint:** `GET` `/driver/orders/available`

- **Description:** Lists all cooked orders seeking a delivery driver (status `ready_for_pickup` with no active `driver_id`).

- **Success Json Response (200 OK):** Array of ready orders containing customer addresses, notes, and merchant coordinates.

#### 2. Claim/Accept Job

- **Endpoint:** `POST` `/driver/orders/{order_id}/accept`

- **Transitions order status to:** `out_for_delivery`

- **Success Json Response (200 OK):**

```json
{
  "status": "success",
  "message": "Order accepted successfully. Keep safe on the road!"
}
```

#### 3. View Driver Deliveries

- **Endpoint:** `GET` `/driver/orders/my-deliveries?status={active|completed}`

- **Query Options:** `status=active` (shows ongoing orders) OR `status=completed` (shows delivered packages).

#### 4. Complete Delivery Handover

- **Endpoint:** `POST` `/driver/orders/{order_id}/complete`

- **Workflow Mutation:** Marks order as `delivered`. If payment_method was `cod`, sets payment_status to `paid`.

- **Success Json Response (200 OK):**

```json
{
  "status": "success",
  "message": "Order successfully marked as delivered. Good job!"
}
```

---

### Group F: Editorial, News & Posts Management

_Restricted To:_ `role:editor`

This module uses `multipart/form-data` to bundle text database records alongside physical binary cover images.

#### 1. Retrieve Posts List

- **Endpoint:** `GET` `/api/editor/editor/posts`

- **Success Json Response (200 OK):** Returns a paginated list of posts.

#### 2. Publish New Article

- **Endpoint:** `POST` `/api/editor/editor/posts`

- **Content-Type:** `multipart/form-data`

- **Body Form Parameters:**
  - `title` (Required, string)
  - `content` (Required, string)
  - `image_path` (Optional, binary file upload)

#### 3. Modify Editorial Post

- **Endpoint:** `POST` `/api/editor/editor/posts/{post_id}`

- **Dart Trick:** Use the `POST` verb and pass `_method: "PUT"` inside the field attributes to overwrite files on older multi-part servers seamlessly.

- **Multipart Fields:**
  - `title` (Required, string)
  - `content` (Required, string)
  - `_method` (String constraint: `"PUT"`)
  - `image` (Optional, binary file upload)

#### 4. Delete Editorial Post

- **Endpoint:** `DELETE` `/api/editor/editor/posts/{post_id}`

- **Success Json Response (200 OK):**

```json
{
  "message": "Post and associated image deleted successfully."
}
```

---

### Group G: Core Admin Resource Managers

_Restricted To:_ `role:admin`

Core entities (Category and Product CRUD modules) can be managed globally through the Admin endpoints.

- `/api/admin/roles` — Role Management (`GET`, `POST`, `SHOW`, `PUT`, `DELETE`)
- `/api/admin/users` — User Master Database (`GET`, `POST`, `SHOW`, `PUT`, `DELETE`)
- `/api/admin/categories` — E-Commerce Category Catalog CRUD
- `/api/admin/products` — E-Commerce Product Catalog CRUD
- `/api/admin/order` — Global Order Master Grid
- `/api/admin/sliders` — Admin Promotional Slide CRUD

#### Product Creation Media Upload

- **Endpoint:** `POST` `/api/admin/products`

- **Content-Type:** `multipart/form-data`

- **Multipart Form Fields:**
  - `product_name` (String, required)
  - `product_description` (String, required)
  - `qty` (Integer, required)
  - `price` (Numeric double, required)
  - `star` (Double, `0-5`, required)
  - `time_value` (Integer minutes, required)
  - `category_id` (Integer Category ID, required)
  - `product_image` (Binary product media file, required)

---

## 5. Standard Error Envelopes

### Unauthenticated State (HTTP 401)

Returned if the `Bearer Token` is omitted or invalid:

```json
{
  "message": "Unauthenticated."
}
```

### Unauthorized Action (HTTP 403)

Returned when a user attempts actions outside of their assigned role permissions:

```json
{
  "status": "error",
  "message": "Unauthorized access"
}
```

### Request Validation Failure (HTTP 422 / HTTP 200 with error flag)

```json
{
  "status": "error",
  "message": {
    "username": ["The username has already been taken."],
    "email": ["The email has already been taken."]
  }
}
```

---

## 6. Complete Flutter Dart API Service Boilerplate

This copy-pasteable Dart code provides absolute compatibility with your Laragon Laravel structure. Add the `http` package to your `pubspec.yaml` dependencies before compiling.

```dart
// lib/services/api_service.dart

import 'dart:convert';
import 'dart:io';
import 'package:http/http.dart' as http;

class ApiService {
  // Set your server endpoint dynamically
  // 10.0.2.2 is mapped to Host Localhost under Android Emulator environment port
  static const String baseUrl = "http://10.0.2.2:8000/api";

  String? _token;

  // Store the Bearer token in application memory
  void setToken(String token) {
    _token = token;
  }

  void clearToken() {
    _token = null;
  }

  Map<String, String> _getHeaders({bool isMultipart = false}) {
    final headers = {
      'Accept': 'application/json',
    };
    if (!isMultipart) {
      headers['Content-Type'] = 'application/json';
    }
    if (_token != null) {
      headers['Authorization'] = 'Bearer $_token';
    }
    return headers;
  }

  // Generic Get Execution
  Future<http.Response> get(String endpoint) async {
    final url = Uri.parse('$baseUrl$endpoint');
    return await http.get(url, headers: _getHeaders());
  }

  // Generic Json Post Execution
  Future<http.Response> post(String endpoint, Map<String, dynamic> body) async {
    final url = Uri.parse('$baseUrl$endpoint');
    return await http.post(
      url,
      headers: _getHeaders(),
      body: jsonEncode(body),
    );
  }

  // Authentication: Register Method
  Future<Map<String, dynamic>> register({
    required String name,
    required String username,
    required String email,
    required String password,
    required String phone,
    int roleId = 3,
  }) async {
    final response = await post('/auth/register', {
      'name': name,
      'username': username,
      'email': email,
      'password': password,
      'confirm_password': password,
      'phone': phone,
      'role_id': roleId,
    });

    final data = jsonDecode(response.body);
    if (response.statusCode == 201 && data['token'] != null) {
      setToken(data['token']);
    }
    return data;
  }

  // Authentication: Login Method
  Future<Map<String, dynamic>> login(String email, String password) async {
    final response = await post('/auth/login', {
      'email': email,
      'password': password,
    });

    final data = jsonDecode(response.body);
    if (response.statusCode == 200 && data['token'] != null) {
      setToken(data['token']);
    }
    return data;
  }

  // Authentication: Logout Method
  Future<Map<String, dynamic>> logout() async {
    final response = await post('/auth/logout', {});
    clearToken();
    return jsonDecode(response.body);
  }

  // Customer: Store Order
  Future<Map<String, dynamic>> placeOrder({
    required String deliveryAddress,
    required List<Map<String, dynamic>> products,
    double? lat,
    double? lng,
    String paymentMethod = 'cod',
    String? notes,
    int? restaurantId,
  }) async {
    final response = await post('/user/orders', {
      'delivery_address': deliveryAddress,
      'latitude': lat,
      'longitude': lng,
      'payment_method': paymentMethod,
      'notes': notes,
      'restaurant_id': restaurantId,
      'products': products,
    });
    return jsonDecode(response.body);
  }

  // Article Publishing with Image (Multipart File Upload Demo)
  Future<http.StreamedResponse> createPost({
    required String title,
    required String content,
    File? imageFile,
  }) async {
    final url = Uri.parse('$baseUrl/editor/editor/posts');
    final request = http.MultipartRequest('POST', url);
    request.headers.addAll(_getHeaders(isMultipart: true));

    request.fields['title'] = title;
    request.fields['content'] = content;

    if (imageFile != null) {
      request.files.add(
        await http.MultipartFile.fromPath(
          'image_path',
          imageFile.path,
        ),
      );
    }

    return await request.send();
  }

  // Admin: Update Product with Photo Upload (PUT spoof setup)
  Future<http.StreamedResponse> editProduct({
    required int productId,
    required String productName,
    required double price,
    required int quantity,
    required int categoryId,
    File? imageFile,
  }) async {
    final url = Uri.parse('$baseUrl/admin/products/$productId');
    final request = http.MultipartRequest('POST', url); // Use POST
    request.headers.addAll(_getHeaders(isMultipart: true));

    // Spoof dynamic PUT request details
    request.fields['_method'] = 'PUT';
    request.fields['product_name'] = productName;
    request.fields['price'] = price.toString();
    request.fields['qty'] = quantity.toString();
    request.fields['category_id'] = categoryId.toString();

    if (imageFile != null) {
      request.files.add(
        await http.MultipartFile.fromPath(
          'product_image',
          imageFile.path,
        ),
      );
    }

    return await request.send();
  }
}
```
