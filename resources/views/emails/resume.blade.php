<table style="font-family:Arial, Helvetica, sans-serif;
	color:#666;
	font-size:16px;
	text-shadow: 1px 1px 0px #fff;
	background:#eaebec;
	margin:20px;
	border:#ccc 1px solid;
	border-collapse:separate;
	border-spacing: 0px;

	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;

	-moz-box-shadow: 0 1px 2px #d1d1d1;
	-webkit-box-shadow: 0 1px 2px #d1d1d1;
	box-shadow: 0 1px 2px #d1d1d1;">
    <tr >
        <td colspan="2" style="text-align: center;"><img src="<?php echo $message->embed('img/frontend/logo.jpg'); ?>"> </td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid #e0e0e0; border-right: 1px solid #e0e0e0; background: #fafafa;  padding: 7px 17px;">ПІБ  </td>
        <td style="border-bottom: 1px solid #e0e0e0; background: #fafafa;  padding: 7px 17px;">{{ $name }}</td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid #e0e0e0; border-right: 1px solid #e0e0e0; padding: 7px 17px;">Телефон</td>
        <td style="border-bottom: 1px solid #e0e0e0; padding: 7px 17px;">{{ $telephone }}</td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid #e0e0e0; border-right: 1px solid #e0e0e0; background: #fafafa;  padding: 7px 17px;">Спеціальність</td>
        <td style="border-bottom: 1px solid #e0e0e0; background: #fafafa;  padding: 7px 17px;">{{ $specialty }}</td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid #e0e0e0; border-right: 1px solid #e0e0e0; background: #fafafa;  padding: 7px 17px;">Досвід роботи</td>
        <td style="border-bottom: 1px solid #e0e0e0; background: #fafafa;  padding: 7px 17px;">{{ $experience }}</td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid #e0e0e0; border-right: 1px solid #e0e0e0; padding: 7px 17px;">Бажаний рівень зп</td>
        <td style="border-bottom: 1px solid #e0e0e0; padding: 7px 17px;">{{ $salary }}</td>
    </tr>
    <tr>
        <td colspan="2" style="border-bottom: 1px solid #e0e0e0; font-style:italic; border-right: 1px solid #e0e0e0; background: #fafafa;  padding: 7px 17px; text-align: center;"><h4>Для детального перегляду резюме перейдіть в адмін.панель сайту!</h4></td>


    </tr>
</table>
