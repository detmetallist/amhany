<?php
class amocrm2 {
	const BASE_url='amocrm.ru';
	const AUTH_url='/private/api/auth.php?type=json';
	const ACCOUNT_url='/private/api/v2/json/accounts/current';
	const LEAD_url='/private/api/v2/json/leads/set';
	const CONTACT_url='/private/api/v2/json/contacts/set';
	const CONTACT_UPDATE_url='/private/api/v2/json/contacts/set';
	const CONTACT_GET_url='/private/api/v2/json/contacts/list';
	const UNSORTED_url='/api/unsorted/add';
	const TASK_url='/private/api/v2/json/tasks/set';
	const NOTE_url='/private/api/v2/json/notes/set';
	//const USER_login='';
	//const USER_hash='';
	//const Cookie_file='amocrmcookie.txt';
	const Cookie_file='amocrm.cookie.txt';
   	const Debug_file='amo-debug.log';

	public $Error='';
	public $curlError='';
	public $curlCode='';
	public $curlURL='';
	public $curlReturn='';
	public $curlRequest='';
	public $curlDebug;
	public $curlDebugMode=1;
	public $accUrl='';
	public $debug=0;
	public $authok=0;
	public $login='';
	public $hash='';

	public $ContactFields=array();
	public $LeadFields=array();
	public $LeadStatuses=array();
	public $Users=array();
	public $TaskTypes=array();
	public $AccountDebug=array();

public function normalizePhone($phone)
   {
   $int=0;
   $phone=trim($phone);
   if (strpos($phone,'+')===0) //РЅР°С‡РёРЅР°РµС‚СЃСЏ СЃ +
      {
      $int=1;
      }
   $phone = preg_replace('/[^\d]/', '', $phone);
   $len=strlen($phone);
   if (!$int)
      {
      if ($len==11)
         $phone = preg_replace('/^8/', '7', $phone);
      elseif ($len==10)
         $phone='+7'.$phone;
      }
   if ($int) 
      $phone='+'.$phone;

   return $phone;
   }


	public function curlData($url,$method,$data=null) {
		$fail=0;	
		$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
		#Устанавливаем необходимые опции для сеанса cURL
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
		if (stripos($url,$this->accUrl)===false)
			$url=$this->accUrl.$url;
/*		if (stripos($url,'type=json')===false) {
			if (stripos($url,'?')===false)
				$url.='?';
			else 
				$url.='&';
			$url.='type=json';
			}*/
		$this->curlURL=$url;
		curl_setopt($curl,CURLOPT_URL,$url);

		if (strtoupper($method)!=='POST' && strtoupper($method)!=='GET') {
			curl_setopt($curl,CURLOPT_CUSTOMREQUEST,$method);
			}
			
		if (strtoupper($method)==='POST') {
			curl_setopt($curl,CURLOPT_POST,true);
			curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($data));
			$this->curlRequest=json_encode($data);
			//echo $this->curlRequest."<br>";
			}

		//curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
		curl_setopt($curl,CURLOPT_HEADER,false);
		curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/'.self::Cookie_file); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
		curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/'.self::Cookie_file); #PHP>5.3.6 dirname(__FILE__) -> __DIR__

		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
		
		if ($this->curlDebugMode) {
			curl_setopt($curl, CURLOPT_VERBOSE, true);
			$verbose = fopen(dirname(__FILE__).'/curldebug.log', 'w');
			curl_setopt($curl, CURLOPT_STDERR, $verbose);
			}

		$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
		//$this->debug("CurlData:() RowResponse is ".print_r($out,true));
		$this->curlReturn=urldecode($out);
		//$this->debug("Curl Returned: {$this->curlReturn}");

		$this->curlCode=curl_getinfo($curl,CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера

		if ($this->curlDebugMode) {
			$this->curlDebug=curl_getinfo($curl);
			}

		if (!$out && $this->curlCode!='204') {
			$this->curlError=curl_error($curl);
			$this->Error="Curl Error: $this->curlError";
			$this->debug("Curl Error: $this->curlError");
			$fail=1;
			}
		if (!$this->checkResponseCode($this->curlCode,$out))
			$fail=1;

		curl_close($curl); #Заверашем сеанс cURL

		if ($fail)
			{
			return false;
			}
		
      if ($this->curlCode!='204')
         return $this->decodeResponse($out);
      else
         return true;
		}

