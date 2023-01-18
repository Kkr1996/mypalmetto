<?php 
//onkeyup="searchUsers()" 
    global $wpdb;    
    echo '<h2>User Data</h2>';
    $users = get_users( array( 'fields' => array( 'ID' ), 'role' => 'subscriber' ) );
    $userCount = count($users);
    $current_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."&";
    echo '<div class="export-data"><h5>Total Users '.$userCount.'</h5><a href="#" id="downloadcsv"></a><button onclick="download_csv_all()" class="export-data-btn">Export All</button>
    </div><button onclick="download_csv()" class="export-data-btn-all">Export Selected</button>';
    echo '<form action="'.$current_url.'" method="get"><div class="user-table-filters">
       <input type="hidden" id="page" name="page" placeholder="Search by username or name or catawba location..." value="userlisting"> 
        <input type="text" id="nameFilter" placeholder="Search by username or name or catawba location..." name="searchbytype" value="'.$_GET['searchbytype'].'"> 
        
        Search by beer'.do_shortcode('[reg-cpf  key="fav_beer" type="select" class="form-control" placeholder="Favorite Beer"]').' 
        
        Search by Age'.do_shortcode('[reg-cpf id="agerange" key="agerange" type="select" class="form-control" placeholder="Age Range"]').'
        
        Search by State'.do_shortcode('[reg-cpf id="state" key="state" type="select" class="form-control" placeholder="Age Range"]').'

        <input type="submit" name="submit" id="search-u" value="Filter"></div></form>';

        $fav_bear     =    $_GET['fav_beer'];
        $agerange     =    $_GET['agerange'];
        $state        =    $_GET['state'];
        $allsearch    =    $_GET['searchbytype'];
        if(strlen($allsearch)>0)
        {
           $allsearch =  $_GET['searchbytype'];
        }
//        else
//        {
//            $allsearch = array();
//        }
        if($agerange == "select age"){
            $agerange = array();
        }
        else{
            $agerangeval= $agerange;
        }
        if($fav_bear=="Select Beer"){
             $fav_bear = array();
        }
        else{
            $fav_bearval   = "fav".$fav_bear;
        }
        if($state=="Select State"){
             $state = array();
        }
        else{
            $stateval   =$state;
        }
        if(isset($_GET['submit']))
        {
            $usersearch = array($fav_bearval,$agerangeval,$stateval); 
            foreach($usersearch as $key=>$value)
            { 
                if(strlen($value)>0)
                {
                  $usersearchnew[$key] =  $value; 
                }
              
            }
        }
        else
        {
            $usersearchnew =array();
        }
