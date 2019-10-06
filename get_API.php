<?php
	function fetchData($apiURL){
		$data = file_get_contents($apiURL);
		$oferty = json_decode($data,true);
		$work = '';
		foreach ($oferty['data'] as $id => $values) {
				$categories='';
					foreach($values["categories"] as $category){
						$categories.=$category;
					}
				$positions='';
					foreach($values["positions"] as $position){
						$positions.=$position;
					}
				$cities='';
					foreach($values["cities"] as $city){
						$cities.=$city;
					}
				$content='';
					$content.="<h3>".$values["content"]["title"]."</h3>";
					$content.="<p>".$values["content"]["content"]."</p>";
					$content.="<a href='".$values["content"]["apply_url"]."'><button class='btn' >aplikowac</button></a>";

				$kontakty='<hr><span>Napisac do menegera: </span><ul>';
					foreach($values["exports"] as $kontakt){
						$kontakty.= "<li><a href='mailto:" . $kontakt['contact_person_email'] . "'>" . $kontakt['contact_person'] . "</a></li>";
					}
				$kontakty.='</ul>';
				echo '
					<style>
					 .card{
					 	border: 1px solid black;
					 	border-radius: 3px;
					 	padding: 20px;
					 	width: 200px;
					 	margin: 5px;
					 }
					 .m-1{
					 	margin: 1px;
					 }
					 .d-flex{
					 	display:flex;
					 }
					 .btn{
					 	border-radius: 5px;
					 	border: none;
					 	padding: 10px;
					 	background-color: orange;
					 }
					</style>
				';

				$oferta='<div class="card">';
					$oferta.= "<h5 class='m-1'>".$categories."</h5>";
					$oferta.= "<h5 class='m-1'>".$positions."</h5>";
					$oferta.= "<h5 class='m-1'>".$cities."</h5>";
					$oferta.= "<div>".$content."</div>";
					$oferta.= "<div>".$kontakty."</div>";
				$oferta.='</div>';

				$work.=$oferta;
		}
		echo '<div class="d-flex">'.$work.'</div>';
	}
	
	fetchData('https://demo.appmanager.pl/api/v1/ads?_format=json');
?>