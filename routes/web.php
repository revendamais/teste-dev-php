<?php

use App\Events\UserCreatedEvent;
use App\Models\User;
use App\Services\Auth\JWT\JWTtoken;
use App\Services\Bot\CcconetTrain;
use App\Services\Bot\ConsumeModel;
use App\Services\Container\ContainerProvider;
use App\Services\Container\ServiceContainer;
use App\Services\EventService\EventServiceProvider;
use App\Services\Files\Zip;
use App\Services\Github\GithubLogin;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Route;
use App\Facades\Github;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\App;
use Psr\Container\ContainerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\BrowserConsoleHandler;
use Illuminate\Support\Str;
use Phpml\Classification\NaiveBayes;

//veiculo_placa
$veiculos = [
    ['veiculo placa']
];
$ocorrencia_address = [
    ['ocorrencia rua'],
    ['ocorrencia endereco'],
    ['ocorrencia bairro'],
    ['ocorrencia setor'],
    ['ocorrencia local']
];
$ocorrencia_address_response = [

];
//ocorrencia
$ocorrencia = [
    ['ocorrencia hoje'],
    ['ocorrencia ontem'],
    ['ocorrencia cpf', 'solicitante'],
    ['ocrrencia solicitante', 'anonimo'],
    ['ocorrencia tipo', 'ocorrencia'],
    ['ocorrencia finalizado', 'hoje'],
    ['ocorrencia aberta'],
    ['ocorrencia rua'],
    ['ocorrencia endereco'],
    ['ocorrencia bairro'],
    ['ocorrencia setor'],
    ['ocorrencia local']
];
Route::get('/', function () {
    return view('welcome');
});