	public function decodeResponse($response) {
		if (!is_array($response=json_decode(urldecode($response),true)))
			return false;
		if (!isset($response['response']))
			return false;
		return $response['response'];
		}
		
	public function doAuth($user,$hash) {
		$userdata=array(
	  		'USER_LOGIN'=>$user, #Ваш логин (электронная почта)
  			'USER_HASH'=>$hash, #Хэш для доступа к API (смотрите в профиле пользователя)
			);
		$res=$this->curlData(self::AUTH_url,'post',$userdata);
		if (is_array($res) && isset($res['auth']) && $res['auth']==1)
			{
		$this->debug("Ok");
			return true;
			}
		else 
		    {
         $this->debug("Failed");
         return false;
         }
		}

	public function checkResponseCode($code,$out='') {
		$code=(int)$code;
		$oldError=$this->curlError;
		$errors=array(
			301=>'Moved permanently',
			400=>'Bad request',
			401=>'Unauthorized',
			403=>'Forbidden',
			404=>'Not found',
			500=>'Internal server error',
			502=>'Bad gateway',
			503=>'Service unavailable'
			);
		#Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке
		if($code!=200 && $code!=204) {
         if (isset($errors[$code]))
			   $this->curlError=$errors[$code];
         else
			   $this->curlError="Неизвестная ошибка $code";
         if (!empty($out)) {
            $out=json_decode($out,true);
            if (isset($out['response']['error'])) {
               $this->curlError.=" Error value: '".$out['response']['error']."'";
               }
            }
         if (!empty($oldError))
            $this->curlError.=" Curl response error: $oldError";
         return false;
         }
		return true;
		}
		
	public function __construct($user,$hash,$url,$debug=0) {
		mb_internal_encoding("UTF-8");
		$this->accUrl='https://'.$url.'.'.self::BASE_url;
		$this->debug=$debug;
		if ($this->debug==1) {
	      		$this->df=fopen(self::Debug_file,'a');
	      		$this->debug("AmoCrm2 API initialized");
         		}
		$this->login=$user;
		$this->hash=$hash;
		if ($this->doAuth($user,$hash)) {
         		$this->authok=1;
         		}
	}

   public function fatal($s) {
      $o="Fatal error: $s\n";
      $o.="Debug information:\n";
      if (!empty($this->Error)) {
         $o.="ERROR={$this->Error}\n";
         }
	//$o.="Task Type list:\n";
	//$o.=print_r($amocrm->TaskTypes,true)."\n";
      //$o.="Account Debug Information:\n";
      //$o.=print_r($this->AccountDebug,true)."\n";
      //$o.="Lead Statuses list:\n";
      //$o.=print_r($this->LeadStatuses,true)."\n";
      $o.="Curl debug information:\n";
      $o.="CURL CODE={$this->curlCode}\n";
      if (!empty($this->curlError)) {
         $o.="CURL ERROR={$this->curlError}\n";
         }
      $o.="URL={$this->curlURL}\n";
      $o.="REQUEST is:\n";
      $o.=print_r(json_decode(urldecode($this->curlRequest),true),true)."\n";
      $o.="RETURN is:\n";
      $o.=print_r(json_decode(urldecode($this->curlReturn),true),true)."\n";
      $o.="DEBUG is:\n";
      $o.=print_r(json_decode(urldecode($this->curlDebug),true),true)."\n";
      $this->debug($o);
      }

   public function debug($s) {
	if ($this->debug)
      	fputs($this->df,$s."\n");

      }

   public static function debugstatic($s) {
      $f=fopen(self::Debug_file,'a');
      fputs($f,$s."\n");
      }


