<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;

class event_tbl extends Model
{
    protected $table = "event";

    public function insertEvent($params){
        try{
            $insert_event = new event_tbl();
            $insert_event->user_name = strtoupper($params['user_name']);
            $insert_event->event_name = $params['event_name'];
            $insert_event->date_from = $params['from'];
            $insert_event->date_to = $params['to'];
            $insert_event->day = json_encode($params['days']);
            $insert_event->save();

            return $insert_event->id;
        }catch(e $e){
            return $e;
        }
    }

    //select event
    public function selectEvent($params){
        try{

            $event = event_tbl::select()
                                ->where('id', $params['event_id'])
                                ->first();
            
            if(empty($event)){
                //date range
                $from = Carbon::parse(Carbon::now()->format('Y-m-d'));
                $to = Carbon::parse(Carbon::now()->format('Y-m-d'));
                $selected_days = [];
            }else{
                //date range
                $from = Carbon::parse($event['date_from']);
                $to = Carbon::parse($event['date_to']);
                $selected_days = json_decode($event['day']);
            }

            //get between dates
            $dates = array();
            $current = strtotime($from);
            $last = strtotime($to);

            while( $current <= $last ) { 
                $dates[] = date('Y-m-d', $current);
                $current = strtotime('+1 day', $current);
            }

            //assign event data
            $event_data = [];
            $current_month = $from->englishMonth;
            $current_year = $from->year;

            array_push($event_data, [
                'date' => $from->englishMonth." ".$from->year,
                'event' => '',
                'status' => 'month'
            ]);

            foreach($dates as $date){
                $date = Carbon::parse($date);

                $status = '';
                $event_name = '';
                $checkEvent = in_array($date->englishDayOfWeek, $selected_days); //check if the date have an event

                if($date->englishMonth == $current_month && $date->year == $current_year){
                             
                    if($checkEvent){
                        $status = 'event';
                        $event_name = $event['event_name'];
                    }

                    array_push($event_data, [
                        'date' => $date->day.". ".$date->englishDayOfWeek,
                        'event' => $event_name,
                        'status' => $status
                    ]);
                }else{
                    //set new month
                    array_push($event_data, [
                        'date' => $date->englishMonth." ".$date->year,
                        'event' => '',
                        'status' => 'month'
                    ]);

                    //check if the date have an event
                    if($checkEvent){
                        $status = 'event';
                        $event_name = $event['event_name'];
                    }

                    array_push($event_data, [
                        'date' => $date->day.". ".$date->englishDayOfWeek,
                        'event' => $event_name,
                        'status' => $status
                    ]);

                    $current_month = $date->englishMonth;
                    $current_year = $date->year;
                }
            }

            return $event_data;
        }catch(e $e){
            return $e;
        }
    }
}
