<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\AddOnCategories;
use App\Models\Addon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Product;
use App\Models\ProductCard;
use App\Models\Feature;
use App\Models\PricingPlan;
use App\Models\PricingFeature;
use App\Models\PricingFeaturePlan;



class Apis extends Controller
{
    public function Blogs()
    {
        $blogs = Blog::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(6); // 6 per page

        return response()->json($blogs);
    }


    public function BlogSlugs()
    {
        $slugs = Blog::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->pluck('slug'); // only get slugs column

        return response()->json($slugs);
    }

    public function BlogBySlug($slug)
    {
        // Find the requested blog
        $blog = Blog::where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        // Fetch latest 3 blogs (excluding the current one)
        $latest = Blog::where('status', 'published')
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get();

        return response()->json([
            'Blogs' => $blog,
            'latest' => $latest,
        ]);
    }


    public function image($id)
    {
        $blog = Blog::findOrFail($id);

        // Check if the blog has a featured image
        if (!$blog->featured_image || !Storage::disk('private')->exists($blog->featured_image)) {
            abort(404, 'Image not found');
        }

        // Stream the file to the browser
        return Storage::disk('private')->response($blog->featured_image);
    }

    public function Addons(Request $request)
    {
        $categoryId = $request->query('category');

        // Get all categories
        $categories = AddOnCategories::get(['id', 'category_name']);

        // If category filter applied
        $addons = Addon::query()
            ->when($categoryId, fn($q) => $q->where('category', $categoryId))
            ->select('id', 'category', 'name', 'icon', 'short_detail')
            ->get()
            ->map(function ($addon) {
                return [
                    'id' => $addon->id,
                    'category' => $addon->category,
                    'name' => $addon->name,
                    'icon' => $addon->icon,
                    'short_detail' => $addon->short_detail,
                ];
            });

        return response()->json([
            'categories' => $categories,
            'addons' => $addons,
        ]);
    }

    public function Products()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Fetch cards for a product
    public function ProductCards(Request $request)
    {
        $productId = $request->query('product_id');

        if (!$productId) {
            return response()->json(['error' => 'Missing product_id'], 400);
        }

        $cards = ProductCard::where('product_id', $productId)->get();
        return response()->json($cards);
    }

    // Fetch features for a card
    public function Features(Request $request)
    {
        $cardId = $request->query('card_id');

        if (!$cardId) {
            return response()->json(['error' => 'Missing card_id'], 400);
        }

        $features = Feature::where('card_id', $cardId)->get();
        return response()->json($features);
    }

    public function Pricing()
    {
        $plans = PricingPlan::all()->map(function ($plan) {
            $monthly = (float) $plan->monthly_price;
            $discount = (int) $plan->yearly_discount; // cast to integer

            $yearly = $monthly * 12;
            $yearly_price = $yearly - ($yearly * $discount / 100);

            return [
                'id' => $plan->id,
                'name' => $plan->name,
                'monthly_price' => $monthly,
                'yearly_discount' => $discount, // now integer
                'yearly_price' => round($yearly_price, 2) // keep 2 decimals
            ];
        });

        $features = PricingFeature::all();

        $matrix = [];
        foreach ($features as $feature) {
            $matrix[$feature->id] = [];

            foreach ($plans as $plan) {
                $exists = PricingFeaturePlan::where('pricing_feature_id', $feature->id)
                    ->where('pricing_plan_id', $plan['id'])
                    ->exists();

                $matrix[$feature->id][$plan['id']] = $exists;
            }
        }

        return response()->json([
            'plans' => $plans,
            'features' => $features,
            'matrix' => $matrix
        ]);
    }

}