	public function loadAccount() {
		if (!$res=$this->curlData(self::ACCOUNT_url,'get'))
			return false;
		$this->AccountDebug=$res;
		$account=$res['account'];
		//echo 'Users: <pre>'.print_r($account['users'],true).'</pre>';
		foreach ($account['users'] as $user) {
			$u['login']=$user['login'];
			$u['id']=intval($user['id']);
			$u['name']=isset($user['name']) ? $user['name'] : '';
			$u['lastname']=isset($user['lastname']) ? $user['lastname'] : '';
			$this->Users[$u['id']]=$u;
			}

		foreach ($account['leads_statuses'] as $lead) {
			$l['name']=$lead['name'];			
			$l['id']=$lead['id'];			
			$l['color']=$lead['color'];			
			$l['editable']=$lead['editable'];
			$this->LeadStatuses[$l['id']]=$l;			
			}

		foreach ($account['custom_fields'] as $cfn=>$cfd) {
			if ($cfn=='contacts') {
				foreach ($cfd as $cf) {
				        $c['id']=intval($cf['id']);
					$c['name']=$cf['name'];
					$c['code']=$cf['code'];
					$c['type']=intval($cf['type_id']);
					$c['multiple']=$cf['multiple']=='Y' ? 1 : 0;
					$c['subfields']=array();
					if ($c['multiple']) {
						foreach ($cf['enums'] as $ei=>$ed) {
							$c['subfields'][$ei]=$ed;
							}
						}
					$this->ContactFields[$c['id']]=$c;
					}
				}
			if ($cfn=='leads') {
				foreach ($cfd as $cf) {
				        $c['id']=intval($cf['id']);
					$c['name']=$cf['name'];
					$c['code']=$cf['code'];
					$c['type']=intval($cf['type_id']);
					$c['multiple']=$cf['multiple']=='Y' ? 1 : 0;
					$c['subfields']=array();
					if ($c['multiple']) {
						foreach ($cf['enums'] as $ei=>$ed) {
							$c['subfields'][$ei]=$ed;
							}
						}
					if (isset($cf['subtypes'])) {
						$c['subtypes']=array();
						foreach ($cf['subtypes'] as $sti=>$std) {
							$c['subtypes'][]=$std['name'];
							}
						}
					
					$this->LeadFields[$c['id']]=$c;
					unset($c);
					}
				}
			}
		foreach ($account['task_types'] as $task) {
			$t['id']=intval($task['id']);
			$t['name']=isset($task['name']) ? $task['name'] : '';
			$t['code']=isset($task['code']) ? $task['code'] : '';
			$this->TaskTypes[$t['id']]=$t;
			}
      		$this->debug("loadAccount(): AccountData: ".print_r($account,true));      

		return true;
		}

	function getUserId($login) {
		if (!is_array($this->Users))
			return false;
		foreach ($this->Users as $uid=>$user) {
			if (strtolower($user['login'])==strtolower($login))
				return $uid;
			}
		return false;
		}
	
	function getContactFieldId($name) {
		if (!is_array($this->ContactFields))
			return false;
		foreach ($this->ContactFields as $cfid=>$cfv) {
			//echo "checking ".mb_strtolower($cfv['name'])." against ".mb_strtolower($name)."<br>";
			if (mb_strtolower($cfv['name'])===mb_strtolower($name))
				return $cfid;
			}
		return false;
		}

	function getContactFieldSubs($id) {
		if (!is_array($this->ContactFields))
			return false;
		if (isset($this->ContactFields[$id]) && $this->ContactFields[$id]['multiple']==1)
			return $this->ContactFields[$id]['subfields'];
		else
			return false;
		}

	function getLeadFieldId($name) {
		$this->debug("getLeadFieldId(): looking for $name...");
		if (!is_array($this->LeadFields))
			return false;
		foreach ($this->LeadFields as $cfid=>$cfv) {
			//echo "checking ".mb_strtolower($cfv['name'])." against ".mb_strtolower($name)."<br>";
			if (mb_strtolower($cfv['name'])===mb_strtolower($name))
				return $cfid;
			}
		return false;
		}

	function getLeadStatusId($name) {
		$this->debug("getLeadStatusId(): looking for $name...");
		if (!is_array($this->LeadStatuses))
			return false;
		foreach ($this->LeadStatuses as $cfid=>$cfv) {
			//echo "checking ".mb_strtolower($cfv['name'])." against ".mb_strtolower($name)."<br>";
			if (mb_strtolower($cfv['name'])===mb_strtolower($name))
				return $cfid;
			}
		return false;
		}

	function getLeadFieldSubs($id) {
		$this->debug("getLeadFieldSubs(): looking for $id...");
		if (!is_array($this->LeadFields))
			return false;
		if (isset($this->LeadFields[$id]) && $this->LeadFields[$id]['multiple']==1)
			return $this->LeadFields[$id]['subfields'];
		else
			return false;
		}

	function getLeadFieldSubtypes($id) {
		$this->debug("getLeadFieldSubtypes(): looking for $id...");
		if (!is_array($this->LeadFields))
			return false;
		if (isset($this->LeadFields[$id]) && isset($this->LeadFields[$id]['subtypes']))
			return $this->LeadFields[$id]['subtypes'];
		else
			return false;
		}


