<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\LaporanMasukForm;
use App\Model\NaskahMasukModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LaporanMasukHandler extends ActionHandler
{
    /**
     * Handle request url '/laporan-masuk' or route name 'laporan_masuk'
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
        if (!$this->user->hasPermission('laporan_masuk')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $model = new LaporanMasukForm();
        if ($request->getMethod() === 'POST'){
            if ($model->validateWith($request) === true){
                if(strtotime($model->end) < strtotime($model->start)){
                    $model->addError('form', 'Tanggal berakhir harus lebih besar atau sama dengan tanggal mulai.');
                }
                if(!$model->hasError()){
                    return redirect_url(route('cetak_laporan_masuk') . $model->start . '/' . $model->end);
                }
            }
        }

        $params['page'] = 'laporan_masuk';
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
        if (!$this->user->hasPermission('cetak_laporan_masuk')) {
            $this->session->addFlashError('Anda tidak berwenang mengakses halaman tersebut');
            return redirect('home');
        }

        $start = $request->getAttribute('start');
        $stop = $request->getAttribute('stop');
        $where = null;
        if($start && $stop){
            $where = "`tanggal` >= '{$start}' AND `tanggal` <= '{$stop}'";
        }

        $params['data'] = NaskahMasukModel::find($where);
        $params['start'] = $start;
        $params['stop'] = $stop;

        return view('cetak_laporan_masuk', $params, $response);
    }
}