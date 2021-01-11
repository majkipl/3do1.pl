<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        u + .body {
            line-height: 100% !important;
        }
    </style>
</head>
<body>
<div style="margin: 0 auto; width: 650px;">
    <table style="float: left;" width="650" cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
            <td>
                <img src="{{ asset('images/mail/mailing-varta_01.jpg') }}" alt="VARTA 3:1" moz-do-not-send="true"/>
            </td>
        </tr>
        </tbody>
    </table>
    <table style="float: left; text-align: center; font-family: Arial, Helvetica, sans-serif; color: #091742;"
           width="650" cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
            <td width="50"><br></td>
            <td>
                <div style=" font-size: 24px;">
                    <b> Dziękujemy za udział w naszej akcji! </b>
                </div>
            </td>
            <td width="50"><br></td>
        </tr>
        <tr>
            <td height="20"><br></td>
        </tr>
        <tr>
            <td width="50"><br></td>
            <td>
                <div style=" font-size: 14px; color: #091742;">Kliknij w ten link:</div>
            </td>
            <td width="50"><br></td>
        </tr>
        <tr>
            <td height="10"><br>
            </td>
        </tr>
        <tr>
            <td width="50"><br></td>
            <td>
                <div style=" font-size: 20px; color: #091742;">
                    <a href="{{ route('front.confirm.application', $details) }}" title="weryfikuj" moz-do-not-send="true">LINK</a>
                </div>
            </td>
            <td width="50"><br></td>
        </tr>
        <tr>
            <td height="10"><br>
            </td>
        </tr>
        <tr>
            <td width="50"><br></td>
            <td>
                <div style=" font-size: 14px; color: #091742;"> aby potwierdzić Twoje zgłoszenie.</div>
            </td>
            <td width="50"><br></td>
        </tr>
        </tbody>
    </table>
    <table style="float: left;" width="650" cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
            <td>
                <img src="{{ asset('images/mail/mailing-varta_02.gif') }}" alt="znajdź nas na:" moz-do-not-send="true"/>
            </td>
        </tr>
        </tbody>
    </table>
    <table style="float: left;" width="650" cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
            <td style="width: 226px;">
                <img src="{{ asset('images/mail/mailing-varta_03.gif') }}"
                     style="border: 0; margin: 0; padding: 0; float: left;" alt="" moz-do-not-send="true"/>
            </td>
            <td style="width: 40px;">
                <a href="https://www.facebook.com/Varta.AGPL" target="blank" moz-do-not-send="true">
                    <img src="{{ asset('images/mail/mailing-varta_04.gif') }}"
                         style="border: 0; margin: 0; padding: 0; float: left;" alt="facebook" moz-do-not-send="true"/>
                </a>
            </td>
            <td style="width: 40px;">
                <img src="{{ asset('images/mail/mailing-varta_05.gif') }}" style="border: 0; margin: 0; padding: 0"
                     alt="" moz-do-not-send="true"/>
            </td>
            <td style="width: 40px;">
                <a href="https://www.youtube.com/user/vartaconsumer" target="blank" moz-do-not-send="true">
                    <img src="{{ asset('images/mail/mailing-varta_06.gif') }}"
                         style="border: 0; margin: 0; padding: 0; float: left;" alt="youtube" moz-do-not-send="true"/>
                </a>
            </td>
            <td style="width: 40px;">
                <img src="{{ asset('images/mail/mailing-varta_07.gif') }}"
                     style="border: 0; margin: 0; padding: 0; float: left;" alt="" moz-do-not-send="true"/>
            </td>
            <td style="width: 40px;">
                <a href="https://www.instagram.com/varta.agpl/" target="blank" moz-do-not-send="true">
                    <img src="{{ asset('images/mail/mailing-varta_08.gif') }}"
                         style="border: 0; margin: 0; padding: 0; float: left;" alt="instagram" moz-do-not-send="true"/>
                </a>
            </td>
            <td style="width: 224px;">
                <img src="{{ asset('images/mail/mailing-varta_09.gif') }}"
                     style="border: 0; margin: 0; padding: 0; float: left;" alt="" moz-do-not-send="true"/>
            </td>
        </tr>
        </tbody>
    </table>
    <table style="float: left;" width="650" cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
            <td>
                <img src="{{ asset('images/mail/mailing-varta_10.gif') }}" alt="" moz-do-not-send="true"/>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
