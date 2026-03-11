<table width="100%" cellpadding="0" cellspacing="0" style="background:#f3f4f6;padding:40px 0;font-family:Arial,Helvetica,sans-serif">

    <tr>
        <td align="center">

            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:10px;padding:40px">

                <!-- HEADER -->
                <tr>
                    <td align="center" style="padding-bottom:20px">

                        <h2 style="margin:0;color:#0f766e">
                            Verifikasi Email
                        </h2>

                    </td>
                </tr>


                <!-- TEXT -->
                <tr>
                    <td align="center" style="color:#374151;font-size:14px;padding-bottom:25px">

                        Gunakan kode berikut untuk memverifikasi akun anda.

                    </td>
                </tr>


                <!-- OTP -->
                <tr>
                    <td align="center" style="padding-bottom:30px">

                        <div style="
                            display:inline-block;
                            padding:15px 30px;
                            font-size:32px;
                            font-weight:bold;
                            letter-spacing:8px;
                            background:#f0fdfa;
                            color:#0f766e;
                            border-radius:8px;
                            border:1px dashed #0d9488;
                        ">

                            {{ $otp }}

                        </div>

                    </td>
                </tr>


                <!-- INFO -->
                <tr>
                    <td align="center" style="font-size:13px;color:#6b7280;padding-bottom:20px">

                        Kode ini berlaku selama <b>10 menit</b>.

                    </td>
                </tr>


                <!-- FOOTER -->
                <tr>
                    <td align="center" style="font-size:12px;color:#9ca3af">

                        Jika anda tidak meminta kode ini, silakan abaikan email ini.

                    </td>
                </tr>

            </table>

        </td>
    </tr>

</table>