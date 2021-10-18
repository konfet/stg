<?php 

namespace app\controllers;

use \yii2sshconsole\Controller;
use app\models\Item;

class TestController extends Controller
{
        public $defaultAction = 'exec';

        
        
        public function actionExec()
        {
         
                $this->connect('ftp.fotomas.ru', [
                        'username' => 'a47370_fmas',
                        'password' => 'mmmskms', // optional
                ]);

                // Or via private key
                /*
                $this->auth('example.com', [
                        'username' => 'myusername',
                        'key' => '/path/to/private.key',
                        'password' => 'mykeypassword', // optional
                ]);
                */

                /*$output = $this->run('echo "test"');
                echo 'Output: ' . $output; // Output: test*/

                $output = $this->run('php -v');
                echo '<pre><br>' . print_r($output) . '</pre>';
                $output = $this->run('/home/httpd/fcgi-bin/a47370_fmas/php-cli -v');
                echo '<pre><br>' . print_r($output) . '</pre>';
                
//  ---------------------------------------------------------------------------------------------------------------------------------------------------------
//  
//  /home/httpd/fcgi-bin/a47370_fmas/php-cli /home/httpd/vhosts/fotomas.ru/subdomains/test11/httpdocs/basic/yii fdffd
                //m211015_210510_create_user_table
            //$output = $this->run('/home/httpd/fcgi-bin/a47370_fmas/php-cli /home/httpd/vhosts/fotomas.ru/subdomains/test11/httpdocs/basic/yii migrate m211015_210510_create_user_table --interactive=0');
//  create migration for table
                //$output = $this->run('/home/httpd/fcgi-bin/a47370_fmas/php-cli /home/httpd/vhosts/fotomas.ru/subdomains/test11/httpdocs/basic/yii migrate/create create_statistics_table --interactive=0');
//  run one migration
//                $output = $this->run('/home/httpd/fcgi-bin/a47370_fmas/php-cli /home/httpd/vhosts/fotomas.ru/subdomains/test11/httpdocs/basic/yii migrate/to m211016_074240_create_statistics_table --interactive=0');  
//  redo 10 last migration
                //$output = $this->run('/home/httpd/fcgi-bin/a47370_fmas/php-cli /home/httpd/vhosts/fotomas.ru/subdomains/test11/httpdocs/basic/yii migrate/redo 10 --interactive=0');  
                
  
//  migrate                
                //$output = $this->run('/home/httpd/fcgi-bin/a47370_fmas/php-cli /home/httpd/vhosts/fotomas.ru/subdomains/test11/httpdocs/basic/yii migrate --interactive=0');

//  redo                
                //$output = $this->run('/home/httpd/fcgi-bin/a47370_fmas/php-cli /home/httpd/vhosts/fotomas.ru/subdomains/test11/httpdocs/basic/yii migrate/redo --interactive=0');
                
                
//  run bulk command
                $output = $this->run('/home/httpd/fcgi-bin/a47370_fmas/php-cli /home/httpd/vhosts/fotomas.ru/subdomains/test11/httpdocs/basic/yii bulk/transfer-money 5');
                return '<pre><br>' . print_r($output) . '</pre>';                
/*                
                $output = $this->run([
                        'cd /path/to/install',
                        './put_offline.sh',
                        'git pull -f',
                        'composer install',
                        './yii migrate --interactive=0',
                        './build.sh',
                        './yii cache/flush',
                        './put_online.sh',
                ]);

                // Or via callback
                $this->run([
                        'cd /path/to/install',
                        './put_offline.sh',
                        'git pull -f',
                        'composer install',
                        './yii migrate --interactive=0',
                        './build.sh',
                        './yii cache/flush',
                        './put_online.sh',
                ], function($line) {
                        echo $line;
                });*/
        }
        
        public function actionIndex()
        {
            echo("Index Test");
        }
        
        public function actionTestArray()
        {
            $arr = Item::find()->asArray()->all();
            //echo '<pre>'; print_r($arr); die;                
            $rand_key = array_rand($arr);
            $pk_key = $arr[$rand_key]['id'];
            return "selected: {$rand_key}, PK: {$pk_key}";
            
        }
        
        
        public function actionSendMail()
        {
            \Yii::$app->mailer->compose()
                 ->setFrom(['login.for.test.purposes@gmail.com' => 'SLOTEGRATOR'])
                 ->setTo('mskurlatov@gmail.com')
                 ->setSubject('Тема сообщения!!!')
                 ->setTextBody('Текст сообщения!!!!')
                 ->setHtmlBody('<h1>текст сообщения в формате HTML</h1>')
                 ->send();
            return 'sent';
            
        }
}