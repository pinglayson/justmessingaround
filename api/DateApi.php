<?php

namespace Api;

use Api\BaseApi;
use Carbon\Carbon;

class DateApi extends BaseApi
{
    public static function between()
    {
        $return = '';

        if (isset($_GET['from']) && isset($_GET['to']) && isset($_GET['format'])) {

            // http://justmessingaround.test/api/v1/between?from=2019-09-18%2006:57:44&to=2019-09-01%2006:57:44
            // format - days|weekdays|weeks|seconds|minutes|hours|years
            $from = Carbon::parse($_GET['from']);
            $to = Carbon::parse($_GET['to']);

            if (isset($_GET['format'])) {
                switch ($_GET['format']) {
                    case 'days':
                        $return = $from->diffInDays($to);
                        break;
                    case 'weekdays':
                        $return = $from->diffInWeekdays($to);
                        break;
                    case 'weeks':
                        $return = $from->diffInWeeks($to);
                        break;
                    case 'seconds':
                        $return = $from->diffInSeconds($to);
                        break;
                    case 'minutes':
                        $return = $from->diffInMinutes($to);
                        break;
                    case 'hours':
                        $return = $from->diffInHours($to);
                        break;
                    case 'years':
                        $return = $from->diffInYears($to);
                        break;
                    default:
                        self::returnFailed("Allowable format values: days|weekdays|weeks|seconds|minutes|hours|years");
                }
            }
            self::returnSuccess($return);
        } else {
            self::returnFailed('Required fields: from, to, format ');
        }
    }
}
