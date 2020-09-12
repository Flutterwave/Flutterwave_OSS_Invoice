<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Goto Dispatch</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Avenir" rel="stylesheet">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Montserrat:400,700,400italic">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato:400,700,400italic">

</head>
<body style="padding:0;" bgcolor="#eaeced">

<style type="text/css">
    * {
        -ms-text-size-adjust:100%;
        -webkit-text-size-adjust:none;
        -webkit-text-resize:100%;
        text-resize:100%;
        font: 14px/25px Avenir, Montserrat, Lato, sans-serif;
    }
    a{
        outline:none;
        color:#40aceb;
        text-decoration:underline;
    }
    a:hover{text-decoration:none !important;}
    .nav a:hover{text-decoration:underline !important;}
    .title a:hover{text-decoration:underline !important;}
    .title-2 a:hover{text-decoration:underline !important;}
    .btn:hover{opacity:0.8;}
    .btn a:hover{text-decoration:none !important;}
    .btn{
        -webkit-transition:all 0.3s ease;
        -moz-transition:all 0.3s ease;
        -ms-transition:all 0.3s ease;
        transition:all 0.3s ease;
    }
    .amt-text-b{
        color: #8B8C8E;
        font-weight: lighter;
    }
    .receipt-box{
        position: relative; top: 51px;
    }
    .content-text{
        margin:0; font-size: 16px;
    }
    @media only screen and (max-width:470px) {
        .receipt-box {
            position: relative;
            top: 30px;
        }
    }
    table td {border-collapse: collapse !important;}
    .ExternalClass, .ExternalClass a, .ExternalClass span, .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div{line-height:inherit;}
    @media only screen and (max-width:500px) {
        table[class="flexible"]{width:100% !important;}
        table[class="center"]{
            float:none !important;
            margin:0 auto !important;
        }
        *[class="hide"]{
            display:none !important;
            width:0 !important;
            height:0 !important;
            padding:0 !important;
            font-size:0 !important;
            line-height:0 !important;
        }
        td[class="aligncenter"]{text-align:center !important;}
        th[class="flex"]{
            display:block !important;
            width:100% !important;
        }
        td[class="wrapper"]{padding:0 !important;}
        td[class="holder"]{padding:30px 15px 20px !important;}
        td[class="nav"]{
            padding:20px 0 0 !important;
            text-align:center !important;
        }
        td[class="h-auto"]{height:auto !important;}
        td[class="description"]{padding:30px 20px !important;}
        td[class="i-120"] img{
            width:120px !important;
            height:auto !important;
        }
        td[class="footer"]{padding:5px 20px 20px !important;}
        td[class="footer"] td[class="aligncenter"]{
            line-height:25px !important;
            padding:20px 0 0 !important;
        }
        tr[class="table-holder"]{
            display:table !important;
            width:100% !important;
        }
        th[class="thead"]{display:table-header-group !important; width:100% !important;}
        th[class="tfoot"]{display:table-footer-group !important; width:100% !important;}
    }
</style>

