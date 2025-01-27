<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;
use App\Http\Controllers\{
    DashboardController,
    UserController,
    PostController,
    ProfileController,
    CommentController,
    ReactionController,
    HobbyController,
    UserHobbyController,
    LocationController,
    FriendController
};

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index'); // Lấy danh sách người dùng
        Route::get('/{id}', [UserController::class, 'show'])->name('show'); // Hiển thị chi tiết người dùng
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit'); // Hiển thị form chỉnh sửa
        Route::post('/{id}', [UserController::class, 'update'])->name('update'); // Cập nhật người dùng
        // User Hobbies
        Route::get('/edit/my-hobbies={id}', [UserHobbyController::class, 'edit'])->name('hobbies.edit');
        Route::patch('/edit/my-hobbies={userId}/add-my-hobbies/{hobbyId}', [UserHobbyController::class, 'addHobbyToUser'])->name('addHobbies');
        Route::patch('/edit/my-hobbies/add-new-hobbies', [UserHobbyController::class, 'addNewHobbyToUser'])->name('newHobbies');
        Route::delete('/my-hobbies={userId}/delete/{hobbyId}', [UserHobbyController::class, 'removeHobbyFromUser'])->name('removeMyHobby');
        // Profile Routes
        Route::get('/edit/profile={id}', [ProfileController::class, 'edit'])->name('profiles.edit');
        Route::patch('/update/profile', [ProfileController::class, 'update'])->name('profiles.update');
    });
    
    // Post Routes
    Route::resource('posts', PostController::class);
    Route::get('/edit/posts={id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    // Comment Routes
    Route::prefix('comments')->group(function () {
        Route::post('/', [CommentController::class, 'store'])->name('comments.store');
        Route::put('{comment}', [CommentController::class, 'update'])->name('comments.update');
        Route::delete('{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
        Route::get('post/{post}', [CommentController::class, 'show'])->name('comments.show');
    });

    // Reaction Routes
    Route::post('/reactions', [ReactionController::class, 'store'])->name('reactions.store');
    Route::delete('/reactions/{id}', [ReactionController::class, 'destroy'])->name('reactions.destroy');

    // Locations
    Route::apiResource('locations', LocationController::class);

    // Friends
    Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
    Route::patch('/friends', [FriendController::class, 'store'])->name('friends.addfriend'); // Add friend
    Route::patch('/friends={id}', [FriendController::class, 'update'])->name('friends.update'); // Accept/Decline
    Route::delete('/friends={id}', [FriendController::class, 'destroy'])->name('friends.unfriend');
});

require __DIR__ . '/auth.php';
