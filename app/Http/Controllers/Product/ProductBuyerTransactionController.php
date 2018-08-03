<?php

namespace App\Http\Controllers\Product;

use App\Buyer;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductBuyerTransactionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, User $buyer)
    {
        $rules = [
            'quentity' => 'required|integer|min:1'
        ];
        $this->validate($request, $rules);

        if($buyer->id == $product->seller_id){
            return $this->errorResponse('buyer must be different from seller', 409);
        }
        if(!$buyer->isVerified()){
            return $this->errorResponse('buyer must be verified a user.', 409);
        }
        if(!$product->seller->isVerified()){
            return $this->errorResponse('the seller must be verified a user.', 409);
        }
        if(!$product->isAvailable()){
            return $this->errorResponse('Product is not available.', 409);
        }
        if($product->quentity < $request->quentity){
            return $this->errorResponse('the Product does not have enough units for this transaction.', 409);
        }

        return DB::transaction(function () use ($request, $product, $buyer){
            $product->quentity -= $request->quentity;
            $product->save();

            $transaction = Transaction::create([
                'quentity' => $request->quentity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id
            ]);

            return $this->showOne($transaction);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
