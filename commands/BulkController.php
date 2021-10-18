<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\UserPrizes;

class BulkController extends Controller
{
    /**
     * This command bulk transfers money to users  from earliest dates
     * @param int $size
     * @return int
     */
    public function actionTransferMoney($size = 3): int
    {                
        $transaction = \Yii::$app->db->beginTransaction();
        $prizes = UserPrizes::find()->where(['status' => UserPrizes::S_ACTIVE, 'type' => UserPrizes::T_MONEY,])
                ->limit($size)->orderBy('id ASC')->all();

        $count = 0;
        $success = '';
        $errors = '';
        foreach ($prizes as $prize) {                        
            $res = $prize->transfer(true);
            if ($res) {
                $success .= "{$prize->id},";
            }
            else {
                $errors .= "{$prize->id},";
            }
            $count ++;
        }
        $transaction->commit();            
        echo "{$count} money prizes were processed\n";
//        echo "Success: {$success}\n";        
//        echo "Errors: {$errors}\n";        
        
        return ExitCode::OK;
    }
}
