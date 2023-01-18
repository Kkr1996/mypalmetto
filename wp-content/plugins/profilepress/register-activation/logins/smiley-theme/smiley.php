<?php
/**
 * Theme name: Smiley Login Theme
 * Builder type: Login form
 */
namespace logins\smiley_theme;

/**
 * Class Smiley_Login
 * @package logins\smiley_theme
 */
class Smiley_Login
{

    public static function instance()
    {
        global $wpdb;

        $wpdb->insert(
            LOGIN_TABLE,
            array(
                'title'     => 'Smiley Login Theme',
                'structure' => self::structure(),
                'css'       => self::css(),
                'date'      => date('Y-m-d')
            ),
            array(
                '%s',
                '%s',
                '%s',
                '%s'
            )
        );
    }

    /** Login CSS */
    public static function css()
    {
        $asset_url = PROFILEPRESS_ROOT_URL . 'assets/images/smiley';

        return <<<CSS
/* css class for the login generated errors */
.profilepress-login-status {
	background-color: #34495e;
    color: #ffffff;
    border: medium none;
    border-radius: 4px;
    font-size: 15px;
    font-weight: normal;
    text-align: center;
    line-height: 1.4;
    padding: 8px 5px;
    margin: 5px auto;
}

.profilepress-login-status a {
    color: #ea9629 !important;
}

.ppprofile1 .ppboxa {
	background: #fff;
	max-width: 350px;
	width: 100%;
	height: 80px;
	margin: 0 auto;
	text-align: center;
	border-top-left-radius: 4px;
	border-top-right-radius: 4px;
}

.ppprofile1 .ppavatar {
    display: inline;
    border-radius: 120px;
    border: 6px solid #fff;
    margin-top: 05px;
    background: #f1f1f1;
    max-width: 120px;
    width: 100%;
}

.ppprofile1 .smi-username {
  border-top-left-radius:4px;
  border-top-right-radius:4px;
}

.ppprofile1 .smi-password {
  border-bottom:0;
  border-bottom-left-radius:4px;
  border-bottom-right-radius:4px;
}

.ppprofile1 .smi-links {
  font-size: 14px !important;
}

.ppprofile1 .ppboxb {
	background: url({$asset_url}/bg1.png);
	max-width: 350px;
	width: 100%;
	/* height: 400px; */
	margin: 0 auto;
	color: #fff;
	border-radius: 4px;
}

.ppprofile1 .ppuserdata {
    text-align: center;
    padding-top: 80px;
    text-shadow: 0 1px 1px rgba(0, 0, 0, .25);
}

.ppprofile1 span.ppname {
    font-size: 36px;
}

.ppprofile1 span.pptitle {
    text-transform: uppercase;
    font-size: 12px;
    color: rgba(255, 255, 255, .8);
}

.ppprofile1 .ppprofdata {
    padding: 30px;
    background: rgba(0, 0, 0, .1);
    margin-top: 50px;
    /* height: 90px; */
    margin: 30px;
    border-radius: 4px;
    text-shadow: 0 1px 1px rgba(0, 0, 0, .25);
    text-align: center;
    padding-bottom: 5px;
}

.ppprofile1 .ppprofdata a {
  color: #fff !important;
}

.ppprofile1 .ppprofdata ul {
	list-style: none;
	margin: 0;
	padding: 0;
}

.ppprofile1 .ppprofdata ul li {
	padding-bottom: 10px;
}

.ppprofile1 .ppprofdata ul li a{
	color: #F1F1F1;
	text-decoration: none;
}

.ppprofile1 .ppprofdata ul li strong {
	padding-right: 6px;
	color: #D6EBFA;
}

.ppprofile1 .ppsocial {
	margin: 0;
	padding: 0;
	text-align: left;
    position: absolute;
    margin-top: -90px;
    margin-left: 20px;
    opacity: 0.2;
}

.ppprofile1 .ppsocial li {
	list-style: none;
	display: inline;
}

.ppprofile1 input[type=text], .ppprofile1 input[type=password] {
    border: 0;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    color: #7c7c7c;
    background-color: #fff;
    font-family: "Proxima Nova";
    font-size: 14px;
    padding: 11px;
    max-width: 230px;
    width: 100%;
    border-bottom: 1px dashed rgba(0, 0, 0, .05);
    margin-bottom: 0px;
}

.ppprofile1 input[type=text]:focus, .ppprofile1 input[type=password]:focus {
	outline: 0;
}

.ppprofile1 .ppsoclog {
	text-align: center;
	color: #F1F1F1;
	text-decoration: none;
	font-size: 12px;
    cursor: pointer;
    border: 0 none;

}

.ppprofile1 .pploginbutton {
	text-align: center;
}

.ppprofile1 .pplogbutt {
    background: #f1f1f1;
    border: 1px solid rgba(0, 0, 0, .15);
    font-family: "Proxima Nova";
    font-size: 15px;
    color: rgba(31, 31, 31, 0.5);
    text-transform: uppercase;
    max-width: 290px;
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, .1);
    margin-bottom: 30px;
}

.ppprofile1 .ppsocialmedia {
    background: rgba(0, 0, 0, .2);
    margin-bottom: 30px;
    padding: 30px;
    text-align: center;
    display: none;
}

.ppprofile1 .ppsocialmedia .ppsochead {
	font-weight: 500;
	font-size: 16px;
}

.ppsocialmedia img {
    max-width: 220px;
    width: 100%;
    padding-top: 10px;
     margin: auto;
}

.pp-gender {
  border: 0;
  background: #fff;
  max-width: 230px;
  width: 100%;
  font-size: 14px;
  font-family: "Proxima Nova", sans-serif;
  color: #7c7c7c;
  font-weight: 500;
  border-radius: 0;border-bottom-right-radius:4px;
  padding: 12px;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  border-bottom-left-radius: 4px;
}

.pp-gender:focus {
	outline: none;
}
CSS;

    }


    /** Login structure */
    public static function structure()
    {
        $asset_url = PROFILEPRESS_ROOT_URL . 'assets/images/smiley';

        return <<<STRUCTURE
<script type="text/javascript">
	(function ($) {
		$(document).ready(function () {
				$("#ppsoclog").click(function () {
					$(".ppsocialmedia").toggle('slow');
				});
			}
		);
	})(jQuery);
</script>
<div class="ppprofile1">
	<div class="ppboxa">
		<img src="{$asset_url}/avatar.gif" class="ppavatar"/>
	</div>
	<div class="ppboxb">
		<div class="ppuserdata">
					<span class="ppname">
						Sign In
					</span>
		</div>
		<div class="ppprofdata">
			<form>
				[login-username class="smi-username" placeholder="Username"]
				[login-password class="smi-password" placeholder="Password"]
				<br style="clear:both"/><br/>
				<a id="ppsoclog" class="ppsoclog smi-links">Login with social media instead?</a>
				<br/><br/> [link-lost-password class="ppsoclog smi-links" label="Forgot your password?"]
				<br/><br/> [link-registration class="ppsoclog smi-links" label="Not registered yet?"]

		</div>
		<div class="ppsocialmedia animated">
			<span class="ppsochead">Login with your desired service...</span> <br/>
			<a href="[facebook-login-url]"><img src="{$asset_url}/social/fb.png"/></a><br/>
			<a href="[linkedin-login-url]"><img src="{$asset_url}/social/li.png"/></a><br/>
			<a href="[twitter-login-url]"><img src="{$asset_url}/social/tr.png"/></a>
		</div>
		<div class="pploginbutton">
			[login-submit class="pplogbutt" value="Sign In"]
		</div>

	</div>
</div>

STRUCTURE;
    }
}