// echo '<pre>',var_dump($usersearchnew); echo '</pre>';

        echo '<div class="user-table-wrap"><table class="user-listing-table" id="user-lt">
            <thead>
                <tr>
                    <th><input type="checkbox" name="selectall" id="allcheck" onchange="checkAll()"></th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Favorite Beer</th>
                    <th>Catawba Location</th>
                    <th>State</th>
                    <th>City</th>
                    <th>ZIP Code</th>
                    <th>Mailing Address</th>
                    <th>Last  Stamp Claimed</th>
                    <th>Total Stamps Claimed</th>
                    <th>Total Rewards Claimed</th>
                    <th>Shirt size</th>
                </tr>
            </thead>
            <tbody>';
             $countresult=0;
             foreach($users as $key =>$user_id){
                 $UID = $user_id->ID; 
                // $UID = 517; 
                 //echo 643;
//                 if($key < 2)
//                 {
                 
                 $lastBadge = $wpdb->get_col("SELECT badge FROM user_badges WHERE user_id = '$UID' ORDER BY ID DESC");
                 
              //   echo '<pre>',var_dump($lastBadge); echo '</pre>';
                 
                 
                 
                 
                 $rewards = $wpdb->get_col("SELECT reward_id FROM user_rewards WHERE userid = '$UID' ");
                 $lastBadgeTitle = get_post($lastBadge[0]);
                 $nickname = get_user_meta( $user_id->ID, 'nickname');
                 $userAvatar = get_user_meta( $user_id->ID, 'pp_profile_avatar');
                 $firstName = get_user_meta ( $user_id->ID, 'first_name');
                 $LastName = get_user_meta ( $user_id->ID, 'last_name');
                 $email = get_userdata($user_id->ID);
                 $emailAdd = $email->user_email;
                 $favBeer = get_user_meta ( $user_id->ID, 'fav_beer');
                 $shirtsize = get_user_meta ( $user_id->ID, 'shirtsize');
                
                 $catLoc = get_user_meta ( $user_id->ID, 'catawba_location');
                 
                $eachuserdata = array(get_user_meta ( $user_id->ID, 'agerange')[0],"fav".$favBeer[0],get_user_meta ( $user_id->ID, 'state')[0]);
                 
                $eachuserdatastring = array($nickname[0],$firstName[0].' '.$LastName[0],$catLoc[0],$emailAdd,get_user_meta ( $user_id->ID, 'city')[0],get_user_meta ( $user_id->ID, 'zip')[0],$lastBadgeTitle->post_title,count($lastBadge),count(array_unique($rewards)),get_user_meta ( $user_id->ID, 'mailing_address')[0]);
                 
               // $eachuserdatastring = array($nickname[0],$firstName[0].' '.$LastName[0]);
                 
                $exist="false";

                $result=array_diff($usersearchnew,$eachuserdata);
                if($allsearch)
                {
                    foreach($eachuserdatastring as $val)
                    {
                        $exists = strpos($val, $allsearch);
                        if ($exists !== false)
                        {
                              $exist = "true";
                              break;
                        }
                    }
                    $search = count($result) == 0 & $exist==="true"; 
                }
                else
                {
                    $search = count($result) == 0;   
                }

                 
                
                 if($search){
              
                 $countresult++;
                 echo '<tr id="'.$user_id->ID.'">';
                 echo '<td><input type="checkbox" id="'.$user_id->ID.'"></td>';
                 echo '<td class="username">'.($nickname[0] ? $nickname[0] : 'N/A').'</td>';
                 echo '<td>'.($firstName[0] ? $firstName[0] : 'N/A').' '.$LastName[0].'</td>';
                 echo '<td>'.($emailAdd ? $emailAdd : 'N/A').'</td>';
                 echo '<td>'.(get_user_meta ( $user_id->ID, 'agerange')[0] ? get_user_meta ( $user_id->ID, 'agerange')[0] : 'N/A').'</td>';
                 echo '<td>'.($favBeer[0] ? $favBeer[0] : 'N/A').'</td>';
                 echo '<td>'.($catLoc[0] ? $catLoc[0] : 'N/A').'</td>';
                 echo '<td>'.(get_user_meta ( $user_id->ID, 'state')[0] ? get_user_meta ( $user_id->ID, 'state')[0] : 'N/A').'</td>';
                 echo '<td>'.(get_user_meta ( $user_id->ID, 'city')[0] ? get_user_meta ( $user_id->ID, 'city')[0] : 'N/A').'</td>';
                 echo '<td>'.(get_user_meta ( $user_id->ID, 'zip')[0] ? get_user_meta ( $user_id->ID, 'zip')[0] : 'N/A').'</td>';
                 echo '<td>'.(get_user_meta ( $user_id->ID, 'mailing_address')[0] ? get_user_meta ( $user_id->ID, 'mailing_address')[0] : 'N/A').'</td>';
                 echo '<td>'.($lastBadgeTitle ? $lastBadgeTitle->post_title : 'N/A').'</td>';
                 echo '<td>'.($lastBadge ? count(array_unique($lastBadge)) : '0').'</td>';
                 echo '<td>'.($rewards ? count($rewards) : '0').'</td>';
                 echo '<td>'.$shirtsize[0].'</td>';
                 echo '</tr>'; 
                 }
                  $exist="false";
             }
            // }
            echo '</tbody></table></div>'; 
           if($countresult==0){
                echo '<p>No matches found.</p>';
            }



        echo '<div class="user-table-wrap"><table class="user-listing-table" id="user-all-list" style="display:none">
            <thead>
                <tr>
                    <th><input type="checkbox" name="selectall" id="allcheck" onchange="checkAll()"></th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Favorite Beer</th>
                    <th>Catawba Location</th>
                    <th>State</th>
                    <th>City</th>
                    <th>ZIP Code</th>
                    <th>Mailing Address</th>
                    <th>Last  Stamp Claimed</th>
                    <th>Total Stamps Claimed</th>
                    <th>Total Rewards Claimed</th>
                </tr>
            </thead>
            <tbody>';
             $countresult=0;
             foreach($users as $key =>$user_id){
                 $UID = $user_id->ID; 
                 //$UID = 643; 
                 //echo 643;
//                 if($key < 2)
//                 {
                 $lastBadge = $wpdb->get_col("SELECT badge FROM user_badges WHERE user_id = '$UID' ORDER BY ID DESC");
                 $rewards = $wpdb->get_col("SELECT reward_id FROM user_rewards WHERE userid = '$UID' ");
                 $lastBadgeTitle = get_post($lastBadge[0]);
                 $nickname = get_user_meta( $user_id->ID, 'nickname');
                 $userAvatar = get_user_meta( $user_id->ID, 'pp_profile_avatar');
                 $firstName = get_user_meta ( $user_id->ID, 'first_name');
                 $LastName = get_user_meta ( $user_id->ID, 'last_name');
                 $email = get_userdata($user_id->ID);
                 $emailAdd = $email->user_email;
                 $favBeer = get_user_meta ( $user_id->ID, 'fav_beer');
                 $catLoc = get_user_meta ( $user_id->ID, 'catawba_location');
                 
                $eachuserdata = array(get_user_meta ( $user_id->ID, 'agerange')[0],"fav".$favBeer[0],get_user_meta ( $user_id->ID, 'state')[0]);
                 
                $eachuserdatastring = array($nickname[0],$firstName[0].' '.$LastName[0],$catLoc[0],$emailAdd,get_user_meta ( $user_id->ID, 'city')[0],get_user_meta ( $user_id->ID, 'zip')[0],$lastBadgeTitle->post_title,count(array_unique($lastBadge)),count($rewards),get_user_meta ( $user_id->ID, 'mailing_address')[0]);
                 
               // $eachuserdatastring = array($nickname[0],$firstName[0].' '.$LastName[0]);
                 
                $exist="false";

                $result=array_diff($usersearchnew,$eachuserdata);
                if($allsearch)
                {
                    foreach($eachuserdatastring as $val)
                    {
                        $exists = strpos($val, $allsearch);
                        if ($exists !== false)
                        {
                              $exist = "true";
                              break;
                        }
                    }
                    $search = count($result) == 0 & $exist==="true"; 
                }
                else
                {
                    $search = count($result) == 0;   
                }

                 
                
                 //if($search){
                     
                 $countresult++;
                 echo '<tr id="'.$user_id->ID.'">';
                 echo '<td><input type="checkbox" id="'.$user_id->ID.'"></td>';
                 echo '<td class="username">'.($nickname[0] ? $nickname[0] : 'N/A').'</td>';
                 echo '<td>'.($firstName[0] ? $firstName[0] : 'N/A').' '.$LastName[0].'</td>';
                 echo '<td>'.($emailAdd ? $emailAdd : 'N/A').'</td>';
                 echo '<td>'.(get_user_meta ( $user_id->ID, 'agerange')[0] ? get_user_meta ( $user_id->ID, 'agerange')[0] : 'N/A').'</td>';
                 echo '<td>'.($favBeer[0] ? $favBeer[0] : 'N/A').'</td>';
                 echo '<td>'.($catLoc[0] ? $catLoc[0] : 'N/A').'</td>';
                 echo '<td>'.(get_user_meta ( $user_id->ID, 'state')[0] ? get_user_meta ( $user_id->ID, 'state')[0] : 'N/A').'</td>';
                 echo '<td>'.(get_user_meta ( $user_id->ID, 'city')[0] ? get_user_meta ( $user_id->ID, 'city')[0] : 'N/A').'</td>';
                 echo '<td>'.(get_user_meta ( $user_id->ID, 'zip')[0] ? get_user_meta ( $user_id->ID, 'zip')[0] : 'N/A').'</td>';
                 echo '<td>'.(get_user_meta ( $user_id->ID, 'mailing_address')[0] ? get_user_meta ( $user_id->ID, 'mailing_address')[0] : 'N/A').'</td>';
                 echo '<td>'.($lastBadgeTitle ? $lastBadgeTitle->post_title : 'N/A').'</td>';
                 echo '<td>'.($lastBadge ? count($lastBadge) : '0').'</td>';
                 echo '<td>'.($rewards ? count($rewards) : '0').'</td>';
                 echo '</tr>'; 
               //  }
                  $exist="false";
             }
            // }
            echo '</tbody></table></div>'; 









