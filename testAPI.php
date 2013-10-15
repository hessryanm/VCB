<?php

    if (isset($_POST['submit']))
    {
        $token = isset($_POST['token'])? trim(strtolower($_POST['token'])) : '';
        $section = trim(strtolower($_POST['section']));
        $method = trim(strtolower($_POST['method']));
        
        $query = array();
        
        if (is_array($_POST['var']) && is_array($_POST['val']))
        {
            for ($x = 0; $x <= count($_POST['var']) - 1; $x++)
            {
                $var = trim(strtolower($_POST['var'][$x]));
                $val = $_POST['val'][$x];
                
                if (strlen($var) > 0)
                {
                    $query[$var] = $val;
                }
            }
            
        }
        
        if (strlen($token) > 0 && !isset($query['token']))
        {
            $query['token'] = $token;
        }
        
        $url = 'https://alpha.vcallboard.com/api/v1/index.php/'.$section.'/'.$method;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $rsp = curl_exec($ch); // this is the response, as string

        curl_close($ch);
    }
    else
    {
        $token = '';
        $section = '';
        $method = '';
        $rsp = '';
        $query = array();
    }

?>
<html>
    <head>
        <title>EmptySpace API development tool</title>
        <style type="text/css">
            body {
                padding: 0px;
                margin: 0px;
            }
        </style>
        <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    </head>
    <body>
        <form method="post" action="">
            <table width="100%">
                <tr bgcolor="#333333">
                    <td style="padding:5px;color:white;">
                        API development tool
                    </td>
                </tr>
            </table>
            <table width="100%">
                <tr bgcolor="#dddddd">
                    <td>
                        Request
                    </td>
                    <td width="100%">
                        Response
                    </td>
                </tr>
                <tr>
                    <td valign="top" style="height:20px;">
                        <table>
                            <tr>
                                <td>
                                    Token:
                                </td>
                                <td>
                                    <input type="text" name="token" value="<?=$token?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Section:
                                </td>
                                <td>
                                    <input type="text" name="section" value="<?=$section?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Method:
                                </td>
                                <td>
                                    <input type="text" name="method" value="<?=$method?>" />
                                </td>
                            </tr>
                        </table>
                        <table width="100%" id="variables" style="height:20px;">
                            <tr bgcolor="#dddddd">
                                <td colspan="3">
                                    Variables
                                </td>
                            </tr>
                            <tr bgcolor="#eeeeee">
                                <td width="10%">
                                    Variable
                                </td>
                                <td width="80%">
                                    Value
                                </td>
                                <td>
                                    <input type="button" value="+" onclick="add_var_row()" style="width:30px;" />
                                </td>
                            </tr>
                            <? if (count($query) == 0): ?>
                            <tr id="var_1">
                                <td>
                                    <input type="text" name="var[]" />
                                </td>
                                <td>
                                    <input type="text" name="val[]" style="width:300px;" />
                                </td>
                                <td>
                                    <input type="button" value="x" onclick="remove_var_row(1)" style="width:30px;" />
                                </td>
                            </tr>
                            <tr id="var_2">
                                <td>
                                    <input type="text" name="var[]" />
                                </td>
                                <td>
                                    <input type="text" name="val[]" style="width:300px;" />
                                </td>
                                <td>
                                    <input type="button" value="x" onclick="remove_var_row(2)" style="width:30px;" />
                                </td>
                            </tr>
                            <? else: ?>
                            <? foreach ($query as $var => $val): ?>
                            <? if ($var == 'token') continue ?>
                            <? $r = rand(1000, 5000); ?>
                            <tr id="var_<?=$r?>">
                                <td>
                                    <input type="text" name="var[]" value="<?=$var?>" />
                                </td>
                                <td>
                                    <input type="text" name="val[]" style="width:300px;" value="<?=$val?>" />
                                </td>
                                <td>
                                    <input type="button" value="x" onclick="remove_var_row(<?=$r?>)" style="width:30px;" />
                                </td>
                            </tr>
                            <? endforeach; ?>
                            <? endif; ?>
                        </table>
                        <table width="100%">
                            <tr bgcolor="#dddddd">
                                <td align="right" style="height:20px;">
                                    <input type="submit" name="submit" value="Send request &rarr;" /> 
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td rowspan="4" valign="top">
                        <pre><?=$rsp?></pre>
                        <hr />
                        <pre><?print_r(json_decode($rsp))?></pre>
                    </td>
                </tr>
            </table>
        </form>
        <script>
            function add_var_row()
            {
                var id = Math.floor((Math.random() * 1000) + 1);
                var code  = '<tr id="var_' + id + '">';
                    code += '<td>';
                    code += '<input type="text" name="var[]" /\>';
                    code += '</td>';
                    code += '<td>';
                    code += '<input type="text" name="val[]" style="width:300px;" /\>';
                    code += '</td>';
                    code += '<td>';
                    code += '<input type="button" value="x" onclick="remove_var_row(' + id + ')" style="width:30px;" /\>';
                    code += '</td>';
                    code += '</tr>';

                $('#variables tr:last').after(code);
            }
            
            function remove_var_row(id)
            {
                $('#var_' + id).remove();
            }
        </script>
    </body>
</html>
