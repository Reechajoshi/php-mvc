<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->library('session');
        date_default_timezone_set('Asia/Colombo');
    }

    public function index()
    {
        /*
         * Capital Bazzar 
        */
        $data['capitalList'] = $this->home_model->getCapiatlData();

        if(isset($_COOKIE['cVideoID']))
        {
            $data['cPlay']= 'no';
            $data['cVideoID'] = $_COOKIE['cVideoID'];
            $data['cVideoNumber'] = $_COOKIE['cVideoNumber'];
            $data['cButtonTitle']= $_COOKIE['cButtonTitle'];
            $data['cButtonTime']= $_COOKIE['cButtonTime'];
        }
        else{
            $now = date('Y-m-d H:i');

            $data['cPlayVideo'] = $this->home_model->getCPlay($now);
            $data['cPlayNext'] = $this->home_model->getCPlayNext($now);

            if(empty($data['cPlayNext']))
            {
                $data['cPlayNext'][0]['datetime'] = date('Y-m-d 23:59');
            }


            /*get diff to seconds*/
            $dateDiff= date_diff(date_create($data['cPlayNext'][0]['datetime']),date_create($data['cPlayVideo'][0]['datetime']));

            $hr =  $dateDiff->format('%h');
            $mi = $dateDiff->format('%i');
            $time = $hr.':'.$mi;
            $peoSec = (strtotime("1970-01-01 $time UTC"));

            $seconds = $peoSec - 10;

            setcookie('cVideoID', $data['cPlayVideo'][0]['id'] , time()+$seconds);
            setcookie('cVideoNumber', $data['cPlayVideo'][0]['number'] , time()+$seconds);
            setcookie('cButtonTitle', $data['cPlayVideo'][0]['number'] , time()+$seconds);
            setcookie('cButtonTime', date('g:i A', strtotime($data['cPlayVideo'][0]['datetime'])) , time()+$seconds);

            $data['cPlay']= 'yes';
            $data['cVideoID']= $data['cPlayVideo'][0]['id'] ;
            $data['cVideoNumber']= $data['cPlayVideo'][0]['number'];
            $data['cButtonTitle']= $data['cPlayVideo'][0]['number'];
            $data['cButtonTime']= date('g:i A', strtotime($data['cPlayVideo'][0]['datetime']));
        }

        /*
         * Royal DC
        */

        $data['royalList'] = $this->home_model->getRoyalData();

        if(isset($_COOKIE['rVideoID']))
        {
            $data['rPlay']= 'no';
            $data['rVideoID'] = $_COOKIE['rVideoID'];
            $data['rVideoNumber'] = $_COOKIE['rVideoNumber'];
            $data['rButtonTitle']= $_COOKIE['rButtonTitle'];
            $data['rButtonTime']= $_COOKIE['rButtonTime'];
        }
        else{
            $now = date('Y-m-d H:i');

            $data['rPlayVideo'] = $this->home_model->getRPlay($now);
            $data['rPlayNext'] = $this->home_model->getRPlayNext($now);

            if(empty($data['rPlayNext']))
            {
                $data['rPlayNext'][0]['datetime'] = date('Y-m-d 23:59');
            }

            /*get diff to seconds*/
            $dateDiff= date_diff(date_create($data['rPlayNext'][0]['datetime']),date_create($data['rPlayVideo'][0]['datetime']));
            $hr =  $dateDiff->format('%h');
            $mi = $dateDiff->format('%i');
            $time = $hr.':'.$mi;
            $peoSecRoyal = (strtotime("1970-01-01 $time UTC"));

            $secondsRoyal = $peoSecRoyal - 10;

            setcookie('rVideoID', $data['rPlayVideo'][0]['id'] , time()+$secondsRoyal);
            setcookie('rVideoNumber', $data['rPlayVideo'][0]['number'] , time()+$secondsRoyal);
            setcookie('rButtonTitle', $data['rPlayVideo'][0]['number'] , time()+$secondsRoyal);
            setcookie('rButtonTime', date('g:i A', strtotime($data['rPlayVideo'][0]['datetime'])) , time()+$secondsRoyal);

            $data['rPlay']= 'yes';
            $data['rVideoID']= $data['rPlayVideo'][0]['id'] ;
            $data['rVideoNumber']= $data['rPlayVideo'][0]['number'];
            $data['rButtonTitle']= $data['rPlayVideo'][0]['number'];
            $data['rButtonTime']= date('g:i A', strtotime($data['rPlayVideo'][0]['datetime']));
        }

        $this->load->view('include/header');
        $this->load->view('pages/home',$data);

    }

    public function delete()
    {
        setcookie('cVideoID', 'x' , time()-10000);
        setcookie('cVideoNumber', 'x', time()-10000);
        setcookie('cButtonTitle', 'x' , time()-10000);
        setcookie('cButtonTime', 'x' , time()-10000);
        setcookie('rVideoID', 'x' , time()-10000);
        setcookie('rVideoNumber', 'x', time()-10000);
        setcookie('rButtonTitle', 'x' , time()-10000);
        setcookie('rButtonTime', 'x' , time()-10000);
        redirect('admin/capital');

    }

    public function is_cPlayed()
    {
        $id = $this->input->post('id');

        $data = array(
            'is_cPlayed' => 1
        );

        $this->db->where('id', $id);
        $this->db->update('video', $data);
    }

    public function getAjaxCapital()
    {
        $date = $this->input->post('date');


        $result = $this->home_model->getAjaxCapital($date);
        if(empty($result))
        {
            $response = FALSE;
            echo json_encode($response);
        }
        else{
            echo json_encode($result);
        }
    }

    public function getAjaxRoyal()
    {
        $date = $this->input->post('date');


        $result = $this->home_model->getAjaxRoyal($date);
        if(empty($result))
        {
            $response = FALSE;
            echo json_encode($response);
        }
        else{
            echo json_encode($result);
        }
    }
    
    public function test()
    {
    	$result = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
	echo json_encode($result);
    }
}