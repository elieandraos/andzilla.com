<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Andzilla\Services\ReportManager;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //number_format($this->amount, 2, '.', ',')
        $this->middleware('auth');
        $this->reportManager = new ReportManager;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //remaining income
        $totalExpenses = $this->reportManager->getCurrentMonthTotalByType($debit = 0)->pluck('total')->first();
        $totalIncome = $this->reportManager->getCurrentMonthTotalByType($debit = 1)->pluck('total')->first();
        $remaining = $totalIncome - $totalExpenses;
        
        if(!$totalIncome){
            $progress = 0;
        }
        else{
            $progress = ceil( ($remaining / $totalIncome) * 100 );
        }
       
        
        // expenses transactions total number
        $count = $this->reportManager->getCurrentMonthTotalNumberOfExpensesTransactions()->pluck('count')->first();

        // max category this month
        $category = $this->reportManager->getCurrentMonthExpensesByCategory()->sort()->last();
        if(!$category){
            $highestCategoryName = 'n/a';
            $highestCategoryTotal = 0;
            $highestCategoryIcon = 'fa fa-tasks';
        }
        else{
            $highestCategoryName = $category->category->name;
            $highestCategoryTotal = $category->total;
            $highestCategoryIcon = $category->category->icon;
        }

        return view('home', [
            'remaining' =>  number_format($remaining, 2, '.', ','),
            'progress'  =>  $progress,
            'count'     =>  $count,
            'highestCategoryName' => $highestCategoryName,
            'highestCategoryTotal' => number_format($highestCategoryTotal, 2, '.', ','),
            'highestCategoryIcon' => $highestCategoryIcon,
        ]);
    }
}
