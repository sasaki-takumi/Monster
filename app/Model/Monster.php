<?php
	class Monster extends Model{
		public $name = 'Monster';
		public $useTable = false;
	
		public function HotelInfo($type,$location){
			//施設情報を表示
			//morioka->盛岡市内
			//shizukuishi->雫石
			//appi->安比高原・八幡平・二戸
			//kuji->陸中海岸北部（久慈・宮古・岩泉）
			//ofunato->陸中海岸南部（大船渡・陸前高田・釜石）
			//kitakami->北上・花巻・遠野
			//ichinoseki->奥州・平泉・一関

			

			$ninohe = array(11,23);//二戸
			$iwate = array(0,1,2,3,4,5,6,7,8,9,10,12,13,14,16,17,18,19,20,21,22,24,25,26,27,28);//岩手町appi
			$shizukuishi = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29);//雫石
			$ichinoseki = array(0,4,6,7,12,13,15,17,19,22,23,25,26,27,29);//一関
			$kuji = array(0,3,4,6,8,14,16);//久慈
			$iwaizumi = array(2,7,21,25);//岩泉
			$miyako = array(1,9,10,11,13,15,17,18,22,23,24,28);//宮古
			$morioka = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29);//盛岡
			$hanamaki = array(5,6,7,10,11,12,15,17,18,19,20);//花巻
			$tono = array(2,7,13,14,24);//北上
			$kitakami = array(0,1,4,8,9,21,22,23,25,26,27,28,29);//北上


			$url2 = 'https://app.rakuten.co.jp/services/api/Travel/SimpleHotelSearch/20131024?format=json&largeClassCode=japan&middleClassCode=iwate&smallClassCode='.$type.'&applicationId=1073386405579335366';
			$json2 = file_get_contents($url2);
			$obj2 = json_decode($json2);


			//二戸
			if ($location == 'ninohe') {
				$Hotel = $ninohe[mt_rand(0,1)];

				$hotel[0] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelName;

				$hotel[1] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address1;
				$hotel[2] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address2;

				$hotel[3] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelImageUrl;
				$hotel[4] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->roomImageUrl;

				$hotel[5] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelMapImageUrl;

				return $hotel;
			}

			//岩手
			if ($location == 'iwate') {
				$Hotel = $iwate[mt_rand(0,25)];

				$hotel[0] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelName;

				$hotel[1] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address1;
				$hotel[2] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address2;

				$hotel[3] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelImageUrl;
				$hotel[4] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->roomImageUrl;

				$hotel[5] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelMapImageUrl;

				return $hotel;
			}

			//雫石
			if ($location == 'sizukuishi') {
				$Hotel = $shizukuishi[mt_rand(0,29)];

				$hotel[0] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelName;

				$hotel[1] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address1;
				$hotel[2] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address2;

				$hotel[3] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelImageUrl;
				$hotel[4] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->roomImageUrl;

				$hotel[5] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelMapImageUrl;

				return $hotel;
			}
			
			//一関
			if ($location == 'itinoseki') {
				$Hotel = $ichinoseki[mt_rand(0,14)];

				$hotel[0] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelName;

				$hotel[1] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address1;
				$hotel[2] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address2;

				$hotel[3] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelImageUrl;
				$hotel[4] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->roomImageUrl;

				$hotel[5] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelMapImageUrl;

				return $hotel;
			}

			//北上
			if ($location == 'kitakami') {
				$Hotel = $kitakami[mt_rand(0,12)];

				$hotel[0] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelName;

				$hotel[1] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address1;
				$hotel[2] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address2;

				$hotel[3] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelImageUrl;
				$hotel[4] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->roomImageUrl;

				$hotel[5] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelMapImageUrl;

				return $hotel;
			}

			//遠野
			if ($location == 'tono') {
				$Hotel = $tono[mt_rand(0,4)];

				$hotel[0] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelName;

				$hotel[1] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address1;
				$hotel[2] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address2;

				$hotel[3] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelImageUrl;
				$hotel[4] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->roomImageUrl;

				$hotel[5] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelMapImageUrl;

				return $hotel;
			}

			//花巻
			if ($location == 'hanamaki') {
				$Hotel = $hanamaki[mt_rand(0,10)];

				$hotel[0] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelName;

				$hotel[1] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address1;
				$hotel[2] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address2;

				$hotel[3] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelImageUrl;
				$hotel[4] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->roomImageUrl;

				$hotel[5] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelMapImageUrl;

				return $hotel;
			}

			//久慈
			if ($location == 'kuzi') {
				$Hotel = $kuji[mt_rand(0,6)];

				$hotel[0] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelName;

				$hotel[1] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address1;
				$hotel[2] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address2;

				$hotel[3] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelImageUrl;
				$hotel[4] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->roomImageUrl;

				$hotel[5] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelMapImageUrl;

				return $hotel;
			}

			//岩泉
			if ($location == 'iwaizumi') {
				$Hotel = $iwaizumi[mt_rand(0,3)];

				$hotel[0] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelName;

				$hotel[1] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address1;
				$hotel[2] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address2;

				$hotel[3] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelImageUrl;
				$hotel[4] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->roomImageUrl;

				$hotel[5] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelMapImageUrl;

				return $hotel;
			}

			//宮古
			if ($location == 'miyako') {
				$Hotel = $miyako[mt_rand(0,11)];

				$hotel[0] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelName;

				$hotel[1] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address1;
				$hotel[2] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address2;

				$hotel[3] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelImageUrl;
				$hotel[4] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->roomImageUrl;

				$hotel[5] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelMapImageUrl;

				return $hotel;
			}

			//盛岡
			if ($location == 'morioka') {
				$Hotel = $morioka[mt_rand(0,28)];

				$hotel[0] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelName;

				$hotel[1] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address1;
				$hotel[2] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->address2;

				$hotel[3] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelImageUrl;
				$hotel[4] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->roomImageUrl;

				$hotel[5] = $obj2->hotels[$Hotel]->hotel[0]->hotelBasicInfo->hotelMapImageUrl;

				return $hotel;
			}


		}
	}