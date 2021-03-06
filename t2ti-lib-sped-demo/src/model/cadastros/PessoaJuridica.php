<?php
/*******************************************************************************
Title: T2Ti ERP Fenix                                                                
Description: Model relacionado à tabela [PESSOA_JURIDICA] 
                                                                                
The MIT License                                                                 
                                                                                
Copyright: Copyright (C) 2020 T2Ti.COM                                          
                                                                                
Permission is hereby granted, free of charge, to any person                     
obtaining a copy of this software and associated documentation                  
files (the "Software"), to deal in the Software without                         
restriction, including without limitation the rights to use,                    
copy, modify, merge, publish, distribute, sublicense, and/or sell               
copies of the Software, and to permit persons to whom the                       
Software is furnished to do so, subject to the following                        
conditions:                                                                     
                                                                                
The above copyright notice and this permission notice shall be                  
included in all copies or substantial portions of the Software.                 
                                                                                
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,                 
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES                 
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND                        
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT                     
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,                    
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING                    
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR                   
OTHER DEALINGS IN THE SOFTWARE.                                                 
                                                                                
       The author may be contacted at:                                          
           t2ti.com@gmail.com                                                   
                                                                                
@author Albert Eije (alberteije@gmail.com)                    
@version 1.0.0
*******************************************************************************/
declare(strict_types=1);

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="PESSOA_JURIDICA")
 */
class PessoaJuridica extends ModelBase implements \JsonSerializable
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", name="CNPJ")
	 */
	private $cnpj;

	/**
	 * @ORM\Column(type="string", name="NOME_FANTASIA")
	 */
	private $nomeFantasia;

	/**
	 * @ORM\Column(type="string", name="INSCRICAO_ESTADUAL")
	 */
	private $inscricaoEstadual;

	/**
	 * @ORM\Column(type="string", name="INSCRICAO_MUNICIPAL")
	 */
	private $inscricaoMunicipal;

	/**
	 * @ORM\Column(type="date", name="DATA_CONSTITUICAO")
	 */
	private $dataConstituicao;

	/**
	 * @ORM\Column(type="string", name="TIPO_REGIME")
	 */
	private $tipoRegime;

	/**
	 * @ORM\Column(type="string", name="CRT")
	 */
	private $crt;


    /**
     * Relations
     */
    
    /**
     * @ORM\OneToOne(targetEntity="Pessoa", inversedBy="pessoaJuridica")
     * @ORM\JoinColumn(name="ID_PESSOA", referencedColumnName="id")
     */
    private $pessoa;


    /**
     * Gets e Sets
     */

    public function getId() 
	{
		return $this->id;
	}

	public function setId($id) 
	{
		$this->id = $id;
	}

    public function getCnpj() 
	{
		return $this->cnpj;
	}

	public function setCnpj($cnpj) 
	{
		$this->cnpj = $cnpj;
	}

    public function getNomeFantasia() 
	{
		return $this->nomeFantasia;
	}

	public function setNomeFantasia($nomeFantasia) 
	{
		$this->nomeFantasia = $nomeFantasia;
	}

    public function getInscricaoEstadual() 
	{
		return $this->inscricaoEstadual;
	}

	public function setInscricaoEstadual($inscricaoEstadual) 
	{
		$this->inscricaoEstadual = $inscricaoEstadual;
	}

    public function getInscricaoMunicipal() 
	{
		return $this->inscricaoMunicipal;
	}

	public function setInscricaoMunicipal($inscricaoMunicipal) 
	{
		$this->inscricaoMunicipal = $inscricaoMunicipal;
	}

    public function getDataConstituicao() 
	{
		if ($this->dataConstituicao != null) {
			return $this->dataConstituicao->format('Y-m-d');
		} else {
			return null;
		}
	}
	public function setDataConstituicao($dataConstituicao) 
	{
		$this->dataConstituicao = $dataConstituicao != null ? new \DateTime($dataConstituicao) : null;
	}

    public function getTipoRegime() 
	{
		return $this->tipoRegime;
	}

	public function setTipoRegime($tipoRegime) 
	{
		$this->tipoRegime = $tipoRegime;
	}

    public function getCrt() 
	{
		return $this->crt;
	}

	public function setCrt($crt) 
	{
		$this->crt = $crt;
	}

    public function getPessoa(): ?Pessoa 
	{
		return $this->pessoa;
	}

	public function setPessoa(?Pessoa $pessoa) 
	{
		$this->pessoa = $pessoa;
	}


    /**
     * Constructor
     */
    public function __construct($objetoJson)
    {
        if (isset($objetoJson)) {
            isset($objetoJson->id) ? $this->setId($objetoJson->id) : $this->setId(null);
            $this->mapear($objetoJson);
        }

		
    }

    /**
     * Mapping
     */
    public function mapear($objeto)
    {
        if (isset($objeto)) {
			$this->setCnpj($objeto->cnpj);
			$this->setNomeFantasia($objeto->nomeFantasia);
			$this->setInscricaoEstadual($objeto->inscricaoEstadual);
			$this->setInscricaoMunicipal($objeto->inscricaoMunicipal);
			$this->setDataConstituicao($objeto->dataConstituicao);
			$this->setTipoRegime($objeto->tipoRegime);
			$this->setCrt($objeto->crt);
		}
    }


    /**
     * Validation
     */
    public function validarObjetoRequisicao($objJson, $id)
    {
        return parent::validarObjeto($objJson, $id, 'PessoaJuridica');
    }


    /**
     * Serialization
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
			'id' => $this->getId(),
			'cnpj' => $this->getCnpj(),
			'nomeFantasia' => $this->getNomeFantasia(),
			'inscricaoEstadual' => $this->getInscricaoEstadual(),
			'inscricaoMunicipal' => $this->getInscricaoMunicipal(),
			'dataConstituicao' => $this->getDataConstituicao(),
			'tipoRegime' => $this->getTipoRegime(),
			'crt' => $this->getCrt(),
        ];
    }
}
