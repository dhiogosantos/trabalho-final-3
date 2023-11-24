<?php
class UsuarioEntidade {
    private $cpf;
    private $nome;
    private $tipoPerfil;
    private $id;

    public function getCpf() {
        return $this->cpf;
    }
    
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome= $nome;
    }

    public function getTipoPerfil() {
        return $this->tipoPerfil;
    }

    public function setTipoPerfil($tipoPerfil) {
        $this->tipoPerfil = $tipoPerfil;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
}
?>