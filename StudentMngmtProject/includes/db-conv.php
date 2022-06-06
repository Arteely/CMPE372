<?php
function db_l_type_enum_to_human($db_enum)
{
    static $c_table = ['inperson' => "In Person", "remote-zoom" => "Zoom"];
    return $c_table[$db_enum];
}
?>
