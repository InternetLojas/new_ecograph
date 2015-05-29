<?php

Class GerarBoleto {

    /**
     * Mapa das classes dos Bancos e seus códigos
     *
     * @var array
     */
    protected static $classMap = array(
        '001' => 'bancobrasil',
        '33' => 'santander',
        '70' => 'brb',
        '90' => 'unicred',
        '104' => 'caixa',
        '237' => 'bradesco',
        '341' => 'itau',
    );

    /**
     * Retorna a instância de um Banco através do código
     *
     * @param int|string $codBanco Código do Banco
     * @param array $params Parâmetros iniciais para construção do objeto
     * @throws Exception Quando o banco não é suportado
     * @return BoletoAbstract
     */
    public static function Banco($codBanco) {
        $codBanco = $codBanco;

        if (!isset(static::$classMap[$codBanco])) {
            throw new Exception(sprintf('O banco de código "%s" não é surportado.', $codBanco));
        }
        //$BancoBoleto = static::$classMap[$codBanco];
        return static::BancoName(static::$classMap[$codBanco]);
    }

    public static function getNomeBanco($codBanco) {
        $codBanco = $codBanco;

        if (!isset(static::$classMap[$codBanco])) {
            throw new Exception(sprintf('O banco de código "%s" não é surportado.', $codBanco));
        }

        return static::$classMap[$codBanco];
    }

    /**
     * Retorna a instância de um Banco através do nome
     *
     * @param string $nome Nome do Banco
     * @param array $params Parâmetros iniciais para construção do objeto
     * @throws Exception Quando a classe não é encontrada
     * @return BoletoAbstract
     */
    public static function BancoName($nome) {
        $class = __NAMESPACE__ . '\\' . $nome;

        if (!class_exists($class)) {
            throw new Exception(sprintf('A classe "%s" não existe.', $class));
        }

        return new $class();
    }

    public static function DigitoVerificador($cod_banco, $digitos, $FatorVencimento, $valorZerofill, $CampoLivre) {

        $num = Utilidades::zeroFill($cod_banco, $digitos) . '9' . $FatorVencimento . $valorZerofill . $CampoLivre;
        $soma = 0;
        $fator = 2;
        $base = 9;
        $r = 0;
        for ($i = strlen($num); $i > 0; $i--) {
            $numeros[$i] = substr($num, $i - 1, 1);
            $parcial[$i] = $numeros[$i] * $fator;
            $soma += $parcial[$i];
            if ($fator == $base) {
                $fator = 1;
            }
            $fator++;
        }
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;

            //corrigido
            if ($digito == 10) {
                $digito = "X";
            }

            /*
              alterado por mim, Daniel Schultz

              Vamos explicar:

              O módulo 11 só gera os digitos verificadores do nossonumero,
              agencia, conta e digito verificador com codigo de barras (aquele que fica sozinho e triste na linha digitável)
              só que é foi um rolo...pq ele nao podia resultar em 0, e o pessoal do phpboleto se esqueceu disso...

              No BB, os dígitos verificadores podem ser X ou 0 (zero) para agencia, conta e nosso numero,
              mas nunca pode ser X ou 0 (zero) para a linha digitável, justamente por ser totalmente numérica.

              Quando passamos os dados para a função, fica assim:

              Agencia = sempre 4 digitos
              Conta = até 8 dígitos
              Nosso número = de 1 a 17 digitos

              A unica variável que passa 17 digitos é a da linha digitada, justamente por ter 43 caracteres

              Entao vamos definir ai embaixo o seguinte...

              se (strlen($num) == 43) { não deixar dar digito X ou 0 } */


            if (strlen($num) == "43") {
                //então estamos checando a linha digitável
                if ($digito == "0" or $digito == "X" or $digito > 9) {
                    $digito = 1;
                }
            }
            return $digito;
        } elseif ($r == 1) {
            $digito = $soma % 11;
            return $resto;
        }
        /* $modulo = static::modulo11($num); */
        /* if ($modulo['resto'] == 0 || $modulo['resto'] == 1 || $modulo['resto'] == 10) {
          $dv = 1;
          } else {
          $dv = 11 - $modulo['resto'];
          }

          return $dv;

         */
    }

    /**
     * Retorna a linha digitável do boleto
     *
     * @return string
     */
    public static function Blocks($chave) {

        // Break down febraban positions 20 to 44 into 3 blocks of 5, 10 and 10
        // characters each.
        $blocks = array(
            '20-24' => substr($chave, 0, 5),
            '25-34' => substr($chave, 5, 10),
            '35-44' => substr($chave, 15, 10),
        );

        return $blocks;
    }

}
