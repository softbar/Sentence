<?php
/** Sentence Modul
 * @author Xaver Bauer
 * @version 1.0
 * @date 15.03.2020
 * @desc Dieses Modul ermöglicht es, aus einfachen Wortlisten mit wenigen wörtern,
 * viele unterschiedliche (teils sehr witzige) Sätze zu bilden.
 */
class Sentence extends IPSModule {
	private const MAX_SEUQENZES = 12;
	function Create() {
		parent::Create();
		for($j=0;$j<self::MAX_SEUQENZES;$j++){
			$this->RegisterPropertyString('Words'.$j, '[]');
		}
		$this->RegisterPropertyInteger('EchoRemoteID', 0);
		$this->RegisterPropertyInteger('MaxSequences', 4);
		$this->RegisterPropertyInteger('ListRowCount', 0);
	}
	function GetConfigurationForm(){
		$form = json_decode(file_get_contents(__DIR__.'/form.json'));
		$form->elements[]=["type"=> "Label","name"=>"InfoLabel", "caption"=>sprintf($this->Translate("With the current settings, %s different text variations are possible"),$this->GetMaxVariations())]; 
		
		$row_def = ["type"=>"RowLayout", "items"=> []];
		$list_def= ["type"=>"List",	"name"=> "Words0","caption"=>"Sentence begin with",
					"add"=> true,"delete"=> true,"sort"=> ["column"=> "word","direction"=> "ascending"],
					"columns"=> [["name"=> "word","caption"=> "Definition",	"width"=> "130px","add"=> "","edit"=> ["type"=> "ValidationTextBox","validate"=> "\w+"]]]
				];
		if($rowCount=$this->ReadPropertyInteger('ListRowCount')){
			$list_def['rowCount']=$rowCount;
		}
		$max = $this->ReadPropertyInteger('MaxSequences');
		for($j=0;($j<$max && $j<self::MAX_SEUQENZES);$j++){
			$row=$row_def;
			for($col=0;$col<4;$col++){
				$no=$j+$col;
				$list=$list_def;
				if($no>0){
					$list['name']="Words$no";
					$list['caption']="next Sentence fragment";
				}
				$row['items'][]=$list;
				if($no>=$max || $no> self::MAX_SEUQENZES)break;
			}
			$j+= $col-1;
			$form->elements[]=$row;
		}
		$row_def['items'][]=["type"=> "Button","caption"=> "Text Output","onClick"=> 'echo SENTENCE_Get($id);'];
		
		$options = IPS_GetInstanceListByModuleID('{496AB8B5-396A-40E4-AF41-32F4C48AC90D}');
		if(!empty($options)){
			foreach($options as $ind=>$id)$options[$ind]=['label'=>IPS_GetName($id),'value'=>$id];
			array_unshift($options, ['label'=>"Not selected",'value'=>0]);
			$form->elements[0]->items[]=["type"=>"Select","name"=>"EchoRemoteID", "caption"=>"Output to Echo Remote device", "options"=>$options];
			if($this->ReadPropertyInteger('EchoRemoteID'))
				$row_def['items'][]=["type"=>"Button","caption"=>"Speak","onClick"=>'echo SENTENCE_Speak($id);'];
		}
// 		$row_def['items'][]=["type"=> "Label","name"=>"InfoLabel", "caption"=>sprintf($this->Translate("There are %s possible output variations"),$this->GetMaxVariations())]; 
		$form->actions=[$row_def];
		return json_encode($form);
	}
	/** Erstellt einen zufälligen Text
	 * @return string Ein zufälliger Text oder leer wenn keine Texte Konfiguriert sind
	 */
	public function Get(){
		return $this->CreateSentence();
	}
	/** Spricht einen zufälligen Text, falls eine EchoRemot Instance im Modul gewählt wurde
	 * @return string|boolean Wenn kein Echo Konfiguriert ist den Text wie mit Get, anderenfalls das Ergenis des aufrufs von ECHOREMOTE_TextToSpeak
	 */
	public function Speak(){
		$sentence=$this->CreateSentence();
		if(!empty($sentence) && ($echoRemoteID=$this->ReadPropertyInteger('EchoRemoteID'))){
			if(IPS_InstanceExists($echoRemoteID) && function_exists('ECHOREMOTE_TextToSpeech')){
				$this->SendDebug(__FUNCTION__,"to Echo => $sentence",0);
				return ECHOREMOTE_TextToSpeech($echoRemoteID,$sentence);
			}
		}
		return $sentence;
	}
	private function GetMaxVariations(){
		$max = $this->ReadPropertyInteger('MaxSequences');
		$sum=0;
		for($j=0;($j<$max && $j<self::MAX_SEUQENZES) ;$j++){
			if($j>=self::MAX_SEUQENZES) break;
			$c=count(json_decode($this->ReadPropertyString('Words'.$j)));
			if($c)$sum= $sum ? $sum * $c : $c;
		}
		return $sum;
	}
	private function CreateSentence(){
		$sentence=[];
		$max = $this->ReadPropertyInteger('MaxSequences');
		for($j=0;($j<$max && $j<self::MAX_SEUQENZES);$j++){
			$a = json_decode($this->ReadPropertyString('Words'.$j));
			if(!empty($a))$sentence[]= $a[random_int(0, count($a)-1)]->word;
		}
		return implode(' ',$sentence);
	}
}

?>