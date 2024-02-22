<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\AksesForm;
use App\Model\AksesModel;
use App\Model\FungsiForm;
use App\Model\FungsiModel;
use App\Model\KlasifikasiForm;
use App\Model\KlasifikasiModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MasterHandler extends ActionHandler
{
    /**
     * Handle request url '/klasifikasi' or route name 'klasifikasi'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function klasifikasi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('klasifikasi')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $query = $request->getQueryParams();
        $where = null;
        if(isset($query['q']) && $query['q']){
            $q = $query['q'];
            $where = "(`kode` LIKE '%{$q}%' OR `nama` LIKE '%{$q}%') AND `is_item`=1";
        }else{
            $where = ['`is_item`=' => 1];
        }

        $params['page'] = 'klasifikasi';
        $params['data'] = KlasifikasiModel::paginate($where);

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/klasifikasi/edit/{kode}' or route name 'edit_klasifikasi'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function editKlasifikasi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('edit_klasifikasi')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new KlasifikasiForm(true);
        $kode = $request->getAttribute('kode');
        if($kode){
            $data = KlasifikasiModel::row('*',['kode='=>$kode]);
            $model->fill($data);
        }
        if($request->getMethod() === 'POST'){
            if ($model->validateWith($request) === true) {
                if (KlasifikasiModel::update(
                    [
                        'nama' => $model->nama,
                        'update_at' => time()
                    ], 
                    ['kode=' => $model->kode]) >= 0) {
                    $this->session->addFlashSuccess('Ubah data berhasil');
                } else {
                    $this->session->addFlashError('Ubah data gagal');
                }
                return redirect('klasifikasi');
            }
        }

        $params['page'] = 'form_klasifikasi';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/klasifikasi/entri' or route name 'entri_klasifikasi'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function entriKlasifikasi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('entri_klasifikasi')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new KlasifikasiForm();
        if ($request->getMethod() == 'POST') {
            if ($model->validateWith($request) === true) {
                if (KlasifikasiModel::exists(['kode=' => $model->kode])) {
                    $model->addError('kode', "Kode '{$model->kode}' sudah ada.");
                } else {
                    if (KlasifikasiModel::create(['kode' => $model->kode, 'nama' => $model->nama, 'create_at' => time()]) > 0) {
                        $this->session->addFlashSuccess('Simpan data berhasil');
                    } else {
                        $this->session->addFlashError('Simpan data gagal');
                    }
                    return redirect('klasifikasi');
                }
            }
        }

        $params['page'] = 'form_klasifikasi';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/klasifikasi/delete/{kode}' or route name 'delete_klasifikasi'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function deleteKlasifikasi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('delete_klasifikasi')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $kode = $request->getAttribute('kode');
        if ($kode) {
            if (KlasifikasiModel::delete(['kode=' => $kode]) > 0) {
                $this->session->addFlashSuccess('Hapus data berhasil');
            } else {
                $this->session->addFlashError('Hapus data gagal');
            }
            return redirect('klasifikasi');
        }

        $params['page'] = 'klasifikasi';

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/fungsi' or route name 'fungsi'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function fungsi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('fungsi')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $query = $request->getQueryParams();
        $where = null;
        if(isset($query['q']) && $query['q']){
            $q = $query['q'];
            $where = "(`kode` LIKE '%{$q}%' OR `nama` LIKE '%{$q}%')";
        }

        $params['page'] = 'fungsi';
        $params['data'] = FungsiModel::paginate($where);

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/fungsi/entri' or route name 'entri_fungsi'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function entriFungsi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('entri_fungsi')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new FungsiForm();
        if ($request->getMethod() == 'POST') {
            if ($model->validateWith($request) === true) {
                if (FungsiModel::exists(['kode=' => $model->kode])) {
                    $model->addError('kode', "Kode '{$model->kode}' sudah ada.");
                } else {
                    if (FungsiModel::create(['kode' => $model->kode, 'nama' => $model->nama, 'create_at' => time()]) > 0) {
                        $this->session->addFlashSuccess('Simpan data berhasil');
                    } else {
                        $this->session->addFlashError('Simpan data gagal');
                    }
                    return redirect('fungsi');
                }
            }
        }

        $params['page'] = 'form_fungsi';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/fungsi/edit/{kode}' or route name 'edit_fungsi'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function editFungsi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('edit_fungsi')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new FungsiForm(true);
        $kode = $request->getAttribute('kode');
        if($kode){
            $data = FungsiModel::row('*',['kode='=>$kode]);
            $model->fill($data);
        }
        if($request->getMethod() === 'POST'){
            if ($model->validateWith($request) === true) {
                if (FungsiModel::update(
                    [
                        'nama' => $model->nama,
                        'update_at' => time()
                    ], ['kode=' => $model->kode]) >= 0) {
                        $this->session->addFlashSuccess('Ubah data berhasil');
                } else {
                    $this->session->addFlashError('Ubah data gagal');
                }
                return redirect('fungsi');
            }
        }

        $params['page'] = 'form_fungsi';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/fungsi/delete/{kode}' or route name 'delete_fungsi'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function deleteFungsi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('delete_fungsi')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $kode = $request->getAttribute('kode');
        if ($kode) {
            if (FungsiModel::delete(['kode=' => $kode]) > 0) {
                $this->session->addFlashSuccess('Hapus data berhasil');
            } else {
                $this->session->addFlashError('Hapus data gagal');
            }
            return redirect('fungsi');
        }

        $params['page'] = 'fungsi';

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/akses' or route name 'akses'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function akses(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('akses')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $query = $request->getQueryParams();
        $where = null;
        if(isset($query['q']) && $query['q']){
            $q = $query['q'];
            $where = "(`kode` LIKE '%{$q}%' OR `nama` LIKE '%{$q}%')";
        }

        $params['page'] = 'akses';
        $params['data'] = AksesModel::paginate($where);
        return view('template', $params, $response);
    }

     /**
     * Handle request url '/akses/entri' or route name 'entri_akses'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function entriAkses(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('entri_akses')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new AksesForm();
        if ($request->getMethod() == 'POST') {
            if ($model->validateWith($request) === true) {
                if (AksesModel::exists(['kode=' => $model->kode])) {
                    $model->addError('kode', "Kode '{$model->kode}' sudah ada.");
                } else {
                    if (AksesModel::create(['kode' => $model->kode, 'nama' => $model->nama, 'create_at' => time()]) > 0) {
                        $this->session->addFlashSuccess('Simpan data berhasil');
                    } else {
                        $this->session->addFlashError('Simpan data gagal');
                    }
                    return redirect('akses');
                }
            }
        }

        $params['page'] = 'form_akses';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/akses/edit/{kode}' or route name 'edit_akses'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function editAkses(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('edit_akses')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new AksesForm(true);
        $kode = $request->getAttribute('kode');
        if($kode){
            $data = AksesModel::row('*',['kode='=>$kode]);
            $model->fill($data);
        }
        if($request->getMethod() === 'POST'){
            if ($model->validateWith($request) === true) {
                if (AksesModel::update(
                    [
                        'nama' => $model->nama,
                        'update_at' => time()
                    ], ['kode=' => $model->kode]) >= 0) {
                        $this->session->addFlashSuccess('Ubah data berhasil');
                } else {
                    $this->session->addFlashError('Ubah data gagal');
                }
                return redirect('akses');
            }
        }

        $params['page'] = 'form_akses';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/akses/delete/{kode}' or route name 'delete_akses'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function deleteAkses(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('delete_akses')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $kode = $request->getAttribute('kode');
        if ($kode) {
            if (AksesModel::delete(['kode=' => $kode]) > 0) {
                $this->session->addFlashSuccess('Hapus data berhasil');
            } else {
                $this->session->addFlashError('Hapus data gagal');
            }
            return redirect('akses');
        }

        $params['page']='akses';

        return view('template', $params, $response);
    }
}
