<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct()
    {
        ob_start();
        parent::__construct();
        $this->load->model('admin_model');

    }

    public function index()
    {

        $logged = $this->session->userdata('logged_in');
        if($logged == TRUE)
        {
            redirect('admin/capital');
//            $this->load->view('include/header_admin');
//            $this->load->view('admin/CB/capital');
        }
        else{
            $this->session->set_flashdata('error', 'Session Expired');
            redirect('admin/user_login');
        }
    }

    public function login()
    {

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Username', 'required');
        $this->form_validation->set_rules('pass', 'Password', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('admin/login');
        }
        else
        {
            $name = $this->input->post('name');
            $pass = $this->input->post('pass');

            $result = $this->admin_model->check_login($name,$pass);
            if($result == TRUE)
            {
                $this->session->set_flashdata('success', 'Welcome Admin');
                redirect('admin');
            }
            else{
                $this->session->set_flashdata('error', 'Invalid Login');
                redirect('admin/user_login');
            }

        }
    }
    public function user_login()
    {
        $this->load->view('admin/login');
    }
    public function user_logout(  )
    {

        $this->load->driver('cache');
        $this->session->sess_destroy();
        $this->cache->clean();
        redirect('admin');
        ob_clean();
    }

    /*
     * Capital Brazzer
     */

    public function capital()
    {
        $logged = $this->session->userdata('logged_in');
        if($logged == TRUE)
        {
            $category = 0;
            $data['capitalLists'] = $this->admin_model->getList($category);
            $this->load->view('include/header_admin');
            $this->load->view('admin/CB/capital',$data);
        }
        else{
            $this->session->set_flashdata('error', 'Session Expired');
            redirect('admin/user_login');
        }

    }
    public function add_capital()
    {
        $logged = $this->session->userdata('logged_in');
        if($logged == TRUE)
        {
            $this->load->view('include/header_admin');
            $this->load->view('admin/CB/add_capital');
        }
        else{
            $this->session->set_flashdata('error', 'Session Expired');
            redirect('admin/user_login');
        }

    }
    public function addd_capital()
    {
        $this->form_validation->set_error_delimiters('<p class="help-block" style="color: red">', '</p>');
        $this->form_validation->set_rules('number', 'Number', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('include/header_admin');
            $this->load->view('admin/CB/add_capital');
        }
        else
        {
            $number = $this->input->post('number');
            $date = $this->input->post('date');
            $time = $this->input->post('time');
            $newDate = $date.' '.$time;
            $active = $this->input->post('active');
            $remarks = $this->input->post('remarks');
            $type = 0;

            $data = array(
                'number' => $number,
                'datetime' => $newDate,
                'active' => empty($active) ? '0' : $active,
                'remarks' => $remarks,
                'type' => $type
            );

            $result =   $this->admin_model->add_video($data);

            if($result == TRUE)
            {
                $this->session->set_flashdata('success', 'Record Save Successfully.');
                redirect('admin/add_capital');
            }
            else{
                $this->session->set_flashdata('error', 'Oops! Something Went Wrong');
                redirect('admin/add_capital');
            }

        }
    }
    public function edit_capital($id)
    {
        if(empty($id) || !is_numeric($id))
        {
            $this->session->set_flashdata('error', 'Token Mismatched');
            redirect('admin/capital');
        }
        else
        {
            $data['capitalLists'] = $this->admin_model->getItem($id);
            $this->load->view('include/header_admin');
            $this->load->view('admin/CB/edit_capital',$data);
        }
    }
    public function update_capital()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_error_delimiters('<p class="help-block" style="color: red">', '</p>');
        $this->form_validation->set_rules('number', 'Number', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $data['capitalLists'] = $this->admin_model->getItem($id);
            $this->load->view('include/header_admin');
            $this->load->view('admin/CB/edit_capital',$data);
        }
        else
        {
            $number = $this->input->post('number');
            $date = $this->input->post('date');
            $time = $this->input->post('time');
            $newDate = $date.' '.$time;
            $active = $this->input->post('active');
            $remarks = $this->input->post('remarks');
            $type = 0;

            $data = array(
                'number' => $number,
                'datetime' => $newDate,
                'active' => empty($active) ? '0' : $active,
                'remarks' => $remarks,
                'type' => $type
            );

            $result =   $this->admin_model->update_video($data,$id);

            if($result == TRUE)
            {
                $this->session->set_flashdata('success', 'Record Updated Successfully.');
                redirect('admin/capital');
            }
            else{
                $this->session->set_flashdata('error', 'Oops! Something Went Wrong');
                redirect('admin/edit_capital');
            }

        }
    }


    public function disableCap($id)
    {
        if(empty($id) || !is_numeric($id))
        {
            $this->session->set_flashdata('error', 'Token Mismatched');
            redirect('admin/capital');
        }
        else
        {
            $this->admin_model->disable($id);
            redirect('admin/capital');
        }
    }
    public function activeCap($id)
    {
        if(empty($id) || !is_numeric($id))
        {
            $this->session->set_flashdata('error', 'Token Mismatched');
            redirect('admin/capital');
        }
        else
        {
            $this->admin_model->active($id);
            redirect('admin/capital');
        }
    }

    /*
     * Royal DC
     */

    public function royal()
    {
        $logged = $this->session->userdata('logged_in');
        if($logged == TRUE)
        {
            $category = 1;
            $data['royalLists'] = $this->admin_model->getList($category);
            $this->load->view('include/header_admin');
            $this->load->view('admin/RDC/royal',$data);
        }
        else{
            $this->session->set_flashdata('error', 'Session Expired');
            redirect('admin/user_login');
        }
    }
    public function add_royal()
    {
        $logged = $this->session->userdata('logged_in');
        if($logged == TRUE)
        {
            $this->load->view('include/header_admin');
            $this->load->view('admin/RDC/add_royal');
        }
        else{
            $this->session->set_flashdata('error', 'Session Expired');
            redirect('admin/user_login');
        }

    }
    public function addd_royal()
    {
        $this->form_validation->set_error_delimiters('<p class="help-block" style="color: red">', '</p>');
        $this->form_validation->set_rules('number', 'Number', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('include/header_admin');
            $this->load->view('admin/RDC/add_royal');
        }
        else
        {
            $number = $this->input->post('number');
            $date = $this->input->post('date');
            $time = $this->input->post('time');
            $newDate = $date.' '.$time;
            $active = $this->input->post('active');
            $remarks = $this->input->post('remarks');
            $type = 1;

            $data = array(
                'number' => $number,
                'datetime' => $newDate,
                'active' => empty($active) ? '0' : $active,
                'remarks' => $remarks,
                'type' => $type
            );

            $result =   $this->admin_model->add_video($data);

            if($result == TRUE)
            {
                $this->session->set_flashdata('success', 'Record Save Successfully.');
                redirect('admin/add_royal');
            }
            else{
                $this->session->set_flashdata('error', 'Oops! Something Went Wrong');
                redirect('admin/add_royal');
            }

        }
    }
    public function edit_royal($id)
    {
        if(empty($id) || !is_numeric($id))
        {
            $this->session->set_flashdata('error', 'Token Mismatched');
            redirect('admin/royal');
        }
        else
        {
            $data['capitalLists'] = $this->admin_model->getItem($id);
            $this->load->view('include/header_admin');
            $this->load->view('admin/RDC/edit_royal',$data);
        }
    }
    public function update_royal()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_error_delimiters('<p class="help-block" style="color: red">', '</p>');
        $this->form_validation->set_rules('number', 'Number', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $data['capitalLists'] = $this->admin_model->getItem($id);
            $this->load->view('include/header_admin');
            $this->load->view('admin/RDC/edit_royal',$data);
        }
        else
        {
            $number = $this->input->post('number');
            $date = $this->input->post('date');
            $time = $this->input->post('time');
            $newDate = $date.' '.$time;
            $active = $this->input->post('active');
            $remarks = $this->input->post('remarks');
            $type = 1;

            $data = array(
                'number' => $number,
                'datetime' => $newDate,
                'active' => empty($active) ? '0' : $active,
                'remarks' => $remarks,
                'type' => $type
            );

            $result =   $this->admin_model->update_video($data,$id);

            if($result == TRUE)
            {
                $this->session->set_flashdata('success', 'Record Updated Successfully.');
                redirect('admin/royal');
            }
            else{
                $this->session->set_flashdata('error', 'Oops! Something Went Wrong');
                redirect('admin/edit_royal');
            }

        }
    }


    public function disableRyl($id)
    {
        if(empty($id) || !is_numeric($id))
        {
            $this->session->set_flashdata('error', 'Token Mismatched');
            redirect('admin/royal');
        }
        else
        {
            $this->admin_model->disable($id);
            redirect('admin/royal');
        }
    }
    public function activeRyl($id)
    {
        if(empty($id) || !is_numeric($id))
        {
            $this->session->set_flashdata('error', 'Token Mismatched');
            redirect('admin/royal');
        }
        else
        {
            $this->admin_model->active($id);
            redirect('admin/royal');
        }
    }


}