	function getTaskTypeId($name) {
		if (!is_array($this->TaskTypes))
			return false;
		foreach ($this->TaskTypes as $ttid=>$ttv) {
			//echo "checking ".mb_strtolower($cfv['name'])." against ".mb_strtolower($name)."<br>";
			if (mb_strtolower($ttv['name'])===mb_strtolower($name))
				return $ttid;
			}
		return false;
		}

	function addContact($login,$params) {
		$paramNames=array(
			'name'=>array('id'=>0,'value'=>'','subfield'=>''),
			//'company_name'=>array('id'=>0,'value'=>''),
			'responsible_user_id'=>array('id'=>0,'value'=>$login),
			'linked_leads_id'=>array('id'=>0,'value'=>array()),
			//
			//'телефон'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),
			//'email'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),
			//'источник'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),
			//'фраза'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),*/
			);

		if (!is_array($params)) {
			$this->Error='addContact(): Invalid paramaters';
			return false;
			}
			
		foreach ($params as $pn=>$pv) {
			//echo "processing $pn=>$pv<br>";
			if (isset($paramNames[mb_strtolower($pn)])) {
				//echo "found $pn<br>";
				if (is_string($pv))
               $paramNames[mb_strtolower($pn)]['value']=trim($pv);
            else
               $paramNames[mb_strtolower($pn)]['value']=$pv;
				}
			else {
				//echo "Not found $pn<br>";

				$paramNames[mb_strtolower($pn)]['id']=0;
				$paramNames[mb_strtolower($pn)]['custom']=1;
				if (is_string($pv))
               $paramNames[mb_strtolower($pn)]['value']=trim($pv);
            else
               $paramNames[mb_strtolower($pn)]['value']=$pv;
				}
			}

		foreach ($paramNames as $pi=>$pv) {
			if (isset($pv['custom'])) {
				if ($id=$this->getContactFieldId($pi)) {
					$paramNames[$pi]['id']=$id;
					if ($subfields=$this->getContactFieldSubs($id)) {
						//print_r($subfields);
						$ff=reset($subfields);
						$paramNames[$pi]['subfield']=$ff;
						}
					}
				else {
					$this->Error="addContact(): Couldn't get ID for ContactCustomField name '$pi'";
					return false;
					}	
				}
			}
			
		if (empty($paramNames['name']['value'])) {
			$this->Error='addContact(): Contact name not specified';
			return false;
			}

		$data=array();
		//$data['request']['contacts']['add']['name']=$paramNames['name']['value'];
		foreach ($paramNames as $pi=>$pv) {
			if (!isset($pv['custom']))
				$mdata[$pi]=$pv['value'];				
			}

		foreach ($paramNames as $pi=>$pv) {
			if (isset($pv['custom']) && $pv['id']>0) {
				if (empty($pv['subfield']))
					$cfdata=array('id'=>$pv['id'],'values'=>array(array('value'=>$pv['value'])));
				else
					$cfdata=array('id'=>$pv['id'],'values'=>array(array('value'=>$pv['value'],'enum'=>$pv['subfield'])));
				$mdata['custom_fields'][]=$cfdata;
				}
			}
      
      $data['request']['contacts']['add'][]=$mdata;
      $this->debug("AddContact(): Data: ".print_r($data,true));      

		//echo "DATA=<pre>".print_r($data,true)."</pre>";

		if (!$res=$this->curlData(self::CONTACT_url,'post',$data)) {
			$this->Error='addContact(): Curl returned error: '.$this->curlError;
			return false;
			}
		//echo "DATA=<pre>".print_r($res,true)."</pre>";		
		if (!isset($res['contacts']['add'][0]['id'])) {
			$this->Error='addContact(): invalid response from Curl';
			return false;
			}
		$this->debug("addContact(): returned ".print_r($res,true));
		$this->debug("addContact(): CID is ".$res['contacts']['add'][0]['id']);
		return intval($res['contacts']['add'][0]['id']);
		}	
	
	function updateContact($cid,$login,$params) {
		$paramNames=array(
			'name'=>array('id'=>0,'value'=>'','subfield'=>''),
			'company_name'=>array('id'=>0,'value'=>''),
			//'responsible_user_id'=>array('id'=>0,'value'=>$login),
			'linked_leads_id'=>array('id'=>0,'value'=>array()),
			//
			'телефон'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),
			//'email'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),
			//'источник'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),
			//'фраза'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),*/
			);

