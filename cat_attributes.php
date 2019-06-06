<?php

if(isset($_POST['cID']))
{
	$pdo = new PDO("mysql:dbname=rzmwqvsukr;host=localhost", "rzmwqvsukr", "5Cp6dCPhMJ");
	$statement = $pdo->prepare("SELECT eav_attribute.attribute_id, eav_attribute.attribute_code FROM eav_attribute WHERE eav_attribute.attribute_id IN (  SELECT catalog_eav_attribute.attribute_id FROM catalog_eav_attribute WHERE catalog_eav_attribute.is_filterable = 1 ) AND eav_attribute.attribute_id IN (SELECT eav_entity_attribute.attribute_id FROM eav_entity_attribute JOIN catalog_product_entity ON eav_entity_attribute.attribute_set_id = catalog_product_entity.attribute_set_id JOIN catalog_category_product ON catalog_product_entity.entity_id = catalog_category_product.product_id WHERE catalog_category_product.category_id = ".$_POST['cID'].");");
	$statement->execute();
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);
	//print_r($results);
	$json = json_encode($results);
	echo $json;
}

?>