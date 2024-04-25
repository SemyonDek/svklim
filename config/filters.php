<?
    if (isset($_GET['sort']) && $_GET['sort'] !== '') {
        $sort = 'ORDER BY `PRICE` '.$_GET['sort'];
    } else $sort = '';
    
    if (isset($_GET['search']) && $_GET['search'] !== '') {
        $search = '%'.$_GET['search'].'%';
        $searchStr = "AND (
        `NAME` LIKE '$search')";
    } else $searchStr = '';
    
    if(isset($_GET['idchildcat']) && $_GET['idchildcat'] !== '') {
        $idChildProd = "AND `IDCAT` = '". $_GET['idchildcat'] ."'";

    } else $idChildProd = '';


    if(isset($_GET['min_price']) && ($_GET['min_price'] !== '') )
    {
        $min_prod_mass = $_GET['min_price'];;
    } else {
        $min_prod_mass = 0;
    }

    if(isset($_GET['max_price']) && ($_GET['max_price'] !== '') )
    {
        $max_prod_mass = $_GET['max_price'];
    } else {
        $max_prod_mass = 3000000000;
    }

    $class = [1, 2, 3, 4];
    $str_class = "AND (";
    $i = 0;
    foreach($class as $key => $item_class) {
        if (isset($_GET['class'][$key])) {
            if ($i > 0) {
                $str_class .= " OR CLASS = '". $item_class ."'";
                $i++;
            } else {
                $str_class .= "CLASS = '". $item_class ."'";
                $i++;
            }
        }
    }
    $str_class .= ")";
    if ($i == 0) {
        $str_class = "";
        
    }
    
    $str_producer = "AND (";
    $i = 0;
    foreach($producer as $key => $item_producer) {
        if (isset($_GET['producer'][$key])) {
            if ($i > 0) {
                $str_producer .= " OR PRODUCER = '". $item_producer ."'";
                $i++;
            } else {
                $str_producer .= "PRODUCER = '". $item_producer ."'";
                $i++;
            }
        }
    }
    $str_producer .= ")";
    if ($i == 0) {
        $str_producer = "";
        
    }
    
    $str_series = "AND (";
    $i = 0;
    foreach($series as $key => $item_series) {
        if (isset($_GET['series'][$key])) {
            if ($i > 0) {
                $str_series .= " OR SERIES = '". $item_series ."'";
                $i++;
            } else {
                $str_series .= "SERIES = '". $item_series ."'";
                $i++;
            }
        }
    }
    $str_series .= ")";
    if ($i == 0) {
        $str_series = "";
        
    }

?>