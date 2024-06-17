<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\NotaKeluarForm;
use App\Model\NotaKeluarModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use Throwable;

class NotaKeluarHandler extends ActionHandler
{
    /**
     * Handle request url '/nota-keluar' or route name 'nota_keluar'
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
        if (!$this->user->hasPermission('nota_keluar')) {
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

        $params['page'] = 'nota_keluar';
        $params['data'] = NotaKeluarModel::paginate($where,'*','tanggal DESC,nomor_naskah DESC');

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/nota-keluar/entri' or route name 'entri_nota_keluar'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function entriNota(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('entri_nota_keluar')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new NotaKeluarForm();
        $model->nomor = strval(NotaKeluarModel::getNomorTerakhir($this->tahun) + 1);
        if ($request->getMethod() === 'POST'){
            $model->fill($request->getParsedBody());
            $model->generateNomorNaskah();
            if ($model->validate() === true){
                if (NotaKeluarModel::exists(['nomor=' => $model->nomor])){
                    $model->addError('nomor', "Nomor '{$model->nomor}' sudah ada.");
                }else{
                    $filename = null;
                    foreach ($request->getUploadedFiles() as $file) {
                        if ($file instanceof UploadedFileInterface) {
                            if ($file->getError() === UPLOAD_ERR_OK && $file->getSize() > 0) {
                                $fileExt = strtolower(pathinfo($file->getClientFileName(), PATHINFO_EXTENSION));
                                $allowd_file_ext = 'pdf';
                                if ($file->getSize() > 8388608) { // 8 MB
                                    $model->addError('form', "Ukuran file lebih dari 4MB.");
                                }elseif ($fileExt !== $allowd_file_ext) {
                                    $model->addError('form', "Tipe file harus pdf.");
                                }else {
                                    $path = "uploads/{$this->tahun}/nota_keluar/";
                                    $filename = sprintf('%d.pdf', time());
                                    try{
                                        $file->moveTo($path . $filename);
                                    }catch(Throwable $e){
                                        $this->session->addFlashError('Upload file nota gagal. Error:'.$e->getMessage());
                                        return redirect('nota_keluar');
                                    }
                                }
                            }
                        }
                    }
                    if (!$model->hasError()) {
                        if (NotaKeluarModel::create(
                            [
                                'nomor' => $model->nomor,
                                'fungsi' => $model->fungsi,
                                'klasifikasi' => $model->klasifikasi,
                                'tahun' => $this->tahun,
                                'nomor_naskah' => $model->nomor_naskah,
                                'perihal' => $model->perihal,
                                'tanggal' => $model->tanggal,
                                'tujuan' => $model->tujuan,
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
                        return redirect('nota_keluar');
                    }
                }
            }
        }

        $params['page'] = 'form_nota_keluar';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/nota-keluar/edit/{id}' or route name 'edit_nota_keluar'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function editNota(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('edit_nota_keluar')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new NotaKeluarForm(true);
        $id = $request->getAttribute('id');
        if ($id){
            $data = NotaKeluarModel::row('*', ['id=' => $id]);
            $model->fill($data);
        }
        if ($request->getMethod() === 'POST'){
            $model->fill($request->getParsedBody());
            if ($model->validate() === true){
                $filename = $data['file'] ?? null;
                foreach ($request->getUploadedFiles() as $file) {
                    if ($file instanceof UploadedFileInterface) {
                        if ($file->getError() === UPLOAD_ERR_OK && $file->getSize() > 0) {
                            $fileExt = strtolower(pathinfo($file->getClientFileName(), PATHINFO_EXTENSION));
                            $allowd_file_ext = 'pdf';
                            if ($file->getSize() > 8388608) { // 8 MB
                                $model->addError('form', "Ukuran file lebih dari 4MB.");
                            }elseif ($fileExt !== $allowd_file_ext) {
                                $model->addError('form', "Tipe file harus pdf.");
                            }else {
                                try{
                                    $path = "uploads/{$this->tahun}/nota_keluar/";
                                    if($filename && is_file($path .$filename)){
                                        unlink($path . $filename);
                                    }
                                    $filename = sprintf('%d.pdf', time());
                                    $file->moveTo($path . $filename);
                                }catch(Throwable $e){
                                    $this->session->addFlashError('Upload file nota gagal. Error:'.$e->getMessage());
                                    return redirect('nota_keluar');
                                }
                            }
                        }
                    }
                }
                if (!$model->hasError()) {
                    $model->generateNomorNaskah();
                    if (NotaKeluarModel::update(
                        [
                            'fungsi' => $model->fungsi,
                            'klasifikasi' => $model->klasifikasi,
                            'tahun' => $this->tahun,
                            'nomor_naskah' => $model->nomor_naskah,
                            'perihal' => $model->perihal,
                            'tanggal' => $model->tanggal,
                            'tujuan' => $model->tujuan,
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
                    return redirect('nota_keluar');
                }
            }
        }

        $params['page'] = 'form_nota_keluar';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/nota-keluar/delete/{id}' or route name 'delete_nota_keluar'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function deleteNota(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('delete_nota_keluar')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $id = $request->getAttribute('id');
        if ($id) {
            $data = NotaKeluarModel::row('*', ['id=' => $id]);
            $filename = $data['file'] ?? null;

            try{
                $path = "uploads/{$this->tahun}/nota_keluar/";
                if($filename && is_file($path .$filename)){
                    unlink($path . $filename);
                }
                NotaKeluarModel::delete(['id=' => $id]);
                $this->session->addFlashSuccess('Hapus data berhasil');
            }catch(Throwable $e){
                $this->session->addFlashError('Hapus data gagal. Error:'.$e->getMessage());
            }
        }
        
        return redirect('nota_keluar');
    }
}
