<?php
namespace Tests\Unit;

use App\Main\Fornecedor\Model\Fornecedor;
use App\Services\ApiExternos\BuscaCnpj;
use InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;


class BuscarCpnjTest extends TestCase
{

    public function test_busca_cpnj_status_ok() : void
    {
        $fornecedor = $this->getMockBuilder(Fornecedor::class)
            ->setConstructorArgs([null, "83.213.764/0001-92", null, null, null])
                 ->onlyMethods(["toArray", "getCpfCnpj"])
                         ->getMock();

        $buscar = $this->getMockBuilder(BuscaCnpj::class)
            ->setConstructorArgs([$fornecedor])
                ->onlyMethods(['loadConfig', 'handleCnpj', 'run', 'status'])
                    ->getMock();

        $buscar->method('loadConfig')->willReturn($buscar);
        $buscar->method('handleCnpj')->willReturn($buscar);
        $buscar->method('run')->willReturn($buscar);
        $buscar->method('status')->willReturn(value: 200);

        $result = $buscar
            ->handleCnpj()
            ->loadConfig()
            ->run()
            ->status();

        
        $this->assertSame(200, $result);
    }

    public function test_throw_exception_on_invalid_cnpj() : void
    {
        $fornecedor = $this->getMockBuilder(Fornecedor::class)
            ->setConstructorArgs([null, "345345654", null, null, null])
                 ->onlyMethods(["toArray", "getCpfCnpj"])
                         ->getMock();

        $buscar = $this->getMockBuilder(BuscaCnpj::class)
            ->setConstructorArgs([$fornecedor])
                ->onlyMethods(['loadConfig', 'run', 'status'])
                    ->getMock();

        $buscar->method('loadConfig')->willReturn($buscar);

        $this->expectException(InvalidArgumentException::class);
        
        $buscar->loadConfig()->handleCnpj();
    }
}