		if (!is_array($params)) {
			$this->Error='updateContact(): Invalid paramaters';
			return false;
			}
			
		foreach ($params as $pn=>$pv) {
			//echo "processing $pn=>$pv<br>";
			if (isset($paramNames[mb_strtolower($pn)])) {
				//echo "found $pn<br>";
				if (is_string($pv))
               $paramNames[mb_strtolower($pn)]['value']=trim($pv);
            else
               $paramNames[mb_strtolower($pn)]['value']=$pv;
				}
			else {
				//echo "Not found $pn<br>";

				$paramNames[mb_strtolower($pn)]['id']=0;
				$paramNames[mb_strtolower($pn)]['custom']=1;
				if (is_string($pv))
               $paramNames[mb_strtolower($pn)]['value']=trim($pv);
            else
               $paramNames[mb_strtolower($pn)]['value']=$pv;
				}
			}

		foreach ($paramNames as $pi=>$pv) {
			if (isset($pv['custom'])) {
				if ($id=$this->getContactFieldId($pi)) {
					$paramNames[$pi]['id']=$id;
					if ($subfields=$this->getContactFieldSubs($id)) {
						//print_r($subfields);
						$ff=reset($subfields);
						$paramNames[$pi]['subfield']=$ff;
						}
					}
				else {
					$this->Error="updateContact(): Couldn't get ID for ContactCustomField name '$pi'";
					return false;
					}	
				}
			}

		//if (empty($paramNames['name']['value'])) {
		//	$this->Error='updateContact(): Contact name not specified';
		//	return false;
		//	}

      $mdata['id']=$cid;
      $mdata['last_modified']=time();
      
		$data=array();
		//$data['request']['contacts']['add']['name']=$paramNames['name']['value'];
		foreach ($paramNames as $pi=>$pv) {
			if (!isset($pv['custom']) && !empty($pv['value']))
				$mdata[$pi]=$pv['value'];				
			}


		foreach ($paramNames as $pi=>$pv) {
			if (isset($pv['custom']) && $pv['id']>0 && !empty($pv['value'])) {
				if (empty($pv['subfield']))
					$cfdata=array('id'=>$pv['id'],'values'=>array(array('value'=>$pv['value'])));
				else
					$cfdata=array('id'=>$pv['id'],'values'=>array(array('value'=>$pv['value'],'enum'=>$pv['subfield'])));
				$mdata['custom_fields'][]=$cfdata;
				}
			}
      

      $data['request']['contacts']['update'][]=$mdata;
      $this->debug("UpdateContact(): Data: ".print_r($data,true));      

		//echo "DATA=<pre>".print_r($data,true)."</pre>";

