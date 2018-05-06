<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;

class TransactionsController extends Controller
{
	protected $user;

	/**
	 * Adding the auth user in the constructor
	 * https://laravel-news.com/controller-construct-session-changes-in-laravel-5-3
	 * 
	 * @return type
	 */
	public function __construct()
	{
		$this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
	}

	/**
	 * Index of the user transactions page.
	 * 
	 * @return type
	 */
    public function index()
    {
    	return view('transactions.index');
    }

    /**
     * Fetch the user transatcions.
     * 
     * @param Request $request 
     * @return type
     */
    public function fetch(Request $request)
    {
        \DB::enableQueryLog();
        $transactions = Transaction::mine();

        //chain the filters if applicable
        if($request->has('categories'))
            $transactions = $transactions->byCategories($request->get('categories'));

        if($request->has('date'))
            $transactions = $transactions->byDaterange($request->get('date'));

        $transactions = $transactions->orderBy('due_at', 'DESC')->paginate(15);
        //dd(\DB::getQueryLog());
        return TransactionResource::collection($transactions);
    }

    /**
     * Display the create form.
     *  
     * @return type
     */
    public function create()
    {
    	$user_categories = $this->user->categories()->orderBy('name', 'ASC')->get();
    	$categories = $user_categories->pluck('name', 'id')->toArray();
    	//Create an array of option attribute
    	$icons_attributes = [];
		foreach($user_categories as $item)
			$icons_attributes[$item->id] = ['data-icon' => $item->icon ];
	
        return view('transactions.create', ['categories' => $categories, 'icons_attributes' => $icons_attributes ]);
    }

    /**
     * Store transacation in database.
     * 
     * @param TransactionRequest $request 
     * @return type
     */
    public function store(TransactionRequest $request)
    {
       $transaction = new Transaction($request->all());
       $transaction->user_id = Auth::user()->id;
       $transaction->save();

        flash('Transaction was created successfully.')->success();
        return redirect(route('transactions'));
    }

    /**
     * Display the edit form.
     * 
     * @param Request $request 
     * @param type $transactionId 
     * @return type
     */
    public function edit(Request $request, $transactionId)
    {
        $user_categories = $this->user->categories()->orderBy('name', 'ASC')->get();
        $categories = $user_categories->pluck('name', 'id')->toArray();
        //Create an array of option attribute
        $icons_attributes = [];
        foreach($user_categories as $item)
            $icons_attributes[$item->id] = ['data-icon' => $item->icon ];
        
        $transaction = Transaction::findOrFail($transactionId);
        return view('transactions.edit', ['categories' => $categories, 'icons_attributes' => $icons_attributes, 'transaction' => $transaction ]);
    }

    /**
     * Update the transaction in the database.
     * 
     * @param TransactionRequest $request 
     * @param type $transactionId 
     * @return type
     */
    public function update(TransactionRequest $request, $transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        $input = $request->all();

        if(!$request->get('debit'))
            $input['debit'] = 0;
        $transaction->update($input);
        
        flash('Transaction was updated successfully.')->success();
        return redirect(route('transactions'));
    }

    public function categories()
    {
         // get the user categories
        $user_categories = $this->user->categories()->orderBy('name', 'ASC')->get();
        $categories = $user_categories->pluck('name', 'id');

        return response()->json(['categories' => $categories]);
        //Create an array of option attribute
        // $icons_attributes = [];
        // foreach($user_categories as $item)
        //     $icons_attributes[$item->id] = ['data-icon' => $item->icon ];

    }
}
