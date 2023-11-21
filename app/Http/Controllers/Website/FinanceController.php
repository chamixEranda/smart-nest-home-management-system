<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use App\Models\Income;
use App\Models\ExpenseCategory;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
class FinanceController extends Controller
{
    public function index()
    {
        return view('website.finance.index');
    }

    public function budgetingIndex()
    {
        $expensesData = Expense::where('user_id', auth()->user()->id)->get();
        $incomeData = Income::where('user_id', auth()->user()->id)->get();

        $labels = $expensesData->pluck('date');

        $expensesValues = $expensesData->pluck('amount');
        $incomeValues = $incomeData->pluck('amount');

        return view('website.finance.budgeting',compact('labels', 'expensesValues', 'incomeValues'));
    }

    public function json_expense_by_category() 
    {
        $transactions = Expense::where('user_id', auth()->user()->id)
            ->selectRaw('expense_category_id, IFNULL(SUM(amount), 0) as amount')
            ->with('category')
            ->groupBy('expense_category_id')
            ->get();
        $category = array();
        $colors   = array();
        $amounts  = array();
        $data     = array();

        foreach ($transactions as $transaction) {
            array_push($category, $transaction->category->name);
            array_push($colors, $transaction->category->color);
            array_push($amounts, (double) $transaction->amount);
        }

        echo json_encode(array('amounts' => $amounts, 'category' => $category, 'colors' => $colors));

    }

    public function json_income_by_category()
    {
        $transactions = Income::where('user_id', auth()->user()->id)
            ->selectRaw('income_category_id, IFNULL(SUM(amount), 0) as amount')
            ->with('category')
            ->groupBy('income_category_id')
            ->get();
        $category = array();
        $colors   = array();
        $amounts  = array();
        $data     = array();

        foreach ($transactions as $transaction) {
            array_push($category, $transaction->category->name);
            array_push($colors, $transaction->category->color);
            array_push($amounts, (double) $transaction->amount);
        }

        echo json_encode(array('amounts' => $amounts, 'category' => $category, 'colors' => $colors));
    }

    public function incomeCategoryIndex()
    {
        $lims_category_list = IncomeCategory::where('user_id', auth()->user()->id)->active()->paginate(10);
        
        return view('website.finance.incomes.income_category', compact('lims_category_list'));
    }

    public function incomeCategoryStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required|unique:income_categories',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }

        DB::beginTransaction();

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        IncomeCategory::create($data);

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.income_category_created_successfully')]);
    }

    public function incomeCategoryUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => Helpers::error_processor($validator)
            ]);
        }

        DB::beginTransaction();

        $data = $request->all();
        $lims_category_data = IncomeCategory::find($data['id']);
        $lims_category_data->update($data);

        DB::commit();

        return response()->json(['status' => true, 'message' => translate('messages.income_category_updated_successfully')]);
    }

    public function incomeCategoryDelete($id)
    {
        DB::beginTransaction();

        $lims_category_data = IncomeCategory::find($id);
        $lims_category_data->is_active = false;
        $lims_category_data->save();

        DB::commit();

        return back();
    }

    public function savingIndex()
    {
        $income_balance = new Collection;
        $expense_balance = new Collection;
        $all_transaction_list = new Collection;

        $income_balance = Income::join('income_categories', 'incomes.income_category_id', '=', 'income_categories.id')
                        ->where('incomes.user_id', auth()->user()->id)
                        ->selectRaw("'Income' as type, incomes.date, incomes.amount, incomes.name, income_categories.name as category")
                        ->get();

        $expense_balance = Expense::join('expense_categories', 'expenses.expense_category_id', '=', 'expense_categories.id')
                        ->where('expenses.user_id', auth()->user()->id)
                        ->selectRaw("'Expense' as type, expenses.date, expenses.amount, expenses. name, expense_categories.name as category")
                        ->get();

        $all_transaction_list = $income_balance->concat($expense_balance)->sortByDesc('date');
        $balance = 0;

        return view('website.finance.savings', compact('all_transaction_list','balance'));
    }

    public function transactionsIndex()
    {
        $expenses = Expense::with('category')->get();
        $totalExpenses = $expenses->sum('amount');

        $categoryPercentages = $expenses->groupBy('category.name')
        ->map(function ($categoryExpenses) use ($totalExpenses) {
            $categoryTotal = $categoryExpenses->sum('amount');
            return [
                'percentage' => $categoryTotal / $totalExpenses * 100,
                'expenses' => $categoryExpenses,
            ];
        });
        $lims_expense_category_list = ExpenseCategory::with('expenses')->where('user_id', auth()->user()->id)->active()->get();
        return view('website.finance.transactions',compact('lims_expense_category_list','categoryPercentages'));
    }
}
