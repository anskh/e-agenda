<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\InternalKeluarForm;
use App\Model\InternalKeluarModel;
use Exception;
use Laminas\Diactoros\UploadedFile;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class InternalKeluarHandler extends ActionHandler
{
    /**
     * Handle request url '/internal-keluar' or route name 'internal_keluar'
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
        if (!$this->user->hasPermission('internal_keluar')) {
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

        $params['page'] = 'internal_keluar';
        $params['data'] = InternalKeluarModel::paginate($where,'*','tanggal DESC,nomor_naskah DESC');

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/internal-keluar/entri' or route name 'entri_internal_keluar'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function entriInternal(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('entri_internal_keluar')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new InternalKeluarForm();
        $model->nomor = strval(internalKeluarModel::getNomorTerakhir($this->tahun) + 1);
        if ($request->getMethod() === 'POST'){
            $model->fill($request->getParsedBody());
            $model->generateNomorNaskah();
            if ($model->validate() === true){
                if (InternalKeluarModel::exists(['nomor=' => $model->nomor])){
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
                                        $file->moveTo("public/uploads/{$this->tahun}/internal_keluar/{$filename}");
                                    }catch(Exception $e){
                                        $this->session->addFlashError('Upload file surat internal gagal');
                                        return redirect('internal_keluar');
                                    }
                                }
                            }
                        }
                    }
                    if (!$model->hasError()) {
                        if (InternalKeluarModel::create(
                            [
                                'akses' => $model->akses,
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
                        return redirect('internal_keluar');
                    }
                }
            }
        }

        $params['page']='form_internal_keluar';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/internal-keluar/edit/{id}' or route name 'edit_internal_keluar'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function editInternal(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('edit_internal_keluar')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new InternalKeluarForm(true);
        $id = $request->getAttribute('id');
        if ($id){
            $data = InternalKeluarModel::row('*', ['id=' => $id]);
            $model->fill($data);
        }
        if ($request->getMethod() === 'POST'){
            $model->fill($request->getParsedBody());
            $model->generateNomorNaskah();
            if ($model->validate() === true){
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
                                    $path = "public/uploads/{$this->tahun}/internal_keluar/";
                                    if($filename){
                                        if(file_exists($path .$filename)){
                                            unlink($path . $filename);
                                        }
                                    }
                                    $filename = sprintf('%d.pdf', time());
                                    $file->moveTo($path . $filename);
                                }catch(Exception $e){
                                    $this->session->addFlashError('Upload file surat internal gagal');
                                    return redirect('internal_keluar');
                                }
                            }
                        }
                    }
                }
                if (!$model->hasError()) {
                    if (InternalKeluarModel::update(
                        [
                            'akses' => $model->akses,
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
                    return redirect('internal_keluar');
                }
            }
        }

        $params['page'] ='form_internal_keluar';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/internal-keluar/delete/{id}' or route name 'delete_internal_keluar'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function deleteinternal(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('delete_internal_keluar')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $id = $request->getAttribute('id');
        if ($id) {
            $data = InternalKeluarModel::row('*', ['id=' => $id]);
            $filename = $data['file'] ?? null;
            if ($filename) {
                try{
                    $path = "public/uploads/{$this->tahun}/internal_keluar/";
                    if(file_exists($path . $filename)){
                        unlink($path . $filename);
                    }
                }catch(Exception $e){
                    $this->session->addFlashError('Hapus file surat internal gagal');
                    return redirect('internal_keluar');
                }
            }
            if (InternalKeluarModel::delete(['id=' => $id]) > 0) {
                $this->session->addFlashSuccess('Hapus data berhasil');
            } else {
                $this->session->addFlashError('Hapus data gagal');
            }
        }

        return redirect('internal_keluar');
    }
}
