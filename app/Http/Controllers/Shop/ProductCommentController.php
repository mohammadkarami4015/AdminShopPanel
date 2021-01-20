<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\Shop\CommentReplyRequest;
use App\Product;
use App\ProductComment;
use App\Shop;

class ProductCommentController
{
    public function index(Shop $shop, Product $product)
    {
        $productComments = $product->productComments()
            ->where('shop_id', $shop->id)
            ->where('replay_flag', '0')
            ->with('child')
            ->latest()->paginate(20);

        return view('shops.productComment.index', compact('productComments', 'product', 'shop'));
    }

    public function create(Shop $shop, Product $product, ProductComment $productComment)
    {
        if ($productComment->replay_flag == 0 && !$productComment->child)
            return view('shops.productComment.create', compact('productComment', 'product', 'shop'));
        else
            return back()->withErrors('امکانپذیر نیست');
    }

    public function reply(CommentReplyRequest $request, Shop $shop, Product $product, ProductComment $productComment)
    {
        if ($productComment->replay_flag == 0 && !$productComment->child) {
            ProductComment::createNew($productComment, $request->get('message'));
        } else {
            return back()->withErrors('امکانپذیر نیست');
        }

        return redirect(route(' productComment.index', [$shop,$product]));
    }

    public function destroy(Shop $shop, Product $product, ProductComment $productComment)
    {
        if ($productComment->replay_flag != 0) {
            $productComment->delete();
            return back();
        } else {
            flash('error');
            return back();
        }
    }

    public function verify($shop, $product, $id, $value)
    {
        $comment = ProductComment::query()->find($id);

        $comment->update(['admin_verification' => $value]);
    }
}
