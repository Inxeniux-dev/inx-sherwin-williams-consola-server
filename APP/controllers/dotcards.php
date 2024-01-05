<?php
class Dotcards extends Controller
{
    protected $dotCardtModel;
    protected $appService;
    protected $service;

    public function __construct()
    {
        $this->dotCardModel = $this->model('DotcardModel');
        $this->appService = $this->service('AppService');
        $this->service = $this->service('DotcardService');
    }


    public function index()
    {
      if(!$_SESSION["permissions"][22]->status) {  $this->view('error/permisos', null); return; }
      $this->view('dotcards/index');
    }

    public function getlist($page = 1, $search = '')
    {   $data = $this->dotCardModel->getDotCards($page, $search);
        $paginator = $this->appService->getPaginatorAjax($data["paginator"], $page);
        $response = $this->service->DotCardTableList($data["cards"], $paginator);
        echo $response;
    }



    public function details($id_card = 0)
    {   $data = $this->dotCardModel->getDataDotCard($id_card);
        $changes = $this->dotCardModel->getListChanges($id_card);

        $this->view('dotcards/detail' , ["data" => $data, "changes" => $changes]);
    }

    public function changedetail($id_change = 0)
    {
      $data = $this->dotCardModel->getDataChange($id_change);
      $data_prods = $this->dotCardModel->getDataChangeProds($id_change);
      $this->view('dotcards/changedetail' , ["data" => $data, "prods" => $data_prods, "id" => $id_change]);
    }

    public function change($id_card = 0)
    {
      if($_SESSION["config"]["bloqueo"] == 1) {  $this->view('error/bloqueo', null); return; }

      if(!$_SESSION["config"]["unlok_system"])
      {
          $system_date = date("Y-m-d");
          if($system_date != $_SESSION["config"]["date_corte"])
          {
              $this->view('sales/block', null);
              return;
          }
      }

      $sync = $this->dotCardModel->SyncCard($id_card);
      $KEY = generaKeyQue();

      if($sync)
      {
            $data = $this->dotCardModel->addChangeHuella($id_card, $KEY);
      }

      $data = $this->dotCardModel->getDataDotCard($id_card);
      $this->view('dotcards/change' , ["data" => $data, "KEY" => $KEY, "sync" => $sync]);
    }


    public function changelist()
    {
        $this->view('dotcards/changelist' , null);
    }


    public function add($iddotcard = 0)
    {
        $data["edit"] = false;
        if($iddotcard > 0)
        {
            $data = $this->dotCardModel->getDataDotCard($iddotcard);
            $data->edit = true;
        }
        else{
            $data["num_tarjeta"] = date("my-dmis");
        }

        $data = json_decode(json_encode($data));
        $this->view('dotcards/add' , $data);
    }


    public function register()
    {
        $data = [
            "duplicate" => false,
            "card" => isset($_POST["card"]) ? $_POST["card"] : '',
            "card_hidden" => isset($_POST["cardh"]) ? $_POST["cardh"] : '',
            "phone" => isset($_POST["phone"]) ? $this->appService->sanear_string($_POST["phone"]) : '',
            "points" => isset($_POST["points"]) ? $_POST["points"] : '',
            "direction" => isset($_POST["direction"]) ? $this->appService->sanear_string(strtoupper($_POST["direction"])) : '',
            "name" => isset($_POST["name"]) ? $this->appService->sanear_string(strtoupper($_POST["name"])) : '',
            "email" => isset($_POST["email"]) ? $_POST["email"] : '',
            "descount" => isset($_POST["descount"]) ? $this->appService->sanear_string($_POST["descount"]) : '',
            "occupation" => isset($_POST["occupation"]) ? $this->appService->sanear_string(strtoupper($_POST["occupation"])) : '',
            "card_update" => isset($_POST["card_update"]) ? $_POST["card_update"] : '',
            "edit" => isset($_POST["edit"]) ? $_POST["edit"] : '',
            "idcard" => isset($_POST["idc"]) ? $_POST["idc"] : '',
        ];

        $res = $this->service->validateAddDotCard($data);

        if($res["validation"])
        {
            $is_duplicate = true;

            if(isset($data["edit"]) && $_POST["edit"] == "true") /* Si existe la variable edit y es true, es una actualización */
            {
                if($_POST["card"] != $_POST["card_update"])
                {
                    if($this->dotCardModel->getByItems(['num_tarjeta'], [$_POST["card_update"]], ['AND'])->fetch_object() == NULL)
                    {
                        $is_duplicate = false;
                    }
                }
                else{ $is_duplicate = false; }
            }
            else{ /* Si no existe la variable edit, es un registro nuevo */
                if($this->dotCardModel->getByItems(['num_tarjeta'], [$_POST["card"]], ['AND'])->fetch_object() == NULL)
                {
                    $is_duplicate = false;
                }
            }

            if(!$is_duplicate)  /* si no esta duplicado */
            {
               $res["duplicate"] = false;
                if(isset($_POST["edit"]) && $_POST["edit"] == "true")
                {
                    $update =  $this->dotCardModel->updateDotCard($data); /* Update to Location */
                    $res["save"] = $update["status"];
                    $res["id"] = $data["idcard"];
                }
                else{
                        $save = $this->dotCardModel->saveDotCard($data); /* Add to User */
                        $res["save"] = $save["status"];
                        $res["id"] = $save["status"] ? $save["id"] : 0;
                }
            }
            else{ $res["duplicate"] = true; }


        }

        echo json_encode($res);

    }


}
