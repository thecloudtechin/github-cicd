<!--<h1>Hi, {{ $name }}</h1>-->
<!--<p>Sending Mail using Lumen.</p>-->

<html>

<body>
    <div>
        <center style="background-color:#f6f6f6;border-bottom-color:#9B1B25;border-bottom-style:solid;border-bottom-width:5px;width:100%">
            <div style="margin:0 auto">
                <table style="border-spacing:0;font-family:sans-serif;color:#333;margin:0 auto;width:100%;border-collapse:collapse" width="100%" align="center">
                    <tbody>
                        <tr>
                            <td align="center" width="100%">
                                <a rel="nofollow" style="text-decoration:none" href="" target="_blank" data-saferedirecturl=""> <img style="line-height:100%;text-decoration:none;border:0;width: 40%;" src="https://deliveryguru.co.uk/images/hotelogo/{{$hotel_id}}.png"  border="0"></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </center>
        <center style="width:100%;table-layout:fixed;background:#f6f6f6">
            <div style="margin:0 auto">
                <br>
                <table style="border-spacing:0;font-family:sans-serif;color:#333;border-collapse:collapse">
                    <tbody>
                        <tr>
                            <td style="padding:0;width:10px" width="10">&nbsp;</td>
                            <td style="padding:0">
                                <table style="border-spacing:0;font-family:sans-serif;color:#333;margin:0 auto;width:100%;background:#fff;border-collapse:collapse" width="100%" align="center">
                                    <tbody>
                                        <tr>
                                            <td style="padding:0;font-size:0" height="24">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0" align="center"><h4 style="color:green;">Thanks for Booking</h4></td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0;font-size:0" height="24">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0">
                                                <h1 style="color:#212121;font-family:Montserrat,-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;line-height:1.6;font-size:28px;font-weight:300;text-align:center;margin:0 16px 16px 16px">Your booking at <strong style="font-weight:bold">{{ $created_date }}</strong></h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0;font-size:0" height="20">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0;text-align:center;font-size:0" align="left">
                                                <div style="vertical-align:top;width:50%">
                                                    <table style="border-spacing:0;font-family:sans-serif;color:#333;border-collapse:collapse;width:100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding:0" align="left" valign="top">
                                                                    <h3 style="font-family:Montserrat,-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;font-weight:400;line-height:1.6;text-align:left;font-size:18px;color:#9B1B25;margin:0 16px 8px 16px"><span>Booking Reference</span></h3>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:0" align="left" valign="top">
                                                                    <div style="color:#212121;font-family:-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;font-size:16px;font-weight:400;line-height:1.6;text-align:left;margin:0 16px 16px 16px">{{ $bookingid }} {{$time}} {{$timing}}</div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div style="vertical-align:top;width:50%">
                                                    <table style="border-spacing:0;font-family:sans-serif;color:#333;border-collapse:collapse;width:100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding:0" align="left" valign="top">
                                                                    <h3 style="font-family:Montserrat,-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;font-weight:400;line-height:1.6;text-align:left;font-size:18px;color:#9B1B25;margin:0 16px 8px 16px"><span>Reservation Name</span></h3>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:0" align="left" valign="top">
                                                                    <div style="color:#212121;font-family:-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;font-size:16px;font-weight:400;line-height:1.6;text-align:left;margin:0 16px 16px 16px">{{ $name }}</div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div style="line-height:22px;font-size:20px">&nbsp;</div>
                                                <div style="vertical-align:top;width:50%">
                                                    <table style="border-spacing:0;font-family:sans-serif;color:#333;border-collapse:collapse;width:100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding:0" align="left" valign="top">
                                                                    <h3 style="font-family:Montserrat,-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;font-weight:400;line-height:1.6;text-align:left;font-size:18px;color:#9B1B25;margin:0 16px 8px 16px"><span>Number of People</span></h3>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:0" align="left" valign="top">
                                                                    <div style="color:#212121;font-family:-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;font-size:16px;font-weight:400;line-height:1.6;text-align:left;margin:0 16px 16px 16px">{{ $person }} people</div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div style="vertical-align:top;width:50%">
                                                    <table style="border-spacing:0;font-family:sans-serif;color:#333;border-collapse:collapse;width:100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding:0" align="left" valign="top">
                                                                    <h3 style="font-family:Montserrat,-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;font-weight:400;line-height:1.6;text-align:left;font-size:18px;color:#9B1B25;margin:0 16px 8px 16px"><span>Booked Date</span></h3>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:0" align="left" valign="top">
                                                                    <div style="color:#212121;font-family:-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;font-size:16px;font-weight:400;line-height:1.6;text-align:left;margin:0 16px 8px 16px">{{ $created_date}} </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                               </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0;font-size:0" height="24">&nbsp;</td>
                                        </tr><tr>
                                            <td style="padding:0;text-align:left;font-size:0" align="left">
                                                <h3 style="font-family:Montserrat,-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;font-weight:400;line-height:1.6;text-align:left;font-size:18px;color:#9B1B25;margin:0 16px 8px 16px">Contact</h3>
                                                <div style="vertical-align:top;width:50%">
                                                    <table style="border-spacing:0;font-family:sans-serif;color:#333;border-collapse:collapse;width:100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding:0" align="left" valign="top">
                                                                    <div style="color:#212121;font-family:-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;font-size:16px;font-weight:400;line-height:1.6;text-align:left;margin:0 16px 16px 16px">{{ $phonenumber}}</div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0;font-size:0" height="24">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0">
                                                <h3 style="font-family:Montserrat,-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;font-weight:400;line-height:1.6;text-align:left;font-size:18px;color:#9B1B25;margin:0 16px 8px 16px"><span>Customer Support</span></h3>
                                                <div style="color:#212121;font-family:-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;font-size:16px;font-weight:400;line-height:1.6;text-align:left;margin:0 16px 16px 16px"><strong style="font-weight:bold">Any questions?</strong>contact us on
                                                    <a rel="nofollow" style="color:#9B1B25;text-decoration:none" href="mailto:{{$hotel_email}}" target="_blank">order@deliveryguru.co.uk</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td style="padding:0;width:10px" width="10">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </center>
        <center style="width:100%;table-layout:fixed;background:#f6f6f6">
            <div style="margin:0 auto">
                <table style="border-spacing:0;font-family:sans-serif;color:#333;margin:0 auto;width:100%;border-collapse:collapse" width="100%" align="center">
                    <tbody>
                        <tr>
                            <td style="padding:0;font-size:0" height="10">&nbsp;</td>
                        </tr>
                        <tr>
                            <tdstyle="padding:10px">
                                <table style="border-spacing:0;font-family:sans-serif;color:#333;border-collapse:collapse" width="100%">
                                    <tbody>
                                        <tr>
                                            <td style="padding:0">
                                                <table style="border-spacing:0;font-family:sans-serif;color:#333;border-collapse:collapse" border="0" width="100%" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding:0" align="center">
                                                                <div style="color:#212121;font-weight:400;line-height:1.6;font-size:11px;font-family:Montserrat,-apple-system,BlinkMacSystemFont,avenir next,avenir,Segoe UI,helvetica neue,helvetica,sans-serif;text-align:center;margin:10px 16px 16px 16px"><a href="">deliveyguru.co.uk | All Rights Reserved.</a></div>
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
            </div>
        </center>
    </div>
</body>

<html>

