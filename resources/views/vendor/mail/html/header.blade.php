<tr>
    <td style="vertical-align:top; width:600px; height:200px; color: #fefefe;
        background-color:  rgba(253,249,241,0.76);">
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
            <tr>
                <td style="height: 20px; line-height: 10px; font-size: 10px; width: 100%; padding-top: 20px;" align="center">
                    <div style="margin-left: auto; margin-right: auto">
                        <img src="{{ asset('img/app-logo-128x128.png') }}" width="60px" height="60px">
                    </div>
                </td>
            </tr>
            <tr>
                <td style="height: 20px; line-height: 20px; width: 100%;padding-top: 60px;
                color: #F1FDFF; text-align: center" align="center">
                    <p style="font-size: 18px;font-weight: bold; color: rgba(76,76,76,0.98); text-align: center;
margin-left: auto; margin-right: auto">
                        {{ $slot }}
                    </p>
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
