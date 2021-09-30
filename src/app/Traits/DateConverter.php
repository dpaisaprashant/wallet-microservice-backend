<?php

namespace App\Traits;
use Fivedots\NepaliCalendar\Calendar;
use Fivedots\NepaliCalendar\NepaliDataProvider;

trait DateConverter
{

    public function ConvertNepaliDateFromRequest($requestData,$year,$month,$date){
        $date = $requestData[$year].'-'.$requestData[$month].'-'.$requestData[$date];    //converts date to yyyy-mm-dd format
        $dateAD = $this->NepaliToEnglish($date);
        return $dateAD['year'].'-'.$dateAD['month'].'-'.$dateAD['date'];  // returns date in yyyy-mm-dd format
    }

    public function EnglishToNepali($date){
       $SplitDate = $this->SplitDate($date);
       $year = $SplitDate[0];
       $month = $SplitDate[1];
       $day = $SplitDate[2];
       $calendar = new Calendar(new NepaliDataProvider());
       $nepaliDate = $calendar->englishToNepali($year, $month,$day);
       return $nepaliDate;
    }

    public function NepaliToEnglish($date){
        $SplitDate = $this->SplitDate($date);
        $year = $SplitDate[0];
        $month = $SplitDate[1];
        $day = $SplitDate[2];
        $calendar = new Calendar(new NepaliDataProvider());
        $nepaliDate = $calendar->nepaliToEnglish($year, $month,$day);
        return $nepaliDate;
    }

    public function SplitDate($date){
        return preg_split("/[\s-]+/",$date,0);
    }


}