		if (!$res=$this->curlData(self::CONTACT_UPDATE_url,'post',$data)) {
			$this->Error='updateContact(): Curl returned error: '.$this->curlError;
			return false;
			}
		$this->debug('updateContact(): Response:'.print_r($res,true));
		//echo "DATA=<pre>".print_r($res,true)."</pre>";		
		//if (!isset($res['contacts']['update'][0]['id'])) {
		//	$this->Error='updateContact(): invalid response from Curl';
		//	return false;
		//	}
		$this->debug("updateContact() returned: ".print_r($res,true));
		//return intval($res['contacts']['update'][0]['id']);
		return true;
		}	


	function addLead($login,$params) {
		$paramNames=array(
			'name'=>array('id'=>0,'value'=>'','subfield'=>''),
			//'company_name'=>array('id'=>0,'value'=>''),
			'responsible_user_id'=>array('id'=>0,'value'=>$login),
			'status_id'=>array('id'=>0,'value'=>0),
			'price'=>array('id'=>0,'value'=>0),
			//'linked_leads_id'=>array('id'=>0,'value'=>array()),
			//
			//'телефон'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),
			//'email'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),
			//'источник'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),
			//'фраза'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),*/
			'tags'=>array('id'=>0,'tags'=>1,'value'=>''),
			);

		if (!is_array($params)) {
			$this->Error='addLead(): Invalid paramaters';
			return false;
			}
			
		foreach ($params as $pn=>$pv) {
			//echo "processing $pn=>$pv<br>";
			if (isset($paramNames[mb_strtolower($pn)])) {
				//echo "found $pn<br>";
				if (is_string($pv))
               				$paramNames[mb_strtolower($pn)]['value']=trim($pv);
            			else
               				$paramNames[mb_strtolower($pn)]['value']=$pv;
				}
			else {
				//echo "Not found $pn<br>";
				
				$paramNames[mb_strtolower($pn)]['id']=0;
				$paramNames[mb_strtolower($pn)]['custom']=1;
				if (is_array($pv)) {
					foreach ($pv as $pvn=>$pvv) {
						$paramNames[mb_strtolower($pn)]['foundsubtypes'][mb_strtolower($pvn)]=$pvv;
						//$this->debug("Set foundsubtypes data $pvn to $pvv");
						}
					}
				elseif (is_string($pv))
               				$paramNames[mb_strtolower($pn)]['value']=trim($pv);
            			else
               				$paramNames[mb_strtolower($pn)]['value']=$pv;
				}
			}

		foreach ($paramNames as $pi=>$pv) {
			if (isset($pv['custom'])) {
				if ($id=$this->getLeadFieldId($pi)) {
					$paramNames[$pi]['id']=$id;
					if ($subfields=$this->getLeadFieldSubs($id)) {
						//print_r($subfields);
						$ff=reset($subfields);
						$paramNames[$pi]['subfield']=$ff;
						}
					if ($subtypes=$this->getLeadFieldSubtypes($id)) {
						//print_r($subfields);
						//$this->debug("Got subtypes ".print_r($subtypes,true));
						//$this->debug("Foundsubtypes=".print_r($paramNames[$pi]['foundsubtypes'],true));
						foreach ($subtypes as $stn=>$std) {
							$this->debug("Cheking subtype $std...");
							if (isset($paramNames[$pi]['foundsubtypes'][mb_strtolower($std)])) {
								//$this->debug("Found subtype $std!");
								$paramNames[$pi]['subtypes'][$std]=$paramNames[$pi]['foundsubtypes'][mb_strtolower($std)];
								}
							}
						}
					}
				else {
					$this->Error="addLead(): Couldn't get ID for LeadCustomField name '$pi'";
					return false;
					}	
				}
			}

		if (empty($paramNames['name']['value'])) {
			$this->Error='addLead(): Lead name not specified';
			return false;
			}

		$data=array();
		//$data['request']['contacts']['add']['name']=$paramNames['name']['value'];

		//if (!$leadstatusid=$this->getLeadStatusId('Первичный Контакт'))
		//	{
		//	$this->Error="addLead(): Couldn't get ID for LeadStatus name 'Первичный Контакт'";
		//	return false;
		//	}
		//else
		//	{
		//	$mdata['status_id']=$leadstatusid;
		//	}
		$mdata['status_id']=0;
		//foreach ($this->Users as $ud)
		//	{
		//	if ($ud['login']==$login)
		//		{
		//		$mdata['status_id']=$ud['id'];
		//		break;				
		//		}
		//	}

		//$mdata['price']=2000;
		$mdata['tags']='';
		
		foreach ($paramNames as $pi=>$pv) {
			if (isset($pv['tags']))
				{
				$tags=explode(',',$pv['value']);
				foreach ($tags as $ti=>$t)
					{
					trim($t,"'");
					$tags[$ti]="'$t'";
					}
				$mdata[$pi]=implode(',',$tags);
				}				
			}

		foreach ($paramNames as $pi=>$pv) {
			if (!isset($pv['custom']))
				$mdata[$pi]=$pv['value'];				
			}

		foreach ($paramNames as $pi=>$pv) {
			if (isset($pv['custom']) && $pv['id']>0) {
				if (!empty($pv['subfield']))
					$cfdata=array('id'=>$pv['id'],'values'=>array(array('value'=>$pv['value'],'enum'=>$pv['subfield'])));
				elseif (isset($pv['subtypes'])) {
					//$this->debug("Found subtypes for $pi");
					$cfdata=array('id'=>$pv['id'],'values'=>array());
					foreach ($pv['subtypes'] as $stn=>$std) {
						$cfdata['values'][]=array('value'=>$std,'subtype'=>$stn);
						}
					//$this->debug("cfdata=".print_r($cfdata,true));
					}
				else					
					$cfdata=array('id'=>$pv['id'],'values'=>array(array('value'=>$pv['value'])));


				$mdata['custom_fields'][]=$cfdata;
				}
			}

                $data['request']['leads']['add'][]=$mdata;
               	$this->debug("addLead(): Data=".print_r($data,true));
		//echo "DATA=<pre>".print_r($data,true)."</pre>";

		if (!$res=$this->curlData(self::LEAD_url,'post',$data)) {
			$this->Error='addLead(): Curl returned error: '.$this->curlError;
			return false;
			}
		$this->debug("addLead() returned ".print_r($res,true));
		//echo "DATA=<pre>".print_r($res,true)."</pre>";		
		if (!isset($res['leads']['add'][0]['id'])) {
			$this->Error='addLead(): invalid response from Curl';
			return false;
			}
			
		$this->debug("addLead(): LID is ".$res['leads']['add'][0]['id']);
		return intval($res['leads']['add'][0]['id']);
		}
	
	function addNote($type,$lid,$note) {
		$mdata = array(
        	'element_id' => $lid,
        	'element_type' => $type,
        	'note_type' => 4,
        	'text' => $note,
        	//'responsible_user_id' => $this->getLeadStatusId('Первичный Контакт'),
		);

		$data['request']['notes']['add'][] = $mdata;
		if (!$res=$this->curlData(self::NOTE_url,'post',$data)) {
			$this->Error='addNote(): Curl returned error: '.$this->curlError;
			return false;
			}
		if (!isset($res['notes']['add'][0]['id'])) {
			$this->Error='addNote(): invalid response from Curl';
			return false;
			}
		$this->debug("addNote(): returned ".print_r($res,true));
		$this->debug("addNote(): NID is ".$res['notes']['add'][0]['id']);
		return intval($res['notes']['add'][0]['id']);
		}

	function addTaskForContact($uid,$cid,$type,$text) {
		
		$data=array();
		//$data['request']['contacts']['add']['name']=$paramNames['name']['value'];
                if (!$tid=$this->getTaskTypeId($type)) {
			$this->Error="addTaskForContact(): TaskTypeId not found for TaskType '$type'";
			return false;
			}
		
		$mdata['element_id']=$cid;
		$mdata['element_type']=1;
		$mdata['task_type']=$tid;
		$mdata['text']=$text;
		$mdata['responsible_user_id']=$uid;
                $mdata['complete_till']=time()+7*24*60*60; //неделя


		$data['request']['tasks']['add'][]=$mdata;
		//echo "DATA=<pre>".print_r($data,true)."</pre>";
		
		if (!$res=$this->curlData(self::TASK_url,'post',$data)) {
			$this->Error='addTaskForContact(): Curl returned error: '.$this->curlError;
			return false;
			}
		//echo "DATA=<pre>".print_r($res,true)."</pre>";		
		if (!isset($res['tasks']['add'][0]['id'])) {
			$this->Error='addTaskForContact(): invalid response from Curl';
			return false;
			}
		return intval($res['tasks']['add'][0]['id']);
		}

	function checkContact($fields,$doall=false) {

	$this->debug("CheckContact(): looking for '".print_r($fields['phone'],true)."'");
      $data=array();
      $found=0;
      if (!is_array($fields) || !isset($fields['phone']))
			{
			$this->Error="checkContact(): Phone query is not set'";
			$this->debug="checkContact(): Phone query is not set'";
			return false;
			}
	$fields['phone']=trim($fields['phone']);
	$fields['phone']=trim($fields['phone'],'+');
	$res=$this->curlData(self::CONTACT_GET_url."?query={$fields['phone']}",'get',$data);
	$this->debug("checkContact() returned ".print_r($res,true));
	if (!$res) {
		$this->Error='checkContact(): Curl returned error: '.$this->curlError;
		$this->debug('checkContact(): Error: '.$this->curlError);
		return false;
	}
      
	if (isset($res['contacts']) && count($res['contacts'])>0)
		{
		//$this->getContactFieldId('Телефон');
		foreach ($res['contacts'] as $c=>$v)
			{
			//$this->debug("Contacts: ".print_r($v,true));
			foreach ($v['custom_fields'] as $cc=>$vv) 
               			{
				foreach ($vv['values'] as $ccc=>$vvv)
					{
					//$this->debug("checking '{$vvv['value']}' against '{$fields['phone']}'");
					if (trim($vvv['value'])==$fields['phone'])
						{
						//$this->debug("Found: ".$vvv['value']);
						$found=1;
						break;
						}
					}
				if ($found)
					break;
               			}
			if ($found)
				return $v['id'];
			}
		if (!$found)
			{
			$this->debug('Contact not found');
			return -1;
			}

		}
	else
		{
		$this->debug('Contact not found');
		return -1;
		}
	}
   
   function loadContact($cid) {
   
      $data=array();
		$paramNames=array(
			'name'=>array('id'=>0,'value'=>'','subfield'=>''),
			'company_name'=>array('id'=>0,'value'=>''),
			'responsible_user_id'=>array('id'=>0,'value'=>''),
			'linked_leads_id'=>array('id'=>0,'value'=>array()),
			//
			'телефон'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),
			'email'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),
			//'источник'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),
			//'фраза'=>array('id'=>0,'custom'=>1,'value'=>'','subfield'=>''),*/
			);
   
		if (!$res=$this->curlData(self::CONTACT_GET_url."?id={$cid}",'get',$data)) {
			$this->Error='loadContact(): Curl returned error: '.$this->curlError;
			$this->debug('loadContact(): Error: '.$this->curlError);
			return false;
         }
      
      //$this->debug("loadContact(): Res=".print_r($res,true));
      
      if (count($res)==0)
         {
         $this->debug("loadContact(): Contact $cid not found");
         return -1;
         }
         
      $data=array();
		foreach ($paramNames as $pn=>$pv) {
				//echo "processing $pn=>$pv<br>";
			
			if ($pv['custom']=1)
			   {
			   if (isset($res['contacts'][0][$pn]))
			      {
			      if (!is_array($res['contacts'][0][$pn]))
   			      $data[$pn]=$res['contacts'][0][$pn];
   			   else
   			      $data[$pn]=$res['contacts'][0][$pn];
			      }
			   else
			      {
			      foreach ($res['contacts'][0]['custom_fields'] as $cfn=>$cfv)
			         {
                  if (mb_strtolower($pn)==mb_strtolower($cfv['name']))
                     {
                     $data[$pn]=$cfv['values'][0]['value'];
                     }
			         }
			      }
				}
         }
      $this->debug("loadContact(): Data=".print_r($data,true));
      return $data;
      }

	function addUnsorted($leaddata,$contactdata,$category,$source,$uid) {
      $phoneid=$this->getContactFieldId('телефон');
				
      $data['request']['unsorted']=array(
         'category'=>'sip',
         'add'=>array(
            array(
               'source'=>686,
               'source_uid'=>'a1fee7c0fc436088e64ba2e8822ba2b3',
               'date_create'=>time(),
               'data'=>array(
                  'leads'=>array(
                     array(
                        'name'=>$leaddata['name'],
                        ),
                     ),
                  'contacts'=>array(
                     array(
                        'name'=>$contactdata['name'],
                        'custom_fields' => array(
                           array(
                              'id'     => $phoneid,
                              'values' => array(
                                 array(
                                    'enum'  => 'WORK',
                                    'value' => '79951234567',
                                    ),
                                 ),                        
                              ),
                           ),
                        ),
                     ),
                  ),
               'source_data' => array(
                  'from'     => '79951234567',
                  'to'       => $uid,
                  'date'     => time(),
                  'duration' => 5,
                  'link'     => 'http://anycan.ru',
                  'service'  => 'CkKwPam6',               
                  ),
               ),        
            ),
         );

      $this->debug("addUnsorted(): Data: ".print_r($data,true));
         
		if (!$res=$this->curlData(self::UNSORTED_url.'?login='.$this->login.'&api_key='.$this->hash,'post',$data)) {
			$this->Error='addUnsorted(): Curl returned error: '.$this->curlError;
			$this->debug('addUnsorted(): Error: '.$this->curlError);
			return false;
         }
      $this->debug("addUnsorted(): Res: ".print_r($res,true));
      return true;         
      }

   public function listUnsorted() {
      $url='/api/unsorted/list/';
      $data=array();
		if (!$res=$this->curlData($url.'?login='.$this->login.'&api_key='.$this->hash,'get',$data)) {
			$this->Error='listUnsorted(): Curl returned error: '.$this->curlError;
			$this->debug('listUnsorted(): Error: '.$this->curlError);
			return false;
         }
      $this->debug('listUnsorted(): Res: '.print_r($res,true));

      }

	//End of class amocrm2	
	}
?>