<?php

declare(strict_types=1);
class DMP64 extends IPSModule
{
		public function Create()
		{
			//Never delete this line!
			parent::Create();
			$this->RegisterPropertyString('IPAddress', '192.168.1.1');
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
		}
		
		function SetInputGain(int $channel, float $valuedb)
		{
			$channel = $this->GetChannelId($channel,0,5);
			$value = $this->ScaleVolume($valuedb, -18 ,1868,2848);
			// 1868 ... 2848  -> -18dB ... 80dB
			$command = "Wg4000".$channel."*".$value."AU%7C";
			$this->SendCommand($command);
		}
		function SetInputMute(int $channel, bool $mute)
		{
			$channel = $this->GetChannelId($channel,0,5);

			$command = "WM4000".$channel."*".IntFromBool($mute)."AU%7C";
			$this->SendCommand($command);
		}
		
		function SetPreMixerGain(int $channel, float $valuedb)
		{
			$channel = $this->GetChannelId($channel,0,5);
			$value = $this->ScaleVolume($valuedb, -100 ,1048,2168);
			// 1048 ... 2168  -> -100dB ... 12dB
			$command = "Wg4010".$channel."*".$value."AU%7C";
			$this->SendCommand($command);
		}
		function SetPreMixerMute(int $channel, bool $mute)
		{
			$channel = $this->GetChannelId($channel,0,5);

			$command = "WM4010".$channel."*".IntFromBool($mute)."AU%7C";
			$this->SendCommand($command);
		}
		function SetOutputGain(int $channel, float $valuedb)
		{
			$channel = $this->GetChannelId($channel,0,3);
			$value = $this->ScaleVolume($valuedb, -100 ,1048,2048);
			// 1048 ... 2168  -> -100dB ... 12dB
			$command = "Wg6000".$channel."*".$value."AU%7C";
			$this->SendCommand($command);
		}
		function SetOutputMute(int $channel, bool $mute)
		{
			$channel = $this->GetChannelId($channel,0,3);
						
			$command = "WM6000".$channel."*".IntFromBool($mute)."AU%7C";
			$this->SendCommand($command);
		}
		function SetVirtualReturnGain(int $channel, float $valuedb)
		{
			$channel = $this->GetChannelId($channel,0,5);
			$value = $this->ScaleVolume($valuedb, -100 ,1048,2168);
			// 1048 ... 2168  -> -100dB ... 12dB
			$command = "Wg5000".$channel."*".$value."AU%7C";
			$this->SendCommand($command);
		}
		function SetVirtualReturnMute(int $channel, bool $mute)
		{
			$channel = $this->GetChannelId($channel,0,5);
		
			$command = "WM5000".$channel."*".IntFromBool($mute)."AU%7C";
			$this->SendCommand($command);
		}
		
		function SetMixPointGain(int $channelfrom,int $channelto, float $valuedb)
		{
			$channelfrom = $this->GetChannelId($channelfrom,0,9);
			$channelto = $this->GetChannelId($channelto,0,7);
			$value = $this->ScaleVolume($valuedb, -35 ,1698,2298);
			
			// 1048 ... 2168  -> -100dB ... 12dB
			$command = "Wg20".$channelfrom."0".$channelto."*".$value."AU%7C";
			$this->SendCommand($command);
		}
		function SetMixPointMute(int $channelfrom,int $channelto, bool $mute)
		{
			$channelfrom = $this->GetChannelId($channelfrom,0,9);
			$channelto = $this->GetChannelId($channelto,0,7);
			
			
			$command = "WM20".$channelfrom."0".$channelto."*".IntFromBool($mute)."AU%7C";
			$this->SendCommand($command);
		}
		
		function LoadPreset(int $preset)
		{
			if($preset>32 || $preset<1)
			{
				$this->SendDebug('LoadPreset()', 'Invalid preset' , 0);
				echo "Invalid preset";
				die;
			}
			$command = $preset.".";
			$this->SendCommand($command);
		}
		
		private function ScaleVolume(float $valuedb, float $minvaluedb ,int $min,int $max)
		{
			$value = intval(( $valuedb - $minvaluedb )*10 + $min) ;
			if($value < $min)
				$value = $min;
			if($value > $max)
				$value =$max;
			return $value;
		}
		
		private function GetChannelId($channel,$min,$max)
		{
			$channel = $channel-1;
			if($channel>$max || $channel<$min)
			{
				$this->SendDebug('GetChannelId()', 'Invalid channel' , 0);
				echo "Invalid channel";
				die;
			}
			return $channel;
		}
		
		private function IntFromBool(bool $input)
		{
			if($input)
				return 1; 
			return 0; 

		}
		
		
		function SendCommand(string $command)
		{
		$this->SendDebug('SendCommand()', 'Command: ' . $command , 0);

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://'.$this->ReadPropertyString('IPAddress').'/api.html?cmd='.$command,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			));
		$response = curl_exec($curl);

		curl_close($curl);

		$this->SendDebug('SendCommand()', 'Response: ' . $response , 0);

		return ($response=="ok");
		}
}