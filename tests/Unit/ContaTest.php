<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Conta;

class ContaTest extends TestCase {

    use RefreshDatabase;

    protected function loadConta(): Conta {
        return factory(Conta::class)->create();
    }

    public function testMutationSaque(): void {
        $conta = $this->loadConta();
        # Test Saque
        $this->graphQL(/** @lang GraphQL */ '
                mutation sacar($conta: Int!) {
                    sacar(conta: $conta, valor: 2000) {
                        conta
                        saldo
                    }
                }
        ', [
            'conta' => $conta->conta
        ])->assertJson([
            'data' => [
                'sacar' => [
                    'conta' => $conta->conta,
                    'saldo' => 1000,
                ]
            ]
        ]);
    }

    public function testMutationDeposito(): void {
        $conta = $this->loadConta();

        # Teste Deposito
        $this->graphQL(/** @lang GraphQL */ '
                mutation depositar($conta: Int!) {
                    depositar(conta: $conta, valor: 2000) {
                        conta
                        saldo
                    }
                }
        ', [
            'conta' => $conta->conta
        ])->assertJson([
            'data' => [
                'depositar' => [
                    'conta' => $conta->conta,
                    'saldo' => 5000,
                ]
            ]
        ]);
    }

    public function testQuerySaldo(): void {
        $conta = $this->loadConta();

        $this->graphQL(/** @lang GraphQL */ '
            query saldo($conta: Int!) {
                    saldo(conta: $conta)
                }
        ', [
            'conta' => $conta->conta
        ])->assertJson([
            'data' => [
                'saldo' => 3000
            ]
        ]);
    }

}
