<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;

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
	 * Lists the user's transactions.
	 * 
	 * @return type
	 */
    public function index()
    {
    	$transactions = Transaction::mine()->orderBy('due_at', 'DESC')->paginate();
    	return view('transactions.index', [ 'transactions' => $transactions ]);
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
        $transaction->update($request->all());
        
        flash('Transaction was updated successfully.')->success();
        return redirect(route('transactions'));
    }
}
