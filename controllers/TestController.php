<?php 

namespace app\controllers;
use \yii2sshconsole\Controller;

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
               $output = $this->run('/home/httpd/fcgi-bin/a47370_fmas/php-cli /home/httpd/vhosts/fotomas.ru/subdomains/test11/httpdocs/basic/yii migrate/redo 10 --interactive=0');  
                
  
//  migrate                
                //$output = $this->run('/home/httpd/fcgi-bin/a47370_fmas/php-cli /home/httpd/vhosts/fotomas.ru/subdomains/test11/httpdocs/basic/yii migrate --interactive=0');

//  redo                
                //$output = $this->run('/home/httpd/fcgi-bin/a47370_fmas/php-cli /home/httpd/vhosts/fotomas.ru/subdomains/test11/httpdocs/basic/yii migrate/redo --interactive=0');
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
        
        public function actionIndex2()
        {
            echo("Index Test2");
        }
}