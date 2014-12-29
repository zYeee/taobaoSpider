<?php
    class prop{
        private $p_1;
        private $p_2;
        private $p_3;
        private $p_4;
        private $p_5;
        private $p_6;
        private $p_7;
        private $p_8;
        private $p_9;
        private $p_10;
        private $p_11;
        private $p_12;
        private $p_13;
        private $p_14;
        private $p_15;
        private $p_16;
        private $p_17;
        private $p_18;
        private $p_19;
        private $p_20;
        private $p_21;
        private $p_22;
        private $p_23;
        private $p_24;
        private $p_25;
        private $p_26;
        private $p_27;
        private $p_28;
        private $p_29;
        private $p_30;
        private $p_31;
        private $p_32;
        private $p_33;
        private $p_34;

        function __construct(){
            $this->p_1=$this->p_2=$this->p_3=$this->p_4=$this->p_5=$this->p_6=$this->p_7=$this->p_8=$this->p_9=$this->p_10=$this->p_11=$this->p_12=$this->p_13=$this->p_14=$this->p_15=$this->p_16=$this->p_17=$this->p_18=$this->p_19=$this->p_20=$this->p_21=$this->p_22=$this->p_23=$this->p_24=$this->p_25=$this->p_26=$this->p_27=$this->p_28=$this->p_29=$this->p_30=$this->p_31=$this->p_32=$this->p_33=$this->p_34="";
        }
	function get_prop($props){
            $name=$props['name'];
            $value=$props['value'];
            switch($name){
                case "品牌":$this->p_1=addslashes(str_replace("‘","'",$value));break;
                case "货号":$this->p_2=addslashes(str_replace("‘","'",$value));break;
                case "上市年份季节":$this->p_3=addslashes(str_replace("‘","'",$value));break;
                case "风格":$this->p_4=addslashes(str_replace("‘","'",$value));break;
                case "适用对象":$this->p_5=addslashes(str_replace("‘","'",$value));break;
                case "毛重":$this->p_6=addslashes(str_replace("‘","'",$value));break;
                case "包装体积":$this->p_7=addslashes(str_replace("‘","'",$value));break;
                case "适用季节":$this->p_8=addslashes(str_replace("‘","'",$value));break;
                case "鞋帮高度":$this->p_9=addslashes(str_replace("‘","'",$value));break;
                case "帮面材质":$this->p_10=addslashes(str_replace("‘","'",$value));break;
                case "里料材质":$this->p_11=addslashes(str_replace("‘","'",$value));break;
                case "皮质特征":$this->p_12=addslashes(str_replace("‘","'",$value));break;
                case "鞋底材质":$this->p_13=addslashes(str_replace("‘","'",$value));break;
                case "靴款品名":$this->p_14=addslashes(str_replace("‘","'",$value));break;
                case "筒高":$this->p_15=addslashes(str_replace("‘","'",$value));break;
                case "鞋头":$this->p_16=addslashes(str_replace("‘","'",$value));break;
                case "跟高":$this->p_17=addslashes(str_replace("‘","'",$value));break;
                case "鞋跟款式":$this->p_18=addslashes(str_replace("‘","'",$value));break;
                case "闭合方式":$this->p_19=addslashes(str_replace("‘","'",$value));break;
                case "流行元素":$this->p_20=addslashes(str_replace("‘","'",$value));break;
                case "制作工艺":$this->p_21=addslashes(str_replace("‘","'",$value));break;
                case "图案":$this->p_22=addslashes(str_replace("‘","'",$value));break;
                case "款式":$this->p_23=addslashes(str_replace("‘","'",$value));break;
                case "鞋跟形状":$this->p_24=addslashes(str_replace("‘","'",$value));break;
                case "适合场合":$this->p_25=addslashes(str_replace("‘","'",$value));break;
                case "鞋头款式":$this->p_26=addslashes(str_replace("‘","'",$value));break;
                case "后帮":$this->p_27=addslashes(str_replace("‘","'",$value));break;
                case "侧帮":$this->p_28=addslashes(str_replace("‘","'",$value));break;
                case "跟型":$this->p_29=addslashes(str_replace("‘","'",$value));break;
                case "帮高":$this->p_30=addslashes(str_replace("‘","'",$value));break;
                case "内里材质":$this->p_31=addslashes(str_replace("‘","'",$value));break;
                case "开口深度":$this->p_32=addslashes(str_replace("‘","'",$value));break;
                case "靴筒内里材质":$this->p_33=addslashes(str_replace("‘","'",$value));break;
                case "靴筒材质":$this->p_34=addslashes(str_replace("‘","'",$value));break;
            }
        }
 	function __get($props){
            return $this->$props;
        }
    }
?>
