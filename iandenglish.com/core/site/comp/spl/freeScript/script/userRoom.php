<?
namespace core\comp\spl\freeScript\logic;

// Engine
use core\classes\userUtils;
use core\classes\dbus;
use core\classes\render;
use core\classes\site\dir as sitePath;
use core\classes\request;
use core\classes\password;

// ORM
use ORM\users as usersOrm;

class userRoomMvc{

    public function run($comp){
        $tplPath = sitePath::getSiteCompTplPath($comp['isTplOut'], $comp['nsPath']);

        
        $render = new render($tplPath, '');

        $usersOrm = new usersOrm();

        $type = request::get('type');
        switch($type){
            case 'restore':
                if (isset($comp['rstatus'])){
                    $tpl = 'user/restoreok.tpl.php';
                    break;
                }

                $code = request::get('code');
                $email = request::get('email');
                $isExists = (boolean)$usersOrm->selectFirst('1', ['login'=>$email, 'restoreCode'=>$code]);
                if ( !$isExists ){
                    $tpl = 'user/wrongcode.tpl.php';
                    break;
                }

                $tpl = 'user/restore.tpl.php';
                $render->setVar('code', $code);
                $render->setVar('email', $email);
                break;
            case 'newpwd':
                $tpl = self::_defaultView($comp, $render, $usersOrm);
                if ( isset($comp['cstatus']) ){
                    $render->setVar('cstatus', $comp['cstatus']);
                }
                break;
            default:
				if ( !dbus::$user){
					echo '<p>Авторизуйтесь</p>';
					return;
				}
                $tpl = self::_defaultView($comp, $render, $usersOrm);
        }
		
		

        $render->setMainTpl($tpl)
            ->setContentType(null)
            ->render();

        // func. run
    }

    private function _defaultView($comp, $render, $usersOrm){
        $userData = $usersOrm->selectFirst('balance, login', ['id'=>dbus::$user['id']]);

        $render->setVar('balance', $userData['balance']);
        $render->setVar('login', $userData['login']);
        return userUtils::getCompTpl($comp);
        // func. _defaultView
    }

    public function init(&$comp){
        if ( !request::isPost()){
            return;
        }
        $type = request::get('type');
        $password = new password(10);
        switch($type){
            case 'restore':
                $pwd = trim(request::post('pwd'));
                if ( strlen($pwd) < 5 ){
                    return;
                }
                $code = request::get('code');
                $email = request::get('email');
                $usersOrm = new usersOrm();

                $pwd = $password->hash($pwd);
                $usersOrm->update(['pwd'=>$pwd, 'restoreCode'=>''], ['login'=>$email, 'restoreCode'=>$code]);
                $comp['rstatus'] = 1;
                break;
            case 'newpwd':
                if ( !dbus::$user){
                    return;
                }
                $newPwd = trim(request::post('newpwd'));
                if ( strlen($newPwd) < 5 ){
                    return;
                }


                $oldPwd = trim(request::post('oldpwd'));

                $usersOrm = new usersOrm();
                $pwdHast = (new usersOrm())->get('pwd', ['id' => dbus::$user['id']]);

                if ( !$password->verify($oldPwd, $pwdHast) ){
                    $comp['cstatus'] = 'badold';
                    return;
                }

                $newPwd = $password->hash($newPwd);
                $usersOrm->update(['pwd'=>$newPwd ], ['id'=>dbus::$user['id']]);
                $comp['cstatus'] = 'ok';
                break;
        }
        // func. init
    }

    // class userMvc
} 