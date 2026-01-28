<?php
	class MaxValue extends IPSModule {

		public function Create()
		{
			//Never delete this line!
			parent::Create();

			$this->RegisterPropertyString("Variables", "");
		}

		public function Destroy()
		{
			//Never delete this line!
			parent::Destroy();
		}

		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();

			$ident = "Max";
			$this->RegisterVariableInteger($ident, $ident);

			$variables = $this->getRegisteredVariables();

			if($variables != NULL) {
				foreach($variables as $variable) {
					//IPS_LogMessage("MaxValue", sprintf("Registering to %d", $variable->VariableID));
					$this->RegisterMessage($variable->VariableID, VM_UPDATE);
				}
			}
		}

		public function MessageSink($timestamp, $senderId, $message, $data) {
			$variables = $this->getRegisteredVariables();
			if($variables == NULL) return;

			$variableIsValid = false;
			foreach($variables as $variable) {
				if($variable->VariableID == $senderId) {
					$variableIsValid = true;
					break;
				}
			}

			if(!$variableIsValid) {
				$this->UnregisterMessage($senderId, VM_UPDATE);
				IPS_LogMessage("MaxValue", sprintf("Unregistered from sender %d", $senderId));
				return;
			}

			$maxValue = $this->calculateMaxValue();
			$this->SetValue("Max", $maxValue);
			//IPS_LogMessage("MaxValue", "Message from SenderID ".$senderId." with Message ".$message."\r\n Data: ".print_r($data, true));
		}

		private function calculateMaxValue() {
			$maxValue = null;

			$variables = $this->getRegisteredVariables();
			foreach($variables as $variable) {
				if(!IPS_VariableExists($variable->VariableID)) {
					IPS_LogMessage("MaxValue", sprintf("Skipping %d: variable does not exist", $variable->VariableID));
					continue;
				}
				$value = GetValueInteger($variable->VariableID);
				if($maxValue === null || $value > $maxValue) {
					$maxValue = $value;
				}
			}

			return $maxValue ?? 0;
		}

		private function getRegisteredVariables() {
			$variablesJson = $this->ReadPropertyString("Variables");
			$result = json_decode($variablesJson);
			return (json_last_error() == JSON_ERROR_NONE) ? $result : NULL;
		}

	}