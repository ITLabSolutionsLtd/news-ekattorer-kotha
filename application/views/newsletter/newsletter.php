<html>

<head>
    <title>NEWSLETTER - Shyamal Sylhet</title>
    <style>
        a.row-a:hover{
            background: #2cb66e !important;
            color: #fff !important;
            transition: 0.5s ease; 
        }
    </style>
</head>

<body>
    
    <!-- © 2018 Shift Technologies. All rights reserved. -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
        <tbody>
            <tr>
                <td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">

                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody" style="max-width:600px">
                        <tbody>
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableCard" style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
                                        <tbody>
                                            <tr>
                                                <td style="background-color:#2cb66e;font-size:1px;line-height:3px" class="topBorder" height="3">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td style="padding-bottom: 5px;" align="center" valign="top" class="imgHero">
                                                    <a href="<?php echo base_url(); ?>" style="text-decoration:none" target="_blank">
								                        <img alt="" border="0" src="<?php echo base_url('images/shyamal-sylhet-logo.png'); ?>" style="max-width:200px;height:auto; display:block;color: #f9f9f9; padding-top: 35px;" >
								                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="mainTitle">
                                                    <h2 class="text" style="color:#000;font-family:Solaimanlipi; font-size:22px;font-weight:600;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">নিউজলেটার</h2>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="padding-bottom: 5px; border-bottom: 0.5px solid #ececec; padding-left: 20px; padding-right: 20px;" align="center" valign="top" class="subTitle">
                                                    <h4 class="text" style="color:#999;font-family: solaimanlipi; font-size:14px;font-style:normal;letter-spacing:normal;text-align:center;margin:0">তারিখ: ১১-১২-২০২২</h4>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="padding-top: 15px; padding-left:20px;padding-right:20px" valign="top" class="containtTable ui-sortable">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="tableDescription" style="">
                                                        <tbody>
                                                            <?php
                                                                if($newses){
                                                                    $count = 0;
                                                                    foreach($newses as $row){ ?>
                                                                        <tr>
                                                                            <td style="padding-bottom: 10px;" valign="top" class="description">
                                                                                <a class="row-a" href="<?php echo base_url('news/'.$row->news_id); ?>" style="color: #666; width: 100%; float: left; transition: 0.5s ease;  background: #f1f1f1; padding-bottom: 10px; padding-top: 10px; padding-left: 5px;">
                                                                                    <p class="text" style="font-family: Arial,solaimanlipi; font-size: 18px;margin: 0; font-weight: 600; font-style: normal; letter-spacing: normal; line-height: unset; text-transform: none; vertical-align: inherit;"> 
                                                                                    <img src="<?php echo base_url('images/icon/newsletter.png'); ?>" style="float: left;max-height: 20px;padding-right: 10px;" >  
                                                                                    <span style="float: left; width: 90%;"><?php echo stripslashes($row->news_headline); ?></span>
                                                                                </p>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    <?php }
                                                                }else { ?>
                                                                    <tr>
                                                                        <td style="padding-bottom: 10px;" valign="top" class="description">
                                                                            <a class="#" style="color: #666; width: 100%; float: left; transition: 0.5s ease;  background: #f1f1f1; padding-bottom: 10px; padding-top: 10px; padding-left: 5px;">
                                                                                <p class="text" style="font-family: Arial,solaimanlipi; font-size: 18px;margin: 0; font-weight: 600; font-style: normal; letter-spacing: normal; line-height: unset; text-transform: none; vertical-align: inherit;"> 
                                                                                <img src="<?php echo base_url('images/icon/newsletter.png'); ?>" style="float: left;max-height: 20px;padding-right: 10px;" >  
                                                                                <span style="float: left; width: 90%;"><?php echo 'কোন নিউজ আপলোড করা হয় নি! ';  ?></span>
                                                                            </p>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                <?php   
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size:1px;line-height:1px" height="20">&nbsp;</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="space">
                                        <tbody>
                                            <tr>
                                                <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperFooter" style="max-width:600px">
                        <tbody>
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="footer">
                                        <tbody>
                                            <tr>
                                                <td style="padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px" align="center" valign="top" class="socialLinks">
                                                    <a href="#facebook-link" style="display:inline-block" target="_blank" class="facebook">
                                                        <img alt="" border="0" src="<?php echo base_url('images/icon/facebook.png')?>" style="height:auto;width:100%;max-width:40px;margin-left:2px;margin-right:2px" width="40">
                                                    </a>
                                                    <a href="#twitter-link" style="display: inline-block;" target="_blank" class="twitter">
                                                        <img alt="" border="0" src="<?php echo base_url('images/icon/twitter.png')?>" style="height:auto;width:100%;max-width:40px;margin-left:2px;margin-right:2px" width="40">
                                                    </a>

                                                    <a href="#linkdin-link" style="display: inline-block;" target="_blank" class="linkdin">
                                                        <img alt="" border="0" src="<?php echo base_url('images/icon/linkdin.png')?>" style="height:auto;width:100%;max-width:40px;margin-left:2px;margin-right:2px" width="40">
                                                    </a>
                                                    <a href="#linkdin-link" style="display: inline-block;" target="_blank" class="linkdin">
                                                        <img alt="" border="0" src="<?php echo base_url('images/icon/twitter.png')?>" style="height:auto;width:100%;max-width:40px;margin-left:2px;margin-right:2px" width="40">
                                                    </a>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="padding: 10px 10px 5px;" align="center" valign="top" class="brandInfo">
                                                    <p class="text" style="color:#bbb;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">©&nbsp;Shyamal Sylhet. | Miirabazar, Sylhet | Bangladesh .</p>
                                                </td>
                                            </tr>
                                            

                                            <tr>
                                                <td style="padding: 0px 10px 10px;" align="center" valign="top" class="footerEmailInfo">
                                                    <p class="text" style="color:#bbb;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:20px;text-transform:none;text-align:center;padding:0;margin:0">If you have any quetions please contact us <a href="#" style="color:#bbb;text-decoration:underline" target="_blank">shyamal.sylhet@gmail.com</a>
                                                    </p>
                                                </td>
                                            </tr>



                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>