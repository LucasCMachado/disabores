<?php  
  require_once "_connect/conexao_relatorios.php";
  $dbh = Database::conexao();
  require_once "assets/mpdf60/mpdf.php";


  class reportCliente extends mpdf{  
 
    // Atributos da classe  
    private $pdo  = null;  
    private $pdf  = null;
    private $css  = null;
    private $data_mensal  = null;
    private $titulo = null;
    echo"<script>alert(".$data_mensal.");</script>";

    /*  
    * Construtor da classe  
    * @param $css  - Arquivo CSS  
    * @param $titulo - Título do relatório   
    */  
    public function __construct($css, $titulo) {  
      $this->pdo  = Conexao::getInstance();  
      $this->titulo = $titulo;  
      $this->setarCSS($css);  
    }
  
    /*  
    * Método para setar o conteúdo do arquivo CSS para o atributo css  
    * @param $file - Caminho para arquivo CSS  
    */  
    public function setarCSS($file){  
     if (file_exists($file)):  
       $this->css = file_get_contents($file);  
     else:  
       echo 'Arquivo inexistente!';  
     endif;  
    }  
 
    /*  
    * Método para montar o Cabeçalho do relatório em PDF  
    */  
    protected function getHeader(){  
       $data = date('j/m/Y');  
       $retorno = "<table class=\"tbl_header\" width=\"1000\">  
               <tr>  
                 <td align=\"left\">DiSabores</td>  
                 <td align=\"right\">Gerado em: $data</td>  
               </tr>  
             </table>";  
       return $retorno;  
     }  
 
     /*  
     * Método para montar o Rodapé do relatório em PDF  
     */  
     protected function getFooter(){  
       $retorno = "<table class=\"tbl_footer\" width=\"1000\">  
               <tr>
                 <td align=\"right\">Página: {PAGENO}</td>  
               </tr>  
             </table>";  
       return $retorno;  
     }  
 
    /*   
    * Método para construir a tabela em HTML com todos os dados  
    * Esse método também gera o conteúdo para o arquivo PDF  
    */  
    private function getTabela(){  
      $color  = false;  
      $retorno = "";  
 
      $retorno .= "<h2 style=\"text-align:center\">{$this->titulo}</h2>";  
      $retorno .= "<table style='border-collapse: collapse;width: 100%;'>  
           <tr>  
             <th style='padding: 8px;text-align: left;border-bottom: 1px solid #ddd;'>Nome Cliente</td>  
             <th style='padding: 8px;text-align: left;border-bottom: 1px solid #ddd;'>Data da venda</td>  
             <th style='padding: 8px;text-align: left;border-bottom: 1px solid #ddd;'>Período</td>  
             <th style='padding: 8px;text-align: left;border-bottom: 1px solid #ddd;'>Valor</td>
             <th style='padding: 8px;text-align: left;border-bottom: 1px solid #ddd;'>Valor</td>  
           </tr>";  
 
      $sql = 'SELECT venda.valor_total as "valor", venda.data_venda, cliente.nome as "nomeCliente", periodo.nome as "nomePeriodo" FROM venda LEFT JOIN cliente ON cliente.id=venda.id_cliente LEFT JOIN periodo ON periodo.id=venda.id_periodo WHERE venda.data_venda LIKE "'.$data_mensal.'%"';  
      foreach ($this->pdo->query($sql) as $reg):  
         $retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";  
         $retorno .= "<td style='padding: 8px;text-align: left;border-bottom: 1px solid #ddd;'>{$reg['nomeCliente']}</td>";   
         $retorno .= "<td style='padding: 8px;text-align: left;border-bottom: 1px solid #ddd;'>{$reg['data_venda']}</td>";  
         $retorno .= "<td style='padding: 8px;text-align: left;border-bottom: 1px solid #ddd;'>{$reg['nomePeriodo']}</td>";  
         $retorno .= "<td style='padding: 8px;text-align: left;border-bottom: 1px solid #ddd;'>{$reg['valor']}</td>";
         $retorno .= "<td style='padding: 8px;text-align: left;border-bottom: 1px solid #ddd;'>{$data_mensal}</td>";  
       $retorno .= "<tr>";  
       $color = !$color;  
      endforeach;  
 
      $retorno .= "</table>";  
      return $retorno;  
    } 
 
    /*   
    * Método para construir o arquivo PDF  
    */  
    public function BuildPDF(){  
     $this->pdf = new mPDF('utf-8', 'A4-L');  
     $this->pdf->WriteHTML($this->css, 1);  
     $this->pdf->SetHTMLHeader($this->getHeader());  
     $this->pdf->SetHTMLFooter($this->getFooter());  
     $this->pdf->WriteHTML($this->getTabela());   
    }   
 
    /*   
    * Método para exibir o arquivo PDF  
    * @param $name - Nome do arquivo se necessário grava-lo  
    */  
    public function Exibir($name = null) {  
     $this->pdf->Output($name.'.pdf', 'I');  
    } 

  }  
      function inverteData($data_inverte){
    if(count(explode("/",$data_inverte)) > 1){
        return implode("-",array_reverse(explode("/",$data_inverte)));
    }elseif(count(explode("-",$data_inverte)) > 1){
        return implode("/",array_reverse(explode("-",$data_inverte)));
    }
} 