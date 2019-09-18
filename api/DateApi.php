<?php

namespace Api;

use Api\BaseApi;
use Carbon\Carbon;

class DateApi extends BaseApi
{
    public static function between()
    {
        $return = "";
        
        if(isset($_GET['from']) && isset($_GET['to'])){

            // http://justmessingaround.test/api/v1/between?from=2019-09-18%2006:57:44&to=2019-09-01%2006:57:44
            $from = Carbon::parse($_GET['from']);
            $to = Carbon::parse($_GET['to']);

            self::returnSuccess("Days: ". $from->diffInDays($to));

        } else {
            $return = 'Required fields: from, to ';
        }

        self::returnSuccess($return);
        
    }

}