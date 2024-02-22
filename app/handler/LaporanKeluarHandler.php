<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\DinasKeluarModel;
use App\Model\EksternalKeluarModel;
use App\Model\InternalKeluarModel;
use App\Model\LaporanKeluarForm;
use App\Model\MemoKeluarModel;
use App\Model\NotaKeluarModel;
use App\Model\TugasKeluarModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LaporanKeluarHandler extends ActionHandler
{
    /**
     * Handle request url '/laporan-keluar' or route name 'laporan_keluar'
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
        if (!$this->user->hasPermission('laporan_keluar')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new LaporanKeluarForm();
        if ($request->getMethod() === 'POST'){
            if ($model->validateWith($request) === true){
                if(strtotime($model->end) < strtotime($model->start)){
                    $model->addError('form', 'Tanggal berakhir harus lebih besar atau sama dengan tanggal mulai.');
                }
                if(!$model->hasError()){
                    return redirect_url(route('cetak_laporan_keluar') . $model->jenis . '/' . $model->start . '/' . $model->end);
                }
            }
        }

        $params['page'] = 'laporan_keluar';
        $params['model'] = $model;

        return view('template', $params, $response);
    }    
    /**
     * cetak
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function cetak(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!$this->user->getIdentity()->isAuthenticated()) {
            $this->session->addFlashError('Silahkan login terlebih dahulu');
            return redirect('login');
        }
        if (!$this->user->hasPermission('cetak_laporan_keluar')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $start = $request->getAttribute('start');
        $stop = $request->getAttribute('stop');
        $jenis = $request->getAttribute('jenis');
        $data = [];
        $where = null;
        if($start && $stop){
            $where = "`tanggal` >= '{$start}' AND `tanggal` <= '{$stop}'";
        }
        if($jenis){
            if($jenis === 'memo'){
                $jenis = 'Memorandum';
                $data = MemoKeluarModel::find($where);
            }elseif($jenis === 'nota'){
                $jenis = 'Nota Dinas/KAK/Form Belanja';
                $data = NotaKeluarModel::find($where);
            }elseif($jenis === 'surtug'){
                $jenis = 'Surat Tugas';
                $data = TugasKeluarModel::find($where);
            }elseif($jenis === 'dinas'){
                $jenis = 'Surat Dinas';
                $data = DinasKeluarModel::find($where);
            }elseif($jenis === 'internal'){
                $jenis = 'Undangan Internal';
                $data = InternalKeluarModel::find($where);
            }elseif($jenis === 'eksternal'){
                $jenis = 'Undangan Eksternal';
                $data = EksternalKeluarModel::find($where);
            }
        }

        $params['data'] = $data;
        $params['jenis'] = $jenis;
        $params['start'] = $start;
        $params['stop'] = $stop;

        return view('cetak_laporan_keluar', $params, $response);
    }
}