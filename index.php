<?php
function getDollarPrice($param1='USD',$param2='EGP')
{



    $pram1=strtoupper($param1);

    $pram2=strtoupper($param2);



	$url="http://www.xe.com/ar/currencyconverter/convert/?Amount=1&From=$param1&To=$param2";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $data = curl_exec($curl);
    libxml_use_internal_errors(true);
    $dom = new \DomDocument();
    $dom->loadHTML($data);
    $classname="data-amount";
    $span=$dom->getElementsByTagName('span');
    $ret=[];
    foreach ($span as $item){
        if($item->getAttribute($classname))
            $ret[$classname]= floatval($item->getAttribute ($classname));
    }
    curl_close($curl);

    if(isset($ret['data-amount']))
    return $ret['data-amount'];
    else
        retrun -1;
	
}

echo getDollarPrice('SAR','EGP');