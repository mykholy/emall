<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use App\Models\GiftProduct;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class GiftController extends Controller
{

    public function index()
    {
        $gifts = Gift::orderBy('expired_at', 'ASC')->paginate(10);
        return view('admin.gifts.gifts')->with([
            'gifts' => $gifts
        ]);
    }

    public function create()
    {

        $products = Product::get(['id', 'name']);

        return view('admin.gifts.create-gift', compact('products'));
    }


    public function store(Request $request)
    {


        $this->validate($request,
            [
                'name' => 'required|string',
                'description' => 'required',
                'started_at' => 'required|date',
                'expired_at' => 'required|date|after:started_at',
                'product_ids' => 'required|array|min:1',
                'image' => 'required'
            ],
            [
                'name.required' => 'Please provide gift name',
                'description.required' => 'Please provide gift description',
                'expired_at.after' => 'The expired at must be a date after started_at',
                'product_ids.required' => 'Please select products',
                'image.required' => 'Please provide a image'


            ]
        );

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gifts', 'public');
            $gift = new Gift();
            $gift->name = $request->get('name');
            $gift->description = $request->get('description');
            $gift->started_at = $request->get('started_at');
            $gift->expired_at = $request->get('expired_at');
            $gift->image_url = $path;


            if ($gift->save()) {
                $this->giftProductsInsertMany($request->product_ids, $gift);
                return redirect(route('admin.gifts.index'))->with('message', 'Gift added');
            } else {
                return redirect(route('admin.gifts.index'))->with('error', 'Gift was not added');
            }
        }
        return redirect()->route('admin.gifts.index')->with('error', 'Something wrong');

    }

    public function show($id)
    {
        $gift = Gift::with('user', 'products', 'products.product.productImages')->find($id);

        return view('admin.gifts.show-gift')->with([
            'gift' => $gift
        ]);
    }

    public function random_draw($id)
    {
        $gift = Gift::with('user', 'products', 'products.product.productImages')->find($id);
        if ($gift->user_id) {
            return redirect()->back()->with('message', 'Gift has been Random draw successfully');

        }
        $gift_products_ids = $gift->products->pluck('product_id')->toArray();
        $orders = Order::where('status', '>=', Order::$ORDER_DELIVERED)
            ->with('carts')->whereHas('carts', function ($q) use ($gift_products_ids) {
                $q->whereIn('product_id', $gift_products_ids);
            })->get();

        $user_ids = collect($orders)->pluck('user_id')->values()->unique()->toArray();//to get unique user_ids
        $winner_user_id = null;
        if ($user_ids)
            $winner_user_id = Arr::random($user_ids);//get only one user id random

        $gift->user_id = $winner_user_id;

        if ($gift->save() && $winner_user_id) {
            return redirect()->back()->with('message', 'Gift Random draw successfully');
        } else {
            return redirect()->back()->with('error', 'Gift Random draw can not find winner user');
        }

    }


    public function edit($id)
    {
        $gift = Gift::with('products')->find($id);

        $products = Product::get(['id', 'name']);


        return view('admin.gifts.edit-gift')->with([
            'gift' => $gift,
            'products' => $products,
        ]);

    }


    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required|string',
                'description' => 'required',
                'started_at' => 'required|date',
                'expired_at' => 'required|date|after:started_at',
                'product_ids' => 'required|array|min:1',

            ],
            [
                'description.required' => 'Please provide coupon description',
                'expired_at.after' => 'The expired at must be a date after today',
                'product_ids.required' => 'Please select products',

            ]
        );

        $gift = Gift::find($id);
        $gift->name = $request->get('name');
        $gift->description = $request->get('description');
        $gift->started_at = $request->get('started_at');
        $gift->expired_at = $request->get('expired_at');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gifts', 'public');
            $gift->image_url = $path;
        }

        if (isset($request->is_active)) {
            $gift->is_active = true;
        } else {
            $gift->is_active = false;
        }
        if ($gift->save()) {
            $gift->products()->delete();//to delete old product
            $this->giftProductsInsertMany($request->product_ids, $gift);

            return redirect(route('admin.gifts.index'))->with('message', 'Gift updated');
        } else {
            return redirect(route('admin.gifts.index'))->with('error', 'Gift was not updated');
        }
    }


    public function destroy($id)
    {

    }

    public function giftProductsInsertMany($product_ids, $gift)
    {
        foreach ($product_ids as $product_id) {
            $data['product_id'] = $product_id;
            $data['gift_id'] = $gift->id;
            $productsModels[] = $data;
        }
        GiftProduct::insert($productsModels);
        return true;

    }
}
