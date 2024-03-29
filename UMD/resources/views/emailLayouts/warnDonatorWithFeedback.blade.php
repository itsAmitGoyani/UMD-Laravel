<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Warn Donator Mail</title>

    <style type="text/css">
        /* Take care of image borders and formatting */

        img {
            max-width: 600px;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a img {
            border: none;
        }

        table {
            border-collapse: collapse !important;
        }

        #outlook a {
            padding: 0;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .backgroundTable {
            margin: 0 auto;
            padding: 0;
            width: 100% !important;
        }

        table td {
            border-collapse: collapse;
        }

        .ExternalClass * {
            line-height: 115%;
        }


        /* General styling */

        td {
            font-family: Arial, sans-serif;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100%;
            height: 100%;
            color: #6f6f6f;
            font-weight: 400;
            font-size: 18px;
        }


        h1 {
            margin: 10px 0;
        }

        a {
            color: #27aa90;
            text-decoration: none;
        }


        .body-padding {
            padding: 0 75px;
        }


        .force-full-width {
            width: 100% !important;
        }
    </style>

    <style type="text/css" media="screen">
        @media screen {
            @import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,900);

            /* Thanks Outlook 2013! */
            * {
                font-family: 'Source Sans Pro', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
            }
        }
    </style>

    <style type="text/css" media="only screen and (max-width: 599px)">
        /* Mobile styles */
        @media only screen and (max-width: 599px) {

            table[class*="w320"] {
                width: 320px !important;
            }

            td[class*="w320"] {
                width: 280px !important;
                padding-left: 20px !important;
                padding-right: 20px !important;
            }

            img[class*="w320"] {
                width: 250px !important;
                height: 67px !important;
            }

            td[class*="mobile-spacing"] {
                padding-top: 10px !important;
                padding-bottom: 10px !important;
            }

            *[class*="mobile-hide"] {
                display: none !important;
                width: 0 !important;
            }

            *[class*="mobile-br"] {
                font-size: 12px !important;
            }

            td[class*="mobile-center"] {
                text-align: center !important;
            }

            table[class*="columns"] {
                width: 100% !important;
            }

            td[class*="column-padding"] {
                padding: 0 50px !important;
            }
        }
    </style>
</head>

<body offset="0" class="body" style="padding:0; margin:0; display:block; background:#eeebeb; -webkit-text-size-adjust:none" bgcolor="#eeebeb">
    <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
        <tr>
            <td align="center" valign="top" style="background-color:#eeebeb" width="100%">
                <center>
                    <table cellspacing="0" cellpadding="0" width="600" class="w320">
                        <tr>
                            <td align="center" valign="top">
                                <table cellspacing="0" cellpadding="0" bgcolor="#363636" class="force-full-width">
                                    <tr>
                                        <td style="font-size:12px;">
                                            &nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color:#ffa33b; font-size: 30px; text-align:center; font-weight: bold;">
                                        MedCharity
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">
                                            &nbsp;
                                        </td>
                                    </tr>
                                </table>
                                <table cellspacing="0" cellpadding="0" class="force-full-width" style="background-color:#3bcdb0;">
                                    <tr>
                                        <td style="background-color:#ffa33b; padding-left: 20px; padding-right: 20px;">
                                            <table cellspacing="0" cellpadding="0" class="force-full-width">
                                                <tr>
                                                    <td style="font-size:30px; font-weight: 600; color: #ffffff; text-align:center;" class="mobile-spacing">
                                                        <br>
                                                        You are Warned
                                                        <br>
                                                        <p style="font-size:16px; font-weight: 500; color: #000000;">
                                                            by admin to donate at MedCharity due to your last useless donation.
                                                            <br><br>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>

                                <table cellspacing="0" cellpadding="0" class="force-full-width" bgcolor="#ffffff">
                                    <tr>
                                        <td style="background-color:#ffffff;">
                                            <table class="columns" cellspacing="0" cellpadding="0" width="100%" align="right">
                                                <tr>
                                                    <td class="column-padding" style="text-align:left; vertical-align:top; padding-left: 20px; padding-right:30px;">
                                                        <br>
                                                        <span style="color:#ffa33b; font-size:16px; font-weight:bold;">
                                                            Hey {{$donatorname}}, Here is your feedback for your last donation.
                                                        </span>
                                                        <br><br>
                                                        <span style="font-size:15px; color:#ffa33b;">
                                                            {{$fcategoryname}}
                                                        </span>
                                                        <br><br>
                                                        <span style="font-size:14px;">
                                                            {{$fdescription}}
                                                        </span>
                                                        <br><br>
                                                        <span style="font-size:14px;">
                                                            NGO : {{$ngoname}}
                                                            <br>
                                                            Donation Date : {{$date}}
                                                        </span>
                                                        <br><br><br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table cellspacing="0" cellpadding="0" bgcolor="#363636" class="force-full-width">
                                    <tr>
                                        <td style="color:#f0f0f0; font-size: 12px; text-align:center; padding-bottom:4px;">
                                            <br>
                                            © 2020 | MedCharity | All Rights Reserved
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color:#ffa33b; font-size: 12px; text-align:center;">
                                            View in browser | Contact
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">
                                            &nbsp;
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </center>
            </td>
        </tr>
    </table>
</body>

</html>