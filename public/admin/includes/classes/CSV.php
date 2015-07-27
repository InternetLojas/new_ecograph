<?php
/**
 * Gera um documento com valores separados por v�rgula
 */
class CSV {
    /**
     * Matriz que ir� armazenar todas as linhas do CSV
     * @var array
     */
    private $data = array();

    /**
     * N�mero de colunas
     * @var integer
     */
    private $fields = 0;

    /**
     * Salva o arquivo em disco
     * @param string $file O nome do arquivo
     */
    public function save( $file ){
        $dir = dirname( $file );
        $ret = false;

        if ( !empty( $dir ) ){
            if ( !is_dir( $dir ) ){
                throw new Exception( "O diret�rio n�o existe." );
            }
        }

        if ( file_exists( $file ) ){
            if ( !is_writable( $file ) ){
                throw new Exception( "O arquivo de destino n�o � grav�vel." );
            }
        }

        if ( ( $fh = fopen( $file , "w+" ) ) ){
            $csv = (string) $this;
            fwrite( $fh , $csv , strlen( $csv ) );
            fclose( $fh );
            $ret = true;
        } else {
            throw new Exception( "N�o foi poss�vel abrir/criar o arquivo para grava��o." );
        }

        return( $ret );
    }

    /**
     * Adiciona uma nova linha ao CSV
     * @param CSVLine $line A linha que ser� adicionada
     * @return CSV Refer�ncia ao pr�prio objeto
     */
    public function addLine( CSVLine $line ){
        if ( !count( $this->data ) ){
            $this->fields = $line->count();
        } elseif ( $this->fields != $line->count() ){
            throw new Exception( "Todas as linhas devem ter o mesmo n�mero de colunas" );
        }

        $this->data[] = $line;
        return( $this );
    }

    /**
     * Converte o objeto para sua representa��o em string
     * @return string
     */
    public function __toString(){
        return( implode( "\n" , $this->data ) );
    }
}


/**
 * Gera uma linha de um documento com valores separados por v�rgula
 */
class CSVLine {
    /**
     * Matriz que ir� armazenar os dados das colunas
     * @var array
     */
    private $data = array();

    /**
     * N�mero de campos da linha
     * @var integer
     */
    private $fields = 0;

    /**
     * Constroi uma nova linha de valores separados por v�rgula
     * @param mixed $arg1[optional] Um valor que ser� armazenado na linha
     * @param mixed $arg2[optional] Um valor que ser� armazenado na linha
     * @param mixed ... Um valor que ser� armazenado na linha
     * @param mixed $argn[optional] Um valor que ser� armazenado na linha
     */
    public function __construct( $arg1 , $arg2){
        $argv = func_get_args();
        $argc = count( $argv );

        for ( $i = 0 ; $i < $argc ; $i++ ){
            $this->addData( $argv[ $i ] );
        }
    }

    /**
     * Converte o objeto para sua representa��o em string
     * @return string
     */
    public function __toString(){
        return( implode( "," , $this->data ) );
    }

    /**
     * Adiciona um novo valor � linha
     * @param mixed $value Um valor qualquer
     * @return CSVLine Refer�ncia ao pr�prio objeto
     */
    public function addData( $value ){
        if ( preg_match( "/(,|\r\n|\n|\"|')+/" , $value ) ){
            $value = preg_replace( "/\"+/" , "\"\"" , $value );
            $value = sprintf( "\"%s\"" , $value );
        }

        $this->data[] = $value;
        ++$this->fields;
    }

    /**
     * Conta o n�mero de colunas que a linha possui
     * @return integer
     */
    public function count(){
        return( count( $this->data ) );
    }
}
?>