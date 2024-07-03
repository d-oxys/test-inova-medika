<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Membuat roles
        $admin = $auth->createRole('admin');
        $pegawai = $auth->createRole('pegawai');
        $master = $auth->createRole('master');
        $pasien = $auth->createRole('pasien');

        // Membuat permissions
        $manageDataMaster = $auth->createPermission('manageDataMaster');
        $manageTransaksi = $auth->createPermission('manageTransaksi');
        $viewPasien = $auth->createPermission('viewPasien');

        // Menambahkan permissions ke roles
        $auth->add($admin, $manageDataMaster);
        $auth->add($pegawai, $manageTransaksi);
        $auth->add($pasien, $viewPasien);

        // Menambahkan roles ke user
        $auth->assign($admin, 1);
        $auth->assign($pegawai, 2);
        $auth->assign($master, 3);
        $auth->assign($pasien, 4);
    }
}
