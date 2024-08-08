<?php
$amouser='prazdnikmeda@yandex.ru';
$amoapikey='c99517eb0ce7d1fb908c4578af407f31';
$amohost='new55fe5dc4540c5';

require('class.amocrm2.php');
$amo=new amocrm2($amouser,$amoapikey,$amohost,1);

if (!$amo->authok) {
		$amo->debug("Authorizathion failed");
		return;
	}
$amo->debug("Request: ".print_r($_REQUEST,true));

//$amo->debug("Name='$name', Phone='$number', Email='$mail'");
if (!$amo->loadAccount()) {
   	$amo->debug("Error loadAccount");
	return;
	}
//$amo->debug("loadAccountData: ".print_r($amo->AccountDebug,true));
$amo->debug("LeadFields: ".print_r($amo->LeadFields,true));

$leadstatusid=$amo->getLeadStatusId('ЛИД первичный контакт');

				
if (!$uid=$amo->getUserId($amouser)) {
	$amo->debug('User '.$amouser.' not found');
	return;
	}

/*$amo->debug("Checking Contact...");           
$cid=$amo->checkContact(array('phone'=>$phone));
if ($cid===false)
	{
   	$amo->debug("checkContact(".$phone.") Error: ".$amo->Error);
	return;
   	}

if ($cid==-1) {
	$amo->debug("Contact not found");
	} else {
	$amo->debug("Found contact: $cid");
	}
*/
$data['name']='Заявка с сайта am-present.ru';
$data['Комментарий']=$param4;
$data['status_id']=$leadstatusid;

$amo->debug("Adding lead...");
if (!$lid=$amo->addLead($uid,$data)) {
	$amo->debug("addLead Error: ".$amo->Error);
	return;
   	}
$amo->debug("Lead added; LID=$lid");

$amo->debug("Adding contact...");
if (empty($param1))
	$cdata['name']=$param2;
else
	$cdata['name']=$param1;
$cdata['Email']=$param3;
$cdata['Телефон']=$param2;
$cdata['linked_leads_id']=array($lid);
if (!$cid=$amo->addContact($uid,$cdata)) {
	$amo->debug("addContact Error: ".$amo->Error);
	return;
      	}
$amo->debug("Contact added; CID=$cid");
	