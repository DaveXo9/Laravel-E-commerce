<?php

namespace App\Http\Controllers\Site;

use Cart;
use App\Models\Order;

use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PayPalService;


class CheckoutController extends Controller
{
    protected $payPal;

    public function __construct(PayPalService $payPal)
    {
        $this->payPal = $payPal;
    }

    public function index()
    {
        return view('site.pages.checkout');
    }

    public function store(Request $request){

        $order = Order::create([
            'order_number'      =>  'ORD-'.strtoupper(uniqid()),
            'user_id'           => auth()->user()->id,
            'status'            =>  'pending',
            'grand_total'       =>  Cart::getSubTotal(),
            'item_count'        =>  Cart::getTotalQuantity(),
            'payment_status'    =>  0,
            'payment_method'    =>  null,
            'name'             =>   $request->input('name'),
            'address'           =>  $request->input('address'),
            'city'              =>  $request->input('city'),
            'country'           =>  $request->input('country'),
            'post_code'         =>  $request->input('post_code'),
            'phone_number'      =>  $request->input('phone_number'),
            'notes'             =>  $request->input('notes')
        ]);
    
        if ($order) {
    
            $items = Cart::getContent();
    
            foreach ($items as $item)
            {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = Product::where('name', $item->name)->first();
    
                $orderItem = new OrderItem([
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item->quantity,
                    'price'         =>  $item->getPriceSum()
                ]);
    
                $order->items()->save($orderItem);
                
            }
            $this->payPal->processPayment($order);
        }

        return redirect()->route('home')->with('message', 'Order placed successfully.');
    }

    public function complete(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        $status = $this->payPal->completePayment($paymentId, $payerId);

        $order = Order::where('order_number', $status['invoiceId'])->first();
        $order->status = 'processing';
        $order->payment_status = 1;
        $order->payment_method = 'PayPal -'.$status['salesId'];
        $order->save();

        Cart::clear();
        return view('site.pages.success', compact('order'));
    }
}
