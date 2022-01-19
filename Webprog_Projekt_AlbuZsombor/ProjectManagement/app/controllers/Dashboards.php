<?php

class Dashboards extends Controller{
    protected $dashboardModel;
    public function __construct(){
        $this->dashboardModel = $this->model('Dashboard');
    }

    public function displayDashboards(){
       
            $data= $this->dashboardModel->getSumValue();
			$data1= $this->dashboardModel->getCountKész();
			$data2= $this->dashboardModel->getCountBefejezetlen();
			$data3= $this->dashboardModel->getCountFolyamatban();
			$data4= $this->dashboardModel->getAvgValue();
		
						
			$this->view('dashboards/displayDashboards', $data,$data1,$data2,$data3,$data4);
        }
    

  
}