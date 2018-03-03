<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Andzilla\Services\ReportManager;

class ReportsController extends Controller
{
	protected $reportManager;

	public function __construct()
	{
		$this->reportManager = new ReportManager;
	}


    public function index()
    {
    	$report = $this->reportManager->getCurrentMonthExpensesByCategory();
        $datasets = $report->pluck('amount')->toArray();
    	$labels = $report->pluck('category.name')->toArray();    
       
    	return view('reports.index', [ 
            'datasets' => json_encode($datasets), 
            'labels' => json_encode($labels),
        ]);
    }

    /**
     * Get total expenses by month
     * 
     * @return type
     */
    public function monthly()
    {
        $report = $this->reportManager->getMonthlyTotalExpenses();
        $datasets = $report->pluck('total')->toArray();
        $labels = $report->pluck('month')->map(function ($item, $key) {
                return date('F', mktime(0, 0, 0, $item, 10));
            })->toArray();

        return view('reports.monthly', [ 
            'datasets' => json_encode($datasets), 
            'labels' => json_encode($labels),
        ]);
    }

   /**
    *  Get total expenses by month and splitted by category
    * 
    *  @return type
    */
    public function monthlyTotalByCategory()
    {
        $report = $this->reportManager->getMonthlyTotalExpensesByCategory();
        $borderColors = ["#EF9A9A", "#CE93D8", "#9FA8DA", "#80CBC4", "#90CAF9", "#E6EE9C", "#FFCC80", "#B0BEC5"];

        // get the labels
        $currentMonth = intval(date('m'));
        $labels = [];
        for($i=1; $i <= $currentMonth; $i++)
            $labels[] = date('F', mktime(0, 0, 0, $i, 10));;
        
        // get the datasets
        $counter = 0;
        $values = $report->map(function ($item, $key) use ($borderColors, &$counter) {
            
            $tmp = [];
            foreach($item as $k => $v)
                $tmp[$k] = $v;
            ksort($tmp);

            $data= [
                'data' => array_values($tmp),
                'label' => $key,
                'fill' => false,
                'borderColor' => $borderColors[$counter],
                'backgroundColor' => $borderColors[$counter],
            ];
            $counter++;
            return $data;
        });
 
        $datasets = $values->values()->all();

        return view('reports.monthly-total-by-category', [ 
            'datasets' => json_encode($datasets), 
            'labels' => json_encode($labels),
        ]);
    }
}
