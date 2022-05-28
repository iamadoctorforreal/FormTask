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





$content = fread($file_open2, filesize($filename2));

$content2[] = fgetcsv($file_open2, filesize($filename2), ",");



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

print_r($data);

//The two lines below have refused to print the last input in my CSV file.
//So, I keep trying to solve it.

print_r (end($data));
print_r ($data[array_key_last($data)]);


	fclose($file_open2);

}


?>
