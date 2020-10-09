<?php

namespace App\GraphQL\Mutations;

use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Arr;
use GraphQL\Type\Definition\ResolveInfo;
use App\Conta;
use App\Exceptions\CustomException;

class ContaMutator {

    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args) {
        // TODO implement the resolver
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue
     * @param  mixed[]  $args
     */
    public function saque($rootValue, array $args) {
        $dataBefore = Arr::only($args, ['conta', 'valor']);
        $data['conta'] = $dataBefore['conta'];

        if ($conta = Conta::where('conta', '=', $data['conta'])->first()) {
            $saldoAtual = $conta['saldo'];

            if ($saldoAtual < $dataBefore['valor']) {
                throw new CustomException(
                        'Saldo Insuficiente.'
                );
            } else {
                $data['saldo'] = $saldoAtual - $dataBefore['valor'];
                if ($conta->update($data)) {
                    return $conta;
                } else {
                    throw new CustomException(
                            'Erro Interno.'
                    );
                }
            }
        } else {
            throw new CustomException(
                    'Conta Inexistente'
            );
        }
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue
     * @param  mixed[]  $args
     */
    public function deposito($rootValue, array $args) {
        $dataBefore = Arr::only($args, ['conta', 'valor']);
        $data['conta'] = $dataBefore['conta'];

        if ($conta = Conta::where('conta', '=', $data['conta'])->first()) {
            $saldoAnterior = $conta['saldo'];
            $data['saldo'] = $saldoAnterior + $dataBefore['valor'];

            if ($conta->update($data)) {
                return $conta;
            } else {
                throw new CustomException(
                        'Erro Interno.'
                );
            }
        } else {
            throw new CustomException(
                    'Conta Inexistente'
            );
        }
    }

}
