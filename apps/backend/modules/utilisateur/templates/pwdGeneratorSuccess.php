<h1>Générer un mot de passe crypté</h1>
<div id="tableauSaisie">
    <form method="post" action="">
        <table>
            <tr>
                <th>
                    Mot de passe
                </th>
                <td>
                    <input id="pwdToConvert" type="text" name="password" size=34 maxlength=32>
                    <input id="convertPwd" type="button" value="Convertir" onClick="document.getElementById('pwdToConvert').value=hex_md5(hex_sha1(document.getElementById('pwdToConvert').value))">
                </td>
            </tr>
        </table>
    </form>
</div>