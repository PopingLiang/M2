<?php

class Account_Info extends Controller
{
    protected $accmodel;

    function __construct()
    {
        $this->accmodel = $this->model('AccountInfo');
    }

    public function index()
    {
        if (isset($_POST['_method'])) {
            $data = [
                'account'   => strtolower($_POST['account'] ?? ''),
                'user_name' => $_POST['user_name'] ?? '',
                'gender'    => isset($_POST['gender']) ? ($_POST['gender'] >= 0 ? $_POST['gender'] : '') : '',
                'birth'     => $_POST['birth'] ?? '',
                'email'     => $_POST['email'] ?? '',
                'remark'    => $_POST['remark'] ?? '',
            ];
            switch ($_POST['_method']) {
                case 'POST':
                    $bool = $this->accmodel->CreatData($data);
                    if (!$bool) {
                        echo json_encode(['res' => '新增失敗!!']);
                        break;
                    }
                    echo json_encode(['res' => true]);
                    break;
                case 'UPDATE':
                    $bool = $this->accmodel->UpdateData($_POST['uid'], $data);
                    if (!$bool) {
                        echo  json_encode(['res' => '修改失敗!!']);
                        break;
                    }
                    echo json_encode(['res' => true]);
                    break;
                case 'DELETE':
                    $bool = $this->accmodel->DeleteData(implode(',', $_POST['uid']));
                    if (!$bool) {
                        echo  json_encode(['res' => '刪除失敗!!']);
                        break;
                    }
                    echo json_encode(['res' => true]);
                    break;
            }
            exit;
        }

        $page = $_POST['page'] ?? 1;

        $data = $this->accmodel->showData($_POST['search'] ?? null, $_POST['sort'] ?? null);
        $c = count($data); //總資料
        $ChunkData = array_chunk($data, 10); // 10筆為一組
        $ChunkCount = count($ChunkData); //  總頁數
        $PageDataCount = count($ChunkData[$page - 1]); //此頁有幾筆資料
        echo json_encode(['data' => $ChunkData[$page - 1], 'total' => $c, 'AllPage' => $ChunkCount, 'PageDataCount' => $PageDataCount, "ThisPage" => $page,]);
    }
}
