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

            // http://justmessingaround.test/api/v1/between?from=2019-09-18%2006:57:44&to=2019-09-01%2006:57:44&format=days&to_tz=America/Sitka

            $from = self::validateDate($_GET['from']);
            if (isset($_GET['from_tz'])) {
                $from = self::prepareDateTimezone($_GET['from'], $_GET['from_tz']);
            }

            $to = self::validateDate($_GET['to']);
            if (isset($_GET['to_tz'])) {
                $to = self::prepareDateTimezone($_GET['to'], $_GET['to_tz']);
            }

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
                        self::returnFailed('Allowable format values: days|weekdays|weeks|seconds|minutes|hours|years.');
                }
            }
            self::returnSuccess($return);
        } else {
            self::returnFailed('Required fields: from, to, format.');
        }
    }

    private static function prepareDateTimezone($date, $timezone)
    {
        if (in_array($timezone, timezone_identifiers_list())) {
            return Carbon::parse($date, $timezone);
        } else {
            self::returnFailed('Invalid timezone, check https://www.php.net/manual/en/timezones.php for valid timezones.');
        }
    }

    private static function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);
        if($d && $d->format($format) == $date){
            return Carbon::parse($date);
        } else {
            self::returnFailed('Invalid date or format. e.g \'2019-09-18 06:57:44\'');
        }
    }
}
