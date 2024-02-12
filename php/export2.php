<?php 

session_start();

// Fetch records from database 
$conn=mysqli_connect("127.0.0.1","ccgroup3","f2b5rfFQhhgA","ccgroup3");
//prendo le variabili da sessione
$contoID=$_SESSION['contoID'];
$startdate=$_SESSION["startdate"];
$enddate=$_SESSION["enddate"];
//$query = $conn->query("SELECT * FROM TMovimentiContoCorrente "); 
 
$query = $conn->prepare("SELECT TC.DescrizioneEstesa, TC.Saldo, TC.Data, TC.Importo, CM.NomeCategoria 
FROM TMovimentiContoCorrente TC
JOIN TCategorieMovimenti CM ON TC.CategoriaMovimentoID = CM.CategoriaMovimentoID
WHERE TC.ContoCorrenteID = ?
AND TC.Data BETWEEN ? AND ?
ORDER BY TC.Data DESC");

$query->bind_param("iss",$contoID, $startdate, $enddate);
$query->execute();
$result = $query->get_result();

if($result->num_rows > 0){ 
    $delimiter = ","; 
    //$filename = "members-data_" . date('Y-m-d') . ".csv"; 
    $filename="export-search.csv";
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array( 'Date', 'Amaunt', 'Balance', 'Movement Category', 'Description'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    //"SELECT TC.DescrizioneEstesa, TC.Saldo, TC.Data, TC.Importo, CM.NomeCategoria FROM TMovimentiContoCorrente TC JOIN TCategorieMovimenti CM ON TC.CategoriaMovimentoID = CM.CategoriaMovimentoID WHERE TC.ContoCorrenteID = ? ORDER BY TC.MovimentoID DESC LIMIT ?"
    while($row = $result->fetch_assoc()){ 
        //$status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['Data'], $row['Importo'], $row['Saldo'], $row['NomeCategoria'], $row['DescrizioneEstesa']); 
        // + , $status all'array lineData se capisci cosa fa $status
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
mysqli_close($conn);
exit; 
 
?>
