<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bite_Blitz">
    <meta name="author" content="Bite_Blitz">
    <title>Your OTP for forgot password.</title>
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-family: 'Roboto', sans-serif;
        }
        span {
            font-family: 'Roboto', sans-serif;
            padding: 8px 0px 0px 0px;
            color: #465280;
            font-size: 14px;
            line-height: 22px;
            margin:0px;"
        }
    </style>
</head>

<body style="margin: 0; padding: 0;">
    <table role="presentation" style="width: 100%; border-collapse: collapse; border: 0; border-spacing: 0; background: #F8F5F4;">
        <tr>
            <td align="center" style="padding: 0;">
                <table role="presentation" style="width: 602px; border-collapse: collapse; border: 1px solid #cccccc; border-spacing: 0; text-align: left;">
                    <tr>
                        <td align="center" style="padding: 20px 20px 10px 30px; background: #ffffff;">
                            <img src="img/ealogo.png" alt="" width="140" style="height: auto; display: block;" />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px 40px 30px 40px; background: #FAFBFD; text-align: center;">
                            <table role="presentation" style="width: 100%; border-collapse: collapse; border: 0; border-spacing: 0;">
                                <tr>
                                    <td style="padding: 0 0 0px 0; color: #153643; text-align: center;">
                                        <h1 style="font-family: 'Roboto', sans-serif; padding: 8px 0px 10px 0px; color: #465280; font-size: 14px; line-height: 18px; margin: 0px;"></h1>

                                        <p style="font-family: 'Roboto', sans-serif; padding: 8px 0px 10px 0px; color: #465280; font-size: 17px; line-height: 18px; margin: 0px;">Dear {{ $user->name }},</p>

                                        <p style="font-family: 'Roboto', sans-serif; padding: 8px 0px 0px 0px; color: #465280; font-size: 19px; line-height: 22px; margin: 0px;">
                                            Your otp is : <strong> {{ $user->otp }}</strong>
                                        </p><br>

                                        <div style="text-align: left;">
                                            <span>Best Regards, </span><br>
                                            <span>Velvet Brew</span><br>
                                            <span>Customer Support Team</span><br>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>


</html>
