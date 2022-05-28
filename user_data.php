<?php
$name = $_POST ["name"];
$email = $_POST ["email"];
$dob = $_POST ["date"];
$gender = $_POST ["gender"];
$country = $_POST ["country"];



if(isset($_POST["submit"]))
{

$filename = "./userdata.csv";	

$file_open = fopen($filename, "a");
$no_rows = count(file($filename));
if($no_rows > 1)
{
$no_rows = ($no_rows - 1) + 1;
}
$form_data = array(
'sr_no' => $no_rows,
'name' => $name,
'email' => $email,
'date' => $dob,
'gender' => $gender,
'country' => $country
);

fputcsv($file_open, $form_data, ",");
fclose($file_open);



$filename2 = "./userdata.csv";


$file_open2 = fopen($filename2, "r");



function csv_content_parser($content4) {
	foreach (explode("\n", $content4)as $line){
		yield str_getcsv($line);
	}
}

$content4 = file_get_contents('./userdata.csv');
$data =array();
foreach (csv_content_parser($content4) as $fields) {
	array_push($data, $fields);
}


//It works just fine now, initially I thought I had to return the latest input in the userdata.csv file, but it turns out all I had to do was just print_r the form input, I hope I am right

print_r( "SN: ".$form_data['sr_no'].
"<br/> Name: ".$form_data['name'].
"<br/>Email: ".$form_data['email'].
"<br/>Date of Birth: ".
$form_data['date'].
"<br/>Gender: ".$form_data['gender'].
"<br/>Country: ".$form_data['country']);


	fclose($file_open2);

}


?>
