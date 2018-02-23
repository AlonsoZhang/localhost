<?php


include 'Classes/PHPExcel/IOFactory.php';

$_REQUEST["FileName"] = 'N71 AE Limits Rev B.xlsx';

if(isset($_REQUEST["FileName"]))
{
   $inputFileName = "file/".$_REQUEST["FileName"];
   $objPHPExcel   = PHPExcel_IOFactory::load($inputFileName);
   $sheetData     = $objPHPExcel->setActiveSheetIndex(1)->toArray(null,true,true,true);
   
   $Stations      = "DP";
      
   $KeywordStations = "TestSpec_RSW_Tossing,TestSpec_RCW_Tossing,TestSpec_LBFW_Tossing,TestSpec_RBFW_Tossing,TestSpec_CGS_Snap Pass/Fail,TestSpec_CGS_Vision Pass/Fail,TestSpec_CGS_Machine Pass/fail,TestSpec_CGS_Post CG Pick Tossing,TestSpec_CGS_Pre CG Pick Tossing";

   $CaptureStations = "TestSpec_Battery3in1_Battery_Toss_1_SN,TestSpec_Battery3in1_Battery_Toss_2_SN,TestSpec_Battery3in1_Battery_Toss_3_SN";

   $DoifelseStations = "TestSpec_CIM_Before_Actual-Cal_Gap-X,TestSpec_CIM_Before_Press_X_Gap,TestSpec_CIM_Before_Actual-Cal_Gap-R,TestSpec_CIM_Before_Press_R_Gap,TestSpec_CIM_Actual-Cal_Gap-X,TestSpec_CIM_After_Press_X_Gap,TestSpec_CIM_Actual-Cal_Gap-R,TestSpec_CIM_After_Press_R_Gap";
                
   $NameMatch     = array();
   $NameMatch['RSW']    = 'TestSpec_RSW';
   $NameMatch['RCW']    = 'TestSpec_RCW';
   $NameMatch['IT-RS1'] = 'TestSpec_IT-RS1';
   $NameMatch['IT-RS2'] = 'TestSpec_IT-RS2';

   $NameMatch['MBA']      = 'TestSpec_MBA';
   $NameMatch['MBO']      = 'TestSpec_MBO';
   $NameMatch['PFR']      = 'TestSpec_PFR';
   $NameMatch['SA-IT-CG'] = 'TestSpec_SA-IT-CG';

   $NameMatch['LFW']        = 'TestSpec_LBFW';
   $NameMatch['RFW']        = 'TestSpec_RBFW';
   $NameMatch['CIM']        = 'TestSpec_CIM';
   $NameMatch['Mic2']       = 'TestSpec_MMV';
   $NameMatch['DP']         = 'TestSpec_DP2';
   $NameMatch['SMS']        = 'TestSpec_SMM';
   $NameMatch['SA-IT-HSG1'] = 'TestSpec_SA-IT-HSG1';
   $NameMatch['SA-IT-HSG2'] = 'TestSpec_SA-IT-HSG2';

   $NameMatch['RCAM Install']        = 'TestSpec_RCAM';
   $NameMatch['Battery 3-in-1 POR']  = 'TestSpec_Battery3in1';
   $NameMatch['CDP']                 = 'TestSpec_CDP';
   $NameMatch['HDP']                 = 'TestSpec_HDP';
   $NameMatch['AAA']                 = 'TestSpec_AAA';
   $NameMatch['CGS']                 = 'TestSpec_CGS';

   $NameMatch['STOM']         = 'TestSpec_STOM';
   $NameMatch['IT-CG']        = 'TestSpec_IT-CG';
   $NameMatch['IT4']          = 'TestSpec_IT-4';
   $NameMatch['IT-HSG1']      = 'TestSpec_IT-HSG1';
   $NameMatch['IT-HSG2']      = 'TestSpec_IT-HSG2';

   $NameMatch['LASER ETCH']      = 'TestSpec_LASER-ETCH';


$ERROR = '';



   $TotleCount    = 0 ; 
   $TotleStations = "";
   $Body          = "";

   $StationsSpec  = array();
   for ($i=1; $i <= count($sheetData) ; $i++)
{
   if ( checkstr($Stations,$sheetData[$i][B]) ) 
   {
      $Items           = array();
      $StationName = $sheetData[$i][B];
      $StationName = $NameMatch[ $StationName ]; 
 
      $Body=$Body.'<table border="1">';
      $Body=$Body.'<tr><td colspan="6">'.$StationName .'</td></tr>';
     
      

      $index = 1;
      foreach( $sheetData[$i+1] as $key => $value)
      {
            if( $value != null )
            {  
               $index++;
               if ($index > 2) 
               {
                  
                   // USpec
                   if ( $sheetData[$i+2][$key] == "" || $sheetData[$i+2][$key] == "N/A" || is_null($sheetData[$i+2][$key]) ) 
                   {
                      if( $sheetData[$i+2][$key] != "0" )
                      {
                        $sheetData[$i+2][$key] = "NA";
                      }
                   }


                   // LSpec
                   if ( $sheetData[$i+4][$key] == ""  || $sheetData[$i+4][$key] == "N/A"|| is_null($sheetData[$i+4][$key])) 
                   {
                      if( $sheetData[$i+4][$key] != "0" )
                      {
                        $sheetData[$i+4][$key] = "NA";
                      }
                   }
                    

                   // Units
                    if ( strlen($sheetData[$i+5][$key]) > 8 || is_null($sheetData[$i+5][$key]) ||  $sheetData[$i+5][$key] == "NA" ||  $sheetData[$i+5][$key] == "N/A" || $sheetData[$i+5][$key] == "1, 0" || $sheetData[$i+5][$key] == "1,0") 
                   {
                      $sheetData[$i+5][$key] = "";
                   }
                   else
                   {
                      $sheetData[$i+5][$key] = preg_replace('/^( |\s)*|( |\s)*$/', '',$sheetData[$i+5][$key]); 
                   }

                   $Body=$Body."<tr>";
                   $Body=$Body.'<td>'.$index.'</td>';
                   $Body=$Body.'<td>'.$sheetData[$i+1][$key].'</td>';
                   $Body=$Body.'<td>'.$sheetData[$i+2][$key].'</td>';
                   $Body=$Body.'<td>'.$sheetData[$i+3][$key].'</td>';
                   $Body=$Body.'<td>'.$sheetData[$i+4][$key].'</td>';
                   $Body=$Body.'<td>'.$sheetData[$i+5][$key].'</td>';
                   $Body=$Body."</tr>";


                    if ($sheetData[$i+2][$key] == "NA" && $sheetData[$i+4][$key] == "NA" && $sheetData[$i+2][$key] != "0" && $sheetData[$i+4][$key] != "0") {
                      if ( checkstr($CaptureStations,$StationName."_".$sheetData[$i+1][$key]) ) 
                      {
                        $Item = array("TestItem"=>(string)$sheetData[$i+1][$key],"ItemType"=>"Capture","USpec"=>"","LSpec"=>"","Units"=>""); 
                      }
                      else if ( checkstr($KeywordStations,$StationName."_".$sheetData[$i+1][$key]) ) 
                      {
                        $Item = array("TestItem"=>(string)$sheetData[$i+1][$key],"ItemType"=>"Keyword","USpec"=>(string)$sheetData[$i+2][$key],"LSpec"=>"1|Pass","Units"=>""); 
                      }
                      else
                      {
                        $ERROR= $ERROR."$sheetData1".$sheetData[$i+1][$key]." $sheetData2:".$sheetData[$i+2][$key]." $sheetData4:".$sheetData[$i+4][$key]."<BR/>";
                        $Item = array("TestItem"=>(string)$sheetData[$i+1][$key],"ItemType"=>"Upload","USpec"=>(string)$sheetData[$i+2][$key],"LSpec"=>(string)$sheetData[$i+4][$key],"Units"=>(string)$sheetData[$i+5][$key]); 
                      }

                     array_push($Items,$Item);
                   }
                   else
                   {
                   
                      if ( checkstr($DoifelseStations,$StationName."_".$sheetData[$i+1][$key]) ) 
                      {
                       $ERROR= $ERROR."$sheetData2:".$sheetData[$i+2][$key]." $sheetData4:".$sheetData[$i+4][$key]."<BR/>";
                       $Item = array("TestItem"=>(string)$sheetData[$i+1][$key],"ItemType"=>"Doifelse","USpec"=>(string)$sheetData[$i+2][$key],"LSpec"=>(string)$sheetData[$i+4][$key],"Units"=>(string)$sheetData[$i+5][$key]); 
                      }
                      else
                      {
                        $Item = array("TestItem"=>(string)$sheetData[$i+1][$key],"ItemType"=>"Spec","USpec"=>(string)$sheetData[$i+2][$key],"LSpec"=>(string)$sheetData[$i+4][$key],"Units"=>(string)$sheetData[$i+5][$key]);   
                      }
                     array_push($Items,$Item);
                   } 
               } 
              
            }
            else
            {
               if ($key != 'A') 
               {
                  $TotleCount++;
                  $TotleStations = $TotleStations.$sheetData[$i][B].','.($index-1).',';
                  $i=$i+5;

                 $StationsSpec[$StationName] = $Items;
                  break;
               }
               
            }
      }
      $Body.='</table>';
      $Body.='<hr/>';
   }
}

// echo $TotleCount ;
// echo '<hr/>';
// echo $Stations ;
// echo '<hr/>';
// echo $TotleStations ;
// echo '<hr/>';
echo $Body  ;
echo $ERROR ;

echo urldecode(json_encode($StationsSpec));



}




 





function checkstr($str,$needle)
{
  $str    = ','.$str.',';$needle = ','.$needle.',';
  $tmparray = explode($needle,$str);   
  if(count($tmparray)>1)
    return true;   
  else
    return false;     
} 
?>