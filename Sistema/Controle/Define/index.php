<?php  
namespace Sistema\Controle;

class Definir {
      protected $nameSite     = "Painel de Senha";
      protected $nameRazao    = "PRODESP";
      protected $descricao    = "Painel de Senha";
      protected $keywords     = "Painel de Senha";

      protected $logoSite     = "\\imagens";
      protected $iconeSite    = "\\imagens/";  
      protected $css          = "\\css/";
      protected $js           = "\\js/";
      protected $imagens      = "\\imagens/";
      protected $login        = "\\Login";
      protected $usuario      = "\\Usuario";
      protected $sair         = "\\sair";

      protected $index        = "/index.php";
      protected $core         = "/Core";
      protected $require      = "/Requisicoes";
      protected $app          = "/Aplicativos/";
      protected $admin        = "/Admin";

      protected $linkFace     = "";
      protected $linkInsta    = "";
      protected $linkWhats    = "https://api.whatsapp.com/send/?phone=0&text&app_absent=0";

      protected $ip_Local;

      public    $is_mobile;
      public    $u_;
      public    $file;
     
      public function __construct(){
            $this->get_Client_IP();
            $this->isMobile();

            define("_NOME",         "{$this->nameSite}");
            define('_RAZAO',        "{$this->nameRazao}");
            define('_DESCRI',       "{$this->descricao}");
            define('_KWORDS',       "{$this->keywords}");
            define("_LOGO",         "{$this->logoSite}");
            define("_ICONE",        "{$this->iconeSite}");
            define("_INDEX",        "{$this->index}");
            define("_CSS",          "{$this->css}");
            define("_JS",           "{$this->js}");
            define("_IMAGENS",      "{$this->imagens}");
            define("_SAIR",         "{$this->sair}");
            define("_CORE",         "{$this->core}");
            define("_APP",          "{$this->app}");
            define("_REQUIRE",      "{$this->require}");
            define("_LOGIN",        "{$this->login}");
            define("_USUARIO",      "{$this->usuario}");
            define('SEDEX10',       40215);
            define('SEDEXACOBRAR',  40045);
            define('SEDEX',         40010);
            define('PAC',           41106);
            define('_DIR_ADMIN',    "{$this->usuario}{$this->admin}");
            define('LK_Faceb',      "{$this->linkFace}");
            define('LK_Insta',      "{$this->linkInsta}");
            define('LK_Whats',      "{$this->linkWhats}");
            define('IS_MOBILE',     "{$this->is_mobile}");
            define('URL_0',         "{$this->u_[0]}");
            define('URL_1',         "{$this->u_[1]}");
            define('URL_2',         "{$this->u_[2]}");
            define('URL_3',         "{$this->u_[3]}");
            define('URL_4',         "{$this->u_[4]}");
            define('IP_LOCAL',           "{$this->ip_Local}");
      }

      public function isMobile() {
            $this->is_mobile = false;
            $this->urSet();
            
            if (empty($_SERVER['HTTP_USER_AGENT']) ) {
                  $this->is_mobile = false;
            }else{
                  if (
                        strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile')         !== false || 
                        strpos($_SERVER['HTTP_USER_AGENT'], 'Android')        !== false || 
                        strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/')          !== false || 
                        strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle')         !== false || 
                        strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry')     !== false || 
                        strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini')     !== false || 
                        strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi')     !== false 
                  ) {
                        $this->is_mobile = true;
                  } else {
                        $this->is_mobile = false;
                  }
            }
            return $this->is_mobile;
      } 

      public function urSet(){
            $url_ = filter_input(INPUT_GET, 'lnk', FILTER_SANITIZE_ENCODED);
            $this->u_ = array_filter(explode('%2F', $url_));
            if (empty($this->u_[0])) { $this->u_[0] = "";  } 
            if (empty($this->u_[1])) { $this->u_[1] = "";  } 
            if (empty($this->u_[2])) { $this->u_[2] = "";  } 
            if (empty($this->u_[3])) { $this->u_[3] = "";  } 
            if (empty($this->u_[4])) { $this->u_[4] = "";  } 
            return $this->u_;
      }

      private function get_Client_IP() {
if (!empty($_SERVER['HTTP_CLIENT_IP'])){         $this->ip_Local = $_SERVER['HTTP_CLIENT_IP'];}
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){   $this->ip_Local = $_SERVER['HTTP_X_FORWARDED_FOR'];}
if (!empty($_SERVER['HTTP_X_FORWARDED'])){       $this->ip_Local = $_SERVER['HTTP_X_FORWARDED'];}
if (!empty($_SERVER['HTTP_FORWARDED_FOR'])){     $this->ip_Local = $_SERVER['HTTP_FORWARDED_FOR'];}
if (!empty($_SERVER['HTTP_FORWARDED'])){         $this->ip_Local = $_SERVER['HTTP_FORWARDED'];}
if (!empty($_SERVER['REMOTE_ADDR'])){            $this->ip_Local = $_SERVER['REMOTE_ADDR'];}
           return $this->ip_Local;
      }
}
?>