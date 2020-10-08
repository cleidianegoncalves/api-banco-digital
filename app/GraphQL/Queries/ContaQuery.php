<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Arr;
use App\Conta;
use App\Exceptions\CustomException;

class ContaQuery {

    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args) {
        return 'hello';
    }

     public function saldo($rootValue, array $args) {
        $dataBefore = Arr::only($args, ['conta', 'valor']);
        $data['conta'] = $dataBefore['conta'];

        if ($conta = Conta::where('conta', '=', $data['conta'])->first()) {
            return $conta['saldo'];
        } else {
            throw new CustomException(
                    'Conta inexistente.'
            );
        }
    }

}
