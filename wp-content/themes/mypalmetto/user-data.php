<?php 
    global $wpdb;
    $user_id = $_GET['userID'];
    $userName = get_user_meta($user_id, 'nickname')[0];
    $firstName = get_user_meta($user_id, 'first_name')[0];
    $lastName = get_user_meta($user_id, 'last_name')[0];
    $lastBadge = $wpdb->get_col("SELECT badge FROM user_badges WHERE user_id = '400' ORDER BY ID DESC");
    $rewards = $wpdb->get_col("SELECT reward_id FROM user_rewards WHERE userid = '$user_id' ");
    $lastBadgeTitle = get_post($lastBadge[0]);
    /*var_dump(get_user_meta($user_id));*/
    $email = get_userdata($user_id);
    $emailAdd = $email->user_email;
    echo 
        '<div class="userdataTable">
            <div class="user-name"><h3 id="username">'.($userName ? $userName : 'N/A').'</h3><a href="#" id="downloadcsv"></a><button onclick="download_csv()">Export Data</button></div>
            <div class="user-data-inner">
                <ul>
                    <li>
                        <div class="field __bd">
                            <div class="data">
                                Name
                            </div>                            
                        </div>
                        <div class="value __bd">
                            <div class="data" id="fullname">'.($firstName ? $firstName : 'N/A').' '.$lastName.'</div>
                        </div>
                    </li>
                    <li>
                        <div class="field __bd">
                            <div class="data">
                                Email
                            </div>
                        </div>
                        <div class="value __bd">
                            <div class="data" id="email">'.($emailAdd ? $emailAdd : 'N/A').'</div>
                        </div>
                    </li>
                    <li>
                        <div class="field __bd">
                            <div class="data">
                                Favorite Beer
                            </div>
                        </div>
                        <div class="value __bd">
                            <div class="data" id="favbeer">'.(get_user_meta($user_id, 'fav_beer')[0] ? get_user_meta($user_id, 'fav_beer')[0] : 'N/A').'</div>
                        </div>
                    </li>
                    <li>
                        <div class="field __bd">
                            <div class="data">
                                Catawba Location
                            </div>
                        </div>
                        <div class="value __bd">
                            <div class="data" id="catloc">'.(get_user_meta($user_id, 'catawba_location')[0] ? get_user_meta($user_id, 'catawba_location')[0] : 'N/A').'</div>
                        </div>
                    </li>
                    <li>
                        <div class="field __bd">
                            <div class="data">
                                Age Range
                            </div>
                        </div>
                        <div class="value __bd">
                            <div class="data" id="age">'.(get_user_meta($user_id, 'agerange')[0] ? get_user_meta($user_id, 'agerange')[0] : 'N/A').'</div>
                        </div>
                    </li>
                    <li>
                        <div class="field __bd">
                            <div class="data">
                                State
                            </div>
                        </div>
                        <div class="value __bd">
                            <div class="data" id="state">'.(get_user_meta($user_id, 'state')[0] ? get_user_meta($user_id, 'state')[0] : 'N/A').'</div>
                        </div>
                    </li>
                    <li>
                        <div class="field __bd">
                            <div class="data">
                                City
                            </div>
                        </div>
                        <div class="value __bd">
                            <div class="data" id="city">'.(get_user_meta($user_id, 'city')[0] ? get_user_meta($user_id, 'city')[0] : 'N/A').'</div>
                        </div>
                    </li>
                    <li>
                        <div class="field __bd">
                            <div class="data">
                                ZIP Code
                            </div>
                        </div>
                        <div class="value __bd">
                            <div class="data" id="zip">'.(get_user_meta($user_id, 'zip')[0] ? get_user_meta($user_id, 'zip')[0] : 'N/A').'</div>
                        </div>
                    </li>
                    <li>
                        <div class="field __bd">
                            <div class="data">
                                Mailing Address
                            </div>
                        </div>
                        <div class="value __bd">
                            <div class="data" id="address">'.(get_user_meta($user_id, 'mailing_address')[0] ? get_user_meta($user_id, 'mailing_address')[0] : 'N/A').'</div>
                        </div>
                    </li>
                    <li>
                        <div class="field __bd">
                            <div class="data">
                                Last Badge Collected
                            </div>
                        </div>
                        <div class="value __bd">
                            <div class="data" id="lastbadge">'.($lastBadgeTitle ? $lastBadgeTitle->post_title : 'N/A').'</div>
                        </div>
                    </li>
                    <li>
                        <div class="field __bd">
                            <div class="data">
                                Total Badges Collected
                            </div>
                        </div>
                        <div class="value __bd">
                            <div class="data" id="totalbadges">'.($lastBadge ? count($lastBadge) : '0').'</div>
                        </div>
                    </li>
                    <li>
                        <div class="field __bd">
                            <div class="data">
                                Total Rewards Collected
                            </div>
                        </div>
                        <div class="value __bd">
                            <div class="data" id="totalrewards">'.($rewards ? count($rewards) : '0').'</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>';
?>
<script>    
    var userData = [document.getElementById('username').innerHTML, document.getElementById('fullname').innerHTML, document.getElementById('email').innerHTML, document.getElementById('favbeer').innerHTML, document.getElementById('catloc').innerHTML, document.getElementById('age').innerHTML, document.getElementById('state').innerHTML, document.getElementById('city').innerHTML, document.getElementById('zip').innerHTML, document.getElementById('address').innerHTML];    
    function download_csv() {
    var csv = 'Username,Full Name,Email,Favorite Beer,Catawba Location,Age Range,State,City,ZIP Code, Mailing Address\n';  
    csv+=userData;    
    var hiddenElement = document.getElementById('downloadcsv');
    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
    hiddenElement.target = '_blank';
    hiddenElement.download = document.getElementById('username').innerHTML+'.csv';
    hiddenElement.click();
}
</script>