<?php



use App\Http\Controllers\Api\Apis;

use Illuminate\Support\Facades\Route;



Route::get('/blogs', [Apis::class, 'Blogs']);
Route::get('/blogs/{slug}', [Apis::class, 'BlogBySlug']); // blog by slug
Route::get('/blogs/slugs', [Apis::class, 'BlogSlugs']);


Route::get('/blogs/{id}/image', [Apis::class, 'image']);



Route::get('/addons', [Apis::class, 'Addons']);

Route::get('/products', [Apis::class, 'Products']);
Route::get('/product_cards', [Apis::class, 'ProductCards']); // expects product_id query param
Route::get('/features', [Apis::class, 'Features']); // expects card_id query param

Route::get('/pricing', [Apis::class, 'Pricing']);
