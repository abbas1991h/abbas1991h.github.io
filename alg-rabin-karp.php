<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Lang" content="en">
<title>پیاده سازی الگوریتم های تطبیق رشته</title>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="al.js"></script>
<style>
fieldset{
    margin: 5px;
}
.c {
    border: 1px solid;
    margin-left: 0px;
    display: inline-block;
    width: 20px !important;
    height: 20px !important;
    text-align: center;
    z-index: 10;
}
#pattern{
    margin-left: 107px;
    position: absolute;
}
fieldset{
   width:60%;
   margin: auto; 
}
#num {
    z-index: 100;
    margin-top: 20px;
    position: absolute;
    margin-left: -3px;
}
#CLRM{
    direction: rtl;
    float: right;
} 
</style>
</head>
<body style="direction: rtl;"> 
      <fieldset style="width:60%;margin: auto;">
      <pre>سید عباس حسینی
            پیاده سازی الگوریتم: rabin-karp
            
            مرتبه زمانی اجرا:<img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/17b8e46ab3a2a5c04dfc0659093b7c2018d264ba" class="mwe-math-fallback-image-inline" aria-hidden="true" style="vertical-align: -0.838ex; width:17.745ex; height:2.843ex;" alt="{\displaystyle \Theta (m(n-m+1))}">
      </pre>
      <pre>پیاده سازی مثال کتاب:CLRS</pre>
        <form action="alg-rabin-karp.php" method="POST">
           متن:<input type="text" value="2359023141526739921" id="txt" name="txt">
           الگو:<input type="text" value="31415" id="pat" name="pat" size="10">
           عدد اول:<input type="text" value="13" id="q" name="q" size="3">
           <input type="submit" value="اجرا">
           
        </form>
      <pre>پیاده سازی الگوریتم تطبیق رشته در انواع رشته [ساده لوحانه]</pre>
      <form action="alg-rabin-karp.php" method="POST">
      <table>
        <tr>
            <td>
            <label>طول رشته[m]</label>
            <input type="text" size="5" id="m" value="20" name="m">
            </td>
            <td>
            <label>طول الگو[n]</label>
            <input type="text" size="5" id="n" value="3" name="n">
            </td>
            <td>
            <label>الفبای رشته[<img src="https://wikimedia.org/api/rest_v1/media/math/render/svg/9e1f558f53cda207614abdf90162266c70bc5c1e" class="mwe-math-fallback-image-inline" aria-hidden="true" style="vertical-align: -0.338ex; width:1.678ex; height:2.176ex;" alt="\Sigma ">]</label>
