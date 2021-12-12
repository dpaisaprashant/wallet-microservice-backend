<?php

namespace App\Http\Controllers;

use App\Events\LoadTestFundEvent;
use App\Models\LoadTestFund;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\Wallet;
use App\Wallet\Notification\Repository\NotificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LuckyWinnerController extends Controller
{
    CONST VENDOR = "LUCKY WINNER";
    CONST SERVICE_TYPE = "LUCKY WINNER";

    public function index()
    {
        $transactionEventTransactionIds = TransactionEvent::where('service_type', self::SERVICE_TYPE)
            ->where('transaction_type', LoadTestFund::class)
            ->pluck("transaction_id");

        $transactions = LoadTestFund::with('user')
            ->whereIn('id', $transactionEventTransactionIds)
            ->latest()
            ->paginate(15);

        return view('admin.luckyWinner.index')->with(compact('transactions'));
    }

    public function create(Request $request)
    {
        $users = User::latest()->get();
        if ($request->isMethod('post')) {

            $user = User::where('mobile_no', $request->mobile_no)->firstOrFail();


            $currentBalance = Wallet::whereUserId($user->id)->first()->balance * 100;
            $currentBonusBalance = Wallet::whereUserId($user->id)->first()->bonus_balance * 100;

            if (empty($request['amount'])) $request['amount'] = 0;
            if (empty($request['bonus_amount'])) $request['bonus_amount'] = 0;

            Log::info("before_balance: " . $currentBalance);
            Log::info("after_balance: " . ($currentBalance + ($request['amount'] * 100)));

            $description = $request->vendor
                ? $request->vendor . " winner deposit for: " . today()
                : "Winner deposit for: " . today();
            $data = [
                'admin_id' => auth()->user()->id,
                'user_id' => $user->id,
                'description' => $request['description'] ?? $description,
                'before_amount' => $currentBalance,
                'after_amount' => $currentBalance + ($request['amount'] * 100),
                //'after_amount' => $currentBalance + ($preTransaction->getOriginal('amount')),
                'before_bonus_balance' => $currentBonusBalance,
                'after_bonus_balance' => $currentBonusBalance + ($request['bonus_amount'] * 100)
            ];

            $vendor = $request->vendor ?? self::VENDOR;

            DB::beginTransaction();
            try {
                $transaction = LoadTestFund::create($data);
                if (! $transaction) return redirect(route('luckyWinner.index'))->with('error', 'Transaction not created successfully');

                event(new LoadTestFundEvent($transaction, $vendor, self::SERVICE_TYPE));
                DB::commit();

                if (!empty($vendor)) {
                    $notificationRepository = new NotificationRepository($request);
                    $notificationRepository->sendUserNotification($user, [
                        "title" => "Winner Deposit",
                        "message" => "Congratulations!!! You have won Rs. ${$request['amount']} from ${vendor}"
                    ]);
                }

                return redirect(route('luckyWinner.index'))->with('success', 'Transaction created successfully');
            } catch (\Exception $e) {
                Log::info($e);
                DB::rollBack();
                return redirect(route('luckyWinner.index'))->with('error', 'Transaction not created successfully');
            }

        }

        return view('admin.luckyWinner.create')->with(compact('users'));
    }
}
