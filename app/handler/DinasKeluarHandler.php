<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\DinasKeluarForm;
use App\Model\DinasKeluarModel;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

class DinasKeluarHandler extends ActionHandler
{
    /**
     * Handle request url '/dinas-keluar' or route name 'dinas_keluar'
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
        if (!$this->user->hasPermission('dinas_keluar')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $query = $request->getQueryParams();
        if (isset($query['q']) && $query['q']) {
            $q = $query['q'];
            $where = "(`nomor_naskah` LIKE '%{$q}%' OR `perihal` LIKE '%{$q}%') AND `tahun`='{$this->tahun}'";
        } else {
            $where = "`tahun`='{$this->tahun}'";
        }

        if(!file_exists("uploads/{$this->tahun}/dinas_keluar") && !is_dir("uploads/{$this->tahun}/dinas_keluar")){
            mkdir("uploads/{$this->tahun}/dinas_keluar");
        }

        $params['page'] = 'dinas_keluar';
        $params['data'] = DinasKeluarModel::paginate($where, '*', 'tanggal DESC,nomor_naskah DESC');


        return view('template', $params, $response);
    }

    /**
     * Handle request url '/dinas-keluar/entri' or route name 'entri_dinas_keluar'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function entridinas(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('entri_dinas_keluar')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new DinasKeluarForm();
        $model->nomor = strval(DinasKeluarModel::getNomorTerakhir($this->tahun) + 1);
        if ($request->getMethod() === 'POST') {
            $model->fill($request->getParsedBody());
            $model->generateNomorNaskah();
            if ($model->validate() === true) {
                if (DinasKeluarModel::exists(['nomor=' => $model->nomor])) {
                    $model->addError('nomor', "Nomor '{$model->nomor}' sudah ada.");
                } else {
                    $filename = null;
                    foreach ($request->getUploadedFiles() as $file) {
                        if ($file instanceof UploadedFileInterface) {
                            if ($file->getError() === UPLOAD_ERR_OK && $file->getSize() > 0) {
                                $fileExt = strtolower(pathinfo($file->getClientFileName(), PATHINFO_EXTENSION));
                                $allowd_file_ext = 'pdf';
                                if ($file->getSize() > 8388608) { // 8 MB
                                    $model->addError('form', "Ukuran file lebih dari 4MB.");
                                } elseif ($fileExt !== $allowd_file_ext) {
                                    $model->addError('form', "Tipe file harus pdf.");
                                } else {
                                    $filename = sprintf('%d.pdf', time());
                                    try {
                                        $file->moveTo("uploads/{$this->tahun}/dinas_keluar/{$filename}");
                                    } catch (Exception $e) {
                                        $this->session->addFlashError('Upload file surat dinas gagal. Error:' . $e->getMessage());
                                        return redirect('dinas_keluar');
                                    }
                                }
                            }
                        }
                    }
                    if (!$model->hasError()) {
                        try {
                            DinasKeluarModel::create(
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
                                    'user_create' => auth($request)->getIdentity()->getId(),
                                    'create_at' => time()
                                ]
                            );
                            $this->session->addFlashSuccess('Simpan data berhasil');
                        } catch (Exception $e) {
                            $this->session->addFlashError('Simpan data gagal. Error: ' . $e->getMessage());
                        }
                        return redirect('dinas_keluar');
                    }
                }
            }
        }

        $params['page'] = 'form_dinas_keluar';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/dinas-keluar/edit/{id}' or route name 'edit_dinas_keluar'
     *
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface $response
     * @return ResponseInterface
     */
    public function editdinas(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('edit_dinas_keluar')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new DinasKeluarForm(true);
        $id = $request->getAttribute('id');
        if ($id) {
            $data = DinasKeluarModel::row('*', ['id=' => $id]);
            $model->fill($data);
        }
        if ($request->getMethod() === 'POST') {
            $model->fill($request->getParsedBody());
            $model->generateNomorNaskah();
            if ($model->validate() === true) {
                $filename = $data['file'] ?? null;
                foreach ($request->getUploadedFiles() as $file) {
                    if ($file instanceof UploadedFileInterface) {
                        if ($file->getError() === UPLOAD_ERR_OK && $file->getSize() > 0) {
                            $fileExt = strtolower(pathinfo($file->getClientFileName(), PATHINFO_EXTENSION));
                            $allowd_file_ext = 'pdf';
                            if ($file->getSize() > 8388608) { // 8 MB
                                $model->addError('form', "Ukuran file lebih dari 4MB.");
                            } elseif ($fileExt !== $allowd_file_ext) {
                                $model->addError('form', "Tipe file harus pdf.");
                            } else {
                                try {
                                    $path = "uploads/{$this->tahun}/dinas_keluar/";
                                    if ($filename && is_file($path . $filename)) {
                                        unlink($path . $filename);
                                    }
                                    $filename = sprintf('%d.pdf', time());
                                    $file->moveTo($path . $filename);
                                } catch (Exception $e) {
                                    $this->session->addFlashError('Upload file surat dinas gagal. Error:' .  $e->getMessage());
                                    return redirect('dinas_keluar');
                                }
                            }
                        }
                    }
                }
                if (!$model->hasError()) {
                    try{
                        DinasKeluarModel::update(
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
                                'user_update' => auth($request)->getIdentity()->getId(),
                                'update_at' => time()
                            ],
                            [
                                'id=' => $id
                            ]
                            );
                            $this->session->addFlashSuccess('Ubah data berhasil');
                    }catch(Exception $e){
                        $this->session->AddFlashError('Ubah data gagal. Error:' . $e->getMessage());
                    }
                    
                    return redirect('dinas_keluar');
                }
            }
        }

        $params['page'] = 'form_dinas_keluar';
        $params['model'] = $model;

        return view('template', $params, $response);
    }

    /**
     * Handle request url '/dinas-keluar/delete/{id}' or route name 'delete_dinas_keluar'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function deletedinas(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('delete_dinas_keluar')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $id = $request->getAttribute('id');
        if ($id) {
            $data = DinasKeluarModel::row('*', ['id=' => $id]);
            $filename = $data['file'] ?? null;
            try {
                $path = "uploads/{$this->tahun}/dinas_keluar/";
                if ($filename && is_file($path . $filename)) {
                    unlink($path . $filename);
                }
                DinasKeluarModel::delete(['id=' => $id]);
                $this->session->addFlashSuccess('Hapus data berhasil');
            } catch (Exception $e) {
                $this->session->addFlashError('Hapus data gagal. Error:' . $e->getMessage());
            }
        }

        return redirect('dinas_keluar');
    }
}