<!--            <input type="text" size="30" id="sigma" name="sigma" value="1,0"> -->
            <select name="sigma" id="sigma"  title="الفبای رشته">
              <option value="1,0">باینری</option>
              <option value="0,1,2,3,4,5,6,7,8,9">دسیمال</option>
              <option value="T,G,C,A">DNA</option>
              <option value="a,b,c">a,b,c</option>
              <option value="a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z">A-Z</option>
            </select>
            </td>
            <td>
                <input type="submit" value="ساخت رشته و الگو">
            </td>
        </tr>
      </table> 
      </fieldset>
      <fieldset style="width:60%;margin: auto;direction: ltr;">
      <table>     
      <tr>
          <td width="100px">T  متن:</td>
          <td>
          <?php
 //BOOK EXAMPLE START
            // d is the number of characters 
            // in the input alphabet 

            $d = 256; 
            
            /* pat -> pattern 
               txt -> text 
               q -> A prime number 
               s-> number match
            */

            function search($pat, $txt, $q) 
            { 

                $M = strlen($pat); 

                $N = strlen($txt); 

                $i; $j; 

                $p = 0; // hash value  

                        // for pattern 

                $t = 0; // hash value  

                        // for txt 

                $h = 1; 

                $d =1; 
              
                $s=0; //number of match

                // The value of h would 

                // be "pow(d, M-1)%q" 

                for ($i = 0; $i < $M - 1; $i++) 

                    $h = ($h * $d) % $q; 
              

                // Calculate the hash value 

                // of pattern and first 

                // window of text 
                
                for ($i = 0; $i < $M; $i++) 

                { 

                    $p = ($d * $p + $pat[$i]) % $q; 

                    $t = ($d * $t + $txt[$i]) % $q; 

                } 

                // Slide the pattern over 

                // text one by one 
                
                for ($i = 0; $i <= $N - $M; $i++) 

                { 
              

                    // Check the hash values of  

                    // current window of text 

                    // and pattern. If the hash 

                    // values match then only 

                    // check for characters on 

                    // by one 

                    if ($p == $t) 

                    { 

                        // Check for characters 

                        // one by one 

                        for ($j = 0; $j < $M; $j++) 

                        { 

                            if ($txt[$i + $j] != $pat[$j]) 

                                break; 

                        } 
              

                        // if p == t and pat[0...M-1] =  

                        // txt[i, i+1, ...i+M-1] 
                        
                        if ($j == $M)
                        {
                            $s++;
                            echo "<span id='CLRM'>الگو در جابجای ", 

                                                  $i, "\n اُم پیداشد .</span><br/>";
                        }
                    } 

                    // Calculate hash value for  

                    // next window of text:  

                    // Remove leading digit, 

                    // add trailing digit 

                    if ($i < $N - $M) 

                    { 

                        $t = ($d * ($t - $txt[$i] *  

                                    $h) + $txt[$i +  

                                         $M]) % $q; 
              

                        // We might get negative  

                        // value of t, converting 

                        // it to positive 

                        if ($t < 0) 

                        $t = ($t + $q); 

                    } 

                } 
                echo ("<span id='CLRM'>تعداد تطبیق:".$s.'</span>');
            } 
  
 //BOOK EXAMPLE END
               global $m;
               global $n;               
               function sigma(){
//                   return(rand(0,1));
                    if(isset($_POST['sigma'])){
                      $alfba=str_replace(',','',$_POST['sigma']);
                      $count=strlen($alfba);
                      $c=rand(0,$count-1) ;
//                      echo $count;exit;
                      $alfba= explode(',',$_POST['sigma']);
                      return($alfba[$c]);
//                      print_r($alfba);exit;
                    }
               }
               if(isset($_POST['txt'])){
                    $txt=$_POST['txt'];
                    for ($i = 1; $i <= strlen($txt); $i++) 
                   {
                       echo '<td class="c"><span id="num">'.($i).'</span>'.$txt[$i-1].'</td>';
                   }
                    // Driver Code 

//                    $txt = "GEEKS FOR GEEKS"; 
//                    $txt = "2359023141526739921"; 
                      $txt =$_POST['txt'] ; 
//                    $pat = "GEEK"; 
                      $pat = $_POST['pat']; 

                      $q = $_POST['q']; // A prime number 

                    search($pat, $txt, $q); 
                   
               }
               if(isset($_POST['m'])){
                   
                   for ($i = 1; $i <= $_POST['m']; $i++) 
                   {
                       $curval=sigma();
                       $m[$i]=$curval;
                       echo '<td class="c">'.$curval.'</td>';
                   }
//                   print_r($m);exit;
               }
          ?>
          </td>
      </tr>
      <tr>
          <td colspan="1">P الگو:</td>
          <tr id="pattern">
          <?php
          ///msal ketab
             if(isset($_POST['txt'])){           
                  $pat=$_POST['pat']; 
                  for ($i = 1; $i <= strlen($pat); $i++) 
                   {
                       echo '<td class="c">'.$pat[$i-1].'</td>';
                   }
             }
             if(isset($_POST['n'])){           
                   
                   for ($i = 1; $i <= $_POST['n']; $i++) 
                   {
                       $curval=sigma();
                       $n[$i]=$curval;
                       echo '<td class="c">'.$curval.'</td>';
                   }
               }
          ?>
          </tr>
      </tr>
      <tr>
        <td>
        <br/>
        <br/>
        <br/>
        <?php
                if(isset($_POST['start'])){
                      $m=implode($m,',');
                      $m=str_replace(',','',$m);
                      $n=implode($n,',');
                      $n=str_replace(',','',$n);
                      $s=0;
                   for ($i = 0; $i <= ($_POST['m']-$_POST['n']); $i++) 
                   {
                       
                       $nm=substr($m,$i,$_POST['n']);
                       if($nm === $n){
                           $s++;
                           $shift = (($i) * 25)+107; 
//                           echo $shift.'-'.$i;
                           echo '<span style="color:green;">['.$nm."i=".$i.']</span><br>';
                           echo"<script>alert('تطبیق  الگوی$nm در شیفت= $i صورت گرفت.');</script >";
                           echo'<script>$("#pattern").css("margin-left","'.$shift.'px");$("#pattern").css("margin-top","-28px");$("#pattern").css("background-color","green");</script>';
                       }else{
                           echo $nm."i=".$i.'<br>';
                       }
                       
                   }
                   echo '<br/>تعداد تطبیق:'.$s;
                } 
          ?>                       
              <input type="hidden" id="start" value="true" name="start">
              <input type="submit" value="جستجوی الگو" > 
         </form>
        </td>
      </tr>
      </table>
      </fieldset>

</body>
</html>