?>  

<script>
    var table = document.getElementById("user-lt");
    var favBeer = document.getElementById('favbeer');    
    var agerange = document.getElementById('agerange'); 
    favBeer.options[0].innerHTML = 'All';
    agerange.options[0].innerHTML = 'select age';
    //agerange.options[0].innerHTML = agerange;
    
        for(var t = 0; t < table.rows.length; t++){
            var cell = table.rows[t].cells[4];
            if(cell.innerText == "select age"){
                cell.innerHTML = "N/A";
            }
        }  
    //console.log(table.rows.length);
    function checkAll (){
        var table = document.getElementById("user-lt");
        var val = table.rows[0].cells[0].children[0].checked;
        for (var i = 1; i < table.rows.length; i++){
            table.rows[i].cells[0].children[0].checked = val;
        }
    }    
    
    function download_csv(){        
        table = document.getElementById("user-lt");
        var csv = 'Username,Full Name,Email,Age,Favorite Beer,Catawba Location,State,City,ZIP Code, Mailing Address,Last Badge Claimed,Total Badges Claimed,Total Rewards Claimed,Shirt size\n';
        if(table.querySelectorAll('input[type="checkbox"]:checked').length > 0){
            console.log(table.rows.length);
            for (var j = 1; j < table.rows.length; j++){
            var userData = [];
            if(table.rows[j].cells[0].children[0].checked){
                for (var x = 1; x < table.rows[j].cells.length; x++){
                    csv+= table.rows[j].cells[x].innerHTML;
                    if(x < table.rows[j].cells.length - 1){
                       csv+= ',';
                    }
                }
                csv+= '\n';
                }            
            }
           // alert(csv);
            //console.log(csv);
            var hiddenElement = document.getElementById('downloadcsv');
            hiddenElement.href = 'data:attachment/csv;charset=utf-8,' + encodeURIComponent(csv);
            hiddenElement.target = '_blank';
            hiddenElement.download = 'userinformation.csv';
            hiddenElement.click();    
        }
        else{
            alert('Please select a user first!');
        }        
    }
     function download_csv_all(){        
        table = document.getElementById("user-lt");
        var csv = 'Username,Full Name,Email,Age,Favorite Beer,Catawba Location,State,City,ZIP Code, Mailing Address,Last Badge Claimed,Total Badges Claimed,Total Rewards Claimed,Shirt size\n';
       // if(table.querySelectorAll('input[type="checkbox"]:checked').length > 0){
            console.log(table.rows.length);
            for (var j = 1; j < table.rows.length; j++){
            var userData = [];
           // if(table.rows[j].cells[0].children[0].checked){
                for (var x = 1; x < table.rows[j].cells.length; x++){
                    csv+= table.rows[j].cells[x].innerHTML;
                    if(x < table.rows[j].cells.length - 1){
                       csv+= ',';
                    }
                }
                csv+= '\n';
                //}            
            }
           // alert(csv);
            //console.log(csv);
            var hiddenElement = document.getElementById('downloadcsv');
            hiddenElement.href = 'data:attachment/csv;charset=utf-8,' + encodeURIComponent(csv);
            hiddenElement.target = '_blank';
            hiddenElement.download = 'userinformation.csv';
            hiddenElement.click();    
              
    }

</script>