<table style="min-width:320px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#eaeced">
    <!-- fix for gmail -->
    <tbody><tr>
        <td class="hide">
            <table style="width:600px !important;" width="600" cellspacing="0" cellpadding="0">
                <tbody><tr>
                    <td style="min-width:600px; font-size:0; line-height:0;">&nbsp;</td>
                </tr>
                </tbody></table>
        </td>
    </tr>
    <tr>
        <td class="wrapper" style="font-family: 'Avenir', 'Montserrat', 'Lato', sans-serif, Arial">
            <!-- module 1 -->
            <table data-module="module-2" width="100%" cellspacing="0" cellpadding="0">
                <tbody><tr>
                    <td data-bgcolor="bg-module" bgcolor="#eaeced">
                        <table class="flexible" style="margin:0 auto;" width="600" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                            <tr>
                                <td style="vertical-align:top; width:600px; height:200px; color: #fefefe;
                                background-color: #255B1C;
                                background-image: url('{{ asset('img/grid_lines.png') }}');
                                background-size: 100% 65%;background-position: bottom;background-repeat: no-repeat;">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="height: 20px; line-height: 10px; font-size: 10px; width: 100%; padding-top: 20px;" align="center">
                                                <img src="{{ asset('img/gd_logo.png') }}" width="60px" height="60px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 20px; line-height: 20px; width: 100%;padding-top: 60px; color: #F1FDFF;" align="center">
                                                <p style="font-size: 20px;font-weight: bold; color: #ffffff; text-align: center">
                                                    {{ $title }}
                                                </p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td data-bgcolor="bg-block" class="holder" style="padding:58px 60px 12px; color: #626365;" bgcolor="#E6E7E9">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr class="">
                                            <td>
                                                <h3 class="content-text">Hi {{ $name ?? '' }}, </h3><br>
                                                <p class="content-text">
                                                    {!! $message !!}

                                                    <br>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <p class="content-text" style="margin:0;padding-top:10px">
                                                    <br>
                                                    Please, connect with us via the platforms below or give feedback by responding to this email.
                                                </p>
                                                <p class="content-text" style="margin:0;padding-top:30px">
                                                    Best Regards, <br />
                                                    Goto Dispatch.</p>
                                                <br />
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:bottom; width:600px; height:50px; color: #fefefe; background-color: #255B1C; padding: 15px 0;">
                                    <table width="80%" cellspacing="0" cellpadding="0" align="center">
                                        <tbody><tr>
                                            <td style="font-size: 8px; line-height: 22px;" valign="middle" align="center">
                                       <span style="font-size: 10px; color: #CDD9E8;">
                                          <a href="#" target="_blank" style="color: #CDD9E8; font-size: 10px; text-decoration: none; margin-right: 0.5%;">Home</a> |
                                          <a href="#" target="_blank" style="color: #CDD9E8; font-size: 10px; text-decoration: none; margin-right: 0.5%; margin-left: 0.5%;">Support</a> |
                                          <a href="#" target="_blank" style="color: #CDD9E8; font-size: 10px; text-decoration: none; margin-left: 0.5%;">Contact</a>
                                      </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 8px; line-height: 22px;" valign="middle" align="center">
                                                <a target="_blank" href="https://twitter.com/" style="text-decoration: none;">
                                                    <img src="{{ asset('img/twitter.png') }}" style="width: 16px; height: 16px; margin-right: 1%;">
                                                </a>
                                                <a target="_blank" href="https://www.instagram.com/" style="text-decoration: none;">
                                                    <img src="{{ asset('img/instagram.png') }}" style="width: 16px; height: 16px; margin-right: 1%;">
                                                </a>
                                                <a target="_blank" href="https://www.facebook.com/" style="text-decoration: none;">
                                                    <img src="{{ asset('img/facebook.png') }}" style="width: 16px; height: 16px; margin-right: 1%;">
                                                </a>
                                                <a target="_blank" href="https://www.medium.com/" style="text-decoration: none;">
                                                    <img src="{{ asset('img/medium.png') }}" style="width: 18px; height: 18px; margin-right: 1%;">
                                                </a>
                                                <a target="_blank" href="tel:+09090000000" style="text-decoration: none;">
                                                    <img src="{{ asset('img/whatsapp.png') }}" style="width: 16px; height: 16px;">
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody></table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <!-- module 7 -->
            <table data-module="module-7" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td data-bgcolor="bg-module" bgcolor="#eaeced">
                        <table class="flexible" style="margin:0 auto;" width="600" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                            <tr>
                                <td class="footer" style="padding:0 0 20px;">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody><tr class="table-holder">
                                            <th class="tfoot" style="vertical-align:top; padding:7px 0 0 0;" width="400" align="center">
                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                    <tbody><tr>
                                                        <td data-color="text" data-link-color="link text color" data-link-style="text-decoration:underline; color:#797c82;" class="aligncenter" style="font:12px/16px Avenir, Geneva, sans-serif; color:#797c82; padding:0 0 10px;" align="center">
                                                            © {{ date('Y') }} Goto Dispatch. @lang('All rights reserved.')
                                                        </td>
                                                    </tr>
                                                    </tbody></table>
                                            </th>
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

        </td>
    </tr>
    </tbody></table>

</body>
</html>
