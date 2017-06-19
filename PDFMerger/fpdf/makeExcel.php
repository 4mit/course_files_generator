<?php
error_reporting(0);
if(isset($_GET['excel'])) 
{
$name = 'NewFile';
  //header("Content-length: $size");

$conn =  new mysqli("localhost","root","","dummy");

// Check connection
$SQL = "SELECT * from file";
$header = '';
$result ='';
$exportData = mysqli_query($conn,$SQL) or die ( "Sql error : " . mysqli_error( ) );
 
$fields = mysqli_num_fields ( $exportData );
 
for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysqli_fetch_field( $exportData , $i ) . "\t";
}
 
while( $row = mysqli_fetch_row( $exportData ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $result .= trim( $line ) . "\n";
}
$result = str_replace( "\r" , "" , $result );
 
if ( $result == "" )
{
    $result = "\nNo Record(s) Found!\n";                        
}
 
header('Content-disposition: attachment; filename='.'newFile.xls');
header("Content-Type: application/vnd.ms-excel");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$result";
}

?>