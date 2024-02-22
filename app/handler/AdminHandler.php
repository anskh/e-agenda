<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\PasswordForm;
use App\Model\UserModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AdminHandler extends ActionHandler
{
    /**
     * Handle request url '/' or route name 'home'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        

        $params['page'] = 'dashboard';

        return view('template', $params, $response);
    }

        
    /**
     * Handle request url '/password' or route name 'edit_password'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function editPassword(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('edit_password')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new PasswordForm();
        
        if ($request->getMethod() == 'POST') {
            if ($model->validateWith($request) === true) {
                $data = UserModel::row('*', ['id=' => $this->user->getIdentity()->getId()]);
                if($data){
                    if (!password_verify($model->oldpassword, $data['password'])) {
                        $model->addError('oldpassword', "Password lama tidak sesuai.");
                    } else {
                        if (UserModel::Update(
                            [
                                'password' => password_hash($model->password, PASSWORD_BCRYPT),
                                'update_at' => time()
                            ],
                            ['id=' => $this->user->getIdentity()->getId()]) > 0) {
                                $this->session->addFlashSuccess('Ubah password berhasil');
                        } else {
                            $this->session->addFlashError('Ubah password gagal');
                        }
                        return redirect('login');
                    }
                }else{
                    $model->addError('oldpassword', "Password lama tidak sesuai.");
                }
            }
        }

        $params['page'] = 'form_password';
        $params['model'] = $model;

        return view('template', $params, $response);
    }
    
    /**
     * Handle request url '/profil' or route name 'profil'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function profil(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('profil')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $params['page'] = 'profil';
        $params['data'] = UserModel::row('*', ['id=' => $this->user->getIdentity()->getId()]);

        return view('template', $params, $response);
    }
}
