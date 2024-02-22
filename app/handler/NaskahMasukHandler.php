<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\NaskahMasukForm;
use App\Model\NaskahMasukModel;
use Exception;
use Laminas\Diactoros\UploadedFile;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class NaskahMasukHandler extends ActionHandler
{
    /**
     * Handle request url '/naskah-masuk' or route name 'naskah_masuk'
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
        if (!$this->user->hasPermission('naskah_masuk')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $query = $request->getQueryParams();
        if(isset($query['q']) && $query['q']){
            $q = $query['q'];
            $where = "(`nomor_naskah` LIKE '%{$q}%' OR `perihal` LIKE '%{$q}%') AND `tahun`='{$this->tahun}'";
        }else{
            $where = "`tahun`='{$this->tahun}'";
        }

        $params['page'] = 'naskah_masuk';
        $params['data'] = NaskahMasukModel::paginate($where,'*','tanggal DESC,nomor_naskah DESC');

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/naskah-masuk/entri' or route name 'entri_naskah_masuk'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function entri(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('entri_naskah_masuk')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new NaskahMasukForm();
        $model->nomor = strval(NaskahMasukModel::getNomorTerakhir($this->tahun) + 1);
        if ($request->getMethod() === 'POST'){
            if ($model->validateWith($request) === true){
                if (NaskahMasukModel::exists(['nomor=' => $model->nomor])){
                    $model->addError('nomor', "Nomor '{$model->nomor}' sudah ada.");
                }else{
                    $filename = null;
                    foreach ($request->getUploadedFiles() as $file) {
                        if ($file instanceof UploadedFile) {
                            if ($file->getError() === UPLOAD_ERR_OK && $file->getSize() > 0) {
                                $fileExt = strtolower(pathinfo($file->getClientFileName(), PATHINFO_EXTENSION));
                                $allowd_file_ext = 'pdf';
                                if ($file->getSize() > 8388608) { // 8 MB
                                    $model->addError('form', "Ukuran file lebih dari 4MB.");
                                }elseif ($fileExt !== $allowd_file_ext) {
                                    $model->addError('form', "Tipe file harus pdf.");
                                }else {
                                    $filename = sprintf('%d.pdf', time());
                                    try{
                                        $file->moveTo("public/uploads/{$this->tahun}/naskah_masuk/{$filename}");
                                    }catch(Exception $e){
                                        $this->session->addFlashError('Upload file naskah gagal');
                                        return redirect('naskah_masuk');
                                    }
                                }
                            }
                        }
                    }
                    if (!$model->hasError()) {
                        if (NaskahMasukModel::create(
                            [
                                'nomor' => $model->nomor,
                                'tahun' => $this->tahun,
                                'nomor_naskah' => $model->nomor_naskah,
                                'perihal' => $model->perihal,
                                'tanggal' => $model->tanggal,
                                'asal' => $model->asal,
                                'file' => $filename,
                                'keterangan' => $model->keterangan,
                                'user_create' => $this->user->getIdentity()->getId(),
                                'create_at' => time()
                            ]
                        ) > 0) {
                            $this->session->addFlashSuccess('Simpan data berhasil');
                        }else {
                            $this->session->addFlashError('Simpan data gagal');
                        }
                        return redirect('naskah_masuk');
                    }
                }
            }
        }

        $params['page'] = 'form_naskah_masuk';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/naskah-masuk/edit/{id}' or route name 'edit_naskah_masuk'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function edit(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('edit_naskah_masuk')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new NaskahMasukForm(true);
        $id = $request->getAttribute('id');
        if ($id){
            $data = NaskahMasukModel::row('*', ['id=' => $id]);
            $model->fill($data);
        }
        if ($request->getMethod() === 'POST'){
            if ($model->validateWith($request) === true){
                $filename = $data['file'] ?? null;
                foreach ($request->getUploadedFiles() as $file) {
                    if ($file instanceof UploadedFile) {
                        if ($file->getError() === UPLOAD_ERR_OK && $file->getSize() > 0) {
                            $fileExt = strtolower(pathinfo($file->getClientFileName(), PATHINFO_EXTENSION));
                            $allowd_file_ext = 'pdf';
                            if ($file->getSize() > 8388608) { // 8 MB
                                $model->addError('form', "Ukuran file lebih dari 4MB.");
                            }elseif ($fileExt !== $allowd_file_ext) {
                                $model->addError('form', "Tipe file harus pdf.");
                            }else {
                                try{
                                    $path = "public/uploads/{$this->tahun}/naskah_masuk/";
                                    if($filename){
                                        if(file_exists($path .$filename)){
                                            unlink($path . $filename);
                                        }
                                    }
                                    $filename = sprintf('%d.pdf', time());
                                    $file->moveTo($path . $filename);
                                }catch(Exception $e){
                                    $this->session->addFlashError('Upload file naskah gagal');
                                    return redirect('naskah_masuk');
                                }
                            }
                        }
                    }
                }
                if (!$model->hasError()) {
                    if (NaskahMasukModel::update(
                        [
                            'tahun' => $this->tahun,
                            'nomor_naskah' => $model->nomor_naskah,
                            'perihal' => $model->perihal,
                            'tanggal' => $model->tanggal,
                            'asal' => $model->asal,
                            'file' => $filename,
                            'keterangan' => $model->keterangan,
                            'user_update' => $this->user->getIdentity()->getId(),
                            'update_at' => time()
                        ],
                        [
                            'id=' => $id
                        ]
                    ) >= 0) {
                        $this->session->addFlashSuccess('Ubah data berhasil');
                    }else{
                        $this->session->addFlashError('Ubah data gagal');
                    }
                    return redirect('naskah_masuk');
                }
            }
        }

        $params['page'] = 'form_naskah_masuk';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/naskah-masuk/delete/{id}' or route name 'delete_naskah_masuk'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function delete(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('delete_naskah_masuk')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $id = $request->getAttribute('id');
        if ($id) {
            $data = NaskahMasukModel::row('*', ['id=' => $id]);
            $filename = $data['file'] ?? null;
            if ($filename) {
                try{
                    $path = "public/uploads/{$this->tahun}/naskah_masuk/";
                    if(file_exists($path . $filename)){
                        unlink($path . $filename);
                    }
                }catch(Exception $e){
                    $this->session->addFlashError('Hapus file naskah gagal');
                    return redirect('naskah_masuk');
                }
            }
            if (NaskahMasukModel::delete(['id=' => $id]) > 0) {
                $this->session->addFlashSuccess('Hapus data berhasil');
            } else {
                $this->session->addFlashError('Hapus data gagal');
            }
        }

        return redirect('naskah_masuk');
    }
}
