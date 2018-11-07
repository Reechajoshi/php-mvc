<?php
	
	date_default_timezone_set('Asia/Colombo');
	$capitalList = $db->getCapiatlData();
	
	if(isset($_COOKIE['cVideoID']))
        {
            $cPlay = 'no';
            $cVideoID = $_COOKIE['cVideoID'];
            $cVideoNumber = $_COOKIE['cVideoNumber'];
            $cButtonTitle = $_COOKIE['cButtonTitle'];
            $cButtonTime = $_COOKIE['cButtonTime'];
        }
        else{
            $now = date('Y-m-d H:i');

            $cPlayVideo = $db->getCPlay($now);
            $cPlayNext = $db->getCPlayNext($now);

            if(empty($cPlayNext))
            {
                $cPlayNext[0]['datetime'] = date('Y-m-d 23:59');
            }


            /*get diff to seconds*/
            $dateDiff= date_diff(date_create($cPlayNext[0]['datetime']),date_create($cPlayVideo[0]['datetime']));

            $hr =  $dateDiff->format('%h');
            $mi = $dateDiff->format('%i');
            $time = $hr.':'.$mi;
            $peoSec = (strtotime("1970-01-01 $time UTC"));

            $seconds = $peoSec - 10;

            setcookie('cVideoID', $cPlayVideo[0]['id'] , time()+$seconds);
            setcookie('cVideoNumber', $cPlayVideo[0]['number'] , time()+$seconds);
            setcookie('cButtonTitle', $cPlayVideo[0]['number'] , time()+$seconds);
            setcookie('cButtonTime', date('g:i A', strtotime($cPlayVideo[0]['datetime'])) , time()+$seconds);

            $cPlay = 'yes';
            $cVideoID = $cPlayVideo[0]['id'] ;
            $cVideoNumber = $cPlayVideo[0]['number'];
            $cButtonTitle = $cPlayVideo[0]['number'];
            $cButtonTime = date('g:i A', strtotime($cPlayVideo[0]['datetime']));
        }
?>