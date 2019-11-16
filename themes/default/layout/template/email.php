<div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px">
	<div style="text-align:center;    background: url({{CONFIG theme_url}}/img/banner.png) repeat 0 0;
    /* background: linear-gradient(to right, #3d2fae, #6984d1); */
    /* background-image: linear-gradient(-225deg, rgb(99, 108, 224) 0%, rgb(75, 118, 173) 50%, rgb(90, 107, 236) 100%); */
    background-color: #849cf1;
    background-size: 100%; width: 100%; border-radius:8px;magin:12px;padding-top:3%">
		<!--img style="width:75px;height:24px;margin-bottom:16px" width="75" height="24" src="{{CONFIG theme_url}}/img/logo.png"></img-->
		<div style="
			font-size: 30px;
			color: #fff;
			font-family: 'Google Sans',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
			margin: auto;
		">{{LOGO}}</div>
	</div>
	<div style="font-family:'Google Sans',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
		<br>
		<div style="font-size:24px">
		Hello {{USERNAME}}
		</div>
	</div>
	<br><br>
	<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
		have you forgotten your password?
		well do not worry but just click on the button:
	</div>	
	<div style="padding-top:32px;text-align:center">
		<a style="font-family:'Google Sans',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
						line-height:16px;
						color:#ffffff;
						font-weight:400;
						text-decoration:none;
						font-size:14px;
						display:inline-block;
						padding:10px 24px;
						background-color:#4184f3;
						border-radius:5px;
						min-width:90px"
		href="{{CONFIG site_url}}/me/activate?key={{EMAIL_CODE}}&user={{USERID}}">New Password</a>
	</div>
	<br><br>
</div>
