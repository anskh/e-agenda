<?php declare(strict_types=1);

namespace App\Handler;

use App\Model\KlasifikasiModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ApiHandler extends ActionHandler
{
    /**
     * handle request
     * route: json_klasifikasi
     * url: /json_klasifikasi
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function klasifikasi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $kode = $request->getParsedBody()['kode'] ?? '';
        $data = [];
        if($kode){
            $data = KlasifikasiModel::find('kode LIKE %' . $kode . '%', 'kode');
        }
        
        return view_json($data);
    }
}