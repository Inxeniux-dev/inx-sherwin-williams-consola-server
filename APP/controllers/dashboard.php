<?php

class Dashboard extends Controller
{
    protected $model;
    protected $service;

    protected $modelSetting;

    public function __construct()
    {
        $this->modelSetting = $this->model('SettingModel');
        $this->service = $this->service('DashboardService');
    }

    public function index()
    {
      $data = $this->modelSetting->one();

      if($data)
      {
            $paths = [$data->path_backup, $data->path_log, $data->path_upload, $data->path_transfer];
            $this->service->genera_fichero($paths);
      }



      $this->view('dashboard/index', null);
    }

}


?>
