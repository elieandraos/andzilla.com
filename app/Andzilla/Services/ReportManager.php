<?php 

namespace App\Andzilla\Services;

use App\Models\Transaction;

class ReportManager
{

	/**
	 * Get the current month expenses by category
	 * 
	 * @return type
	 */
	public function getCurrentMonthExpensesByCategory()
	{
		return Transaction::with('category')
				->selectRaw('*, sum(amount) as total')
				->whereMonth('due_at', '=', date('m'))
				->where('debit', '=', 0)
				->groupBy('category_id')
				->get();
	}

	/**
	 * Get the total expenses by month
	 * 
	 * @return type
	 */
	public function getMonthlyTotalExpenses()
	{
		return Transaction::selectRaw('MONTH(due_at) as month, sum(amount) as total')
				->where('debit', '=', 0)
				->whereYear('due_at', '=', date('Y'))
				->groupBy('month')
				->get();
	}

	/**
	 * Get the total expenses by month and splitted by category
	 * 
	 * @return type
	 */
	public function getMonthlyTotalExpensesByCategory()
	{
		$monthsNumbers = [];
        $currentMonth = intval(date('m'));
        for($i=1; $i <= $currentMonth; $i++)
            $monthsNumbers[] = $i;

		$collection = Transaction::with('category')
				->selectRaw('*, MONTH(due_at) as month')
				->whereYear('due_at', '=', date('Y'))
				->where('debit', '=', 0)
				->get()
				->groupBy('category.name')
				->map(function($item){
					return $item->groupBy('month')
								->map(function($row){
									return $row->sum('amount');
								});
				});

        $collection->map(function($item) use ($monthsNumbers){
            foreach($monthsNumbers as $index)
                if(!in_array($index, $item->keys()->toArray()))
                    $item->put($index, 0);
            return $item;
        });

        return $collection;
	}
}

?>