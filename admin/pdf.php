<?php
    session_start();
    include 'admin_url_check.php';
    require('../admin/fpdf/fpdf.php');
    $connect=mysqli_connect('localhost','root','');
    mysqli_select_db($connect,'fiesta_db');

    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
      
    $isDel = "";
    $tabName = $_GET["tab"];
    //get data from different table based on different keyword
    if($tabName == "item"){
        $isDel = "Item_isDelete";
        $query=mysqli_query($connect,"select * from $tabName WHERE $isDel = 0;");
    }

    if($tabName == "customer"){
        $isDel = "Cust_isDelete";
        $query=mysqli_query($connect,"select * from $tabName WHERE $isDel = 0 AND Cust_isVerify = 1");
    }

    if($tabName == "admin"){
        $isDel = "Adm_isDelete";
        $query=mysqli_query($connect,"select * from admin WHERE $isDel = 0 ");
    }

    if($tabName == "package"){
        $isDel = "Pack_isDelete";
        $query=mysqli_query($connect,"select * from $tabName WHERE $isDel = 0;");
    }

    if($tabName == "venue"){
        $isDel = "Event_Venue_isDelete";
        $query=mysqli_query($connect,"select * from event_venue WHERE $isDel = 0 AND Event_Venue_ID != 0");
    }

    if($tabName == "voucher"){
        $isDel = "Vouc_isDelete";
        $query=mysqli_query($connect,"select * from voucher WHERE $isDel = 0");
    }

    if($tabName=="booking" || $tabName == "booking2"){
        $query = mysqli_query($connect,"SELECT * FROM book WHERE  Book_isCheck = 1 AND Book_Status != 0;");
    }


    
    
    class PDF extends FPDF {
        public $tabName;

        function setTabName($tabName){
            $this->tabName=$tabName;
        }
        function getTabName(){
            return $this->tabName;
        }
        
        function Header(){
            $tabName = $this->getTabName();

            
            $this->SetFont('Arial','B',15);
            
            //dummy cell to put logo
            //$this->Cell(12,0,'',0,0);
            //is equivalent to:
            $this->Cell(20);
            
            //put logo
            $this->Image('../images/Logo.png',10,10,15);
            
            $this->Cell(100,13,''.ucfirst($tabName).' List',0,1);
            
            //dummy cell to give line spacing
            //$this->Cell(0,5,'',0,1);
            //is equivalent to:
            $this->Ln(5);
            
            $this->SetFont('Arial','',11);
            
            $this->SetFillColor(180,180,255);
            $this->SetDrawColor(180,180,255);

            if($tabName=="booking"){
                $this->Cell(10,5,'ID',1,0,'',true);
                $this->Cell(40,5,''.ucfirst($tabName).' Name',1,0,'',true);
                $this->Cell(37,5,'Customer',1,0,'',true);
                $this->Cell(20,5,' Payment',1,0,'',true);
                $this->Cell(20,5,'Discount',1,0,'',true);
                $this->Cell(28,5,'Voucher',1,0,'',true);
                $this->Cell(15,5,'B_P ID',1,0,'',true);
                $this->Cell(20,5,'Status',1,1,'',true);

            }

            if($tabName=="booking2"){
                $this->Cell(10,5,'B_ID',1,0,'',true);
                $this->Cell(47,5,'Items',1,0,'',true);
                $this->Cell(20,5,'Date',1,0,'',true);
                $this->Cell(20,5,'Time',1,0,'',true);
                $this->Cell(48,5,'Address',1,0,'',true);
                $this->Cell(45,5,'Theme Name',1,1,'',true);
            }

            if($tabName == "item"){
                $this->Cell(20,5,'ID',1,0,'',true);
                $this->Cell(55,5,''.ucfirst($tabName).' Name',1,0,'',true);
                $this->Cell(60,5,' Price',1,0,'',true);
                $this->Cell(55,5,'Admin Name',1,1,'',true);
            }

            if($tabName == "customer"){
                $this->Cell(10,5,'ID',1,0,'',true);
                $this->Cell(55,5,''.ucfirst($tabName).' Name',1,0,'',true);
                $this->Cell(70,5,''.ucfirst($tabName).' Email',1,0,'',true);
                $this->Cell(29,5,'Phone Number',1,0,'',true);
                $this->Cell(26,5,' Membership',1,1,'',true);
            }

            if($tabName=="admin"){
                $this->Cell(10,5,'ID',1,0,'',true);
                $this->Cell(45,5,''.ucfirst($tabName).' Name',1,0,'',true);
                $this->Cell(55,5,''.ucfirst($tabName).' Email',1,0,'',true);
                $this->Cell(54,5,'Phone Number',1,0,'',true);
                $this->Cell(26,5,'Staff ID',1,1,'',true);
            }

            if($tabName=="package"){
                $this->Cell(10,5,'ID',1,0,'',true);
                $this->Cell(40,5,''.ucfirst($tabName).' Name',1,0,'',true);
                $this->Cell(50,5,'Items List',1,0,'',true);
                $this->Cell(15,5,'Price',1,0,'',true);
                $this->Cell(35,5,'Event',1,0,'',true);
                $this->Cell(40,5,'Admin Name',1,1,'',true);
            }

            if($tabName=="venue"){
                $this->Cell(10,5,'ID',1,0,'',true);
                $this->Cell(40,5,''.ucfirst($tabName).' Name',1,0,'',true);
                $this->Cell(20,5,'Price',1,0,'',true);
                $this->Cell(80,5,'Address',1,0,'',true);
                $this->Cell(40,5,'Admin Name',1,1,'',true);
            }

            if($tabName == "voucher"){
                $this->Cell(10,5,'ID',1,0,'',true);
                $this->Cell(35,5,''.ucfirst($tabName).' Name',1,0,'',true);
                $this->Cell(30,5,'Code',1,0,'',true);
                $this->Cell(20,5,'Discount',1,0,'',true);
                $this->Cell(20,5,'Start',1,0,'',true);
                $this->Cell(20,5,'Expire',1,0,'',true);
                $this->Cell(20,5,'Status',1,0,'',true);
                $this->Cell(35,5,'Admin Name',1,1,'',true);
            }

        }
        function Footer(){
            //add table's bottom line
            $this->Cell(190,0,'','T',1,'',true);
            
            //Go to 1.5 cm from bottom
            $this->SetY(-15);
                    
            $this->SetFont('Arial','',8);
            
            //width = 0 means the cell is extended up to the right margin
            $this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
        }
    }
    
    
    //A4 width : 219mm
    //default margin : 10mm each side
    //writable horizontal : 219-(10*2)=189mm
    
    $pdf = new PDF('P','mm','A4'); //use new class
    $pdf->setTabName($tabName);
    
    //define new alias for total page numbers
    $pdf->AliasNbPages('{pages}');
    
    //$pdf->SetAutoPageBreak(true,15);
    $pdf->AddPage();
    
    $pdf->SetFont('Arial','',9);
    $pdf->SetDrawColor(180,180,255);
    
    
    while($data=mysqli_fetch_array($query)){

        if($tabName=="booking"){
            $CustID = $data['Book_Cust_ID'];
            $cust = mysqli_query($connect,"SELECT * FROM customer WHERE Cust_ID = '$CustID';");
            $custRow = mysqli_fetch_assoc($cust);
            $bookID=$data["Book_ID"];
            $pay = mysqli_query($connect,"SELECT * FROM payment WHERE Pay_Book_ID = '$bookID' AND Pay_Cust_ID = '$CustID' ;");
            $payRow = mysqli_fetch_assoc($pay);
            $pdf->Cell(10,5,$data['Book_ID'],1,0,'LR');
            $pdf->Cell(40,5,$data['Book_Event_Name'],1,0,'LR');
            $pdf->Cell(37,5,$custRow['Cust_Name'],1,0,'LR');
            $pdf->Cell(20,5,$payRow['Pay_Amount'],1,0,'LR');
            $pdf->Cell(20,5,$payRow['Pay_Discount_Amount'],1,0,'LR');
            $voucher="";
            if($payRow['Pay_Voucher']==null){
                $voucher="None";
            }else{
                $voucher=$payRow["Pay_Voucher"];
            }
            if($pdf->GetStringWidth($voucher)>28){
                $pdf->SetFont('Arial','',7);
                $pdf->Cell(28,5,$voucher,1,0,'LR');
                $pdf->SetFont('Arial','',9);
            }else{
                $pdf->Cell(28,5,$voucher,1,0,'LR');
            }
            $pdf->Cell(15,5,$data["Book_Pack_ID"],1,0,'LR');
            $var="";
            if($data['Book_Status']==1){
                $var = "Accepted";
            }else if($data['Book_Status']==2){
                $var = "Rejected";
            }else if($data['Book_Status']==3){
                $var = "Cancelled";
            }
            $pdf->Cell(20,5,$var,1,1,'LR');
        }

        if($tabName=="booking2"){
            //join up the address details
            $Address = $data["Book_Event_Venue_S_Address"].', '.$data["Book_Event_Venue_Area"].', '.$data["Book_Event_Venue_Pcode"].', '.$data["Book_Event_Venue_State"];
            $BPid = $data["Book_Pack_ID"];
            //get booking details and equipment details
            $BPitem=mysqli_query($connect,"SELECT * from book_package,equip_book_package where Equip_B_Pack_ID=Book_Pack_ID AND Book_Pack_ID = '$BPid'");
            $itemList = [];
            while($BPitemRow = mysqli_fetch_assoc($BPitem)){
                $itemID = $BPitemRow["Equip_B_Item_ID"];
                $itemName=mysqli_query($connect,"SELECT * from item where Item_ID = '$itemID' AND Item_isDelete = 0;");
                $itemRow = mysqli_fetch_assoc($itemName);
                array_push($itemList,$itemRow["Item_Name"]);
            }
            //join up the items
            $StrItemList = implode(", ",$itemList);

            $cellHeight=5;//normal one-line cell height
            $line = 1;
            //check whether the text is overflowing
            if($pdf->GetStringWidth($Address) < 48 && $pdf->GetStringWidth($StrItemList)<47){
                //if not, then do nothing
                $line=1;
            }else{

                $text = "";
                $textLength = 0;
                if($pdf->GetStringWidth($Address) >= 48 && $pdf->GetStringWidth($Address)>$pdf->GetStringWidth($StrItemList)){
                    $textLength=strlen($Address);
                    $text = $Address;
                }else if($pdf->GetStringWidth($StrItemList)>=47 && $pdf->GetStringWidth($StrItemList)>$pdf->GetStringWidth($Address)){
                    $textLength=strlen($StrItemList);
                    $text = $StrItemList;
                }
                    
                                    
                $errMargin=10;		//cell width error margin, just in case
                $startChar=0;		//character start position for each line
                $maxChar=0;			//maximum character in a line, to be incremented later
                $textArray=array();	//to hold the strings for each line
                $tmpString="";		//to hold the string for a line (temporary)
                
                while($startChar < $textLength){ //loop until end of text
                    //loop until maximum character reached
                    if($pdf->GetStringWidth($Address) >= 48 ){
                        while($pdf->GetStringWidth( $tmpString ) < (48-$errMargin) &&
                        ($startChar+$maxChar) < $textLength ) {
                            $maxChar++;
                            $tmpString=substr($text,$startChar,$maxChar);
                        }
                    }else if($pdf->GetStringWidth($StrItemList)>=47){
                        while($pdf->GetStringWidth( $tmpString ) < (47-$errMargin) &&
                        ($startChar+$maxChar) < $textLength ) {
                            $maxChar++;
                            $tmpString=substr($text,$startChar,$maxChar);
                        }
                    }
                    
                    //move startChar to next line
                    $startChar=$startChar+$maxChar;
                    //then add it into the array so we know how many line are needed
                    array_push($textArray,$tmpString);
                    //reset maxChar and tmpString
                    $maxChar=0;
                    $tmpString="";
                    $line = count($textArray);
                    
                    
                }
                //get number of line
                
            }
            //manually set the xy position for the next cell to be next to it.
            //remember the x and y position before writing the multicell
            $pdf->Cell(10,($line * $cellHeight),$data["Book_ID"],1);
            
            
            
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell(47,$cellHeight,$StrItemList,'TR');
            $pdf->SetXY($xPos + 47 , $yPos);
            $pdf->Cell(20,($line * $cellHeight),$data["Book_Event_Date"],1);
            // $pdf->MultiCell($cellWidth,$cellHeight,$data["Event_Venue_Name"],1);
            $pdf->Cell(20,($line * $cellHeight),$data["Book_Event_Time"],1);                                                                                              
            // $pdf->SetXY($xPos + $cellWidth , $yPos); //adapt height to number of lines
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell(48,$cellHeight,$Address,'LT');
            $pdf->SetXY($xPos + 48 , $yPos);

            if($pdf->GetStringWidth($data["Book_Event_Theme_Name"])>45){
                $pdf->SetFont('Arial','',7);
                $pdf->Cell(45,($line * $cellHeight),$data["Book_Event_Theme_Name"],1,1);
                $pdf->SetFont('Arial','',9);
            }else{
                $pdf->Cell(45,($line * $cellHeight),$data["Book_Event_Theme_Name"],1,1);
            }
            //$pdf->Ln($cellHeight*$line);
            //return the position for next cell next to the multicell
            //and offset the x with multicell width
        }

        if($tabName=="item"){
            $pdf->Cell(20,5,$data['Item_ID'],1,0,'LR');
            $pdf->Cell(55,5,$data['Item_Name'],1,0,'LR');
            $pdf->Cell(60,5,$data['Item_Price'],1,0,'LR');
            $adminID = $data["Item_Adm_ID"];
            $admin = mysqli_query($connect,"SELECT * FROM admin where Adm_ID = '$adminID' AND Adm_isDelete = 0;");
            $adminName = mysqli_fetch_assoc($admin);
            $pdf->Cell(55,5,$adminName["Adm_Name"],1,1,'LR');
        }

        if($tabName == "customer"){
            $pdf->Cell(10,5,$data['Cust_ID'],1,0,'LR');
            $pdf->Cell(55,5,$data['Cust_Name'],1,0,'LR');
            $pdf->Cell(70,5,$data['Cust_Email'],1,0,'LR');
            $pdf->Cell(29,5,$data['Cust_PhoneNo'],1,0,'LR');
            $membership = "";
            if($data["Cust_Membership"]==0){
                $membership = "Other";
            }else if($data["Cust_Membership"]==1){
                $membership = "Personal";
            }else if($data["Cust_Membership"]==2){
                $membership = "Company";
            }
            $pdf->Cell(26,5,$membership,1,1,'LR');
        }

        if($tabName=="admin"){
            $pdf->Cell(10,5,$data['Adm_ID'],1,0,'LR');
            $pdf->Cell(45,5,$data['Adm_Name'],1,0,'LR');
            $pdf->Cell(55,5,$data['Adm_Email'],1,0,'LR');
            $pdf->Cell(54,5,$data['Adm_PhoneNo'],1,0,'LR');
            $pdf->Cell(26,5,$data['Adm_Staff_ID'],1,1,'LR');
        }

        if($tabName=="package"){
            $pID = $data["Pack_ID"];
            $item=mysqli_query($connect,"SELECT * FROM equip_package where Equip_P_Pack_ID = '$pID' AND Equip_P_isDelete = 0");
            $adminID = $data['Pack_Adm_ID'];
            $height = 5*mysqli_num_rows($item);
            $itemName = [];
            while($itemRow = mysqli_fetch_assoc($item)){
                $itemID = $itemRow["Equip_P_Item_ID"];
                $iName=mysqli_query($connect,"SELECT * FROM item WHERE Item_ID = '$itemID' AND Item_isDelete = 0");
                $ITRow = mysqli_fetch_assoc($iName);
                array_push($itemName,$ITRow["Item_Name"]);
            }
            

            $eventID = $data["Pack_Event_ID"];
            $event = mysqli_query($connect,"SELECT * FROM events where Event_ID = '$eventID' AND Event_isDelete = 0");
            $eventName = mysqli_fetch_assoc($event);
            $admin = mysqli_query($connect,"SELECT * FROM admin where Adm_ID = '$adminID' AND Adm_isDelete = 0");
            $adminName = mysqli_fetch_assoc($admin);

            $cellWidth=50;//wrapped cell width
            $cellHeight=5;//normal one-line cell height
            $itemList = implode(", ",$itemName);
            //check whether the text is overflowing
            if($pdf->GetStringWidth($itemList) < $cellWidth){
                //if not, then do nothing
                $line=1;
            }else{
                //if it is, then calculate the height needed for wrapped cell
                //by splitting the text to fit the cell width
                //then count how many lines are needed for the text to fit the cell
                
                $textLength=strlen($itemList);	//total text length
                $errMargin=5;		//cell width error margin, just in case
                $startChar=0;		//character start position for each line
                $maxChar=0;			//maximum character in a line, to be incremented later
                $textArray=array();	//to hold the strings for each line
                $tmpString="";		//to hold the string for a line (temporary)
                
                while($startChar < $textLength){ //loop until end of text
                    //loop until maximum character reached
                    while($pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
                    ($startChar+$maxChar) < $textLength ) {
                        $maxChar++;
                        $tmpString=substr($itemList,$startChar,$maxChar);
                    }
                    //move startChar to next line
                    $startChar=$startChar+$maxChar;
                    //then add it into the array so we know how many line are needed
                    array_push($textArray,$tmpString);
                    //reset maxChar and tmpString
                    $maxChar=0;
                    $tmpString='';
                    
                }
                //get number of line
                $line=count($textArray);
            }
            
            //write the cells
            $pdf->Cell(10,($line * $cellHeight),$data["Pack_ID"],1,0); //adapt height to number of lines
            $pdf->Cell(40,($line * $cellHeight),$data["Pack_Name"],1,0); //adapt height to number of lines
            
            //use MultiCell instead of Cell
            //but first, because MultiCell is always treated as line ending, we need to 
            //manually set the xy position for the next cell to be next to it.
            //remember the x and y position before writing the multicell
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth,$cellHeight,$itemList,'T');
            
            //return the position for next cell next to the multicell
            //and offset the x with multicell width
            $pdf->SetXY($xPos + $cellWidth , $yPos);
            
             //adapt height to number of lines
            if($pdf->GetStringWidth($data["Pack_Price"])>15){
                $pdf->SetFont('Arial','',7);
                $pdf->Cell(15,($line * $cellHeight),$data["Pack_Price"],1,0);
                $pdf->SetFont('Arial','',9);
            }else{
                $pdf->Cell(15,($line * $cellHeight),$data["Pack_Price"],1,0);
            }
            $pdf->Cell(35,($line * $cellHeight),$eventName["Event_Name"],1,0);
            $pdf->Cell(40,($line * $cellHeight),$adminName["Adm_Name"],1,1);
        }

        if($tabName == "venue"){
            $cellWidth=80;//wrapped cell width
            $cellHeight=5;//normal one-line cell height
            $borderBtm = '';

            $Address = $data["Event_Venue_S_Address"].', '.$data["Event_Venue_Area"].', '.$data["Event_Venue_PCode"].', '.$data["Event_Venue_State"];
            $VenueName = $data["Event_Venue_Name"];
            //check whether the text is overflowing
            if($pdf->GetStringWidth($Address) < $cellWidth && $pdf->GetStringWidth($VenueName)<40){
                //if not, then do nothing
                $line=1;
            }else{
                //if it is, then calculate the height needed for wrapped cell
                //by splitting the text to fit the cell width
                //then count how many lines are needed for the text to fit the cell
                $text = "";
                $textLength = 0;
                if($pdf->GetStringWidth($Address) >= $cellWidth &&  $pdf->GetStringWidth($VenueName)<40){
                    $textLength=strlen($Address);
                    $text = $Address;
                }else if($pdf->GetStringWidth($VenueName)>=40 && $pdf->GetStringWidth($Address) < $cellWidth){
                    $textLength=strlen($VenueName);
                    $text = $VenueName;
                }
                    
                                    
                $errMargin=10;		//cell width error margin, just in case
                $startChar=0;		//character start position for each line
                $maxChar=0;			//maximum character in a line, to be incremented later
                $textArray=array();	//to hold the strings for each line
                $tmpString="";		//to hold the string for a line (temporary)
                
                while($startChar < $textLength){ //loop until end of text
                    //loop until maximum character reached
                    if($pdf->GetStringWidth($Address) >= $cellWidth){
                        while($pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
                        ($startChar+$maxChar) < $textLength ) {
                            $maxChar++;
                            $tmpString=substr($text,$startChar,$maxChar);
                        }
                    }else if($pdf->GetStringWidth($VenueName)>=40){
                        while($pdf->GetStringWidth( $tmpString ) < (40-$errMargin) &&
                        ($startChar+$maxChar) < $textLength ) {
                            $maxChar++;
                            $tmpString=substr($text,$startChar,$maxChar);
                        }
                    }
                    
                    //move startChar to next line
                    $startChar=$startChar+$maxChar;
                    //then add it into the array so we know how many line are needed
                    array_push($textArray,$tmpString);
                    //reset maxChar and tmpString
                    $maxChar=0;
                    $tmpString='';
                    $line = count($textArray);
                    
                    
                }
                //get number of line
                
            }
            //manually set the xy position for the next cell to be next to it.
            //remember the x and y position before writing the multicell

            $pdf->Cell(10,($line * $cellHeight),$data["Event_Venue_ID"],1,0); //adapt height to number of lines
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell(40,$cellHeight,$VenueName,'T');
            $pdf->SetXY($xPos + 40 , $yPos);
            
            // $pdf->MultiCell($cellWidth,$cellHeight,$data["Event_Venue_Name"],1);
                                                                                                                                                     
            // $pdf->SetXY($xPos + $cellWidth , $yPos); //adapt height to number of lines
            $pdf->Cell(20,($line * $cellHeight),$data["Event_Venue_Price"],1); 

            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth,$cellHeight,$Address,'T');
            //return the position for next cell next to the multicell
            //and offset the x with multicell width
            $pdf->SetXY($xPos + $cellWidth , $yPos);

            $adminID = $data["Event_Venue_Adm_ID"];
            $admin = mysqli_query($connect,"SELECT * FROM admin WHERE Adm_isDelete = 0 AND Adm_ID = '$adminID'");
            $adminName = mysqli_fetch_assoc($admin);
            $pdf->Cell(40,($line * $cellHeight),$adminName["Adm_Name"],1,1); //adapt height to number of lines
        }

        if($tabName == "voucher"){
            $pdf->Cell(10,5,$data["Vouc_ID"],1,0,'LR');
            $pdf->Cell(35,5,$data["Vouc_Name"],1,0,'LR');
            $pdf->Cell(30,5,$data["Vouc_Code"],1,0,'LR');
            $pdf->Cell(20,5,$data["Vouc_Discount"],1,0,'LR');
            $pdf->Cell(20,5,$data["Vouc_Start_Date"],1,0,'LR');
            $pdf->Cell(20,5,$data["Vouc_Exp_Date"],1,0,'LR');
            $stat = "";
            if($data["Vouc_Status"] == 0){
                $stat = "Active";
            }else if($data["Vouc_Status"] == 1){
                $stat = "Inactive";
            }
            $pdf->Cell(20,5,$stat,1,0,'LR');
            $adminID = $data["Vouc_Adm_ID"];
            $admin=mysqli_query($connect,"SELECT * FROM admin where Adm_ID = '$adminID'");
            $adminName = mysqli_fetch_assoc($admin);
            $pdf->Cell(35,5,$adminName["Adm_Name"],1,1,'');
        }
        
    }
    //output the result
    $pdf->Output();


?>