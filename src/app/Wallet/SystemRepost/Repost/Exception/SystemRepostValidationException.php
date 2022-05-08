<?php

namespace App\Wallet\SystemRepost\Repost\Exception;

use App\Models\SystemRepost;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class SystemRepostValidationException extends Exception
{
    private SystemRepost $systemRepost;

    public function __construct($systemRepost)
    {
        $this->systemRepost = $systemRepost;
    }

    public function report()
    {
        Log::info("Error Message: ", [$this->getMessage()]);
        Log::info("File: " . $this->getFile());
        Log::info("Line: " . $this->getLine());
        Log::info("SystemRepost: " . $this->systemRepost);
    }

    public function render()
    {
        return redirect()->back()->with("error", $this->systemRepost->error_description ?? "Something went wrong");
    }
}
