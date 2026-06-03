<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // 2. restaurants
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cuisine_type')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 3. users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('profile_image')->nullable();
            $table->rememberToken();
            $table->foreignId('role_id')->constrained();
            // From add_avatar_to_users migration:
            $table->boolean('status')->default(true);
            // From add_verification_fields_to_users_table migration:
            $table->string('verification_code', 6)->nullable();
            $table->timestamp('verification_code_expires_at')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });

        // 4. password_reset_tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 5. sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // 6. categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('category_image')->nullable();
            $table->timestamps();
        });

        // 7. products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('product_description');
            $table->integer('qty');
            $table->decimal('price', 10, 2);
            $table->decimal('star', 3, 2);
            $table->integer('time_value');
            $table->string('product_image');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('restaurant_id')->nullable()->constrained();
            $table->timestamps();
        });

        // 8. orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('restaurant_id')->nullable()->constrained();
            $table->foreignId('driver_id')->nullable()->constrained('users');
            $table->date('order_date');
            $table->string('status')->default('pending');
            $table->string('delivery_address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->decimal('delivery_fee', 8, 2)->default(0.00);
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->string('payment_method')->default('cod');
            $table->string('payment_status')->default('pending');
            $table->string('notes')->nullable();
            $table->timestamps();
        });

        // 9. order_details
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('qty');
            $table->timestamps();
        });

        // 10. sliders
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('slider_image');
            $table->string('slider_description');
            $table->timestamps();
        });

        // 11. posts
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->text('image_path')->nullable();
            $table->text('image_url')->nullable();
            $table->timestamps();
        });

        // 12. cache
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        // 13. cache_locks
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });

        // 14. jobs
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        // 15. job_batches
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        // 16. failed_jobs
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        // 17. personal_access_tokens
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('sliders');
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
        Schema::dropIfExists('restaurants');
        Schema::dropIfExists('roles');
    }
};
