<?php
namespace App\Services\ApiExternos;

use App\Main\Fornecedor\Model\Fornecedor;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;
use LogicException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BuscaCnpj
{

    private Response $response;
    private $url;
    private $cnpj;

    public function __construct(
        public Fornecedor $fornecedor
    )
    {}

    public function run()
    {
        $response = Http::get($this->url);
        $this->response = $response;
        return $this;
        
    }
    public function loadConfig()
    {
        $url =  config("services.cpnj_url");
        throw_if(!$url, InvalidArgumentException::class, "url do api não foi configurado");
        $this->url = "{$url}/{$this->cnpj}";
        return $this;
    }
    public function handleCnpj()
    {
        $cnpj = preg_replace("/\D/", "", $this->fornecedor->getCpfCnpj());
        if (strlen($cnpj) < 14) {
            throw new InvalidArgumentException("Cpnj é invalido");
        }
        $this->cnpj = $cnpj;
        return $this;
    }
    public function responseToString()
    {
        return $this->response->body();
    }

    public function status() 
    {
        return $this->response->status();
    }

    public function throwIfFail()
    {
        $status = $this->response->status();
        if ($status !== 200) {
            throw new NotFoundHttpException("Erro ao buscar dados do CNPJ", null, $status);
        }
        return $this;
    }

    public function toObject()
    {
        return json_decode($this->responseToString());
    }
}