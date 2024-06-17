<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\LoginForm;
use App\Model\UserForm;
use App\Model\UserModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * AuthHandler
 */
class AuthHandler extends ActionHandler
{
    /**
     * Handle request url '/login' or route name 'login'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return mixed
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        if ($this->user->getIdentity()->isAuthenticated()) {
            return redirect('home');
        }

        $model = new LoginForm();
        if ($request->getMethod() === 'POST') {
            if ($model->validateWith($request) === true) {

                $row = UserModel::row('*', ['username=' => $model->username]);

                if($row){
                    if(password_verify($model->password, $row['password'])) {
                        if(!file_exists('uploads') && !is_dir('uploads')) {
                            mkdir('uploads');
                        }
                        if(!file_exists('uploads/' . $model->tahun) && !is_dir('uploads/' . $model->tahun)) {
                            mkdir('uploads/' . $model->tahun);
                        }
                        $this->session->set('tahun', $model->tahun);
                        $this->session->setUserId(strval($row['id']));
                        $this->session->setUserHash(sha1($row['password'] . $request->getServerParams()['HTTP_USER_AGENT']));
                        $this->session->addFlashSuccess("Selamat datang '" . ucfirst($row['username'] . "'"));
                        return redirect('home');
                    }
                }
                $model->addError('username', 'Username atau password tidak match.');         
            }
        }

        $params['model'] = $model;
        
        return view('login', $params, $response);
    }
    
    /**
     * Handle request url '/logout' or route name 'logout'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function logout(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if ($this->user->getIdentity()->isAuthenticated()) {
            $this->session->unset('tahun');
            $this->session->unsetUserId();
            $this->session->unsetUserHash();
            if($this->session->hasFlash()){
                $this->session->flash();
            }
            $this->session->addFlashSuccess('Anda telah berhasil keluar.');
        }       

        return redirect('login');
    }

    /**
     * Handle request url '/user' or route name 'user'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function user(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('user')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $query = $request->getQueryParams();
        $where = null;
        if(isset($query['q']) && $query['q']){
            $q = $query['q'];
            $where = ['username LIKE '=>"%{$q}%", 'nama LIKE '=> "%{$q}%", 'OR'];
        }

        $params['page'] = 'user';
        $params['data'] = UserModel::paginate($where, '*');

        return view('template', $params, $response);
    }

    
     /**
     * Handle request url '/user/entri' or route name 'entri_user'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function entriUser(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('entri_user')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new UserForm();
        if ($request->getMethod() == 'POST') {
            if ($model->validateWith($request) === true) {
                if (UserModel::exists(['username=' => $model->username])) {
                    $model->addError('username', "Username '{$model->username}' sudah ada.");
                } else {
                    if (UserModel::create(
                        [
                            'username' => $model->username,
                            'password' => password_hash($model->password, PASSWORD_BCRYPT),
                            'nama' => $model->nama,
                            'role' => $model->role,
                            'fungsi' => $model->fungsi,
                            'create_at' => time()
                        ]) > 0) {
                        $this->session->addFlashSuccess('Simpan data berhasil');
                    } else {
                        $this->session->addFlashError('Simpan data gagal');
                    }
                    return redirect('user');
                }
            }
        }

        $params['page'] = 'form_user';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
   * Handle request url '/user/edit/{userid}' or route name 'edit_user'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function editUser(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('edit_user')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new UserForm(true);
        $userid = $request->getAttribute('userid');
        if($userid){
            $data = UserModel::row('*',['id='=>$userid]);
            $model->fill($data);
        }
        if($request->getMethod() === 'POST'){
            if ($model->validateWith($request) === true) {
                if (UserModel::update(
                    [
                        'username' => $model->username,
                        'nama' => $model->nama,
                        'role' => $model->role,
                        'fungsi' => $model->fungsi,
                        'update_at' => time()
                    ], 
                    [
                        'id=' => $userid
                    ]) >= 0) {
                    $this->session->addFlashSuccess('Ubah data berhasil');
                } else {
                    $this->session->addFlashError('Ubah data gagal');
                }
                return redirect('user');
            }
        }

        $params['page'] = 'form_user';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/user/delete/{userid}' or route name 'delete_user'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function deleteUser(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('delete_user')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $userid = $request->getAttribute('userid');
        if ($userid) {
            if (UserModel::delete(['id=' => $userid]) > 0) {
                $this->session->addFlashSuccess('Hapus data berhasil');
            } else {
                $this->session->addFlashError('Hapus data gagal');
            }            
        }

        return redirect('user');
    }
}
